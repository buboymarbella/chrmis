@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <div style="float:left"> <h1>PLANTILLA</h1></div>
            <div style="float:right"> <a href="{{ route('plantillas.index')}}"><button type="button" class="btn btn-warning btn-sm text-light"><< BACK</button></a></div>
          </div>
         
          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{ route('plantillas.index')}}"></a></li>
            </ol>
          </div> --}}
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default col-md-6">
          <div class="card-header">
            <h3 class="card-title"></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <form class="form-horizontal" method="POST" action="{{ route('plantillas.update', $plantilla->id) }}"  enctype="multipart/form-data">
			@csrf
			@method('PUT')
          <div class="card-body">
            <div class="row">
                <div class="col-md-12" id="data_1">
				@if ($errors->any())
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						@foreach ($errors->all() as $error)
								{{ $error}}<br/>
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
				
				<div class="col-md-8">
					<p style="padding-top:5px;">Select CHR </p>
				   
					<select id="select2-dropdown"  class=" form-control select2" name="livesearch">
						@if(empty($plantilla2))
							<option value="">--Select--</option>
						@else
							<option value="{{ $plantilla2->main_id == null ? '' : $plantilla2->main_id }}">{{ $plantilla2->main_id == null ? '--Select--' : $plantilla2->complete_name }} </option>
						@endif
						<option value="">EMPTY</option>
						@foreach($autocomplete as $item)
						<option value="{{ $item->main_id }}">{{ $item->complete_name }}</option>
						@endforeach
					</select>
				</div>

				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;"> Date of Orig App</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="date_hired" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="@if($plantilla->date_hired == null)
								
								@elseif($plantilla->date_hired == '1970-01-01')
									
								@else
									{{ date('m/d/Y', strtotime($plantilla->date_hired)) }}
								@endif" />
					</div>
        		</div>

				<div class="col-md-12">
					<p style="padding-top:5px;">Plantilla Number </p>
					<input type="text" name="plantilla_number"  placeholder="Plantilla Number" class="form-control input"  value="{{ $plantilla->plantilla_number == null ? '' : $plantilla->plantilla_number }}"/>
				</div>

       			<div class="col-md-12">
					<p style="padding-top:5px;">Position Title </p>
					<!-- <input type="text" name="position_title"  placeholder="Position Title" class="form-control input"  value="{{ $plantilla->title == null ? '' : $plantilla->title }}"/> -->
					<select id="select4-dropdown"  class="form-control select2" name="position_title">
						<option value="{{ $plantilla->title == null ? '' : $plantilla->title }}">{{ $plantilla->title == null ? '--Select--' : $plantilla->title }}</option>
						<option value="">EMPTY</option>
						@forelse ($position as $key=>$position)
						<option>{{ $position->title }}</option>
						@empty
						<option>N/A</option>
						@endforelse
					</select>
				</div>

        		{{-- <div class="col-md-6">
					<p style="padding-top:5px;">Office/Unit </p>
					<input type="text" name="office"  placeholder="Office/Unit" class="form-control input"  value="{{ $plantilla->office == null ? '' : $plantilla->office }}"/>
				</div> --}}

				<div class="col-md-6">
					<p style="padding-top:5px;">Office/Unit </p>
				   
					<select id="select3-dropdown"  class=" form-control select2" name="office">
					 	<option value="{{ $plantilla->office == null ? '' : $plantilla->office }}">{{ $plantilla->office == null ? '--Select--' : $plantilla->office }} </option>
						<option value="">EMPTY</option>
					 	@foreach($unit as $item)
					  		<option value="{{ $item->unit }}">{{ $item->unit }}</option>
					  	@endforeach
					</select>
				</div>

        		<div class="col-md-6">
					<p style="padding-top:5px;">Salary Grade </p>
					<input type="number" name="salary_grade"  placeholder="Salary Grade" class="form-control input"  value="{{ $plantilla->sg == null ? '' : $plantilla->sg }}"/>
				</div>

        		<div class="col-md-6" id="data_1">
					<p style="padding-top:5px;">Staff Action</p>
					 <select name="staff_action" class="form-control" >
						<option value="{{ $plantilla->staff_action == null ? '' : $plantilla->staff_action }}">{{ $plantilla->staff_action == null ? '--Select--' : $plantilla->staff_action }} </option>
						<option value="">Empty</option>
						<option value="fill">Fill-up</option>
						<option value="transfer">Transfer</option>
						<option value="abolish">Abolish</option>
						<option value="retitle">Retitle</option>
						<option value="under_study">Under Study</option>
					</select>
				</div>

        		<div class="col-md-6" id="data_1">
					<p style="padding-top:5px;">Sourcing Method</p>
					 <select name="sourcing_method" class="form-control" >
						<option value="{{ $plantilla->sourcing_method == null ? '' : $plantilla->sourcing_method }}">{{ $plantilla->sourcing_method == null ? '--Select--' : $plantilla->sourcing_method }} </option>
						<option value="">Empty</option>
						<option>Employee Referrals</option>
						<option>Websites</option>
						<option>Social Media</option>
						<option>Job Boards</option>
						<option>Networks</option>
						<option>Internal Selection</option>
						<option>Others</option>
					</select>
				</div>

				<div class="col-md-6" id="data_1">
         		<p style="padding-top:5px;">Start Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="start_date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ $plantilla->start_date == '1970-01-01' ? 'mm/dd/yyyy' : date('m/d/Y', strtotime($plantilla->start_date)) }}"/>
					</div>
        		</div>

        		<div class="col-md-6" id="data_1">
          		<p style="padding-top:5px;">End Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="end_date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ $plantilla->end_date == '1970-01-01' ? 'mm/dd/yyyy' : date('m/d/Y', strtotime($plantilla->end_date)) }}"/>
					</div>
        		</div>

        		<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">SG Level Classification</p>
					 <select name="level_classification" class="form-control" >
						<option value="{{ $plantilla->level_class == null ? '' : $plantilla->level_class }}">
						@if($plantilla->level_class == "1ST")
							1st Level
						@elseif($plantilla->level_class == "2ND_TECH")
							2nd Level Technical
						@elseif($plantilla->level_class == "2ND_SUPERVISORY")
							2nd Level Supervisory
						@else
							--Select--
						@endif
						</option>
						<option value="1st">1st Level</option>
						<option value="2nd_tech">2nd Level Technical</option>
            			<option value="2nd_supervisory">2nd Level Supervisory</option>
					</select>
				</div>

				<div class="col-md-8" id="data_1">
					<p style="padding-top:5px;">Sourcing Method</p>
					 <select name="status" class="form-control" >
						<option value="{{ $plantilla->status == null ? '' : $plantilla->status }}">{{ $plantilla->status == null ? '--Select--' : $plantilla->status }}</option>
						<option value="">Empty</option>
						<option>Publication of Vacancy</option>
						<option>Conduct of Local Board Deliberation</option>
						<option>Conduct of GHQ Board Deliberation</option>
						<option>Conduct of Assessment/Test</option>
						<option>Release of Minutes and Board Resolution</option>
						<option>Release of Directives</option>
						<option>Submission of Requirements</option>
						<option>Approval of Appointment</option>
						<option>Submission of RAI to CSC</option>
						<option>Others</option>
					</select>
				</div>

				<div class="col-md-6">
					<p style="padding-top:5px;">Req'd Training Hours </p>
					<input type="number" name="hours"  placeholder="Ex: 40" class="form-control input"  value="{{ $plantilla->training == null ? '' : $plantilla->training }}"/>
				</div>

        		<div class="col-md-6">
					<p style="padding-top:5px;">Req'd Years of Exp</p>
					<input type="number" name="years"  placeholder="Ex: 4" class="form-control input"  value="{{ $plantilla->experience == null ? '' : $plantilla->experience }}"/>
				</div>

        		<div class="col-md-12" id="data_1">
					<p style="padding-top:5px;">Req'd Eligibility</p>
          			<select id="select4-dropdown" class=" form-control select2" name="eligibility">
						<option value="{{ $plantilla->eligibility == null ? '' : $plantilla->eligibility }}">{{ $plantilla->eligibility == null ? '--Select--' : $plantilla->eligibility }}</option>
						<option value="">Empty</option>
						@forelse ($qualification as $key=>$qualification)
						<option>{{ $qualification->eligibility }}</option>
						@empty
						<option>N/A</option>
						@endforelse
					</select>
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





