@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>COMP ASST MATRIX "VACANT POSITION"</h1>
          </div>
          <div class="col-sm-6">
            <div style="float:right"> <a href="{{ route('computer_asst_matrix')}}"><button type="button" class="btn btn-warning btn-sm text-light"><< BACK</button></a></div>
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
				@elseif($message = Session::get('error'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						{{ $message }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
                @endif
				
				<div class="float-left">
					<form class="form-inline ml-0" method="POST" action="{{ route('search_comp_matrix',$id) }}">
						@csrf
						@method('GET')
						<div class="input-group input-group-sm my-1">
						   <input class="form-control form-control-navbar" type="search" name="search" value="{{ request()->search }}" placeholder="Search" aria-label="Search">
							<div class="input-group-append">
							<button class="input-group-text red lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
								aria-hidden="true"></i></button>
							</div>
						</div>
					</form>
				</div>
				
				<div class="float-right">
					<a href="{{ route('download_computer_asst_matrix',$id)}}"  class="btn btn-tool "> 
					<i class="fa fa-download"></i> &nbsp;Download Excel</a>
					<a href="{{ route('download_computer_asst_matrix',$id)}}"  class="btn btn-tool "> 
					<i class="fa fa-download"></i> &nbsp;Download PDF</a>
				</div>
				
				
				<table id="example1" class="table table-bordered table-striped text-center">
                <thead>
					<tr>
						<th style="width:15%;">Plantilla #</th>
						<th style="width:15%;">Position Title</th>
						<th style="width:5%;">SG</th>
						<th style="width:5%;">Office/Unit</th>
						<th style="width:10%;">Req'd Eligibility</th>
						<th style="width:10%;">Req'd Training Hours</th>
						<th style="width:10%;">Req'd Years of Exp</th>
					</tr>
          </thead>
          <tbody>
					
					@forelse ($plantilla as $key=>$master)
					<tr>
						<td><a href="{{route('comp_asst_matrix_vacant_pos',$master->plantilla_number)}}">{{ $master->plantilla_number == "" ? 'N/A' : $master->plantilla_number }}</a></td>
						<td>{{ $master->title == null ? 'N/A' : $master->title }}</td>
						<td>{{ $master->sg == "" ? 'N/A' : $master->sg}} </td>
						<td>{{ $master->office == "" ? 'N/A' : $master->office}} </td>
						<td>{{ $master->eligibility == null ? 'N/A' : $master->eligibility }}</td>
						<td>{{ $master->training == null ? 'N/A' : $master->training }}</td>
						<td>{{ $master->experience == null ? 'N/A' : $master->experience }}</td>
					</tr>
					@empty
						<tr>
							<td colspan="7"><strong>Sorry</strong> There are no data available.</td>
						</tr>
					@endforelse
					
                </tbody>
				</table>
				<div class="float-left my-2">Showing 1 to 10 of {{ $count_plantilla }} entries</div>
				<div class="float-right">
					{{ $plantilla->appends(['plantilla' => $plantilla->currentPage(),'search_sp_case_op' => request()->search, 'per_page' => request()->per_page])->links() }}
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
