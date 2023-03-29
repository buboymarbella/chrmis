@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>USERS RECORDS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('masters.index')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Users Records</li>
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
					<a href="{{ route('users.create')}}" class="btn btn-sm btn-default btn-flat pull-right"> 
					<i class="fa fa-plus-circle"></i> &nbsp;Add User</a>
				</div>
				<table id="example1" class="table table-bordered table-striped text-center">
                <thead>
					<tr>
						<th style=" width:155px;">Name</th>
						<th style="width:120px;">Office</th>
						<th style="width:150px;">Branch</th>
						<th style="width:150px;">Access Level</th>
						<th style="width:150px;">Action</th>
					</tr>
                </thead>
                <tbody>
					@forelse ($accounts as $key=>$users)
					<tr>
						<td><a href="#">{{ $users->complete_name == "" ? 'N/A' : $users->complete_name }}</a></td>
						<td>{{ $users->office == "" ? 'N/A' : $users->office }}</td>
						<td>{{ $users->branch == null ? 'N/A' : $users->branch }}</td>
						<td>{{ $users->acc_lvl == null ? 'N/A' :  $users->acc_lvl }}</td>
						<td>
							<a href="{{ route('users.show', $users->id) }}" >
							<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm" title="Profile">
							<i class="fa fa-pencil-alt"></i>
							</button>
							</a>
							<form style="display:inline;border:0;" method="post" action="{{ route('users.destroy', $users->id) }}">
								@method('DELETE')
								@csrf
								<button title="Delete" style="display:inline;border:0;" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you to delete the record?')"><i class="fa fa-trash"> </i></button>
							</form>
						</td>
					</tr>
					@empty
						<tr>
							<td colspan="5"><strong>Sorry</strong> There are no data available.</td>
						</tr>
					@endforelse
                </tbody>
				</table>
				<div class="float-left my-2">Showing 1 to 10 of {{ $count_user }} entries</div>
				<div class="float-right">
				{{ $accounts->links() }}
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





