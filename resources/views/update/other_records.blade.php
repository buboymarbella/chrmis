@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
            <div style="float:left"><h1>Skill/Recog/Assoc</h1></div>
            <div style="float:right;"> <a href="{{ route('skills', $masters->master_id)}}"><button type="button" class="btn btn-warning btn-sm text-light">BACK TO PROFILE</button></a></div>
          </div>
          <div class="col-sm-6">
           
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default col-md-6">
          <div class="card-header">
            <h3 class="card-title"></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <form class="form-horizontal" method="POST" action="{{ route('others.update',$masters->id) }}"  enctype="multipart/form-data">
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
				
				<div class="col-md-12" >
                <p style="padding-top:5px;">SPECIAL SKILLS and HOBBIES</p>
					<input autocomplete="off"  type="text" name="skills" placeholder="E.G Reading, Basketball and Web Developing" class="form-control input" 
					value="{{ $masters->skills == null ? '' : $masters->skills }}"/>
				</div>			                       
									   
				<div class="col-md-12">
					<p style="padding-top:5px;">NON-ACADEMIC DISTINCTIONS / RECOGNITION</p>
					<input type="text" name="recognition"  placeholder="E.G Letter of Commendation by AFP on 29 Aug 2019" class="form-control input" 
					value="{{ $masters->recognition == null ? '' : $masters->recognition }}"/>
				</div>
											
									  
				<div class="col-md-12">
					<p style="padding-top:5px;">MEMBERSHIP IN ASSOCIATION/ORGANIZATION</p>
					<input autocomplete="off"  type="text" name="association"  placeholder="E.G Computer Society" class="form-control input" 
					value="{{ $masters->association_member == null ? '' : $masters->association_member }}"/>
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





