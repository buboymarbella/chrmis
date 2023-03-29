@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>CHR DEMOGRAPHICS REPORTS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('masters.index')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Search</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default col-md-4">
          <div class="card-header">
            <h3 class="card-title"></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <form class="form-horizontal" method="POST" action="{{ route('demographics_result') }}"  enctype="multipart/form-data">
			@csrf
			@method('POST')
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
				
				
				<div class="col-md-12">
					<p style="padding-top:5px;">Select Variable</p>
					<select class="form-control input" name="variable" id="select_var">
						<option value="">--Select--</option>
						<option>Blood Type</option>
						<option>Civil Status</option>  
						<option>Indigenous Group Membership</option>
						<option>PWD Membership</option> 
						<option>Sex</option> 
						<option>Solo Parent</option> 
						<!-- <option>Accreditation</option>  -->
						<option>Type of Eligibility</option> 
						<option>Year of Birth</option>
						<option>Year of Retirement</option>  
						<option>Years of Service in the AFP</option>
					</select>
                </div>

				<div class="col-md-12" id="year_birth">
					<p style="padding-top:5px;">Year</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="start_year" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy" data-mask>
					</div>
                </div>

				<!-- <div class="col-md-12" id="eligibility">
					<p style="padding-top:5px;">Eligibility</p>
        
					<div class="input-group">
					<select id="select4-dropdown" style="width:100%" class=" form-control select2" name="eligibility">
						<option value="NULL">--Select--</option>
						@forelse ($qualification as $key=>$qualification)
						<option>{{ $qualification->eligibility }}</option>
						@empty
						<option>N/A</option>
						@endforelse
					</select>
					</div>
                </div> -->

				<div class="col-md-12" id="year_service">
					<p style="padding-top:5px;">No. Years </p>
					<input type="text" name="no_years"  placeholder="No. Years" class="form-control input" />
				</div>

				<div class="col-md-12" id="year_retirees">
					<p style="padding-top:5px;">Year of Retirement </p>
					<input type="text" name="year_retirees"  placeholder="Year of retirement" class="form-control input" />
				</div>
				
				<div class="col-md-12">
					<p style="padding-top:10px;">Office/Unit</p>
					
					<select id="select3-dropdown"  class=" form-control select2" name="office">
						<option value="">--Select--</option>
						<option value="COORDINATING_STAFF">Joint Staff Wide</option>
						<option value="PERSONAL_STAFF">Personal Staff Wide</option>
						<option value="SPECIAL_STAFF">Special Staff Wide</option>
						<option value="AFPWSSUS">AFPWSSU's</option>
						<option value="UNIFIED_COMMAND">Unified Commands</option>
						@forelse ($office as $key=>$office)
						<option>{{ $office->unit }}</option>
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

@push('js')

<script>

$("#select_var").change(function() {
	if ($(this).val() == "Year of Birth") {
		$("#year_birth").show();
	}else{
		$("#year_birth").hide();
	}

	if ($(this).val() == "Year of Retirement") {
		$("#year_retirees").show();
	}else{
		$("#year_retirees").hide();
	}
	
	if ($(this).val() == "Years of Service in the AFP") {
		$("#year_service").show();
	}else{
		$("#year_service").hide();
	}
});	
$("#year_birth").hide();
$("#year_service").hide();
$("#year_retirees").hide();
</script>
@endpush



