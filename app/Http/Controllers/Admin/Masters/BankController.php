<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Imports\BankImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\BankModel;
use App\Models\Country;
use App\Models\Addmore;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Masters\{BankRequest,UpdateBankRequest};
use App\Http\Controllers\Admin\Controller; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class BankController extends Controller
{
    public function index()
    {
        $banks = BankModel::with(['country', 'state', 'city'])->get();
        // using joins show name
        // $bank = DB::table('bank')
        //         ->select('bank.*','countries.name')
        //          ->lefttJoin('countries' ,'countries.id','=','bank.country_id')
        //          ->get();
        $countries = Country::latest()->get();
        $states = State::latest()->get();
        $cities = City::latest()->get();
        $add = Addmore::latest()->get();
        return view('admin.masters.bank', compact('banks','countries','states','cities','add'));
    }

    public function getStates($country_id)
    {
        $states = State::where('country_id', $country_id)->get();
        return response()->json($states);
    }

    public function getCities($state_id)
    {
        $cities = City::where('state_id', $state_id)->get();
        return response()->json($cities);
    }

    public function create()
    {
        //
    }
      
    public function import(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'importratefile' => 'required|mimes:xlsx,csv',
            ]);

            Excel::import(new BankImport, $request->file('importratefile'));

            DB::commit();

            return response()->json(['success' => 'Bank imported successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'creating', 'bank');
        }
    }
   
    public function store(BankRequest $request)
    {
            DB::beginTransaction();
            try {
                $input = $request->validated();

                if ($request->hasFile('images')) {
                    $input['image'] = $request->images->store('uploads');
                }
                if ($request->has('technologies')) {
                    $input['technologies'] =   implode(",", $request->input('technologies')); // Get the array of selected technologies
                }
                if ($request->has('process')) {
                    $input['process'] = $request->input('process'); 
                }
                $banks = BankModel::create(Arr::only($input, BankModel::getFillables()));
           
                // Check if 'location' is present and it's an array
                if (isset($input['location']) && is_array($input['location'])) {
                    foreach ($input['location'] as $key => $location) {
                        
                        $createData = new Addmore([
                            'location' => $location,
                            'mobile' => isset($input['mobile'][$key]) ? $input['mobile'][$key] : null,
                            'document' => isset($input['document'][$key]) ? $input['document'][$key] : null,
                            'nominee' => isset($input['nominee'][$key]) ? $input['nominee'][$key] : '', 
                        ]);                      
                        if ($request->hasFile('document') && $request->file('document')[$key]->isValid()) {
                            $document = $request->file('document')[$key];
                            $documentPath = $document->store('addmore_doc/documents');
                            $createData->document = $documentPath;
                        } else {
                            $createData->document = null; 
                        }
                        $banks->bank()->save($createData);
                    }
                } else {
                    return response()->json(['error' => 'Location data is missing or invalid.']);
                }

                DB::commit();    
                return response()->json(['success' => 'Account created successfully']);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['error' => 'Error occurred: ' . $e->getMessage()]);
            }
    }
        
    public function show(string $id)
    {
        //
    }

    
    public function edit(BankModel $bank, Addmore $add)
    {
        // return $bank;
        $states = State::latest()->get();
        $cities = City::latest()->get();


        if ($bank) 
        {
            // for state edit
            $stateHtml = '<span>
            <option value="">--Select--</option>';
            foreach($states as $state):
                $is_select = $state->id == $bank->state_id ? "selected" : "";
                $stateHtml .= '<option value="'.$state->id.'" '.$is_select.'>'.$state->name.'</option>';
            endforeach;
           $stateHtml .= '</span>';
            // for city edit
            $cityHtml = '<span>
            <option value="">--Select--</option>';
            foreach($cities as $city):
                $is_select = $city->id == $bank->city_id ? "selected" : "";
                $cityHtml .= '<option value="'.$city->id.'" '.$is_select.'>'.$city->name.'</option>';
            endforeach;
            $cityHtml .= '</span>';

                // for technology edit

            $data = config('default.months');
            $techData = collect($bank->technologies);
    
                $arr = explode(",", $bank->technologies);   
                $techHtml = '<span>';
                foreach ($data as $value) {
                    $is_select = in_array($value['id'], $arr) ? "selected" : '';                  
                    $techHtml .= '<option value="' . $value['id'] . '" ' . $is_select . '>' . $value['name'] . '</option>';
                }         
            $techHtml .= '</span>';
            
            // Fetch the 'addmore' data
            $addmoreData = Addmore::where('bank_id', $bank->id)->get();
            $adddata = config('locationdefault.locations');
            $tableRows = '';

            foreach ($addmoreData as $index => $rowData) 
            {
                
                $tableRows .= '<tr>';
                $tableRows .= '<td><input type="hidden" name="auto_id[]" value="' . $rowData->id . '" class="form-control" ></td>';
                $tableRows .= '<td>';
                $tableRows .= '<select name="location[]" class="form-control">';
                $tableRows .= '';
                foreach ($adddata as $info) {
                    $is_select = $info['id'] == $rowData->location ? "selected" : "";
                    $tableRows .='<option value="' . $info['id'] . '" ' . $is_select . '>' . $info['name'] . '</option>';
                }
                $tableRows .= '</select>';
                $tableRows .= '</td>';
                $tableRows .= '<td><input type="text" name="mobile[]" value="' . $rowData->mobile . '" class="form-control" ></td>';
                $tableRows .= '<td>';
                $options = ['nominee1', 'nominee2', 'nominee3'];
                foreach ($options as $option) {
                    $checked = ($option == $rowData->nominee) ? 'checked' : '';
                    $formattedOption = ucwords(str_replace('_', ' ', $option));
                    $tableRows .= '<label><input type="radio" name="nominee[' . $index . ']" value="' . $option . '" ' . $checked . '> ' . ucfirst($formattedOption) . '</label>';
                }
                $tableRows .= '</td>';
                $tableRows .= '<td><input type="file" name="document[]" class="form-control">' . 
                            (!empty($rowData->document) ? '<a href="'.asset('storage/'.$rowData->document).'" target="_blank" class="btn btn-sm btn-primary">View File</a>' : '<label>No document</label>') . 
                            '</td>';
                $tableRows .= '<td><a href="javascript:;" data-id="' . $rowData->id . '" class="btn btn-sm btn-danger deleteAddMore"><i class="fa fa-remove"></i></a></td>';
                $tableRows .= '</tr>';               
            }
            $locationjson = json_encode($adddata);
              
                        $response=[
                            'result'=>1,
                            'bank'=>$bank,
                            'tableRows' =>$tableRows,
                            'locationjson'=>$locationjson,
                            'stateHtml' => $stateHtml,  
                            'cityHtml' => $cityHtml,
                            'technologiesHtml'=>$techHtml,               
                            'selectedTechnologies' => $arr, 
                        ];           
        }
        else
        {
            $response=['result'=>0];
        }
        return $response;
    }
 
    public function update(UpdateBankRequest $request, BankModel $bank)
    {
       try{

            DB::beginTransaction();
            $input=$request->validated();
            if ($request->hasFile('images')) 
            {
                           
                $input['image'] = $request->images->store('uploads');
            }
            if ($request->has('technologies'))
            {
                $input['technologies'] =   implode(",", $request->input('technologies')); 
            }
            $bank->update(Arr::only($input,BankModel::getFillables()));

                 // -- start---
                 if(isset($input['auto_id'])){
                    foreach ($input['auto_id'] as  $key => $auto_id) {
                        if($auto_id!=''){
                            $updateData=[
                            'mobile'=> $input['mobile'][$key],
                             'location' => $input['location'][$key],
                             'nominee' =>isset($input['nominee'][$key]) ? $input['nominee'][$key] : 'nominee1',
                                        ];
                                        $updateFileds = Addmore::where('id',$auto_id)->first(); 
                                        $updateFileds->update($updateData);
                                //document
                                if (isset($input['document'][$key])) {
                                    $document = $input['document'][$key];
                                    if ($document->isValid()) {
                                        $filePath = public_path('storage/' . $updateFileds->document);
                                        if (File::exists($filePath)) {
                                            File::delete($filePath);
                                        }                
                                        $documentPath = $document->store('addmore_doc/documents');
                                        $updateFileds->document = $documentPath;
                                        $updateFileds->save();
                                    }
                                }
                        } else{
                            $createData = new Addmore([
                                
                                'location' => isset($input['location'][$key]) ? $input['location'][$key] : null,
                                 'mobile' => isset($input['mobile'][$key]) ? $input['mobile'][$key] : null,
                                'nominee' => isset($input['nominee'][$key]) ? $input['nominee'][$key] : 'nominee1',
                            ]);
                            if ($request->hasFile('document') && $request->file('document')[$key]->isValid()) {
                                $document = $request->file('document')[$key];
                                $documentPath = $document->store('addmore_doc/documents'); 
                                $createData->document = $documentPath;
                            }
                            
                             $bank->addmo()->save($createData);
                        }
                    }///end foreach
                }
    
            DB::commit();
            return response()->json(['success'=>'bank updated successfully!']);
       }
       catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'bank');
        }
    }

    public function destroy(BankModel $bank)
    {
        try
        {
            DB::beginTransaction();
            $bank->delete();
            DB::commit();

            return response()->json(['success'=> 'bank Account deleted successfully!']);

        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'bank');
        }
    }

    public function deleteSelected(Request $request)
    {
        $request->validate([
            'selected_banks' => 'required|array|min:1',
            'selected_banks.*' => 'exists:bank,id',
        ]);

        $bankIds = $request->input('selected_banks');

        $deleted = BankModel::whereIn('id', $bankIds)->delete();

        if ($deleted) {
            return response()->json(['success' => 'Selected banks have been deleted successfully.']);
        } else {
            return response()->json(['message' => 'An error occurred while deleting the selected banks.'], 500);
        }
    }
}