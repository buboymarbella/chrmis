@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ELIGIBILITIES</h1>
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
          {!! $demographics_eligibility->container() !!}
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
            <form action="/print_demog_result_te" method="POST" enctype="multipart/form-data" target="_blank">
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
						<th>Career Service Professional </th>
						<td>{{$eligibility_csp}}</td>
					</tr>
					
					<tr>
						<th>RA1080 Bar</th>
						<td>{{$eligibility_cssp}}</td>
					</tr>

          <tr>
						<th>RA1080 Board</th>
						<td>{{$eligibility_board}}</td>
					</tr>

          <tr>
						<th>RA7883-Barangay Health Worker Eligibility</th>
						<td>{{$eligibility_barangay_nutrition}}</td>
					</tr>

          <tr>
						<th>PD1569-Barangay Nutrition Scholar Eligibility</th>
						<td>{{$eligibility_barangay_nutrition}}</td>
					</tr>

          <tr>
						<th>RA7160-Barangay Official Eligibility</th>
						<td>{{$eligibility_barangay_official}}</td>
					</tr>

          <tr>
						<th>CSC Res.1302714-Foreign School Honor Graduate Eligibility</th>
						<td>{{$eligibility_fhonor_grad}}</td>
					</tr>

          <tr>
						<th>PD907-Honor Graduate Eligibility</th>
						<td>{{$eligibility_honor_grad}}</td>
					</tr>

          <tr>
						<th>RA10156-Sanggunian Member Eligibility</th>
						<td>{{$eligibility_sanggunian}}</td>
					</tr>

          <tr>
						<th>PD997-Scientific and Technological Specialist Eligibility</th>
						<td>{{$eligibility_scientific}}</td>
					</tr>

          <tr>
						<th>CSC MC11,s.1996, as Amended-Skills Eligibility</th>
						<td>{{$eligibility_skills}}</td>
					</tr>
          
          <tr>
						<th>EO 132/790-Veteran Preference Rating</th>
						<td>{{$eligibility_veteran}}</td>
					</tr>

          <tr>
						<th>CSC Res.90-083-Electronic Data Processing Specialist Eligibility</th>
						<td>{{$eligibility_veteran}}</td>
					</tr>

          <tr>
						<th>OTHERS</th>
						<td>{{$eligibility_edp}}</td>
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
  @if(empty($demographics_eligibility)) 
		<p></p>
	@else
		{{ $demographics_eligibility->script()}}
	@endif
@endpush





