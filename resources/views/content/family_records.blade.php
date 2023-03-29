@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Family Background</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{ route('families_records', $master->main_id)}}">Back to Profile</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content col-md-6">
      <div class="container-fluid ">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default ">
          <div class="card-header">
            <h3 class="card-title"></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <form class="form-horizontal" method="POST" action="{{ route('families.store',$user_id->main_id) }}"  enctype="multipart/form-data">
			@csrf
          <div class="card-body" >
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
					<h4>Spouse</h4>
				</div>
				<div class="col-md-12" id="data_1">
					<p style="padding-top:5px;">Lastname </p>
					<input type="text" name="slast_name"  placeholder="Lastname" class="form-control input"  value=""/>
				</div>
				<!-- End of lastname -->
				<div class="col-md-12">
					<p style="padding-top:5px;">Firstname</p>
					<input type="text" name="sfirst_name" placeholder="Firstname" class="form-control input"  value=""/>
				</div>
				<!-- End of firstname -->
				<div class="col-md-12">
					<p style="padding-top:5px;">Middlename </p>
					<input type="text" name="smiddle_name" placeholder="Middlename" class="form-control input" value=""/>
				</div>
				<!-- End of middlename -->					
				<div class="col-md-12">
					<p style="padding-top:5px;">Extension Name</p>
					<input type="text" name="sextension_name"  placeholder="Extension Name" class="form-control input" value=""/>
				</div>
				
				<!-- End of extension name -->					
				<div class="col-md-12">
					<p style="padding-top:5px;">Occupation</p>
					<input type="text" name="occupation"  placeholder="Occupation" class="form-control input" value=""/>
				</div>
				<!-- End of occupation -->	
				<div class="col-md-12">
					<p style="padding-top:5px;">Employer/Business Name</p>
					<input type="text" name="employer"  placeholder="Employer/Business Name" class="form-control input" value=""/>
				</div>
				<!-- End of occupation -->	
				<div class="col-md-12">
					<p style="padding-top:5px;">Business Address</p>
					<input type="text" name="business_address"  placeholder="Business Address" class="form-control input" value=""/>
				</div>
				<!-- End of occupation -->	
				<div class="col-md-12">
					<p style="padding-top:5px;">Tel No.</p>
					<input type="text" name="telephone_no"  placeholder="Tel No." class="form-control input" value=""/>
				</div>
				
				<div class="col-md-12 mt-3">
					<h4>Father</h4>
				</div>
				
				<div class="col-md-12" id="data_1">
					<p style="padding-top:5px;">Last Name </p>
					<input type="text" name="flast_name"  placeholder="Last Name" class="form-control input"  value=""/>
				</div>
				<!-- End of lastname -->
				<div class="col-md-12">
					<p style="padding-top:5px;">First Name</p>
					<input type="text" name="ffirst_name" placeholder="First Name" class="form-control input"  value=""/>
				</div>
				<!-- End of firstname -->
				<div class="col-md-12">
					<p style="padding-top:5px;">Middle Name </p>
					<input type="text" name="fmiddle_name" placeholder="Middle Name" class="form-control input" value=""/>
				</div>
				<!-- End of middlename -->					
				<div class="col-md-12">
					<p style="padding-top:5px;">Extension Name</p>
					<input type="text" name="fextension_name"  placeholder="Extension Name" class="form-control input" value=""/>
				</div>
				
				<div class="col-md-12 mt-3">
					<h4>Mother</h4>
				</div>
				
				<div class="col-md-12" id="data_1">
					<p style="padding-top:5px;">Maiden Name </p>
					<input type="text" name="maiden_name"  placeholder="Maiden Name" class="form-control input"  value=""/>
				</div>
				<!-- End of mainden name -->
				<div class="col-md-12" id="data_1">
					<p style="padding-top:5px;">Last Name </p>
					<input type="text" name="mlast_name"  placeholder="Lastname" class="form-control input"  value=""/>
				</div>
				<!-- End of lastname -->
				<div class="col-md-12">
					<p style="padding-top:5px;">First Name</p>
					<input type="text" name="mfirst_name" placeholder="Firstname" class="form-control input"  value=""/>
				</div>
				<!-- End of firstname -->
				<div class="col-md-12">
					<p style="padding-top:5px;">Middle Name </p>
					<input type="text" name="mmiddle_name" placeholder="Middlename" class="form-control input" value=""/>
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





