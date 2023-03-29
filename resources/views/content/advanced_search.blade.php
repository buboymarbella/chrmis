@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>CHR DEMOGRAPHICS REPORTS</h1>
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
        <div class="card card-default col-md-8">
          <div class="card-header">
            <h3 class="card-title">CHR</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <form class="form-horizontal" method="POST" action="{{ route('advanced_result') }}"  enctype="multipart/form-data" target="_blank">
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

				<div class="col-md-6">
					<p style="padding-top:5px;">Name</p>
					<input type="text" name="name"  placeholder="Name" class="form-control input" value="{{ old('name') }}"/>
				</div>
				
				@can('viewAny', App\User::class)
				<div class="col-md-6">
					<p style="padding-top:5px;">Office/Unit</p>
					
					<select class="form-control input" name="office">
						<option value="">Select Office</option>
						@forelse ($office as $key=>$office)
						<option>{{ $office->office }}</option>
						@empty
						<option>N/A</option>
						@endforelse
					</select>
				</div>
				@endcan
				
				<div class="col-md-6">
					<p style="padding-top:5px;"> Blood Type </p>
					<select class="form-control input" name="bt">
						<option value="N/A">Select Blood Type</option>
						<option>A</option>
						<option>A+</option>  
						<option>A-</option>  						
						<option>B</option>   
						<option>B+</option> 
						<option>B-</option> 
						<option>O</option> 
						<option>O+</option> 
						<option>O-</option> 
						<option>AB</option>   
						<option>AB-</option>
						<option>AB+</option>
					</select>
                </div>
				
				<div class="col-md-6">
					<p style="padding-top:5px;"> Salary Grade </p>
						<select class="form-control input" name="sg">
							<option value="N/A">Select Salary Grade</option>
							<option value="01">SG-01</option>
							<option value="02">SG-02</option>
							<option value="03">SG-03</option>
							<option value="04">SG-04</option>
							<option value="05">SG-05</option>
							<option value="06">SG-06</option>
							<option value="07">SG-07</option>
							<option value="08">SG-08</option>
							<option value="09">SG-09</option>
							<option value="10">SG-10</option>
							<option value="11">SG-11</option>
							<option value="12">SG-12</option>
							<option value="13">SG-13</option>
							<option value="14">SG-14</option>
							<option value="15">SG-15</option>
							<option value="16">SG-16</option>
							<option value="17">SG-17</option>
							<option value="18">SG-18</option>
							<option value="19">SG-19</option>
							<option value="20">SG-20</option>
							<option value="21">SG-21</option>
							<option value="22">SG-22</option>
							<option value="23">SG-23</option>
							<option value="25">SG-24</option>
							<option value="25">SG-25</option>
							<option value="26">SG-26</option>
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





