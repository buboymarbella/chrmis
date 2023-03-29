@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>STAFFING PLAN REPORT </h1>
          </div>
          <div class="col-sm-6">
            <div style="float:right"> <a href="{{ route('staffing_plan')}}"><button type="button" class="btn btn-warning btn-sm text-light"><< BACK</button></a></div>
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
				
				<div class="float-left my-2">Showing 1 to 10 of {{ $count_plantilla }} entries</div>
				<div class="float-right">
					<a href="{{ route('download_staffing_office_plan',$id)}}" class="btn btn-tool"> 
					<i class="fa fa-download"></i> &nbsp;Download Excel</a>
					<a href="{{ route('download_staffing_office_plan',$id)}}" class="btn btn-tool"> 
					<i class="fa fa-download"></i> &nbsp;Download PDF</a>
				</div>
				
				<div class="card-body table-responsive p-0" style="height: 600px;">
				<table id="example1" class="table table-head-fixed text-nowrap text-center">
                <thead>
					<tr>
						<th style="width:15%;">Plantilla #</th>
						<th style="width:15%;">Position Title</th>
						<th style="width:5%;">SG</th>
						<th style="width:5%;">Office/Unit</th>
						<th style="width:10%;">Staff Action</th>
						<th style="width:10%;">Sourcing Method</th>
						<th style="width:10%;">Start/End Date</th>
						<th style="width:10%;">Classification Level</th>
						<th style="width:10%;">Status</th>
					</tr>
                </thead>
                <tbody>
					
					@forelse ($plantilla as $key=>$master)
					<tr>
						<td>{{ $master->plantilla_number == "" ? 'N/A' : $master->plantilla_number }}</td>
						<td>{{ $master->title == null ? 'N/A' : $master->title }}</td>
						<td>{{ $master->sg == "" ? 'N/A' : $master->sg}} </td>
						<td>{{ $master->office == "" ? 'N/A' : $master->office}} </td>
						<td>@if($master->staff_action == "fill" || $master->staff_action == "FILL")
								Fill-up
							@elseif($master->staff_action == "transfer")
								Transfer
							@elseif($master->staff_action == "abolish")
								Abolish
							@elseif($master->staff_action == "retitle")
								Retitle
							@elseif($master->staff_action == "under_study")
								Under Study
							@else
								N/A
							@endif
						</td>
						<td>{{ $master->sourcing_method == null ? 'N/A' : $master->sourcing_method }}</td>
						<td>@if($master->start_date == '1970-01-01' || $master->end_date == '1970-01-01') 
								N/A
							@elseif($master->start_date == NULL || $master->end_date == NULL) 
								N/A
							@else
								{{date("d M Y", strtotime($master->start_date)) }} / {{date("d M Y", strtotime($master->end_date)) }}
							@endif</td>
						<td>@if($master->level_class == "2ND_TECH")
								2nd Level Technical
							@elseif($master->level_class == "2ND_SUPERVISORY")
								2nd Level Supervisory
							@elseif($master->level_class == "1ST")
								1ST LEVEL
							@else
								N/A
							@endif
						</td>
						<td>{{ $master->status == null ? 'N/A' : $master->status }}</td>
						
					</tr>
					@empty
						<tr>
							<td colspan="9"><strong>Sorry</strong> There are no data available.</td>
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
