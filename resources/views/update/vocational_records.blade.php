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
			<div style="float:right"> <a href="{{ route('masters.show', $masters->master_id)}}"><button type="button" class="btn btn-warning btn-sm text-light">BACK TO PROFILE</button></a></div>
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
          <form class="form-horizontal" method="POST" action="{{ route('vocationals.update',$masters->id) }}"  enctype="multipart/form-data" />
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
					<h4>Vocational / Trade Course</h4>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;" >
						From <small style="color:blue;">Format: yyyy</small>
					</p>
					<input autocomplete="off" type="number"  class="form-control input" name="from4"  placeholder="From" value="{{ $masters->period_from == null ? '' : $masters->period_from }}"/>
				</div>
						   
				<div class="col-md-4">
					<p style="padding-top:5px;" >
						To <small style="color:blue;">Format: yyyy</small>
					</p>
					<input autocomplete="off" type="number"  class="form-control input" name="to4"  placeholder="To" value="{{ $masters->period_to == null ? '' : $masters->period_to }}"/>				
				</div>
				
				<div class="col-md-4" >
					<p style="padding-top:5px;" >
						Year Graduated <small style="color:blue;">Format: yyyy</small>
					</p>
					<input autocomplete="off" type="number" class="form-control input" name="year4"  placeholder="Year Graduated" value="{{ $masters->year_graduated == null ? '' : $masters->year_graduated }}"/>                  
				</div>	
				
				<div class="col-md-12" >
					<p style="padding-top:5px;">
						Name of School
					</p>
					<input autocomplete="off" type="text" class="form-control input" name="vocational"  placeholder="Name of School" value="{{ $masters->name_school == null ? '' : $masters->name_school }}"/>
				</div>
							
				<div class="col-md-8">
					<p style="padding-top:5px;">
						 Course
					</p>
					<input autocomplete="off" type="text" name="course2" placeholder="Course" class="form-control input" value="{{ $masters->course == null ? '' : $masters->course }}"/>
				</div>
							
			  
				<div class="col-md-4" >
					<p style="padding-top:5px;">
						<span style="color:blue">"IF NOT GRADUATED"</span>
					</p>
					<input type="number" name="units_earned2" placeholder="Units earned" class="form-control input" value="{{ $masters->units_earned == null ? '' : $masters->units_earned }}"/>
				</div>
									
				
									
				<div class="col-md-12" >
					<p style="padding-top:5px;">
						Scholarship / Honor Received
					</p>
					<input autocomplete="off" type="text" class="form-control input" name="honor4" placeholder="Scholarship / Honor Received" value="{{ $masters->honor_received == null ? '' : $masters->honor_received }}"/>
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





