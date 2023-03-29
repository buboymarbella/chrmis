@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>PLANTILLA RECORDS</h1>
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
				@elseif($message = Session::get('error'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						{{ $message }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
                @endif
				
				<div class="float-left">
					<form class="form-inline ml-0" method="POST" action="{{ route('search_plantilla') }}">
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
					<a href="{{ route('plantillas.create')}}" class="btn btn-sm btn-default btn-flat pull-right"> 
					<i class="fa fa-plus-circle"></i> &nbsp;Add Plantilla</a>
				</div>
				
				
				<table id="example1" class="table table-bordered table-striped text-center">
                <thead>
					<tr>
						<th style="width:10%;">Position Holder</th>
						<th style="width:12%;">Plantilla #</th>
						<th style="width:12%;">Position Title</th>
						<th style="width:5%;">SG</th>
						<th style="width:5%;">Office/Unit</th>
						<th style="width:10%;">Staff Action</th>
						<th style="width:10%;">Sourcing Method</th>
						<th style="width:10%;">Start/End Date</th>
						<th style="width:10%;">Classification Level</th>
						<th style="width:10%;">Status</th>
						<th style="width:10%;">Action</th>
					</tr>
                </thead>
                <tbody>
					
					@forelse ($plantilla as $key=>$master)
					<tr>
						<td>{{ $master->complete_name == "" ? 'N/A' : $master->complete_name }}</td>
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
							@endif
						</td>
						<td>@if($master->level_class == "2ND_TECH")
								2nd Level Technical
							@elseif($master->level_class == "2ND_SUPERVISORY")
								2nd Level Supervisory
							@elseif($master->level_class == "1ST")
								1st Level
							@else
								N/A
							@endif
						</td>
						<td>{{ $master->status == null ? 'N/A' : $master->status }}</td>
						<td>
							<!--<a href="{{ route('masters.show', Illuminate\Support\Facades\Crypt::encrypt($master->id)) }}" > ENCRYPTION URL-->
							<a href="{{ route('plantillas.edit', $master->id) }}" >
							<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm" title="Update">
							<i class="fa fa-pencil-alt"></i>
							</button>
							</a>
							<form style="display:inline;border:0;" method="post" action="{{ route('plantillas.destroy', $master->id) }}">
								@method('DELETE')
								@csrf
								<button title="Delete" style="display:inline;border:0;" type="submit" class="btn btn-danger btn-sm" 
								onclick="return confirm('Are you sure you to delete the record?')"><i class="fa fa-trash"> </i></button>
							</form>
						</td>
					</tr>
					@empty
						<tr>
							<td colspan="11"><strong>Sorry</strong> There are no data available.</td>
						</tr>
					@endforelse
					
                </tbody>
				</table>
				<div class="float-left my-2">Showing 1 to 10 of {{ $count_plantilla }} entries</div>
				<div class="float-right">
					{{ $plantilla->appends(['plantilla' => $plantilla->currentPage(), 'search' => request()->search, 'per_page' => request()->per_page])->links() }}
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
