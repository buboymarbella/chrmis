@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>SEARCH RESULT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('masters.index')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">CHR</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
           
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"></h3>
			  
			  <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <div class="btn-group">
                    
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
				</div>
            </div>
			
            <!-- /.card-header -->
            <div class="card-body">
				@if ($message = Session::get('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						{{ $message }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
                @endif
				
				<div class="float-left">
					
				</div>
				<div class="float-right">
					<form class="form-inline ml-3" method="POST" action="{{ route('view_advanced_result') }}" target="_blank">
						@csrf
						@method('GET')
						<div class="input-group input-group-sm">
							<input class="form-control form-control-navbar" hidden value="{{ $name }}" name="name">
							<input class="form-control form-control-navbar" hidden value="{{ $office }}" name="office">
							<input class="form-control form-control-navbar" hidden value="{{ $sg }}" name="sg">
							<input class="form-control form-control-navbar" hidden value="{{ $bt }}" name="bt">
							<div class="input-group-append">
								<button class="btn btn-sm btn-default btn-flat pull-right my-1" type="submit">
									<i class="fa fa-print">&nbsp;Print</i>
								</button>
							</div>
						</div>
					</form>
				
				</div>
				
				<div class="card-body table-responsive p-0" style="height: 600px;">
				<table id="example1" class="table table-head-fixed text-nowrap text-center">
                <thead>
					<tr>
						<th style="width:5%;">No.</th>
						<th style="width:30%;">Name</th>
						<th style="width:20%;">Position</th>
						<th style="width:15%;">Office</th>
						<th style="width:10%;">SG</th>
						<th style="width:10%;">Blood Type</th>
					</tr>
                </thead>
                <tbody>
					@forelse ($masters as $key=>$master)
					<tr>
						<td>{{ $key + 1 }}</td>
						<td><a href="{{ route('masters.show', $master->main_id) }}">{{ $master->complete_name == "" ? 'N/A' : $master->complete_name}}</a></td>
						<td>{{ $master->position == null ? 'N/A' : $master->position }}</td>
						<td>{{ $master->office == null ? 'N/A' : $master->office }}</td>
						<td>{{ $master->salary_grade == null ? 'N/A' : $master->salary_grade }}</td>
						<td>{{ $master->blood_type == "" ? 'N/A' : $master->blood_type}}</td>
					</tr>
					@empty
						<tr>
							<td colspan="7"><strong>Sorry</strong> There are no data available.</td>
						</tr>
					@endforelse
                </tbody>
				</table>
				</div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection





