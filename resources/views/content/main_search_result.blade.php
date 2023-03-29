@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Search Result</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('masters.index')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Search Result</li>
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
				<div class="float-left"></div>
				<div class="float-right">
					<form class="form-inline ml-3" method="POST" action="{{ route('search_chr') }}">
						@csrf
						@method('GET')
						<div class="input-group input-group-sm my-1">
						   <input class="form-control form-control-navbar" type="search" name="search" placeholder="Search" aria-label="Search">
							<div class="input-group-append">
							<button class="input-group-text red lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
								aria-hidden="true"></i></button>
							</div>
						</div>
					</form>
				</div>
				<table id="example1" class="table table-bordered table-striped text-center">
                <thead>
					<tr>
						<th style="width:155px;">Item No.</th>
						<th style="width:80px;">Name</th>
						<th style="width:120px;">Unit\Office</th>
						<th style="width:150px;">Position</th>
						<th style="width:100px;">Salary Grade</th>
						<th style="width:100px;">Status</th>
						<th style="width:80px;">Action</th>
					</tr>
                </thead>
                <tbody>
					@forelse ($masters as $key=>$master)
					<tr>
						<td>{{ $master->item_number == "" ? 'N/A' : $master->item_number }}</td>
						<td><a href="{{ route('masters.show', $master->main_id) }}">{{ $master->complete_name == "" ? 'N/A' : $master->complete_name}}</a></td>
						<td>{{ $master->office == "" ? 'N/A' : $master->office}}</td>
						<td>{{ $master->position == null ? 'N/A' : $master->position }}</td>
						<td>{{ $master->salary_grade == null ? 'N/A' : $master->salary_grade }}</td>
						<td>{{ $master->employee_status == null ? 'N/A' : $master->employee_status }}</td>
						<td>
							<!--<a href="{{ route('masters.show', Illuminate\Support\Facades\Crypt::encrypt($master->id)) }}" > ENCRYPTION URL-->
							<a href="{{ route('masters.show', $master->main_id) }}" >
							<button style="display:inline;border:0;" type="submit" class=" btn btn-primary btn-sm" title="Update">
							<i class="fa fa-search">  </i>
							</button>
							</a>&nbsp;&nbsp;
							
						</td>
					</tr>
					@empty
						<tr>
							<td colspan="7"><strong>Sorry</strong> There are no data available.</td>
						</tr>
					@endforelse
                </tbody>
				</table>
				<div class="float-left my-2">Showing 1 to 10 of  entries</div>
				<div class="float-right">
				{{ $masters->links() }}
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





