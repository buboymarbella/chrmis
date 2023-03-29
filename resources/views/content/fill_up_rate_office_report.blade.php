@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>FILL-UP RATE REPORT</h1>
          </div>
          <div class="col-sm-6 pr-4">
            <div style="float:right"> <a href="{{ route('fill_up_rate_date')}}"><button type="button" class="btn btn-warning btn-sm text-light"><< BACK</button></a></div>
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
				
              <table class="table table-head-fixed text-nowrap text-center">
                <tr>
                  <td width="40%">Total Plantilla @ GUAs</td>
                  <td>{{ $guas }}</td>
                </tr>
                <tr>
                  <td>Filled</td>
                  <td>{{ $filled }}</td>
                </tr>
                <tr>
                  <td>Vacant</td>
                  <td>{{ $vacant }}</td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td>Filled 2nd Level</td>
                  <td>{{ $second_level_filled }}</td>
                </tr>
                <tr>
                  <td>Filled 1st Level</td>
                  <td>{{ $first_level_filled }}</td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td>Vacant 2nd Level</td>
                  <td>{{ $second_level_vacant }}</td>
                </tr>
                <tr>
                  <td>Vacant 1st Level</td>
                  <td>{{ $first_level_vacant }}</td>
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
        <table class="table table-head-fixed text-nowrap text-center">
          <tr>
            <td width="40%">Total Plantilla @ {{ $replace }}</td>
            <td>{{ $group }}</td>
          </tr>
          <tr>
            <td>Filled</td>
            <td>{{ $filled_group }}</td>
          </tr>
          <tr>
            <td>Vacant</td>
            <td>{{ $vacant_group }}</td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td>Filled 2nd Level</td>
            <td>{{ $second_level_filled_group }}</td>
          </tr>
          <tr>
            <td>Filled 1st Level</td>
            <td>{{ $first_level_filled_group }}</td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td>Vacant 2nd Level</td>
            <td>{{ $second_level_vacant_group }}</td>
          </tr>
          <tr>
            <td>Vacant 1st Level</td>
            <td>{{ $first_level_vacant_group }}</td>
          </tr>
        </table>
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





