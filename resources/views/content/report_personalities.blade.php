@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>REPORT CTG</h1>
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
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Personalities</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <form class="form-horizontal" method="POST" action="{{ route('result_personalities') }}"  enctype="multipart/form-data" target="_blank">
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
					<p style="padding-top:5px;"> Region </p>
						<select id="reg" class="form-control input" name="region">
							<option value="N/A">Select All</option>
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
					<p style="padding-top:5px;"> Threat Group </p>
					<select id="rpc" class="form-control input" name="threat">
						<option value="N/A">Select All</option>
						 @foreach($threats as $key=>$threat)
						<option>{{ $threat->threat}}</option>
						@endforeach
					</select>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;"> Party Organization </p>
						<select id="res" class="form-control input" name="view_all">
							<option value="N/A">Select Party Organization</option>
						</select>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Status</p>
					<select class="form-control input" name="pers_status">
						<option value="N/A">Select All</option>
						<option>Active</option>
						<option>In-Active</option>
						<option>Deceased</option>
						<option>Missing</option>
						<option>Neutralized</option>
						<option>Surrendered</option>
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





