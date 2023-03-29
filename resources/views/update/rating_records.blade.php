@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
			<div style="float:left"><h1>IPCR</h1></div>
			<div style="float:right"> <a href="{{ route('rating', $masters->master_id)}}"><button type="button" class="btn btn-warning btn-sm text-light">BACK TO PROFILE</button></a></div>
          </div>
          <div class="col-sm-6">
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content col-md-6">
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
          <form class="form-horizontal" method="POST" action="{{ route('ratings.update',$masters->id) }}"  enctype="multipart/form-data">
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
					<p>Numerical Ratings</p>
					<input required type="text" id="search" name="n_rating"  placeholder="Numerical Ratings" class="form-control input" onChange="myFunction()"
						onKeyPress="return disableEnterKey(event)"	value="{{ $masters->n_rating == null ? '' : $masters->n_rating }}"/>
				</div>
						
				<div class="col-md-12">
					<p style="padding-top:5px;">Adjective Ratings</p>
					<input readonly type="text" id="demo" name="a_rating"  placeholder="Adjective Ratings" class="form-control input" 
					value="{{ $masters->a_rating == null ? '' : $masters->a_rating }}"/>
									 
				</div>
				
				<div class="col-md-12" id="data_1">
                    <p style="padding-top:5px;">Start Date Assessment/p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="s_assessment" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ $masters->s_assessment == null ? 'mm/dd/yyyy' : date('m/d/Y', strtotime($masters->s_assessment)) }}" />
					</div>
                </div>
				
				<div class="col-md-12" id="data_1">
                    <p style="padding-top:5px;">End Date Assessment</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="e_assessment" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ $masters->e_assessment == null ? 'mm/dd/yyyy' : date('m/d/Y', strtotime($masters->e_assessment)) }}" />
						
					</div>
                </div>
				
				<div class="col-md-12">
                    <p style="padding-top:5px;">Current Attachment</p>
        
					<div class="input-group">
						
						<input type="text" name="null" class="form-control"
						value="{{ $masters->picture == null ? '' : $masters->picture }}" />
					</div>
                </div>
				
				<div class="col-md-12" id="data_1">
					<p style="padding-top:5px;">Upload IPCR</p>
					<input type="file" name="userfile" id="userfile"  class="form-control input"/>			
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





