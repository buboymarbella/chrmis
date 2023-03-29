@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>LOGS RECORDS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('masters.index')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Logs Records</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-8">
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
					<a href="{{ route('delete_logs') }}" style="display:inline;border:0;padding:0;margin:0">
						<button title="Delete"  type="submit" class="btn btn-danger btn-sm" 
						onclick="return confirm('Are you sure you to delete the record?')"><i class="fa fa-times"> </i> Delete All Logs</button>
					</a>
				</div>
				<div class="float-right">
					<form class="form-inline ml-3" method="POST" action="{{ route('search_log') }}">
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
						<th style=" width:155px;">User</th>
            <th style=" width:155px;">IP Address</th>
            <th style=" width:155px;">Date</th>
						<th style="width:120px;">Action Taken</th>
					</tr>
                </thead>
                <tbody>
					@forelse ($ledgers as $key=>$ledger)
					<tr>
						<td><a href="#">{{ $ledger->complete_name == "" ? 'N/A' : $ledger->complete_name }}</a></td>
            <td><a href="#">{{ $ledger->ip_address == "" ? 'N/A' : $ledger->ip_address }}</a></td>
            <td><a href="#">{{ $ledger->created_at == "" ? 'N/A' : $ledger->created_at }}</a></td>
						<td>{{ $ledger->action == "" ? 'N/A' : $ledger->action }}</td>
					</tr>
					@empty
						<tr>
							<td colspan="2"><strong>Sorry</strong> There are no data available.</td>
						</tr>
					@endforelse
                </tbody>
				</table>
				<div class="float-left my-2">Showing 1 to 10 of {{ $count_logs }} entries</div>
				<div class="float-right">
				{{ $ledgers->links() }}
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





