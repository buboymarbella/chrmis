@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-8">
			<div style="float:left"><h1>Work Experience</h1></div>
            <div style="float:right"> <a href="{{ route('workexpe', $masters->master_id)}}"><button type="button" class="btn btn-warning btn-sm text-light">BACK TO PROFILE</button></a></div>
          </div>
          <div class="col-sm-4">
           
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default col-sm-8">
          <div class="card-header">
            <h3 class="card-title"></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <form class="form-horizontal" method="POST" action="{{ route('works.update',$masters->id) }}"  enctype="multipart/form-data">
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
				
				<div class="col-md-12" id="data_1">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						Note if currently working leave the date "TO" blank
					</div>
				</div>
				
				<div class="col-md-6" id="data_1">
                    <p style="padding-top:5px;">From</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="inclusive_from" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ $masters->inclusive_from == null ? 'm/dd/yyyy' :  date('m/d/Y', strtotime($masters->inclusive_from)) }}"/>
						
					</div>
                </div>
					  
				<div class="col-md-6" id="data_1">
                    <p style="padding-top:5px;">To</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="inclusive_to" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ $masters->inclusive_to == null ? 'm/dd/yyyy' :  date('m/d/Y', strtotime($masters->inclusive_to)) }}"/>
					</div>
                </div>
				
				<div class="col-md-6" >
					<p style="padding-top:5px;">Plantilla Number</p>
					<input autocomplete="off" type="text" name="plantilla_number"  placeholder="ex:AFP-GHQC-ADOF5-172-2013" class="form-control input" required value="{{ $masters->plantilla_number == null ? '' : $masters->plantilla_number }}"/>
				</div>

				<div class="col-md-6" >
					<p style="padding-top:5px;">Position Title</p>
					<input autocomplete="off" type="text" name="position_title"  placeholder="ex:Information Analyst I" class="form-control input" required
					value="{{ $masters->position_title == null ? '' : $masters->position_title }}"/>
				</div>
									  
				<div class="col-md-6">
					<p style="padding-top:5px;">Department/Unit/Office</p>
					<input autocomplete="off" type="text" name="department" placeholder="ex: OJ1" class="form-control input" 
					value="{{ $masters->department == null ? '' : $masters->department }}"/>
				</div>
				
				<div class="col-md-6">
					<p style="padding-top:5px;">Name of Agency/Organization and Location</p>
					<input autocomplete="off" type="text" name="agency" placeholder="ex: Camp Aguinaldo Quezon City" class="form-control input" 
					value="{{ $masters->agency == null ? '' : $masters->agency }}"/>
				</div>
				
				<div class="col-md-6" id="data_1">
					<p style="padding-top:5px;">Immediate Supervisor</p>
					<input type="text" name="supervisor" placeholder="ex: Mark Taguba" class="form-control input" 
					value="{{ $masters->supervisor == null ? '' : $masters->supervisor }}"/>
				</div>
									 
				<div class="col-md-6" id="data_1">
					<p style="padding-top:5px;">Monthly Salary</p>
					<input type="number" name="salary" placeholder="ex:10,000" class="form-control input" value="{{ $masters->salary == null ? '0' : $masters->salary }}"/>
				</div>
									   
				<div class="col-md-6" id="data_1">
					<p style="padding-top:5px;">Salary Grade</p>
					<input type="number" name="salary_grade"  placeholder="ex:12" class="form-control input" value="{{ $masters->salary_grade == null ? '' : $masters->salary_grade }}"/>
				</div>
									   
				<div class="col-md-6" id="data_1">
					<p style="padding-top:5px;">Step Increment</p>
					<select class="form-control input" name="step_increment">
						<option>{{ $masters->step_increment == null ? '0' : $masters->step_increment }}</option>
						<option value="0">0</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
					</select>
				</div>
									   
				<div class="col-md-6" id="data_1">
					<p style="padding-top:5px;">Status of appointment</p>
					<select name="job_status" class="form-control" >
						<option>{{ $masters->job_status == null ? '' : $masters->job_status }}</option>
						<option>Applicant</option>
						<option>Contractual</option>
						<option>Casual</option>
						<option>Job Order</option>
						<option>Provisionary</option>
						<option>Temporary</option>
						<option>Permanent</option>
					</select>
				</div>
									   
				<div class="col-md-6" id="data_1">
					<p style="padding-top:5px;">Government Service</p>
					<select class="form-control input" name="gov_service">
						<option value="{{ $masters->gov_service == null ? '' : $masters->gov_service }}">
							@if( $masters->gov_service == "Y")
								Yes
							@elseif($masters->gov_service == "N")
								No
							@else
								--Select--
							@endif
							
						</option>
						<option value="Y">Yes</option>
						<option value="N">No</option>
					</select>
				</div>
				
				<div class="col-md-12" id="data_1">
					<p style="padding-top:8px;">Summary of Actual Duties</p>
					<textarea class="form-control" name="duties" rows="3" placeholder="Enter ..." style="margin-top: 0px; margin-bottom: 0px; height: 90px;">{{ $masters->duties == null ? '' : $masters->duties }}</textarea>
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





