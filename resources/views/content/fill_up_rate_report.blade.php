@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            @if($endDate == "1970-01-01")
            <h1>FILL-UP RATE REPORT</h1>
            @else
            <h1>FILL-UP RATE REPORT FROM "{{ date("d M Y", strtotime($startDate)) }} to {{ date("d M Y", strtotime($endDate)) }}"</h1>
            @endif
          </div>
          <div class="col-sm-4 pr-4">
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
				<table id="example1" class="table table-head-fixed text-nowrap text-center">
					<tr>
						<th>Select Scale of Report</th>
						<th>GUAs-Wide Fill-up Rate Report</th>
					</tr>
					<tr>
						<th width="30%">
              @if($office != "all")
               {{ str_replace('_', ' ', $office) }}
              @else
              <a href="{{route('fill_up_rate_office_report','COORDINATING_STAFF')}}" target="_blank">Joint Staff Wide</a><br/>
              <a href="{{route('fill_up_rate_office_report','PERSONAL_STAFF')}}" target="_blank">Personal Staff Wide</a><br/>
              <a href="{{route('fill_up_rate_office_report','SPECIAL_STAFF')}}" target="_blank">Special Staff Wide</a><br/>
              <a href="{{route('fill_up_rate_office_report','AFPWSSUS')}}" target="_blank">AFPWSSU's</a><br/>
              <a href="{{route('fill_up_rate_office_report','UNIFIED_COMMAND')}}" target="_blank">Unified Commands</a><br/>
              @endif
              <!-- <a href="#">Office/Units</a><br/> -->
            </th>
						<td width="60%">
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
            </td>
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
        {!! $piechart_fill_up->container() !!}
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
  @if(empty($piechart_fill_up))
		<p></p>
	@else
		{{ $piechart_fill_up->script()}}
	@endif
@endpush