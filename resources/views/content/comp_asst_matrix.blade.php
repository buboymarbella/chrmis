@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>COMPUTERIZED COMPARATIVE ASSESSMENT MATRIX</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('masters.index')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Comp Asst Matrix</li>
            </ol>
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
						<th>Level</th>
						<th>Vacant 1st Level</th>
						<th>Vacant 2nd Level</th>
						<th>Total</th>
					</tr>
					<tr>
						<th><a href="{{route('computer_asst_matrix_office','COORDINATING_STAFF')}}">Joint Staff Wide</a></th>
						<td>{{ $plantilla_jsw_1st }}</td>
            <td>{{ $plantilla_jsw_2nd }}</td>
            <td>{{ $plantilla_jsw_1st + $plantilla_jsw_2nd}}</td>
					</tr>
					
					<tr>
						<th><a href="{{route('computer_asst_matrix_office','PERSONAL_STAFF')}}">Personal Staff Wide</a></th>
						<td>{{ $plantilla_pers_1st }}</td>
            <td>{{ $plantilla_pers_2nd }}</td>
            <td>{{ $plantilla_pers_1st + $plantilla_pers_2nd }}</td>
					</tr>

					<tr>
						<th><a href="{{route('computer_asst_matrix_office','SPECIAL_STAFF')}}">Special Staff Wide</a></th>
            <td>{{ $plantilla_special_1st }}</td>
            <td>{{ $plantilla_special_2nd }}</td>
            <td>{{ $plantilla_special_1st + $plantilla_special_2nd}}</td>
					</tr>

          <tr>
						<th><a href="{{route('computer_asst_matrix_office','UNIFIED_COMMAND')}}">Unified Commands</a></th>
            <td>{{ $plantilla_uc_1st }}</td>
            <td>{{ $plantilla_uc_2nd }}</td>
            <td>{{ $plantilla_uc_1st + $plantilla_uc_2nd }}</td>
					</tr>

          <tr>
						<th><a href="{{route('computer_asst_matrix_office','AFPWSSUS')}}">AFPWSSU's</a></th>
						<td>{{ $plantilla_afpsus_1st }}</td>
            <td>{{ $plantilla_afpsus_2nd }}</td>
            <td>{{ $plantilla_afpsus_1st + $plantilla_afpsus_2nd}}</td>
					</tr>

          {{-- <tr>
						<th><a href="#">Key Budgetary Units</a></th>
						<td>0</td>
            <td>0</td>
            <td>0</td>
					</tr> --}}

          <tr>
						<th>Total (GUAs-Wide)</th>
						<th>{{ $plantilla_jsw_1st + $plantilla_pers_1st + $plantilla_special_1st + $plantilla_uc_1st + $plantilla_afpsus_1st + 0}}</th>
            <th>{{ $plantilla_jsw_2nd + $plantilla_pers_2nd + $plantilla_special_2nd + $plantilla_uc_2nd + $plantilla_afpsus_2nd + 0}}</th>
            <th>{{ $c }}</th>
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