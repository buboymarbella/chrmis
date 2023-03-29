@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>TRAINING MATRIX CPASC</h1>
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
          <a href="{{ route('training_cpasc')}}" class="btn btn-sm btn-default btn-flat pull-right my-1" target="_blank"> 
					<i class="fa fa-download"></i> &nbsp;Donwload</a>
					<a href="{{ route('training_cpasc')}}" class="btn btn-sm btn-default btn-flat pull-right my-1" target="_blank"> 
					<i class="fa fa-print"></i> &nbsp;Print</a>
				</div>
				
				<div class="card-body table-responsive p-0" style="height: 600px;">
				<table id="example1" class="table table-head-fixed text-nowrap text-center">
                <thead>
					<tr>
						<th style="width:5%;">No.</th>
						<th style="width:30%;">Name</th>
						<th style="width:20%;">Position</th>
						<th style="width:10%;">SG</th>
						<th style="width:15%;">Unit\Office</th>
						<th style="width:10%;">Date of CPBSC</th>
					</tr>
                </thead>
                <tbody>
					@forelse ($masters as $key=>$master)
					<tr>
						<td>{{ $key + 1 }}</td>
						<td><a href="{{ route('masters.show', $master->main_id) }}">{{ $master->complete_name == "" ? 'N/A' : $master->complete_name}}</a></td>
						<td>{{ $master->position == null ? 'N/A' : $master->position }}</td>
						<td>@if($master->salary_grade == "")
								N/A
							@elseif(strlen($master->salary_grade) <= 1)
								{!! "SG-0".$master->salary_grade !!}
							@else
								{{ "SG-".$master->salary_grade }}
							@endif</td>
						<td>{{ $master->office == "" ? 'N/A' : $master->office}}</td>
						<td>{{ $master->cpbsc_date == null ? 'N/A' : date("m/d/Y", strtotime($master->cpbsc_date)) }}</td>
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





