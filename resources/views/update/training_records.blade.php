@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Training</h1>
          </div>
          <div class="col-sm-6">
			<div style="float:right"> <a href="{{ route('masters.show', $masters->master_id)}}"><button type="button" class="btn btn-warning btn-sm text-light">BACK TO PROFILE</button></a></div>
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
          <form class="form-horizontal" method="POST" action="{{ route('trainings.update', $masters->id) }}"  enctype="multipart/form-data">
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
					<p style="padding-top:5px;">Title of Training</p>
					<select class="form-control input" name="ghq_training" id="training">
						<option value="{!! $v_training_title !!}">
						@if($masters->training_program == 'CPORT')
							Civilian Personnel Orientation/Reorientation Training
						@elseif ($masters->training_program == 'CPBC')
							Civilian Personnel Basic Course
						@elseif ($masters->training_program == 'CPBSC')
							Civilian Personnel Basic Supervisory Course
						@elseif ($masters->training_program == 'CPASC')
							Civilian Personnel Advance Supervisory Course
						@else
							Select Training
						@endif
						</option>
						<option value="N/A">Select Training</option>
						<option value="CPORT">Civilian Personnel Orientation/Reorientation Training</option>
						<option value="CPBC">Civilian Personnel Basic Course</option>
						<option value="CPBSC">Civilian Personnel Basic Supervisory Course</option>
						<option value="CPASC">Civilian Personnel Advance Supervisory Course</option>
					</select>
				</div>
				
				<div class="col-md-8" >
					<p style="padding-top:5px;">Other Training</p>
					<input autocomplete="off" type="text" name="training_program" placeholder="Title of Training" class="form-control input" id="other_training"
					required value="{{ $training_title == null ? '' : $training_title }}"/>
				</div>		
				
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">From</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="inclusive_from" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ $masters->inclusive_from == null ? 'm/dd/yyyy' :  date('m/d/Y', strtotime($masters->inclusive_from)) }}"/>
					</div>
                </div>
					  
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">To</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="inclusive_to" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ $masters->inclusive_to == null ? 'mm/dd/yyyy' : date('m/d/Y', strtotime($masters->inclusive_to)) }}"/>
					</div>
                </div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Number of Hours</p>
						<input required type="number" name="hour_numbers"  placeholder="Number of Hours" class="form-control input" 
						value="{{ $masters->number_hours == null ? '0' : $masters->number_hours }}"/>
				</div>
									   
				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Type of LD</p>
					<select class="form-control input" name="type_ld">
						<option>{{ $masters->type_ld == null ? '' : $masters->type_ld }}</option>
						<option>Managerial</option>
						<option>Supervisory</option>
						<option>Technical</option>
					</select>
				</div>
									 
				<div class="col-md-8" id="data_1">
					<p style="padding-top:5px;">Conducted & Sponsored by</p>
					<input autocomplete="off" type="text" name="conducted"  placeholder="Conducted & Sponsored by" class="form-control input" 
					value="{{ $masters->conducted == null ? '' : $masters->conducted }}"/>
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





