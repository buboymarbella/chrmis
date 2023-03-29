@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>PWD MEMBER</h1>
          </div>
          <div class="col-sm-6 pr-4">
            <div style="float:right"> <a href="{{ route('demographics')}}"><button type="button" class="btn btn-warning btn-sm text-light"><< BACK</button></a></div>
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
        
        <div class="card-body table-responsive p-0">
          {!! $demographics_pwd->container() !!}
        </div>
        
            </div>
            <!-- /.card-body -->
            
          </div>
          <!-- /.card -->
          
        </div>
      </div>
        <!-- /.col -->

        <div class="col-md-6">
          <div class="card">
           
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"></h3>
			  
			  <div class="card-tools">
              <form action="/print_demog_result_pwd" method="POST" enctype="multipart/form-data" target="_blank">
                  @csrf
                  <a href="#" class="btn btn-tool">
                    <i class="fa fa-download"></i> &nbsp;Download</a>
                </a>
                  <button type="submit" class="btn btn-tool">
                  <i class="fa fa-print"></i> &nbsp;Print</a>
                  </button>
                  <input type="text" name="office" value="{{ $office }}" hidden>
              </form>
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
						<th>Total Number of Civ HR</th>
						<td>{{ $master_count }}</td>
					</tr>
					<tr>
						<th>Civ HR Non-PWD Member</th>
						<td>{{ $pwd_no }}</td>
					</tr>
					
					<tr>
						<th>Civ HR PWD Member</th>
						<td>{{ $pwd }}</td>
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

      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@push('js')
<script src="{{ LarapexChart::cdn() }}"></script>
@if(empty($demographics_pwd))
		<p></p>
	@else
		{{ $demographics_pwd->script()}}
	@endif


@endpush