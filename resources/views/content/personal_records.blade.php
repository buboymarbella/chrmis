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
			<div style="float:right"> <a href="{{ route('masters.show', $master->main_id)}}"><button type="button" class="btn btn-warning btn-sm text-light">BACK TO PROFILE</button></a></div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title"></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <form class="form-horizontal" method="POST" action="{{ route('masters.update',$master->main_id) }}"  enctype="multipart/form-data">
			@csrf
			@method('PUT')
          <div class="card-body">
            <div class="row">
                <div class="col-md-12" id="data_1">
				@if ($errors->any())
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						@foreach ($errors->all() as $error)
								{{ $error }}
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
					<!--<input type="text" name="emp_stat"  placeholder="Employee Status" class="form-control input"  value=""/>-->
					 <select name="employ_stat" class="form-control" >
						<option value="{{ $master->employ_stat == null ? '' : $master->employ_stat }}">{{ $master->employ_stat == null ? '--Select--' : $master->employ_stat }} </option>
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
					<input type="text" name="employee_number"  placeholder="Employee Number" class="form-control input"  value="{{ $master->employee_number == null ? '' : $master->employee_number }}"/>
				</div>

				<div class="col-md-4">
					<p style="padding-top:5px;">Select PLantilla Number</p>
				   
					<select id="select2-dropdown" class=" form-control select2" name="livesearch">
						@if(empty($autocomplete2->master_id))
							<option value="">--Select--</option>
						@else
							<option value="{{ $autocomplete2->id == null ? '' : $autocomplete2->id }}">{{ $autocomplete2->plantilla_number == null ? '--Select--' : $autocomplete2->plantilla_number }} </option>
						@endif
					  @foreach($autocomplete as $item)
					  <option value="{{ $item->id }}">{{ $item->plantilla_number }}</option>
					  @endforeach
					</select>
				</div>
				
				{{-- <div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Item Number</p>
					<input type="text" name="item_number"  placeholder="Item Number" class="form-control input"  value="{{ $master->item_number == null ? '' : $master->item_number }}"/>
				</div> --}}
				
				{{-- <div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Salary Grade</p>
					<input type="number" name="salary_grade"  placeholder="Salary Grade" class="form-control input"  value="{{ $master->salary_grade == null ? '' : str_replace('SG-','',$master->salary_grade) }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Position</p>
					<input type="text" name="position"  placeholder="Position" class="form-control input"  value="{{ $master->position == null ? '' : $master->position }}"/>
				</div> --}}

				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Position <span class="text-danger">*FILL-UP IF NOT PERMANENT</span></p>
					<!-- <input type="text" name="position"  placeholder="Position" class="form-control input"  value="{{ $master->position == null ? '' : $master->position }}"/> -->
					<select id="select4-dropdown"  class=" form-control select2" name="position">
						<option value="{{ $master->position == null ? '' : $master->position }}">{{ $master->position == null ? 'Select Position ' : $master->position }}</option>
						<option value="">Empty</option>
						@forelse ($position as $key=>$position)
						<option>{{ $position->title }}</option>
						@empty
						<option>N/A</option>
						@endforelse
					</select>
				</div>

				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Office/Unit <span class="text-danger">*FILL-UP IF NOT PERMANENT</span></p>
					<!-- <input type="text" name="office"  placeholder="Office/Unit" class="form-control input"  value="{{ $master->office == null ? '' : $master->office }}"/> -->
					<select id="select3-dropdown"  class=" form-control select2" name="office">
						<option>{{ $master->office == null ? '' : $master->office }}</option>
						
						@forelse ($office as $key=>$office)
						<option>{{ $office->unit }}</option>
						@empty
						<option>N/A</option>
						@endforelse
					</select>
				</div>

				{{-- @can('viewAny', App\User::class)
				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Office/Unit</p>
					<input type="text" name="office"  placeholder="Office/Unit" class="form-control input"  value="{{ $master->office == null ? '' : $master->office }}"/>
				</div>
				@endcan --}}
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;"> Date of Orig App</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="date_hired" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="
							@if($master->date_hired == null)
								
							@elseif($master->date_hired == '1970-01-01')
								
							@else
								{{ date('m/d/Y', strtotime($master->date_hired)) }}
							@endif
						" />
					</div>
                </div>
				
				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Lastname </p>
					<input type="text" name="last_name"  placeholder="Lastname" class="form-control input"  value="{{ $master->last_name == null ? '' : $master->last_name }}"/>
				</div>
				<!-- End of lastname -->
				<div class="col-md-4">
					<p style="padding-top:5px;">Firstname</p>
					<input type="text" name="first_name" placeholder="Firstname" class="form-control input"  value="{{ $master->first_name == null ? '' : $master->first_name }}"/>
				</div>
				<!-- End of firstname -->
				<div class="col-md-4">
					<p style="padding-top:5px;">Middlename </p>
					<input type="text" name="middle_name" placeholder="Middlename" class="form-control input" value="{{ $master->middle_name == null ? '' : $master->middle_name }}"/>
				</div>
				<!-- End of middlename -->					
				<div class="col-md-4">
					<p style="padding-top:5px;">Extension Name</p>
					<input type="text" name="extension_name"  placeholder="Extension Name" class="form-control input" value="{{ $master->extension_name == null ? '' : $master->extension_name }}"/>
				</div>
				<!-- End of extension name -->	             
				 <div class="col-md-4">
					<p style="padding-top:5px;"> Gender</p>
					<select class="form-control input" name="gender">
						<option value="{{ $master->gender == null ? '' : $master->gender }}">{{ $master->gender == null ? '--Select--' : $master->gender }} </option>
						<option>Male</option>
						<option>Female</option>
					</select>
				</div>
				<!-- End of gender -->		
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;"> Birthdate</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="dob" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="
							@if($master->dob == null)
								
							@elseif($master->dob == '1970-01-01')
								
							@else
								{{ date('m/d/Y', strtotime($master->dob)) }}
							@endif
						
						" />
					</div>
                </div>
				<!-- End of Birthdate -->	
				<div class="col-md-8">
					<p style="padding-top:5px;">Birth Place </p>
					<input type="text" name="pob" placeholder="Birth Place" class="form-control input" value="{{ $master->pob == null ? 'N/A' : $master->pob }}"/>
				</div>
				<!-- End of Birthplace -->	
				<div class="col-md-4">
					<p style="padding-top:5px;"> Civil Status </p>
						<select class="form-control input" name="civil_status">
							<option value="{{ $master->civil_status == null ? '' : $master->civil_status }}">{{ $master->civil_status == null ? '--Select--' : $master->civil_status }} </option>
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
							<option value=" {{ $master->citizenship == null ? '' : $master->citizenship }}">
								@if($master->citizenship == null || $master->citizenship == "")
								@elseif( $master->citizenship == "FP")
									Filipino
								@elseif( $master->citizenship == "DC")
									Dual Citizenship
								@else
								--Select--
								@endif
							</option>
							<option value="fp">Filipino</option>
							<option value="dc">Dual Citizenship</option>
						</select>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;"> By Birth/Naturalize</p>
						<select class="form-control input" name="birth_naturalize">
							@if($master->birth_naturalize == "BB")
								<option value="BB">By Birth</option>
							@elseif($master->birth_naturalize == "BN")
								<option value="BN">By Naturalize</option>
							@endif
							<option value="BB">By Birth</option>
							<option value="bn">By Naturalize</option>
							<option value="">N/A</option>
						</select>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Dual Citizenship <small style="color:blue;">(INDICATE COUNTRY)</small></p>
					<input type="text" name="dual_citizen" placeholder="Dual Citizenship" class="form-control input " value="{{ $master->dual_citizen == null ? '' : $master->dual_citizen }}"/>
				</div>
				
				<!-- End of Citizenship -->
				<div class="col-md-4">
					<p style="padding-top:5px;">Religion</p>
						<input type="text" name="religion" placeholder="Religion" class="form-control input" value="{{ $master->religion == null ? '' : $master->religion }}"/>
										
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Height(m)</p>
						<input type="text" name="height" placeholder="Height(m)" class="form-control input" value="{{ $master->height == null ? '' : $master->height }}"/>
										
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Weight(kg)</p>
						<input type="text" name="weight" placeholder="Weight(kg)" class="form-control input" value="{{ $master->weight == null ? '' : $master->weight }}"/>
										
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Blood Type</p>
						<select class="form-control input" name="blood_type">
							<option value="{{ $master->blood_type == null ? '' : $master->blood_type }}">{{ $master->blood_type == null ? '--Select--' : $master->blood_type }} </option>
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
					<input type="text" name="telephone_no"  placeholder="Telephone Number" class="form-control input" value="{{ $master->telephone_no == null ? '' : $master->telephone_no }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Cellphone Number</p>
					<input type="text" name="cellphone_no"  placeholder="Cellphone Number" class="form-control input" value="{{ $master->cellphone_no == null ? '' : $master->cellphone_no }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Email Address</p>
					<input type="text" name="email_address"  placeholder="Email Address" class="form-control input" value="{{ $master->email_address == null ? '' : $master->email_address }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">GSIS Number</p>
					<input type="text" name="gsis_number"  placeholder="GSIS Number" class="form-control input" value="{{ $identification->gsis_number == null ? '' : $identification->gsis_number }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">BP Number</p>
					<input type="text" name="bp_number"  placeholder="BP Number" class="form-control input" value="{{ $identification->bp_number == null ? '' : $identification->bp_number }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Pag-ibig Number</p>
					<input type="text" name="pagibig_number"  placeholder="Pag-ibig Number" class="form-control input" value="{{ $identification->pagibig_number == null ? '' : $identification->pagibig_number }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Philhealth Number</p>
					<input type="text" name="philhealth_number"  placeholder="Philhealth Number" class="form-control input" value="{{ $identification->philhealth_number == null ? '' : $identification->philhealth_number }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">SSS Number</p>
					<input type="text" name="sss_number"  placeholder="SSS Number" class="form-control input" value="{{ $identification->sss_number == null ? '' : $identification->sss_number }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Tin Number</p>
					<input type="text" name="tin_number"  placeholder="Tin Number" class="form-control input" value="{{ $identification->tin_number == null ? '' : str_replace('-','',$identification->tin_number) }}"/>
				</div>
				
				
				<div class="col-md-4">
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





