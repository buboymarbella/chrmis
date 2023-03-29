@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('masters.index')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Add User</li>
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
            <h3 class="card-title">Add User</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <form class="form-horizontal" method="POST" action="{{ route('users.store') }}"  enctype="multipart/form-data">
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
                    <p style="padding-top:5px;">Last Name </p>
                    <input type="text" name="last_name"  placeholder="Last Name" class="form-control input"  value="{{ old('last_name') }}"/>
                </div>

                <div class="col-md-4">
                  <p style="padding-top:5px;">First Name</p>
                  <input type="text" name="first_name" placeholder="First Name" class="form-control input"  value="{{ old('first_name') }}"/>
                </div>
    
                <div class="col-md-4">
                    <p style="padding-top:5px;">Middle Name </p>
                    <input type="text" name="middle_name" placeholder="Middle Name" class="form-control input" value="{{ old('middle_name') }}"/>
                </div>
            
                <div class="col-md-4">
                    <p style="padding-top:5px;">Extension Name</p>
                    <input type="text" name="extension_name"  placeholder="Extension Name" class="form-control input" value="{{ old('extension_name') }}"/>
                </div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Office</p>
					<select id="select3-dropdown"  class=" form-control select2" name="office">
						<option value="">--Select--</option>
						@forelse ($office as $key=>$office)
						<option>{{ $office->unit }}</option>
						@empty
						<option>N/A</option>
						@endforelse
					</select>
				</div>		

				<div class="col-md-4">
					<p style="padding-top:5px;">Position</p>
					<input type="text" name="position" placeholder="Position" class="form-control input" value="{{ old('position') }}"/>
				</div>	

				<div class="col-md-4">
					<p style="padding-top:5px;">Access Level </p>
						<select class="form-control input" name="acc_lvl">
							<option value="N/A">Access Level</option>
							<option>Administrator</option>
							<option>Supervisor</option>
							<option>User</option>
						</select>
				</div>
				
				<!--<div class="col-md-4">
					<p style="padding-top:5px;"> Branch </p>
						<select class="form-control input" name="branch">
							<option value="N/A">Select Branch</option>
							<option>CTG</option>
							<option>TERRORISM</option>
							<option>FOREIGN</option>
							<option>CI</option>
						</select>
				</div>-->
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Branch</p>
					<input type="text" name="branch" placeholder="Position" class="form-control input" value="{{ old('branch') }}"/>
				</div>	
				
				<div class="col-md-4">
					<p style="padding-top:5px;">E-Mail Address</p>
					<input type="text" name="email" placeholder="E-Mail Address" class="form-control input" value="{{ old('email') }}"/>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Password</p>
					<input type="password" name="password" placeholder="Password" class="form-control input" value=""/>
				</div>	
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Confirm Password</p>
					<input type="password" name="password_confirmation" placeholder="Password" class="form-control input" value=""/>
				</div>

                <div class="col-md-12">
                   <p style="padding-top:5px;">Picture</p>
                  <input type="file" name="select_file">
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
</br>
@endsection





