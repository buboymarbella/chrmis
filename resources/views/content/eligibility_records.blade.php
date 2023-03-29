@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
			<div style="float:left"><h1>Eligibility</h1></div>
            <div style="float:right"> <a href="{{ route('eligibility', $master->main_id)}}"><button type="button" class="btn btn-warning btn-sm text-light">BACK TO PROFILE</button></a></div>
          </div>
          <div class="col-sm-4">
           
          </div>
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
          <form class="form-horizontal" method="POST" action="{{ route('eligibilities.store') }}"  enctype="multipart/form-data">
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
				
				{{-- <div class="col-md-8" id="data_1">
					<p style="padding-top:5px;">Eligibility</p>
					<input autocomplete="off" type="text" name="eligibility" required  placeholder="Eligibility" class="form-control input" 
					value="{{ old('eligibility') }}"/>
				</div> --}}

				<div class="col-md-6">
					<p style="padding-top:5px;">Select Eligibility</p>
					<select id="select4-dropdown"  class=" form-control select2" name="eligibility">
						<option value="NULL">--Select--</option>
						@forelse ($qualification as $key=>$qualification)
						<option>{{ $qualification->eligibility }}</option>
						@empty
						<option>N/A</option>
						@endforelse
					</select>
                </div>
									   
				<div class="col-md-6" >
					<p style="padding-top:5px;"> Rating</p>
					<input autocomplete="off" type="text" name="rating" placeholder="Rating" class="form-control input" 
					value="{{ old('rating') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">Date of examination</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="date_examination" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask>
					</div>
                </div>
									  
				<div class="col-md-8" id="data_1">
					<p style="padding-top:5px;">License Number</p>
					<input autocomplete="off"  type="text" name="license_number" placeholder="License Number" class="form-control input" 
					value="{{ old('license_number') }}"/>
				</div>
									  
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">License Validity</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="license_validity" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('license_validity') }}"/>
					</div>
                </div>
									  
				<div class="col-md-8">
					<p style="padding-top:5px;">Examination Place</p>
					<input autocomplete="off"  type="text" name="examination_place" placeholder="Examination Place" class="form-control input" 
					value="{{ old('examination_place') }}"/>
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





