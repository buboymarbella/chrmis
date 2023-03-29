@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Associate</h1>
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
          <form class="form-horizontal" method="POST" action="{{ route('associates.store') }}"  enctype="multipart/form-data">
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
					<p style="padding-top:5px;">First Name</p>
					<input type="text" name="first_name" placeholder="First Name" class="form-control input"  value="{{ old('first_name') }}"/>
				</div>
				<!-- End of firstname -->
				<div class="col-md-4">
					<p style="padding-top:5px;">Middle Name </p>
					<input type="text" name="middle_name" placeholder="Middle Name" class="form-control input" value="{{ old('middle_name') }}"/>
				</div>
				<!-- End of middlename -->	
				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Last Name </p>
					<input type="text" name="last_name"  placeholder="Last Name" class="form-control input"  value="{{ old('last_name') }}"/>
				</div>
				<!-- End of lastname -->			
				<div class="col-md-4">
					<p style="padding-top:5px;">Extension Name</p>
					<input type="text" name="extension_name"  placeholder="Extension Name" class="form-control input" value="{{ old('extension_name') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;"> Birthdate</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="birthdate" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask />
					</div>
                </div>
				<!--
				<div class="col-md-4">
					<p style="padding-top:5px;">Latitude</p>
					<input type="text" name="latitude" placeholder="Latitude" class="form-control input" value="{{ old('latitude') }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Longitude</p>
					<input type="text" name="longitude" placeholder="Longitude" class="form-control input" value="{{ old('longitude') }}"/>
				</div>
				-->
				<div class="col-md-8">
					<p style="padding-top:5px;">Present Address</p>
					<input type="text" name="address" placeholder="Present Address" class="form-control input" value="{{ old('home_address') }}"/>
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





