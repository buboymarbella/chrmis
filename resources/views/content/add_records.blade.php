@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Personalities</h1>
          </div>
          <div class="col-sm-6">
            
			<div style="float:right"> <a href="{{ route('view_records')}}"><button type="button" class="btn btn-warning btn-sm text-light">BACK CHR RECORDS</button></a></div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Add Civilian Human Resource</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <form class="form-horizontal" method="POST" action="{{ route('masters.store') }}"  enctype="multipart/form-data">
			@csrf
          <div class="card-body">
            <div class="row">
                <div class="col-md-12" id="data_1">
				@if ($errors->any())
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						@foreach ($errors->all() as $error)
								{{ $error }} <br/>
						@endforeach
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
                @endif
                </div>
                <div class="col-md-12" id="data_1">
                @if ($message = Session::get('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						{{ $message }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
                @endif
                </div>
				
				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Employee Status</p>
					<!--<input type="text" name="emp_stat"  placeholder="Employee Status" class="form-control input"  value="{{ old('emp_stat') }}"/>-->
					 <select name="employ_stat" class="form-control" id="employ_stat" onchange="myFunctions2()">
						<option>Applicant</option>
						<option>Contractual</option>
						<option>Casual</option>
						<option>Job Order</option>
						<option>Provisionary</option>
						<option>Temporary</option>
						<option>Permanent</option>	
						<option>Retired</option>
					</select>
				</div>
			
				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Employee Number</p>
					<input type="text" name="employee_number"  placeholder="Employee Number" class="form-control input"  value="{{ old('employee_number') }}"/>
				</div>
				
				{{-- <div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Item Number</p>
					<input type="text" name="item_number"  placeholder="Item Number" class="form-control input"  value="{{ old('item_number') }}"/>
				</div> --}}

				<div class="col-md-4">
					<p style="padding-top:5px;">Select PLantilla Number</p>
				   
					<select id="select2-dropdown"  class=" form-control select2" name="livesearch">
					  <option value="">--Select--</option>
					  @foreach($autocomplete as $item)
					  <option value="{{ $item->id }}">{{ $item->plantilla_number }}</option>
					  @endforeach
					</select>
				</div>
				
				{{-- <div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Salary Grade</p>
					<input type="number" name="salary_grade"  placeholder="Salary Grade" class="form-control input"  value="{{ old('salary_grade') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Position</p>
					<input type="text" name="position"  placeholder="Position" class="form-control input"  value="{{ old('position') }}"/>
				</div> --}}

				{{-- @can('viewAny', App\User::class)
				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Office/Unit</p>
					<input type="text" name="office"  placeholder="Office/Unit" class="form-control input"  value="{{ old('office') }}"/>
				</div>
				@endcan
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;"> Date of Orig App</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="date_hired" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('date_hired') }}" />
					</div>
                </div> --}}

				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Position <span class="text-danger">*FILL-UP IF NOT PERMANENT</span></p>
					<!-- <input type="text" name="position"  placeholder="Position" class="form-control input"  value="{{ old('position') }}"/> -->
					<select id="select4-dropdown"  class=" form-control select2" name="position">
						<option value="">Select Position</option>
						@forelse ($position as $key=>$position)
						<option>{{ $position->title }}</option>
						@empty
						<option>N/A</option>
						@endforelse
					</select>
				</div>

				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Office/Unit <span class="text-danger">*FILL-UP IF NOT PERMANENT</span></p>
					<!-- <input type="text" name="office"  placeholder="Office/Unit" class="form-control input"  value="{{ old('office') }}"/>
					<p style="padding-top:10px;">Office/Unit</p> -->
					
					<select id="select3-dropdown"  class="form-control select2" name="office">
						<option value="">Select Office</option>
						@forelse ($office as $key=>$office)
						<option>{{ $office->unit }}</option>
						@empty
						<option>N/A</option>
						@endforelse
					</select>
				</div>
				
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;"> Date of Orig App</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="date_hired" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('date_hired') }}" />
					</div>
                </div>

                <div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">Last Name </p>
                    <input type="text" name="last_name"  placeholder="Last Name" class="form-control input"  value="{{ old('last_name') }}"/>
                </div>

                <div class="col-md-4">
                  <p style="padding-top:5px;">First Name</p>
                  <input type="text" name="first_name" placeholder="First Name" class="form-control input"  value="{{ old('first_name') }}"/>
                </div>
    
                <div class="col-md-4">
                    <p style="padding-top:5px;">Middle Name </p>
                    <input type="text" name="middle_name" placeholder="Middle Name" class="form-control input" value="{{ old('middle_name') }}"/>
                </div>
            
                <div class="col-md-4">
                    <p style="padding-top:5px;">Extension Name</p>
                    <input type="text" name="extension_name"  placeholder="Extension Name" class="form-control input" value="{{ old('extension_name') }}"/>
                </div>
				
                <div class="col-md-4">
                    <p style="padding-top:5px;"> Gender</p>
                    <select class="form-control input" name="gender">
                        <option value="N/A">Select Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                     </select>
                </div>
				
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;"> Birthdate</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="dob" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('dob') }}" />
					</div>
                </div>
				
				<!-- End of Birthdate -->	
				<div class="col-md-8">
					<p style="padding-top:5px;">Birth Place </p>
					<input type="text" name="pob" placeholder="Birth Place" class="form-control input" value="{{ old('pob') }}"/>
				</div>
				<!-- End of Birthplace -->	
				<div class="col-md-4">
					<p style="padding-top:5px;"> Civil Status </p>
						<select class="form-control input" name="civil_status">
							<option value="">--Select--</option>
							<option>Single</option>
							<option>Married</option>
							<option>Separated</option>
							<option>Widowed</option>
							<option>Others</option>
						</select>
				</div>
				<!-- End of civilstatus -->
			
				<div class="col-md-4">
					<p style="padding-top:5px;"> Citizenship</p>
						<select class="form-control input" name="citizenship">
							<option value="">--Select--</option>
							<option value="fp">Filipino</option>
							<option value="dc">Dual Citizenship</option>
						</select>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;"> By Birth/Naturalize</p>
						<select class="form-control input" name="birth_naturalize">
							<option value="">--Select--</option>
							<option value="bb">By Birth</option>
							<option value="bn">By Naturalize</option>
						</select>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Dual Citizenship <small style="color:blue;">(INDICATE COUNTRY)</small></p>
					<input type="text" name="dual_citizen" placeholder="Dual Citizenship" class="form-control input " value="{{ old('dual_citizen') }}"/>
				</div>
				
				<!-- End of Citizenship -->
				<div class="col-md-4">
					<p style="padding-top:5px;">Religion</p>
						<input type="text" name="religion" placeholder="Religion" class="form-control input" value="{{ old('religion') }}"/>
										
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Height(m)</p>
						<input type="text" name="height" placeholder="Height(m)" class="form-control input" value="{{ old('height') }}"/>
										
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Weight(kg)</p>
						<input type="text" name="weight" placeholder="Weight(kg)" class="form-control input" value="{{ old('weight') }}"/>
										
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Blood Type</p>
						<select class="form-control input" name="blood_type">
							<option value="">--Select--</option>
							<option>A</option>
							<option>A+</option>  
							<option>A-</option>  						
							<option>B</option>   
							<option>B+</option> 
							<option>B-</option> 
							<option>O</option> 
							<option>O+</option> 
							<option>O-</option> 
							<option>AB</option>   
							<option>AB-</option>
							<option>AB+</option>
						</select>
										
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Telephone Number</p>
					<input type="text" name="telephone_no"  placeholder="Telephone Number" class="form-control input" value="{{ old('telephone_no') }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Cellphone Number</p>
					<input type="text" name="cellphone_no"  placeholder="Cellphone Number" class="form-control input" value="{{ old('cellphone_no') }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Email Address</p>
					<input type="email" name="email_address"  placeholder="Email Address" class="form-control input" value="{{ old('email_address') }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">GSIS Number</p>
					<input type="text" name="gsis_number"  placeholder="GSIS Number" class="form-control input" value="{{ old('gsis_number') }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">BP Number</p>
					<input type="text" name="bp_number"  placeholder="BP Number" class="form-control input" value="{{ old('bp_number') }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Pag-ibig Number</p>
					<input type="text" name="pagibig_number"  placeholder="Pag-ibig Number" class="form-control input" value="{{ old('pagibig_number') }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Philhealth Number</p>
					<input type="text" name="philhealth_number"  placeholder="Philhealth Number" class="form-control input" value="{{ old('philhealth_number') }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">SSS Number</p>
					<input type="text" name="sss_number"  placeholder="SSS Number" class="form-control input" value="{{ old('sss_number') }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Tin Number</p>
					<input type="text" name="tin_number"  placeholder="Tin Number" class="form-control input" value="{{ old('tin_number') }}"/>
				</div>

                <div class="col-md-12">
                   <p style="padding-top:5px;">Picture</p>
                  <input type="file" name="select_file">
                </div>

            </div>
				<div class="box-footer">
					
				</div>
			</div>
			
          <!-- /.card-body -->
          <div class="card-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
          </div>
		  
        
        <!-- /.card -->
        </div>
		</form>
      </div>
    </section>
</div>
<br/>
@endsection
@push('js')

@endpush





