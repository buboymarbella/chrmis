@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Vehicle</h1>
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
          <form class="form-horizontal" method="POST" action="{{ route('vehicles.store') }}"  enctype="multipart/form-data">
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
				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Vehicle Type </p>
					<input type="text" name="type_vehicle"  placeholder="Vehicle Type" class="form-control input"  value="{{ old('type_vehicle') }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Plate Number</p>
					<input type="text" name="plate_number" placeholder="Plate Number" class="form-control input"  value="{{ old('plate_number') }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Color</p>
					<input type="text" name="color" placeholder="Color" class="form-control input"  value="{{ old('color') }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Owner</p>
					<input type="text" name="owner" placeholder="Owner" class="form-control input"  value="{{ old('owner') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;"> Date Reported</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="date_reported" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
					</div>
                </div>

				<div class="col-md-12">
					   <p style="padding-top:5px;">Image</p>
					  <input type="file" name="vehicle">
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





