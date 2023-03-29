@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
			<div style="float:left"><h1>TAT COSTING REPORT</h1></div>
            
          </div>
          <div class="col-sm-6">
		  <div style="float:right;padding-right:15px;"> <a href="{{ route('tat_costing_report')}}"><button type="button" class="btn btn-warning btn-sm text-light"><< BACK</button></a></div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row col-md-6">
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
				
				
				<div class="card-body table-responsive p-0" style="">
				<table id="example1" class="table table-head-fixed text-nowrap text-center">
					<tr>
						<th>Total Number of Recently-Filled Plantilla Positions</th>
						<td>{!! $plantilla !!}</td>
					</tr>
					<tr>
						<th>Average TAT from Publication to Onboarding</th>
						<td>{{ $summary_date == "" ? '0 days' :$summary_date->summary_date." days" }} </td>
					</tr>
					<!--
					<tr>
						<th>Average TAT Efficiency Rate</th>
						<td>88.89%</td>
					</tr>
					<tr>
						<th>Average Recruitment Cost from Publication to Onboarding</th>
						<td>PhP 150.00</td>
					</tr>
					-->
					<tr>
						<th>Average Recruitment Cost Savings</th>
						<td>PhP {{  array_sum($sum_cost) }}</td>
					</tr>
				</table>
				</div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
	  </div>
      <!-- /.row -->
	  
	  <div class="row col-md-12">
        <div class="col-12">
          <div class="card">
           
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"></h3>
			  
			  <div class="card-tools">
			  		
                <div class="btn-group">
                    
				<form action="{{ route('download_tat_costing') }}" method="POST" enctype="multipart/form-data" target="_blank" class="py-0">
					@csrf
						<button type="submit" class="btn btn-tool p-0">
						<i class="fa fa-download"></i> &nbsp;Download Excel</button>
						<button type="submit" class="btn btn-tool p-0">
						<i class="fa fa-download"></i> &nbsp;Download PDF</button>
						<input type="text" name="start_date" value="{{ $start }}" hidden>
						<input type="text" name="end_date" value="{{ $end }}" hidden>
						<input type="text" name="status" value="{{ $status }}" hidden>
					</form>
                  </div>
				</div>
            </div>
			
            <!-- /.card-header -->
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
				
				<!-- <div class="float-left">
					<form class="form-inline ml-0" method="POST" action="{{ route('search_chr') }}">
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
					<a href="{{ route('costings.create')}}" class="btn btn-sm btn-default btn-flat pull-right"> 
					<i class="fa fa-plus-circle"></i> &nbsp;Add TAT Costing</a>
				</div>
				 -->
				 <div class="card-body table-responsive p-0" style="height: 600px;">
				 <div class="float-left my-2">Showing {{ $count_masters }} entries</div>
				 <div class="float-right pb-2">
					
				</div>
				<table id="example1" class="table table-head-fixed text-nowrap text-center">
                <thead>
				
					<tr>
						<th style="width:10%;">Plantilla #</th>
						<th style="width:10%">Position</th>
						<th style="width:5%;">Office/SG</th>
						<th style="width:10%;">Pub Vacancy Duration</th>
						<th style="width:10%;">Local Delib Duration</th>
						<th style="width:10%;">GHQ Delib Duration</th>
						<th style="width:10%;">Assessment Test Duration</th>
						<th style="width:10%;">Board Resolution Duration</th>
						<th style="width:10%;">Directives Duration</th>
						<th style="width:10%;">Requirements Duration</th>
						<th style="width:10%;">Appointment Duration</th>
						<th style="width:10%;">Sub of RAI Duration</th>
						<th style="width:5%;">Total Cost</th>
						<th style="width:5%;">Duration</th>
						<th style="width:5%;">Status</th>
					</tr>
                </thead>
                <tbody>
					
					@forelse ($masters as $key=>$master)
					<tr>
						<td>{{ $master->plantilla_number == "" ? 'N/A' : $master->plantilla_number }}</td>
						<td>{{ $master->position == null ? 'N/A' : $master->position }}</td>
						<td>{{ $master->office == "" ? 'N/A' : $master->office}} / 
							@if($master->salary_grade == "")
								N/A
							@elseif(strlen($master->salary_grade) <= 1)
								{!! "SG-0".$master->salary_grade !!}
							@else
								{{ "SG-".$master->salary_grade }}
							@endif
						
						</td>
						<td>@if($master->publication_date == '1970-01-01' || $master->publication_date == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->publication_date == NULL || $master->publication_date == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->publication_date)) }}
							@endif
							/
							@if($master->publication_date_e == '1970-01-01' || $master->publication_date_e == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->publication_date_e == NULL || $master->publication_date_e == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->publication_date_e)) }}
							@endif
						</td>
						<td>@if($master->local_delib_date == '1970-01-01' || $master->local_delib_date == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->local_delib_date == NULL || $master->local_delib_date == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->publication_date)) }}
							@endif
							/
							@if($master->local_delib_date_e == '1970-01-01' || $master->local_delib_date_e == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->local_delib_date_e == NULL || $master->local_delib_date_e == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->local_delib_date_e)) }}
							@endif
						</td>
						<td>@if($master->ghq_delib_date	 == '1970-01-01' || $master->ghq_delib_date	 == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->ghq_delib_date	 == NULL || $master->ghq_delib_date	 == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->ghq_delib_date	)) }}
							@endif
							/
							@if($master->ghq_delib_date_e == '1970-01-01' || $master->ghq_delib_date_e == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->ghq_delib_date_e == NULL || $master->ghq_delib_date_e == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->ghq_delib_date_e)) }}
							@endif
						</td>
						<td>@if($master->assestment_date == '1970-01-01' || $master->assestment_date == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->assestment_date == NULL || $master->assestment_date == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->assestment_date)) }}
							@endif
							/
							@if($master->assestment_date_e == '1970-01-01' || $master->assestment_date_e == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->assestment_date_e == NULL || $master->assestment_date_e == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->assestment_date_e)) }}
							@endif
						</td>
						<td>@if($master->resolution_date == '1970-01-01' || $master->resolution_date == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->resolution_date == NULL || $master->resolution_date == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->resolution_date)) }}
							@endif
							/
							@if($master->resolution_date_e == '1970-01-01' || $master->resolution_date_e == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->resolution_date_e == NULL || $master->resolution_date_e == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->resolution_date_e)) }}
							@endif
						</td>
						<td>@if($master->directive_date == '1970-01-01' || $master->directive_date == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->directive_date == NULL || $master->directive_date == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->directive_date)) }}
							@endif
							/
							@if($master->directive_date_e == '1970-01-01' || $master->directive_date_e == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->directive_date_e == NULL || $master->directive_date_e == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->directive_date_e)) }}
							@endif
						</td>
						<td>@if($master->requirement_date == '1970-01-01' || $master->requirement_date == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->requirement_date == NULL || $master->requirement_date == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->requirement_date)) }}
							@endif
							/
							@if($master->requirement_date_e == '1970-01-01' || $master->requirement_date_e == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->publication_date_e == NULL || $master->requirement_date_e == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->requirement_date_e)) }}
							@endif
						</td>
						<td>@if($master->appointment_date == '1970-01-01' || $master->appointment_date == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->appointment_date == NULL || $master->appointment_date == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->appointment_date)) }}
							@endif
							/
							@if($master->appointment_date_e == '1970-01-01' || $master->appointment_date_e == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->appointment_date_e == NULL || $master->appointment_date_e == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->appointment_date_e)) }}
							@endif
						</td>
						<td>
							@if($master->rai_date == '1970-01-01' || $master->rai_date == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->rai_date == NULL || $master->rai_date == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->rai_date)) }}
							@endif
							/
							@if($master->rai_date_e == '1970-01-01' || $master->rai_date_e == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->rai_date_e == NULL || $master->rai_date_e == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->rai_date_e)) }}
							@endif
						</td>
						<td>Php {{ $master->summary_cost == null ? '0' : number_format($master->summary_cost,2) }}</td>
						<td>
							@if($master->status == "PENDING")
								<span class="text-warning">{{ $master->status }}</span>
							@elseif($master->status == "")
								<span class="text-warning">PENDING</span>
							@else
								<span class="text-primary">{{ $master->summary_date == null ? '0' : $master->summary_date ." day/s" }}</span>
							@endif
						</td>
						<td>@if($master->status == "PENDING")
								<span class="text-danger">{{ $master->status }}</span>
							@elseif($master->status == "")
								<span class="text-danger">PENDING</span>
							@else
								<span class="text-primary">{{ $master->status }}</span>
							@endif
						</td>
						
					</tr>
					@empty
						<tr>
							<td colspan="15"><strong>Sorry</strong> There are no data available.</td>
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
	  </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection





