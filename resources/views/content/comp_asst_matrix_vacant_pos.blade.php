@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Vacant Position "{{ $master->plantilla_number}}"</h1>
          </div>
          <div class="col-sm-6">
            <div style="float:right"> <a href="{{ route('computer_asst_matrix')}}"><button type="button" class="btn btn-warning btn-sm text-light"><< BACK</button></a></div>
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
				
				<!-- <div class="float-left">
					<form class="form-inline ml-0" method="POST" action="{{ route('search_staff_plan') }}">
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
					<a href="{{ route('download_staffing_result',$id)}}" class="btn btn-sm btn-default btn-flat pull-right"> 
					<i class="fa fa-download"></i> &nbsp;Download</a>
				</div> -->
				
				
				<table id="example1" class="table table-bordered table-striped text-center">
                <thead>
					<tr>
						<th style="width:15%;">Plantilla #</th>
						<th style="width:15%;">Position Title</th>
						<th style="width:5%;">SG</th>
						<th style="width:5%;">Office/Unit</th>
						<th style="width:10%;">Req'd Eligibility</th>
						<th style="width:10%;">Req'd Training Hours</th>
						<th style="width:10%;">Req'd Years of Exp</th>
						<th style="width:30%;">Select Internal Candidate ES (Max 5)</th>
					</tr>
          </thead>
          <tbody>
					
					
					<tr>
						<td><a href="#">{{ $master->plantilla_number == "" ? 'N/A' : $master->plantilla_number }}</a></td>
						<td>{{ $master->title == null ? 'N/A' : $master->title }}</td>
						<td>{{ $master->sg == "" ? 'N/A' : $master->sg}} </td>
						<td>{{ $master->office == "" ? 'N/A' : $master->office}} </td>
						<td>{{ $master->eligibility == null ? 'N/A' : $master->eligibility }}</td>
						<td>{{ $master->training == null ? 'N/A' : $master->training }}</td>
						<td>{{ $master->experience == null ? 'N/A' : $master->experience }}</td>
						<td>
						@forelse ($candidate as $key=>$candidate)
						<div class="py-1">
							@if( $candidate->main_id == "")
								<span  class="btn btn-xs btn-warning">CHR INCOMPLETE INFORMATION</span>
							@else
								<a href="{{ route('comp', $candidate->main_id) }}" class="btn btn-xs btn-success">{{ $candidate->complete_name ."-SG".$candidate->salary_grade ." / ". ($candidate->sum_year - 1)." yrs in the service"  }}</a>
							@endif
						</div>
						@empty
							<strong>Sorry</strong> There are no data available.
						@endforelse
						</td>
					</tr>

					
                </tbody>
				</table>
				<br/>
				@if(session('comp'))
				<table id="example1" class="table text-center">

					<tr>
						<th style="width:20%;">Name</th>
						<th style="width:10%;">Position</th>
						<th style="width:10%;">Date of Birth</th>
						<th style="width:5`%;">SG</th>
						<th style="width:10%;">Office/Unit</th>
						<th style="width:40%;"></th>
						<!-- <th style="width:10%;">Performance</th>
						<th style="width:10%;">Education</th>
						<th style="width:10%;">Training</th>
						<th style="width:10%;">Awards</th>
						<th style="width:10%;">Actual</th>
						<th style="width:5%;">Pts</th> -->
						<th style="width:5%;">Action</th>
					</tr>
					<?php $max = ['1'];?>
                        @foreach(session('comp') as $key => $details)
							<tr data-id="{{ $key }}">
								<td>{{ $details['name'] }}</td>
								<td>{{ $details['position'] }}</td>
								<td>
									@if($details['dob'] == '1970-01-01' || $details['dob'] == '1970-01-01') 
										N/A
									@elseif($details['dob'] == NULL || $details['dob'] == NULL) 
										N/A
									@else
										{{date("d M Y", strtotime($details['dob'])) }}
									@endif
								</td>
								<td>{{ $details['salary_grade'] }}</td>
								<td>{{ $details['office'] }}</td>
								<td> 
									<!-- Awards: {{ Illuminate\Support\Str::replace('[', '',$details['commendation']) }}
									<br/>Commendation: {{ $details['commendation1'] }} letters commendation/s 
									<br/>Bachelor Degree:{{ $details['college'] }}
									<br/>Master Degree:{{ $details['graduate'] }}
									<br/>AFP Career Course:{{ $details['career'] }}
									<br/>Number of hour/s of other training: {{ $details['career1'] }} -->
									<div style=" margin: auto;width: 90%;">
										<table style="margin: auto;width: 100%;">
											<tr>
												<td style="width:30%;">Criteria</td><td style="width:60%;">Actual</td><td style="width:10%;">Pts</td>
											</tr>
											<tr>
												<td>Performance (30 pts max)</td><td><b>Ratings: </b>{{ $details['rating'] }}</td><td>{{ $details['rating_total'] }}</td>
											</tr>
											<tr>
												<td>Education (15 pts max)</td><td>
												<b>Vocational:</b> {{ $details['vocational'] }}
												<br/><b>Bachelor Degree:</b> {{ $details['college'] }}
												<br/><b>Master Degree:</b> {{ $details['graduate'] }}
												<br/><b>Doctorate Degree:</b> {{ $details['doctorate'] }}
												</td>
												<td>{{ $details['educ_points'] }}</td>
											</tr>
											<tr>
												<td>Training (10 pts max)</td>
												<td><b>AFP Career Course:</b> {{ $details['career'] }}
													<br/><b>Other Training:</b> {{ $details['career1'] }}
												</td>
												<td>{{ $details['training_other'] }}</td>
											</tr>
											<tr>
												<td>Experience (15 pts max)</td>
												<td>{{ $details['exp'] ." yr/s"}} <span hidden>{{ array_push($max,$details['exp'])}}</span></td>
												<td>{{ round(15 * $details['exp'] / max($max),2 ) }}</td>
											</tr>
											<tr>
												<td>Awards (10 pts max)</td>
												<td><b>Awards:</b> {{ Illuminate\Support\Str::replace('[', '',$details['commendation']) }}
													<br/><b>Commendation:</b> {{ $details['commendation1'] }} letters commendation/s 
												</td>
												<td>{{ $details['commendation_total'] }}</td>
											</tr>
											<tr>
												<td colspan="2" style="font-weight:bold;text-align:right">Total :</td>
												<td> {{ round(15 * $details['exp'] / max($max),2 ) + $details['rating_total'] + $details['commendation_total'] + $details['commendation_total'] + $details['training_other']  + $details['educ_points']}}</td>
											</tr>
										</table>
									</div>
								</td>
								<td class="actions" data-th=""> <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash"></i></button></td>
							</tr>
					
						@endforeach
					
					
				</table>
				@endif
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
@push('js')
<script type="text/javascript">
  
    // 

  
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
  
</script>
@endpush
