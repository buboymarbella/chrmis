@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Education Background</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{ route('education', $master->main_id)}}">Back to Profile</a></li>
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
          <form class="form-horizontal" method="POST" action="{{ route('educations.store') }}"  enctype="multipart/form-data">
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
				
				<div class="col-md-12">
					<h4>Elementary</h4>
				</div>
				
				<div class="col-md-3" >
					<p style="padding-top:5px;" >
						From <small style="color:blue;">Format: yyyy</small>
					</p>
					<input type="number" class="form-control input" name="from1"  placeholder="From" value="{{ old('from1') }}"/>
				</div>
						   
				<div class="col-md-3" >
					<p style="padding-top:5px;" >
						To <small style="color:blue;">Format: yyyy</small>
					</p>
					<input type="number" class="form-control input" name="to1"  placeholder="To" value="{{ old('to1') }}"/>				
				</div>
									
				<div class="col-md-3" >
					<p style="padding-top:5px;" >
						Year Graduated <small style="color:blue;">Format: yyyy</small>
					 </p>
					<input type="number" class="form-control input" name="year1"  placeholder="Year Graduated" value="{{ old('year1') }}"/>                  
				</div>
				
				<div class="col-md-9" >
					<p style="padding-top:5px;">
						Name of School
					</p>
					<input type="text" class="form-control input" name="elem"  placeholder="Name of School" value="{{ old('elem') }}"/>
				</div>
				
				<div class="col-md-9" >
					<p style="padding-top:5px;">
						Scholarship / Honor Received
					</p>
					<input type="text" class="form-control input" name="honor1" placeholder="Scholarship / Honor Received" value="{{ old('honor1') }}"/>
				</div>
				
				<div class="col-md-12">
					<h4>High School</h4>
				</div>
				
				<div class="col-md-3" >
					<p style="padding-top:5px;" >
						From <small style="color:blue;">Format: yyyy</small>
					</p>
					<input type="number" class="form-control input" name="from2"  placeholder="From" value="{{ old('from2') }}"/>                   
				</div>
						   
				<div class="col-md-3" >
					<p style="padding-top:5px;" >
						To <small style="color:blue;">Format: yyyy</small>
					</p>
					<input type="number" class="form-control input" name="to2"  placeholder="To" value="{{ old('to2') }}"/>
				</div>
									
				<div class="col-md-3" >
					<p style="padding-top:5px;" >
						Year Graduated <small style="color:blue;">Format: yyyy</small>
					</p>
					<input autocomplete="off" type="number" class="form-control input" name="year2"  placeholder="Year Graduated" value="{{ old('year2') }}"/>
				</div>
				
				<div class="col-md-9" >
					<p style="padding-top:5px;">
						Name of School
					</p>
					<input type="text" class="form-control input"  name="high"  placeholder="Name of School" value="{{ old('high') }}"/>
				</div>
								
				<div class="col-md-9" >
					<p style="padding-top:5px;">
						 Scholarship / Honor Received
					</p>
					<input autocomplete="off" type="text" class="form-control input" name="honor2" placeholder="Scholarship / Honor Received"  value="{{ old('honor2') }}"/>
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





