@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>OTHER INCENTIVES AWARDS YEAR "{{ $date_commendation}}"</h1>
          </div>
          <div class="col-sm-6">
            <div style="float:right">
			<form action="{{ route('awards_demog_report') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<input type="text" name="year" value="{{ $date_commendation }}" hidden>
                <input type="text" name="office" value="{{ $office }}" hidden>
				<button type="submit" class="btn btn-warning btn-sm text-light"><< BACK</button>
			</form>
			</div>
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
				
				<!-- <div class="float-left">
					<form class="form-inline ml-0" method="POST" action="{{ route('search_staff_plan') }}">
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
				-->
				<div class="float-right pb-2">
					<form action="{{ route('download_incentives_award') }}" method="POST" enctype="multipart/form-data" target="_blank">
					@csrf
						<button type="submit" class="btn btn-tool ">
						<i class="fa fa-download"></i> &nbsp;Download Excel</button>
						<button type="submit" class="btn btn-tool ">
						<i class="fa fa-download"></i> &nbsp;Download PDF</button>
						<input type="text" name="office" value="{{ $office }}" hidden>
						<input type="text" name="date_commendation" value="{{ $date_commendation }}" hidden>
					</form>
				</div> 
				
				
				<table id="example1" class="table table-bordered table-striped text-center pt-2">
                <thead>
					<tr>
						<th style="width:30%;">Name</th>
						<th style="width:15%;">Position Title</th>
						<th style="width:5%;">SG</th>
						<th style="width:5%;">Office/Unit</th>
						<th style="width:5%;">Sex</th>
						<th style="width:30%;">Title of Award/Incentive</th>
						<th style="width:10%;">Date of Conferment of Award/Incentive</th>
					</tr>
          </thead>
          <tbody>
					
				@forelse ($incentives_awards as $master)	
					<tr>
						<td><a href="#">{{ $master->complete_name == "" ? 'N/A' : $master->complete_name }}</a></td>
						<td>{{ $master->position == null ? 'N/A' : $master->position }}</td>
						<td>{{ $master->salary_grade == "" ? 'N/A' : $master->salary_grade}} </td>
						<td>{{ $master->office == "" ? 'N/A' : $master->office}} </td>
						<td>{{ $master->gender == null ? 'N/A' : $master->gender }}</td>
						<td>{{ $master->commendation == null ? 'N/A' : $master->commendation }}</td>
						<td>
							@if($master->commendation_date == '1970-01-01' || $master->commendation_date == '1970-01-01') 
								N/A
							@elseif($master->commendation_date == NULL || $master->commendation_date == NULL) 
								N/A
							@else
								{{date("d M Y", strtotime($master->commendation_date)) }}
							@endif
						</td>
					</tr>
				@empty
					<tr>
					<td colspan="7"><strong>Sorry</strong> There are no data available.</td>
					</tr>
				@endforelse
                </tbody>
				</table>
				<div class="float-left my-2">Showing 1 to 20 of {{ $incentives_awards_count }} entries</div>
				<div class="float-right">
					{{ $incentives_awards->appends(['incentives_awards' => $incentives_awards->currentPage(), 'search_sp_case_op' => request()->search, 'per_page' => request()->per_page])->links() }}
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
