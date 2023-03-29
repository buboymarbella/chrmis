@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>AWARDS DEMOGRAPHICS REPORT</h1>
          </div>
          <div class="col-sm-6 pr-4">
			    <div style="float:right;"> <a href="{{ route('awards_demog_date')}}"><button type="button" class="btn btn-warning btn-sm text-light"><< BACK</button></a></div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row col-md-12">
        <div class="col-md-6">
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
				
				</div>
				
				<div class="card-body table-responsive p-0" style="">
				<table id="example1" class="table table-head-fixed text-nowrap text-center">
					<tr>
						<th>Level of Award</th>
						<th>Nr of Recipients</th>
					</tr>
          
          <tr>
						<th>
              <form action="{{ route('awards_demog_national') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <button type="submit" class="btn btn-xs btn-success" title="Click to View List">National Awards</button>
                <input type="text" name="date_commendation" value="{{ $date_commendation }}" hidden>
                <input type="text" name="office" value="{{ $office }}" hidden>
              </form>
            </th>
						<td>{{ $national_awards }}</td>
					</tr>

          <tr>
						<th>
              <form action="{{ route('awards_demog_honor') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <button type="submit" class="btn btn-xs btn-success" title="Click to View List">Honor Awards</button>
                <input type="text" name="date_commendation" value="{{ $date_commendation }}" hidden>
                <input type="text" name="office" value="{{ $office }}" hidden>
              </form>
            </th>
						<td>{{ $honor_awards }}</td>
					</tr>

          <tr>
						<th>
              <form action="{{ route('awards_demog_incentives') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <button type="submit" class="btn btn-xs btn-success" title="Click to View List">Other Incentives</button>
                <input type="text" name="date_commendation" value="{{ $date_commendation }}" hidden>
                <input type="text" name="office" value="{{ $office }}" hidden>
              </form>
            </th>
						<td>{{ $incintives_awards }}</td>
					</tr>
					
          <!-- <tr>
						<th><a href="{{route('awards_demog_incentives',$date_commendation)}}">Other Incentives</a></th>
            <td>{{ $incintives_awards }}</td>
					</tr>
					<tr>
						<th><a href="{{route('awards_demog_national',$date_commendation)}}">National Awards</a></th>
						<td>{{ $national_awards }}</td>
					</tr>
					
					<tr>
						<th><a href="{{route('awards_demog_honor',$date_commendation)}}">Honor Awards</a></th>
						<td>{{ $honor_awards }}</td>
					</tr>

					<tr>
						<th><a href="{{route('awards_demog_incentives',$date_commendation)}}">Other Incentives</a></th>
            <td>{{ $incintives_awards }}</td>
					</tr> -->
					
				</table>
				</div>
            </div>
            <!-- /.card-body -->
            
          </div>
          <!-- /.card -->
          
        </div>
        <!-- /.col -->


      </div>
      <div class="col-md-6">
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
      
      </div>
      
      <div class="card-body table-responsive p-0">
        {!! $staffing_chart->container() !!}
      </div>
      
          </div>
          <!-- /.card-body -->
          
        </div>
        <!-- /.card -->
        
      </div>
    </div>
      <!-- /.col -->
        
      </div>
      <!-- /.row -->

      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@push('js')
  <script src="{{ LarapexChart::cdn() }}"></script>
  @if(empty($staffing_chart))
		<p></p>
	@else
		{{ $staffing_chart->script()}}
	@endif
@endpush