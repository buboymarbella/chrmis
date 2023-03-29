@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-8">
			<div style="float:left"><h1>Voluntary</h1></div>
            <div style="float:right"> <a href="{{ route('voluntary', $master->main_id)}}"><button type="button" class="btn btn-warning btn-sm text-light">BACK TO PROFILE</button></a></div>
          </div>
          <div class="col-sm-4">
           
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default col-md-8">
          <div class="card-header">
            <h3 class="card-title"></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <form class="form-horizontal" method="POST" action="{{ route('voluntaries.store') }}"  enctype="multipart/form-data">
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
				
				<div class="col-md-12" id="data_1">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						Note if currently active member leave the date "TO" blank
					</div>
				</div>
				
				<div class="col-md-12" >
					<p style="padding-top:5px;">Name & Address of Organization</p>
					<input autocomplete="off" type="text" name="name_organization" placeholder="Name & Address of Organization" class="form-control input" 
					required value="{{ old('name_organization') }}"/>
				</div>	
				
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">From</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="inclusive_from" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('inclusive_from') }}"/>
					</div>
                </div>
					  
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">To</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="inclusive_to" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('inclusive_to') }}"/>
					</div>
                </div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Number of Hours</p>
					<input type="number" name="hour_number"  placeholder="Number of Hours" class="form-control input" 
					value="{{ old('hour_number') }}"/>
				</div>
									 
				<div class="col-md-12" >
					<p style="padding-top:5px;">Position / Nature of work</p>
					<input autocomplete="off" type="text" name="position"  placeholder="Position / Nature of work" class="form-control input" 
					value="{{ old('position') }}"/>
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





