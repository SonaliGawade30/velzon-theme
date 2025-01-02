<x-admin.layout>
    <x-slot name="title">Banks</x-slot>
    <x-slot name="heading">Banks</x-slot>

    {{-- Add Bank Form --}}
    <div class="row" id="addContainer" style="display:none;">
        <div class="col-sm-12">
            <div class="card">
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h4 class="card-title">Add Bank</h4>
                    </div>
                    
                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="Hname">Holder Name<span class="text-danger">*</span></label>
                                <input class="form-control" id="name" name="holdername" type="text" placeholder="Enter Holder Name">
                                <span class="text-danger is-invalid name_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="BAc">Account Number<span class="text-danger">*</span></label>
                                <input class="form-control" id="name" name="accountnumber" type="text" placeholder="Enter Account Number">
                                <span class="text-danger is-invalid name_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="ifsc">IFSC Code<span class="text-danger">*</span></label>
                                <input class="form-control" id="initial" name="ifsccode" type="text" placeholder="Enter IFSC Code">
                                <span class="text-danger is-invalid initial_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="images">Image</label>
                                <input class="form-control" id="images" name="images" type="file" placeholder="Upload Image">
                                <span class="text-danger is-invalid initial_err"></span>
                            </div>

                            {{-- Country Dropdown --}}
                            <div class="col-md-4">
                                <label class="col-form-label" for="country">Country</label>
                                <select class="form-select" id="country" name="country_id">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger is-invalid country_err"></span>
                            </div>

                            {{-- State Dropdown --}}
                            <div class="col-md-4">
                                <label class="col-form-label" for="state">State</label>
                                <select class="form-select" id="state" name="state_id" >
                                <option value="">Select State</option>
                                </select>
                                <span class="text-danger is-invalid state_err"></span>
                            </div>

                            {{-- City Dropdown --}}
                            <div class="col-md-4">
                                <label class="col-form-label" for="city">City</label>
                                <select class="form-select" id="city" name="city_id" >
                                    <option value="">Select City</option>
                                </select>
                                <span class="text-danger is-invalid city_err"></span>
                            </div>
                            {{-- technology select multiple dropdown --}}
                            <div class="col-md-4">
                                
                                <label class="col-form-label" for="technologies">Technologies</label>
                                
                                <select class="js-example-basic-multiple form-select" id="ms1" name="technologies[]" multiple  placeholder="select technologies">   
                                    <option value="1">Angular</option>
                                    <option value="2" >Bootstrap</option>
                                    <option value="3" >React.js</option>
                                    <option value="4">Vue.js</option>
                                   
                                </select>
                            </div>
                        <!-- select multiple checkbox at a time-->
    
                        <label class="col-form-label" for="city">Process</label>
                        <div class="d-flex flex-wrap">
                            <div class="form-check me-3">
                                <input type="checkbox" class="form-check-input sing-chbx" id="choice" name="process[]" value="01">
                                <label class="form-check-label">Withdraw</label>
                            </div>
                            <div class="form-check me-3">
                                <input type="checkbox" class="form-check-input sing-chbx" name="process[]" value="02">
                                <label class="form-check-label">Balance check</label>
                            </div>
                            <div class="form-check me-3">
                                <input type="checkbox" class="form-check-input" name="process[]" value="03">
                                <label class="form-check-label">Mini statement</label>
                            </div>
                            <div class="form-check me-3">
                                <input type="checkbox" class="form-check-input" name="process[]" value="04">
                                <label class="form-check-label">Change Pincode</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="process[]" value="05">
                                <label class="form-check-label">Deposite Money</label>
                            </div>
                        </div>
                         
                       
            <!-- select multiple checkbox at a time end-->

                        </div>

                        <div class="mb-3 row">
                        </div>
                            
                            <!--------------------------------Add more Start----------------------------->
                            <div class="panel panel-footer">
                                <table class="table  table-responsive table-bordered" id="dynamicAddRemove">
                                    <thead>
                                            <tr>
                                                <th>Location</th>
                                                <th>Mobile</th>                                          
                                                <th>NumberOfNominee</th>  
                                                <th>Document </th>
                                                <th style=""><a href="javascip:" class="btn btn-sm btn-success addMoreForm"><i class="fa fa-plus"></i> </a></th>
                                            </tr>
                                    </thead>
                                    <tbody id="addMore">
                                        <tr>       
                                            <td>
                                                <select class="js-example-basic-single form-control" name="location[]" id="location" >
                                                    <option value="">--Select location--</option>                         
                                                        <option value="1" >Pune</option>
                                                        <option value="2" >Mumbai</option>
                                                        <option value="3" >banglore</option>
                                                        <option value="4" >nashik</option>
                                                </select>  
                                            </td>    
                                            <td>   
                                            <input type="text" name="mobile[]" class="form-control" multiple="" id="mobile">
                                            </td>
                                            <td nowrap>
                                                <input type="radio" name="nominee[]" value="nominee1" class="" multiple=""> Nominee1
                                                <input type="radio" name="nominee[]" value="nominee2" class="" multiple="">  Nominee2
                                                <input type="radio" name="nominee[]" value="nominee3" class="" multiple="">Nominee3
                                            </td>    
                                            <td><input type="file" name="document[]" class="form-control" multiple="" id="document"></td>    
                                            <td style=""><a href="javascip:" class="btn btn-sm btn-danger removeAddMore"><i class="fa fa-remove"></i></a></td>
                                        <tr>
                                    </tbody>
                                </table>
                            </div><br>
                            <!-------------------------------- End -------------------------------------->


                    </div> 
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="addSubmit">Submit</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Bank Form --}}
    <div class="row" id="editContainer" style="display:none;">
        <div class="col">
            <form class="form-horizontal form-bordered" method="post" id="editForm">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Bank</h4>
                    </div>
                    <div class="card-body py-2">
                        <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="Hname">Holder Name<span class="text-danger">*</span></label>
                                <input class="form-control" id="holdername" name="holdername" type="text" placeholder="Enter Holder Name">
                                <span class="text-danger is-invalid name_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="BAc">Account Number<span class="text-danger">*</span></label>
                                <input class="form-control" id="accountnumber" name="accountnumber" type="text" placeholder="Enter Account Number">
                                <span class="text-danger is-invalid name_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="ifsc">IFSC Code<span class="text-danger">*</span></label>
                                <input class="form-control" id="ifsccode" name="ifsccode" type="text" placeholder="Enter IFSC Code">
                                <span class="text-danger is-invalid initial_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="images">Image</label>
                                <input class="form-control" id="images" name="images" type="file" placeholder="Upload Image">
                                <span class="text-danger is-invalid initial_err"></span>
                            </div>
                            {{-- Country Dropdown --}}
                            <div class="col-md-4">
                                <label class="col-form-label" for="country">Country</label>
                                <select class="form-select" id="editcountry" name="country_id">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger is-invalid country_err"></span>
                            </div>

                            {{-- State Dropdown --}}
                            <div class="col-md-4">
                                <label class="col-form-label" for="state">State</label>
                                <select class="form-select" id="editstate" name="state_id" >
                                <option value=""  selected>-- Select state --</option>
                                </select>
                                <span class="text-danger is-invalid state_err"></span>
                            </div>

                            {{-- City Dropdown --}}
                            <div class="col-md-4">
                                <label class="col-form-label" for="city">City</label>
                                <select class="form-select" id="editcity" name="city_id" >
                                    <option value="">Select City</option>
                                </select>
                                <span class="text-danger is-invalid city_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="technologies">Technologies</label>
                                <select class="js-example-basic-multiple" id="edittechnologies" name="technologies_id[]" multiple>
                                    <option value="">Select Tech</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-8 px-3 py-3">
                        <label class="col-form-label" for="process">Process</label>
                            <div class="d-flex flex-wrap ">
                                <div class="form-check me-3">
                                    <input type="checkbox" class="form-check-input sing-chbx" id="choice" name="process[]" value="01">
                                    <label class="form-check-label">Withdraw</label>
                                </div>
                                <div class="form-check me-3">
                                    <input type="checkbox" class="form-check-input sing-chbx" name="process[]" value="02">
                                    <label class="form-check-label">Balance check</label>
                                </div>
                                <div class="form-check me-3">
                                    <input type="checkbox" class="form-check-input" name="process[]" value="03">
                                    <label class="form-check-label">Mini statement</label>
                                </div>
                                <div class="form-check me-3">
                                    <input type="checkbox" class="form-check-input" name="process[]" value="04">
                                    <label class="form-check-label">Change Pincode</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="process[]" value="05">
                                    <label class="form-check-label">Deposite Money</label>
                                </div>
                            </div>
                    </div> -->
                        <!-- add more start for edit -->
                        <div class="panel panel-footer">
                            <table class="table table-responsive table-bordered" id="dynamicAddRemove">
                                <thead>
                                    <tr>                                       
                                        <th style="visibility: hidden;">Id</th>
                                        <th>Location</th>
                                        <th>Mobile</th>
                                        <th>Number of Nominee</th>
                                        <th>Document</th>
                                        <th><a href="javascript:" class="btn btn-sm btn-success addMoreForm"><i class="fa fa-plus"></i></a></th>
                                    </tr>
                                </thead>
                                <tbody id="addMoreEdit">
                                   
                                </tbody>
                            </table>
                        </div>

        <!-- end add more edit-->


                    <div class="card-footer">
                        <button class="btn btn-primary" id="editSubmit">Submit</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

     <!-- import data -->
     <div class="row" id="importfile" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <form class="theme-form" name="importfileform" id="importfileform" enctype="multipart/form-data">
                        @csrf

                        <div class="card-header">
                            <h4 class="card-title">Import Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="importratefile">Import File <span class="text-danger">*</span></label>
                                    <input class="form-control" id="importratefile" name="importratefile" type="file" >
                                    <span class="text-danger is-invalid importratefile_err"></span>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="importsubmit">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    {{-- Bank Data Table --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <button id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></button>
                    <button id="importToTable" class="btn btn-success">Import <i class="fa fa-plus"></i></button>
                    <button id="btnCancel" class="btn btn-danger" style="display:none;">Cancel</button>
                    <button id="importbtnCancel" class="btn btn-danger" style="display:none;">Cancel</button>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form id="deleteForm" method="POST" action="{{ route('bank.deleteSelected') }}">
                            @csrf
                            @method('delete')
                            <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAll"> Select All</th>
                                        <th>Holder Name</th>
                                        <th>Account Number</th>
                                        <th>IFSC Code</th>
                                        <th>Image</th>
                                        <th>Country</th>                                   
                                        <th>State</th>
                                        <th>City</th>
                                        <!-- <th>Technologies</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banks as $bank)
                                        <tr>
                                            <td><input type="checkbox" name="selected_banks[]" value="{{ $bank->id }}" onclick="toggleDeleteButton()"></td>
                                            <td>{{ $bank->holdername }}</td>
                                            <td>{{ $bank->accountnumber }}</td>
                                            <td>{{ $bank->ifsccode }}</td>
                                            <td>
                                                @if($bank->image)
                                                    <img width="50" src="{{ asset('storage/'.$bank->image) }}" alt="Image">
                                                @endif
                                            </td>
                                            <td>{{ $bank->country->name ?? 'null' }}</td>
                                            <td>{{ $bank->state->name ?? 'null' }}</td>  
                                            <td>{{ $bank->city->name ?? 'null' }}</td>    
                                           
                                            <td> 
                                        
                                                <button class="edit-element btn text-secondary px-2 py-1" title="Edit bank" data-id="{{ $bank->id }}"><i data-feather="edit"></i></button>
                                                <button class="btn text-danger rem-element px-2 py-1" title="Delete bank" data-id="{{ $bank->id }}"><i data-feather="trash-2"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-danger mt-4 mb-2" id="deleteSelected" style="display:none;" onclick="deleteSelected()">Delete Selected</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- delete data when select multiple checkbox --}}
    <script>
        // Select or deselect all checkboxes
            document.getElementById('selectAll').addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('input[name="selected_banks[]"]');
                checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                toggleDeleteButton();
            });

        // Enable or disable the "Delete Selected" button based on checkbox selection
            document.querySelectorAll('input[name="selected_banks[]"]').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    toggleDeleteButton();
                });
            });

            function toggleDeleteButton()
            {
                const selectedCheckboxes = document.querySelectorAll('input[name="selected_banks[]"]:checked');
                const deleteButton = document.getElementById('deleteSelected');
                if (selectedCheckboxes.length > 0) {
                    deleteButton.style.display = 'inline-block';
                } else {
                    deleteButton.style.display = 'none';
                }
            }

        // Handle the form submission via AJAX
            $('#deleteForm').on('submit', function(event) {
                event.preventDefault(); 
                const formData = new FormData(this); 
                const deleteButton = $('#deleteSelected');
                deleteButton.prop('disabled', true); 
                $.ajax({
                    url: "{{ route('bank.deleteSelected') }}", 
                    type: 'DELETE', 
                    data: formData, 
                    processData: false, 
                    contentType: false, 
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token'), 
                    },
                    success: function(data) {
                        if (data.success) {
                            swal("Successful!", data.success, "success")
                                .then(function() {
                                    swal("Successful!", data.success, "success")
                                .then((action) => {
                                    window.location.href = '{{route('bank.index')}}';
                                });
                                });
                        } else {
                            alert('Error: ' + data.message);
                            deleteButton.prop('disabled', false); 
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error occurred: ' + error);
                        deleteButton.prop('disabled', false); 
                    }
                });
            });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- JavaScript for AJAX Calls --}}
    <script>

        $(document).ready(function() {
            function fetchLocationData(url, targetElement) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        targetElement.empty().append('<option value="">Select</option>');
                        $.each(data, function(key, value) {
                            targetElement.append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                        targetElement.prop('disabled', false);
                    }
                });
            }

            function handleLocationChange(selectElement, urlPrefix, targetElement) {
                $(selectElement).on('change', function() {
                    var selectedId = $(this).val();
                    if (selectedId) {
                        fetchLocationData('/' + urlPrefix + '/' + selectedId, targetElement);
                    } else {
                        targetElement.empty().append('<option value="">Select</option>').prop('disabled', false);
                    }
                });
            }

            // Handle country, state, and city selection for both normal and edit sections
            handleLocationChange('#country', 'get-states', $('#state'));
            handleLocationChange('#state', 'get-cities', $('#city'));
            handleLocationChange('#editcountry', 'get-states', $('#editstate'));
            handleLocationChange('#editstate', 'get-cities', $('#editcity'));
            
        });

    </script>

    {{-- Add Bank Form AJAX --}}
    <script>
        $("#addForm").submit(function(e) {
            e.preventDefault();
            $("#addSubmit").prop('disabled', true);

            var formdata = new FormData(this);
            $.ajax({
                url: '{{ route('bank.store') }}',
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#addSubmit").prop('disabled', true);
                    if (!data.error2) {
                        swal("Successful!", data.success, "success")
                            .then(() => window.location.href = '{{ route('bank.index') }}');
                    } else {
                        swal("Error!", data.error2, "error");
                    }
                },
                statusCode: {
                    422: function(responseObject) {
                        $("#addSubmit").prop('disabled', false);
                        resetErrors();
                        printErrMsg(responseObject.responseJSON.errors);
                    },
                    500: function() {
                        $("#addSubmit").prop('disabled', false);
                        swal("Error occurred!", "Something went wrong please try again", "error");
                    }
                }
            });
        });
    </script>

{{-- Add More Form --}}
    <script>
        $('.addMoreForm').on('click',function(){
            addMoreForm();
        });

        var rowId = 1; 
        function addMoreForm() {
            var tr = '<tr id="row_' + rowId + '">' +
                '<td> <select class="js-example-basic-single form-control" name="location[]" id="location" ><option value="">--Select location--</option><option value="1" name="loc[' + rowId + ']">Pune</option><option value="2" name="loc[' + rowId + ']">Mumbai</option><option value="3" name="loc[' + rowId + ']">Matheran</option><option value="4" name="loc[' + rowId + ']">Banglore</option></select>  </td>' +
                '<td><input type="text" name="mobile[]" class="form-control" multiple=""></td>' +
                // '<td><input type="text" name="adharnumber[]" class="form-control" multiple=""></td>' +
                '<td><input type="radio" name="nominee[' + rowId + ']" value="nominee1" class="" multiple=""> Nominee1 <input type="radio" name="nominee[' + rowId + ']" value="nominee2" class="" multiple=""> Nominee2 <input type="radio" name="nominee[' + rowId + ']" value="nominee3" class="" multiple=""> Nominee3 </td>' +
                '<td><input type="file" name="document[]" class="form-control" multiple=""></td>' +
                '<td><a href="javascrip:" class="btn btn-sm btn-danger removeAddMore" data-rowid="' + rowId + '"><i class="fa fa-remove"></i></a></td>' +
                '<tr>';

            $('#addMore').append(tr); 
            $('#location' + rowId).select2();   // Reinitialize Select2 for the new row
            rowId++;
        }

        $(document).on('click', '.removeAddMore', function () {
            if ($(this).parents('table').find('.removeAddMore').length > 1) {
                $(this).parent().parent().remove();
            } else {
                alert("Cannot remove the last element.");
            }        
        });
    </script>



    {{-- Edit Bank Form AJAX --}}
<script>
        $("#buttons-datatables").on("click", ".edit-element", function(e) {
            e.preventDefault();
            var model_id = $(this).data("id");
            var url = "{{ route('bank.edit', ':model_id') }}".replace(':model_id', model_id);

            var form = $("#editForm")[0];
            form.reset();  
            $("#editForm select").val('').trigger('change'); 

            $.ajax({
                url: url,
                type: 'GET',
                data: { '_token': "{{ csrf_token() }}" },
                success: function(data) {
                    if (!data.error) {
                        $("#editForm input[name='edit_model_id']").val(data.bank.id);
                        $("#editForm input[name='holdername']").val(data.bank.holdername);
                        $("#editForm input[name='accountnumber']").val(data.bank.accountnumber);
                        $("#editForm input[name='ifsccode']").val(data.bank.ifsccode);
                        $("#editForm input[name='images']").val(data.bank.images);
                        $("#editForm select[name='country_id']").val(data.bank.country_id);
                        $("#editForm select[name='state_id']").html(data.stateHtml);
                        $("#editForm select[name='city_id']").html(data.cityHtml);
                        var technologiesSelect = $("#editForm select[name='technologies_id[]']");
                        technologiesSelect.html(data.technologiesHtml);
                        if (data.selectedTechnologies && data.selectedTechnologies.length > 0) {
                            technologiesSelect.val(data.selectedTechnologies).trigger('change'); 
                        } else {
                            technologiesSelect.val([]).trigger('change');
                        }
                        
    //-----  Add More Form Edit -----
    
        var locations = JSON.parse(data.locationjson);
        $('.addMoreForm').on('click',function()
            {
                addMoreForm();
            });
            var rowId = 1; 
                            function addMoreForm() {
                                var tr = '<tr id="row_' + rowId + '">' +
                                     '<td><input type="hidden" name="auto_id[]" class="form-control" multiple=""></td>' +                                                                              
                                    '<td><select class="js-example-basic-single form-control" name="location[]" id="location' + rowId + '">' +
                                    '<option value="">--Select location--</option>';
                                    locations.forEach(function(option) {
                                        tr += '<option value="' + option.id + '">' + option.name + '</option>';
                                        
                                    });
                                    tr += '</select></td>' +
                                    '<td><input type="text" name="mobile[]" class="form-control" multiple=""></td>' + 
                                    '<td nowrap><input type="radio" name="nominee[' + rowId + ']" value="nominee1" class="" multiple=""> <b>nominee1</b> <input type="radio" name="nominee[' + rowId + ']" value="nominee2" class="" multiple=""><b> nominee2</b> <input type="radio" name="nominee[' + rowId + ']" value="nominee3" class="" multiple=""> <b>nominee3</b> </td>' +
                                    '<td><input type="file" name="document[]" class="form-control" multiple=""></td>' +
                                    '<td><a href="javascrip:" class="btn btn-sm btn-danger removeAddMore" data-rowid="' + rowId + '"><i class="fa fa-remove"></i></a></td>' +
                                    '<tr>';

                                $('#addMoreEdit').append(tr); 
                                $('#location' + rowId ).select2();   // Reinitialize Select2 for the new row
                                rowId++;
                            }

                            $(document).on('click', '.removeAddMore', function () {
                                    $(this).parent().parent().remove();    
                            });
                        //-----  Add More Form Edit -----
        //Add more previous selected
        var tableBody = $('#addMoreEdit');
        tableBody.empty(); 
        tableBody.append(data.tableRows);
        tableBody.find('.js-example-basic-single').select2();

                            $("#editContainer").show();
                            $("#addContainer").hide();
                        } else {
                            alert(data.error);
                        }
                    },
                    error: function() {
                        alert("Something went wrong");
                    }
                });
            });
</script>

    {{-- Update Bank AJAX --}}
    <script>
        $(document).ready(function() {
            $("#editForm").submit(function(e) {
                e.preventDefault();
                $("#editSubmit").prop('disabled', true);
                var formdata = new FormData(this);
                formdata.append('_method', 'PUT');
                var model_id = $('#edit_model_id').val();
                var url = "{{  route('bank.update', ':model_id') }}".replace(':model_id', model_id);

                $.ajax({
                    url:url,
                    type: 'POST',
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $("#editSubmit").prop('disabled', false);
                        if (!data.error) {
                            swal("Successful!", data.success, "success")
                                .then(() => window.location.href = '{{ route('bank.index') }}');
                        } else {
                            swal("Error!", data.error, "error");
                        }
                    },
                    statusCode: {
                        422: function(responseObject) {
                            $("#editSubmit").prop('disabled', false);
                            resetErrors();
                            printErrMsg(responseObject.responseJSON.errors);
                        },
                        500: function() {
                            $("#editSubmit").prop('disabled', false);
                            swal("Error occurred!", "Something went wrong please try again", "error");
                        }
                    }
                });
            });
        });
    </script>

    <!-- Delete -->
<script>
    $("#buttons-datatables").on("click", ".rem-element", function(e) {
        e.preventDefault();
        swal({
            title: "Are you sure to delete this Bank Account?",
            icon: "info",
            buttons: ["Cancel", "Confirm"]
        })
        .then((justTransfer) =>
        {
            if (justTransfer)
            {
                var model_id = $(this).attr("data-id");
                var url = "{{ route('bank.destroy', ":model_id") }}";

                $.ajax({
                    url: url.replace(':model_id', model_id),
                    type: 'POST',
                    data: {
                        '_method': "DELETE",
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(data, textStatus, jqXHR) {
                        if (!data.error && !data.error2) {
                            swal("Success!", data.success, "success")
                                .then((action) => {
                                    window.location.reload();
                                });
                        } else {
                            if (data.error) {
                                swal("Error!", data.error, "error");
                            } else {
                                swal("Error!", data.error2, "error");
                            }
                        }
                    },
                    error: function(error, jqXHR, textStatus, errorThrown) {
                        swal("Error!", "Something went wrong", "error");
                    },
                });
            }
        });
    });
</script>


<!-- import -->




</x-admin.layout>
