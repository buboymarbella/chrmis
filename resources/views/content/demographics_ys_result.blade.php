@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>YEAR/S OF SERVICE IN THE AFP</h1>
          </div>
          <div class="col-sm-6 pr-1">
            <div style="float:right"> <a href="{{ route('demographics')}}"><button type="button" class="btn btn-warning btn-sm text-light"><< BACK</button></a></div>
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
				
        <div class="float-left">Showing {{ $service_count }} entries</div>
				
				<div class="float-right pb-2">
        <form action="/download_demog_result_ys" method="POST" enctype="multipart/form-data" target="_blank">
                @csrf
                <button type="submit" class="btn btn-tool">
                <i class="fa fa-download"></i> &nbsp;Download Excel
                </button>
                <a href="#" class="btn btn-tool">
                    <i class="fa fa-download"></i> &nbsp;Download PDF</a>
                </a>
                <input type="text" name="office" value="{{ $office }}" hidden>
                <input type="text" name="num_year" value="{{ $num_year }}" hidden>
            </form>
				</div>
				
				<div class="card-body table-responsive p-0" style="height: 600px;">
				<table id="example1" class="table table-head-fixed text-nowrap text-center">
                <thead>
                  <tr>
                    <th style="width:15%;">Item No.</th>
                    <th style="width:15%;">Name</th>
                    <th style="width:10%;">Unit\Office</th>
                    <th style="width:10%;">Position</th>
                    <th style="width:10%;">Salary Grade</th>
                    <th style="width:15%">Date Hired / Year's in the Service</th>
                    <th style="width:15%;">Compulsory Retirement</th>
                    <th style="width:10%;">Optional Retirement</th>
                  </tr>
                </thead>
                <tbody>
					
                  @forelse ($service as $key=>$master)
                  <tr>
                    <td>{{ $master->item_number == "" ? 'N/A' : $master->item_number }}</td>
                    <td><a href="{{ route('masters.show', $master->main_id) }}">{{ $master->complete_name == "" ? 'N/A' : $master->complete_name}}</a></td>
                    <td>{{ $master->office == "" ? 'N/A' : $master->office}}</td>
                    <td>{{ $master->position == null ? 'N/A' : $master->position }}</td>
                    <td>{{ $master->salary_grade == null ? 'N/A' : $master->salary_grade }}</td>
                    <td>
                        @if($master->date_hired == null)
                  
                        @elseif($master->date_hired == '1970-01-01')
                          
                        @else
                          {{ date('d M Y', strtotime($master->date_hired)) }}
                        @endif
                        / 
                        <?php
                        $dateOfBirth = $master->date_hired;
                        $today = date("Y-m-d");
                        $diff = date_diff(date_create($dateOfBirth), date_create($today));
                        $age = $diff->format('%y');

                        if($age == 1){
                          echo $age."yr";
                        }elseif($age == 0){
                          echo $age;
                        }else{
                          echo $age."yr's";
                        }
                        
                        ?>
                    </td>
                    <td>{{ $master->retirement_date == null ? 'N/A' : date('d M Y',strtotime($master->retirement_date)) }}</td>
                    <td>{{ $master->optional_retire == null ? 'N/A' : date('d M Y',strtotime($master->optional_retire)) }}</td>
                    
                  </tr>
                  @empty
                    <tr>
                      <td colspan="8"><strong>Sorry</strong> There are no data available.</td>
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
