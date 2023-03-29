@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>LTG RECORDS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('masters.index')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">CTG Records</li>
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
					<form class="form-inline ml-3" method="POST" action="{{ route('search_ltg') }}">
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
						<th style=" width:155px;">Name</th>
						<th style="width:80px;">Alias</th>
						<th style="width:100px;">Threat Group</th>
						<th style="width:100px;">Region</th>
						<th style="width:100px;">Source</th>
						<th style="width:100px;">Date Reported</th>
						<th style="width:80px;">Action</th>
					</tr>
                </thead>
                <tbody>
					@forelse ($masters as $key=>$master)
					<tr>
						<td><a href="#">{{ $master->complete_name == "" ? 'N/A' : $master->complete_name }}</a></td>
						<td>{{ $master->alias == "" ? 'N/A' : $master->alias }}</td>
						<td>{{ $master->threat == "" ? 'N/A' : $master->threat }}</td>
						<td>{{ $master->region == "" ? 'N/A' : $master->region }}</td>
						<td>{{ $master->reported_by == null ? 'N/A' : $master->reported_by }}</td>
						<td>{{ $master->date_reported == null ? 'N/A' : date("d M Y", strtotime($master->date_reported)) }}</td>
						<td>
							<a href="{{ route('masters.show', $master->main_id) }}" >
							<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm" title="View">
							<i class="fas fa-folder"></i>
							</button>
							</a>
							<form style="display:inline;border:0;" method="post" action="{{ route('masters.destroy', $master->main_id) }}">
								@method('DELETE')
								@csrf
								<button title="Delete" style="display:inline;border:0;" type="submit" class="btn btn-danger btn-sm"
								onclick="return confirm('Are you sure you to delete the record?')"><i class="fa fa-trash"> </i></button>
							</form>
						</td>
					</tr>
					@empty
						<tr>
							<td colspan="7"><strong>Sorry</strong> There are no data available.</td>
						</tr>
					@endforelse
                </tbody>
				</table>
				<div class="float-left my-2">Showing 1 to 10 of {{ $counts }} entries</div>
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





