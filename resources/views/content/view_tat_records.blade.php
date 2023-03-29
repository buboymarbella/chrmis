@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>TAT and Costing RECORDS</h1>
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
					<form class="form-inline ml-0" method="POST" action="{{ route('search_tat') }}">
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
				
				
				<table id="example1" class="table table-bordered table-striped text-center">
                <thead>
					<tr>
						<th style="width:120px;">Plantilla #</th>
						<th style="width:120px;">Position</th>
						<th style="width:80px;">Office/SG</th>
						<th style="width:100px;">Pub Vacancy Duration</th>
						<th style="width:100px;">Sub of RAI Duration</th>
						<th style="width:50px;">Total Cost</th>
						<th style="width:50px;">Duration</th>
						<th style="width:50px;">Status</th>
						<th style="width:80px;">Action</th>
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
								<span class="text-danger">N/A</span>
							@else
								<span class="text-primary">{{ $master->status }}</span>
							@endif
						</td>
						<td>
							<!--<a href="{{ route('masters.show', Illuminate\Support\Facades\Crypt::encrypt($master->id)) }}" > ENCRYPTION URL-->
							<a href="{{ route('costings.edit', $master->id) }}" >
							<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm" title="Update">
							<i class="fa fa-pencil-alt"></i>
							</button>
							</a>
							<form style="display:inline;border:0;" method="post" action="{{ route('costings.destroy', $master->id) }}">
								@method('DELETE')
								@csrf
								<button title="Delete" style="display:inline;border:0;" type="submit" class="btn btn-danger btn-sm" 
								onclick="return confirm('Are you sure you to delete the record?')"><i class="fa fa-trash"> </i></button>
							</form>
						</td>
					</tr>
					@empty
						<tr>
							<td colspan="9"><strong>Sorry</strong> There are no data available.</td>
						</tr>
					@endforelse
					
                </tbody>
				</table>
				<div class="float-left my-2">Showing 1 to 10 of {{$master_count}} entries</div>
				<div class="float-right">
					{{ $masters->appends(['masters' => $masters->currentPage(), 'search' => request()->search, 'per_page' => request()->per_page])->links() }}
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





