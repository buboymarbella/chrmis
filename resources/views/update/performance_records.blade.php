@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
            <div style="float:left"><h1>PERFORMANCE MGT MONITORING RECORDS</h1></div>
			<div style="float:right"> <a href="{{ route('performance', $masters->master_id)}}"><button type="button" class="btn btn-warning btn-sm text-light">BACK TO PROFILE</button></a></div>
          </div>
          <div class="col-sm-6">
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content col-md-6">
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
          <form class="form-horizontal" method="POST" action="{{ route('performances.update',$masters->id) }}"  enctype="multipart/form-data">
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

				<div class="col-md-12">
					<p style="padding-top:10px;">SEMESTER</p>
					
					<select id="select3-dropdown"  class=" form-control select2" name="semester">
						<option value="{{ $masters->semester == null ? '' : $masters->semester }}">
							@if($masters->semester == "1")
								1st Semester
							@elseif($masters->semester == "2")
								2nd Semester
							@else
								--Select--
							@endif
						</option>
						<option value="1">1st Semester</option>
						<option value="2">2nd Semester</option>
					</select>
				</div>
				
				<div class="col-md-12">
					<p style="margin: 0 0 5px 0;padding:0 0">Name of Supervisor</p>
					<input required type="text" name="supervisor"  placeholder="ex:Sammy Valdez" class="form-control input" value="{{ $masters->supervisor == null ? '' : $masters->supervisor }}"/>
				</div>
						
				<div class="col-md-12 mt-3">
					<p style="margin: 0 0 5px 0;padding:0 0">PREPARATION OF IPCR</p>		 
				</div>
				
				<div class="col-md-12" id="data_1">
                    <p style="margin: 0 0;padding:0 0">Date of concurrence by Civ HR</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="chr_prep" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask value="{{ $masters->ipcr_prep_chr == '1970-01-01' ? 'mm/dd/yyyy' : date('m/d/Y', strtotime($masters->ipcr_prep_chr)) }}" />
					</div>
                </div>

				<div class="col-md-12" id="data_1">
                    <p style="margin: 0 0;padding:0 0">Date of concurrence by Immediate Supervisor</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="super_prep" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask value="{{ $masters->ipcr_prep_supervisor == '1970-01-01' ? 'mm/dd/yyyy' : date('m/d/Y', strtotime($masters->ipcr_prep_supervisor)) }}" />
					</div>
                </div>
				
				<div class="col-md-12 mt-3">
                    <p style="margin: 0 0 5px 0;padding:0 0">PERFORMANCE MONITORING AND COACHING</p>
                </div>

				<div class="col-md-12" id="data_1">
                    <p style="margin: 0 0;padding:0 0">Date of concurrence by Civ HR</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="chr_coaching" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask value="{{ $masters->coaching_chr == '1970-01-01' ? 'mm/dd/yyyy' : date('m/d/Y', strtotime($masters->coaching_chr)) }}" />
					</div>
                </div>

				<div class="col-md-12" id="data_1">
                    <p style="margin: 0 0;padding:0 0">Date of concurrence by Immediate Supervisor</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="super_coaching" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask value="{{ $masters->coaching_supervisor == '1970-01-01' ? 'mm/dd/yyyy' : date('m/d/Y', strtotime($masters->coaching_supervisor)) }}" />
					</div>
                </div>

				<div class="col-md-12 mt-3">
					<p style="margin: 0 0 5px 0;padding:0 0">DISCUSSION OF INTERVENING ACTIVITIES</p>			 
				</div>
				
				<div class="col-md-12" id="data_1">
                    <p style="margin: 0 0;padding:0 0">Date of concurrence by Civ HR</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="chr_activities" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask value="{{ $masters->activities_chr == '1970-01-01' ? 'mm/dd/yyyy' : date('m/d/Y', strtotime($masters->activities_chr)) }}" />
					</div>
                </div>

				<div class="col-md-12" id="data_1">
                    <p style="margin: 0 0;padding:0 0">Date of concurrence by Immediate Supervisor</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="super_activities" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask value="{{ $masters->activities_supervisor == '1970-01-01' ? 'mm/dd/yyyy' : date('m/d/Y', strtotime($masters->activities_supervisor)) }}" />
					</div>
                </div>
				
				<div class="col-md-12 mt-3">
				<p style="margin: 0 0 5px 0;padding:0 0">GRADING OF IPCR</p>
        		</div>
				
				<div class="col-md-12  mt-0 pt-0" id="data_1">
					
                    <p style="margin: 0 0;padding:0 0">Date of concurrence by Civ HR</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="chr_grade" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask value="{{ $masters->grading_chr == '1970-01-01' ? 'mm/dd/yyyy' : date('m/d/Y', strtotime($masters->grading_chr)) }}" />
					</div>
                </div>
				
				<div class="col-md-12" id="data_1">
                    <p style="margin: 0 0 5px 0;padding:0 0">Date of concurrence by Immediate Supervisor</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="super_grade" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask value="{{ $masters->grading_supervisor == '1970-01-01' ? 'mm/dd/yyyy' : date('m/d/Y', strtotime($masters->grading_supervisor)) }}" />
					</div>
                </div>

				<div class="col-md-12 mt-3">
					<p style="margin:0 0;padding:0 0 0 0">Remarks</p>
					<textarea name="remarks" rows="5" placeholder="ex:Sammy Valdez" class="form-control input">{{ $masters->remarks == null ? '' : $masters->remarks }}</textarea>
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





