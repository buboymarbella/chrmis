@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-8">
			<div style="float:left"><h1>Education Background</h1></div>
			<div style="float:right"> <a href="{{ route('education', $master->main_id)}}"><button type="button" class="btn btn-warning btn-sm text-light">BACK TO PROFILE</button></a></div>
          </div>
          <div class="col-sm-4">
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content col-md-8">
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
          <form class="form-horizontal" method="POST" action="{{ route('graduates.store') }}"  enctype="multipart/form-data" />
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
					<h4>Graduate Studies</h4>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;" >
						From <small style="color:blue;">Format: yyyy</small>
					</p>
					<input autocomplete="off" type="number"  class="form-control input" name="from4"  placeholder="From" value="{{ old('from4') }}"/>
				</div>
						   
				<div class="col-md-4">
					<p style="padding-top:5px;" >
						To <small style="color:blue;">Format: yyyy</small>
					</p>
					<input autocomplete="off" type="number"  class="form-control input" name="to4"  placeholder="To" value="{{ old('to4') }}}"/>				
				</div>
				
				<div class="col-md-4" >
					<p style="padding-top:5px;" >
						Year Graduated <small style="color:blue;">Format: yyyy</small>
					</p>
					<input autocomplete="off" type="number" class="form-control input" name="year4"  placeholder="Year Graduated" value="{{ old('year4') }}"/>                  
				</div>	
				
				<div class="col-md-12" >
					<p style="padding-top:5px;">
						Name of School
					</p>
					<input autocomplete="off" type="text" class="form-control input" name="graduate"  placeholder="Name of School" value="{{ old('graduate') }}"/>
				</div>
							
				<div class="col-md-8">
					<p style="padding-top:5px;">
						 Course
					</p>
					<input autocomplete="off" type="text" name="course2" placeholder="Course" class="form-control input" value="{{ old('course2') }}"/>
				</div>
							
			  
				<div class="col-md-4" >
					<p style="padding-top:5px;">
						<span style="color:blue">"IF NOT GRADUATED"</span>
					</p>
					<input type="number" name="units_earned2" placeholder="Units earned" class="form-control input" value="{{ old('units_earned2') }}"/>
				</div>
									
				
									
				<div class="col-md-8" >
					<p style="padding-top:5px;">
						Scholarship / Honor Received
					</p>
					<input autocomplete="off" type="text" class="form-control input" name="honor4" placeholder="Scholarship / Honor Received" value="{{ old('honor4') }}"/>
				</div>

				<div class="col-md-4" id="data_1">
					<p style="padding-top:5px;">Type of Schooling</p>
					<!--<input type="text" name="emp_stat"  placeholder="Employee Status" class="form-control input"  value="{{ old('emp_stat') }}"/>-->
					 <select name="type_of_schooling" class="form-control" >
						<option>Masteral</option>
						<option>Doctorate</option>
					</select>
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





