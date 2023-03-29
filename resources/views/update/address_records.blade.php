@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Address</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{ route('masters.show', $masters->main_id)}}">Back to Profile</a></li>
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
          <form class="form-horizontal" method="POST" action="{{ route('addresses.update', $masters->main_id) }}"  enctype="multipart/form-data">
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
					<strong><h4 style="padding-top:5px;">Residential Address</h3></strong>
				</div>
				
				<div class="col-md-3" >
					<p style="padding-top:5px;" >
						Zip Code
					</p>
					<input type="text" class="form-control input" name="residential_zipcode"  placeholder="Zip Code" value="{{ $address->residential_zipcode == null ? '' : $address->residential_zipcode }}"/>
				</div>
						 
						 
				<div class="col-md-3" >
					<p style="padding-top:5px;" >
						House Number
					</p>
					<input type="text" class="form-control input" name="residential_house"  placeholder="House Number" value="{{ $address->residential_house == null ? '' : $address->residential_house }}"/>
				</div>
				
				  
				<div class="col-md-9" >
					<p style="padding-top:5px;" >
						Street
					</p>
					<input type="text" class="form-control input" name="residential_street"  placeholder="Street" value="{{ $address->residential_street == null ? '' : $address->residential_street }}"/>				
				</div>
									
				<div class="col-md-9" >
					<p style="padding-top:5px;">
						Village
					</p>
					<input type="text" class="form-control input" name="residential_subdivision"  placeholder="Village" value="{{ $address->residential_subdivision == null ? '' : $address->residential_subdivision }}"/>
				</div>
				
				<div class="col-md-9" >
					<p style="padding-top:5px;">
						Barangay
					</p>
					<input type="text" class="form-control input" name="residential_brgy" placeholder="Barangay" value="{{ $address->residential_brgy == null ? '' : $address->residential_brgy }}"/>
				</div>
				
				<div class="col-md-9" >
					<p style="padding-top:5px;">
						City / Municipality
					</p>
					<input type="text" class="form-control input" name="residential_city" placeholder="City / Municipality" value="{{ $address->residential_city == null ? '' : $address->residential_city }}"/>
				</div>
				
				<div class="col-md-9" >
					<p style="padding-top:5px;">
						Province
					</p>
					<input type="text" class="form-control input" name="residential_province" placeholder="Province" value="{{ $address->residential_province == null ? '' : $address->residential_province }}"/>
				</div>
			
				<div class="col-md-12">
					<strong><h4 style="padding-top:5px;">Permanent Address</h3></strong>
				</div>
			
				<div class="col-md-3" >
					<p style="padding-top:5px;" >
						Zip Code
					</p>
					<input type="text" class="form-control input" name="permanent_zipcode"  placeholder="Zip Code" value="{{ $address->permanent_zipcode == null ? '' : $address->permanent_zipcode }}"/>
				</div>
                     
					 
				<div class="col-md-3" >
					<p style="padding-top:5px;" >
						House Number
					</p>
					<input type="text" class="form-control input" name="permanent_house"  placeholder="House Number" value="{{ $address->permanent_house == null ? '' : $address->permanent_house }}"/>
				</div>

				<div class="col-md-9" >
					<p style="padding-top:5px;" >
						Street
					</p>
					<input type="text" class="form-control input" name="permanent_street"  placeholder="Street" value="{{ $address->permanent_street == null ? '' : $address->permanent_street }}"/>				
				</div>
									
				<div class="col-md-9" >
					<p style="padding-top:5px;">
						Village
					</p>
					<input type="text" class="form-control input" name="permanent_subdivision"  placeholder="Village" value="{{ $address->permanent_subdivision == null ? '' : $address->permanent_subdivision }}"/>
				</div>
				
				<div class="col-md-9" >
					<p style="padding-top:5px;">
						Barangay
					</p>
					<input type="text" class="form-control input" name="permanent_brgy" placeholder="Barangay" value="{{ $address->permanent_brgy == null ? '' : $address->permanent_brgy }}"/>
				</div>
				
				<div class="col-md-9" >
					<p style="padding-top:5px;">
						City / Municipality
					</p>
					<input type="text" class="form-control input" name="permanent_city" placeholder="City / Municipality" value="{{ $address->permanent_city == null ? '' : $address->permanent_city }}"/>
				</div>
				
				<div class="col-md-9" >
					<p style="padding-top:5px;">
						Province
					</p>
					<input type="text" class="form-control input" name="permanent_province" placeholder="Province" value="{{ $address->permanent_province == null ? '' : $address->permanent_province }}"/>
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





