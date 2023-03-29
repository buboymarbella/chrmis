@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Activity</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{ route('masters.show', $master->main_id)}}">Back to Profile</a></li>
            </ol>
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
          <form class="form-horizontal" method="POST" action="{{ route('activities.store') }}"  enctype="multipart/form-data">
			@csrf
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
				
				<div class="col-md-4">
					<p style="padding-top:5px;"> Incident </p>
						<select id="incident" class="form-control input" name="incidents">
							<option value="N/A">Select Incident</option>
							<option value="Violent">Violent</option>
							<option value="None-Violent">Non-Violent</option>
						</select>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;"> Acitvity </p>
						<select id="ac" class="form-control input" name="activity">
							<option value="N/A">Select Acitvity</option>
						</select>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;"> Evaluation</p>
					<input type="text" name="evaluation" placeholder="Evaluation" class="form-control input" value="{{ old('evaluation') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;"> Date of Activity</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="date_act" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
					</div>
                </div>
				
				<div class="col-md-4" id="data_1">
						<p style="padding-top:5px;"> Time</p>
						<div class="input-group date" id="timepicker" data-target-input="nearest">
							<input type="text" name="time_act" class="form-control datetimepicker-input" data-target="#timepicker"/>
							<div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
								<div class="input-group-text"><i class="far fa-clock"></i></div>
							</div>
						</div>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;"> Region </p>
						<select id="reg" class="form-control input" name="region">
							<option value="N/A">Select Region</option>
							<option>ARMM</option>
							<option>CAR</option>
							<option>NCR</option>
							<option>Region I</option>
							<option>Region II</option>
							<option>Region III</option>
							<option>Region IVA</option>
							<option>Region IVB</option>
							<option>Region V</option>
							<option>Region VI</option>
							<option>Region VII</option>
							<option>Region VIII</option>
							<option>Region IX</option>
							<option>Region X</option>
							<option>Region XI</option>
							<option>Region XII</option>
							<option>Region XIII</option>
						</select>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;"> Province</p>
						<select id="province" class="form-control input" name="province">
							<option value="N/A">Select Province</option>
						</select>
				</div>
				
				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Municipality/City</p>
					<input type="text" name="city"  placeholder="Municipality/City" class="form-control input"  value="{{ old('city') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">House No. \ Street \ Barangay</p>
					<input type="text" name="brgy" placeholder="Barangay" class="form-control input"  value="{{ old('brgy') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">No. of KIA</p>
					<input type="number" name="kia" placeholder="No. of Casualities" class="form-control input"  value="{{ old('kia') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">No. of MIA</p>
					<input type="number" name="mia" placeholder="No. of Casualities" class="form-control input"  value="{{ old('mia') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">No. of WIA</p>
					<input type="number" name="wia" placeholder="No. of Casualities" class="form-control input"  value="{{ old('wia') }}"/>
				</div>
			
				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">No. of Enemy Killed</p>
					<input type="number" name="enemy_killed" placeholder="No. of Enemy Killed" class="form-control input"  value="{{ old('enemy_killed') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">No. of Enemy Surrendered/Captured</p>
					<input type="number" name="enemy_captured" placeholder="No. of Enemy Surrendered/Captured" class="form-control input"  value="{{ old('enemy_captured') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Source</p>
					<input type="text" name="reported_by" placeholder="Source" class="form-control input"  value="{{ old('reported_by') }}"/>
				</div>
				
				<div class="col-md-12">
					<!-- /.box-header -->
					<p style="padding-top:5px;">Activity Details</p>
					
					<textarea  name="details" class="textarea" placeholder="Place some text here"
							style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
					
					</div>
			
				</div>
					<div class="box-footer">
						
					</div>
				</div>
			
          <!-- /.card-body -->
          <div class="card-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
				<input type="hidden" name="master_id" placeholder="" class="form-control input" readonly value="{{ Illuminate\Support\Facades\Crypt::encrypt($master->main_id)  }}"/>
          </div>
        
        <!-- /.card -->
        </div>
		</form>
      </div>
    </section>
</div>
<br/>
@endsection