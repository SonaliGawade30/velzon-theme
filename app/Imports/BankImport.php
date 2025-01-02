<?php
namespace App\Imports;

use App\Models\BankModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;



class BankImport implements ToModel,WithHeadingRow
{
    /**clear
     * Map each row in the Excel file to the database model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        // print_r($row);
        // die;
        return new BankModel([
            'holdername'    => $row['holdername'],   // Assuming column 1 is holdername
            'accountnumber' => $row['accountnumber'],   // Assuming column 2 is accountnumber
            'ifsccode'      => $row['ifsccode'],   // Assuming column 3 is ifsccode
            'country_id'    => $row['country_id'],   // Assuming column 4 is country_id
            'state_id'      => $row['state_id'],   // Assuming column 5 is state_id
            'city_id'       => $row['city_id'], 
             'image'       => $row['image'],  // Assuming column 6 is image
        ]);
    }

}
