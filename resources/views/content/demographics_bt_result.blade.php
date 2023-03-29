@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>BLOOD TYPE</h1>
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

        <div class="col-md-8">
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
        
        
        <div class="card-body table-responsive p-0">
          {!! $demographics_bt->container() !!}
        </div>
        
            </div>
            <!-- /.card-body -->
            
          </div>
          <!-- /.card -->
          
        </div>
      </div>
        <!-- /.col -->

        <div class="col-md-4">
          <div class="card">
           
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"></h3>
			  
              <div class="card-tools">
              
                <form action="/print_demog_result_bt" method="POST" enctype="multipart/form-data" target="_blank">
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
						<th>Total Number of Civ HR </th>
						<td>{{ $master_count }}</td>
					</tr>

					<tr>
						<th>Male with blood type A</th>
            @if($bt_a == 0)
            <td>0</td>
            @else
						<td>{{ round(($bt_a / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Male with blood type A+</th>
            @if($bt_ap == 0)
            <td>0</td>
            @else
						<td>{{ round(($bt_ap / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Male with blood type A-</th>
            @if($bt_am == 0)
            <td>0</td>
            @else
						<td>{{ round(($bt_am / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Male with blood type B</th>
            @if($bt_b == 0)
            <td>0</td>
            @else
						<td>{{ round(($bt_b / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Male with blood type B+</th>
            @if($bt_bp == 0)
            <td>0</td>
            @else
						<td>{{ round(($bt_bp / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Male with blood type B-</th>
            @if($bt_bm == 0)
            <td>0</td>
            @else
						<td>{{ round(($bt_bm / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Male with blood type O</th>
            @if($bt_o == 0)
            <td>0</td>
            @else
						<td>{{ round(($bt_o / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Male with blood type O+</th>
            @if($bt_op == 0)
            <td>0</td>
            @else
						<td>{{ round(($bt_op / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Male with blood type O-</th>
            @if($bt_om == 0)
            <td>0</td>
            @else
						<td>{{ round(($bt_om / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Male with blood type AB</th>
            @if($bt_ab == 0)
            <td>0</td>
            @else
						<td>{{ round(($bt_ab / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Male with blood type AB+</th>
            @if($bt_abp == 0)
            <td>0</td>
            @else
						<td>{{ round(($bt_abp / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Male with blood type AB-</th>
            @if($bt_abp == 0)
            <td>0</td>
            @else
						<td>{{ round(($bt_abm / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Female with blood type A</th>
            @if($fbt_a == 0)
            <td>0</td>
            @else
						<td>{{ round(($fbt_a / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Female with blood type A+</th>
            @if($fbt_ap == 0)
            <td>0</td>
            @else
						<td>{{ round(($fbt_ap / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Female with blood type A-</th>
            @if($fbt_am == 0)
            <td>0</td>
            @else
						<td>{{ round(($fbt_am / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Female with blood type B</th>
            @if($fbt_b == 0)
            <td>0</td>
            @else
						<td>{{ round(($fbt_b / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Female with blood type B+</th>
            @if($fbt_bp == 0)
            <td>0</td>
            @else
						<td>{{ round(($fbt_bp / $master_count) * 100)."%" }} {{ $master_count }}</td>
            @endif
					</tr>

          <tr>
						<th>Female with blood type B-</th>
            @if($fbt_bm == 0)
            <td>0</td>
            @else
						<td>{{ round(($fbt_bm / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Female with blood type O</th>
            @if($fbt_o == 0)
            <td>0</td>
            @else
						<td>{{ round(($fbt_o / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Female with blood type O+</th>
            @if($fbt_op == 0)
            <td>0</td>
            @else
						<td>{{ round(($fbt_op / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Female with blood type O-</th>
            @if($fbt_om == 0)
            <td>0</td>
            @else
						<td>{{ round(($fbt_om / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Female with blood type AB</th>
            @if($fbt_ab == 0)
            <td>0</td>
            @else
						<td>{{ round(($fbt_ab / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Female with blood type AB+</th>
            @if($fbt_abp == 0)
            <td>0</td>
            @else
						<td>{{ round(($fbt_abp / $master_count) * 100)."%" }}</td>
            @endif
					</tr>

          <tr>
						<th>Female with blood type AB-</th>
            @if($fbt_abm == 0)
            <td>0</td>
            @else
						<td>{{ round(($fbt_abm / $master_count) * 100)."%" }}</td>
            @endif
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
@if(empty($demographics_bt))
		<p></p>
	@else
		{{ $demographics_bt->script()}}
	@endif


@endpush





