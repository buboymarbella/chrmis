@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>TRAINING PARTICIPANT SELECTION MATRIX</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('masters.index')}}">Dashboard</a></li>
			  <li class="breadcrumb-item active">Training Matrix</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title"></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<table class="text-center">
					  
							<tr>
								<th width="50%">COURSE TITLE</th>
								<th width="30%">PROJECT NUMBER OF STUDENTS</th>
								<th width="30%">ACTION</th>
							</tr>
							
							<tr>
								<td><a href="#" target="_blank">Civilian Personnel Orientation/Reorientation Training</a></td>
								<td>{{ $count_cport }}</td>
								<td>
									<a href="{{ route('result_cport') }}" target="_blank">
									<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm" title="View">
									<i class="fas fa-folder"></i>
									</button>
									</a>
									<!-- <a href="{{ route('training_cport_download') }}" >
									<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm my-1" title="Download">
									<i class="fas fa-cloud-download-alt"></i>
									</button>
									</a> -->
								</td>
							</tr>
							
							<tr>
								<td><a href="#" target="_blank">Civilian Personnel Basic Course</a></td>
								<td>{{ $count_cpbc }}</td>
								<td>
									<a href="{{ route('result_cpbc') }}"  target="_blank">
									<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm" title="View">
									<i class="fas fa-folder"></i>
									</button>
									</a>
									<!-- <a href="{{ route('training_cpbc_download') }}">
									<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm my-1" title="Download">
									<i class="fas fa-cloud-download-alt"></i>
									</button>
									</a> -->
								</td>
							</tr>
							
							<tr>
								<td><a href="#" target="_blank">Civilian Personnel Basic Supervisory Course</a></td>
								<td>{{ $count_cpbsc }}</td>
								<td>
									<a href="{{ route('result_cpbsc') }}"  target="_blank">
									<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm" title="View">
									<i class="fas fa-folder"></i>
									</button>
									</a>
									<!-- <a href="{{ route('training_cpbsc_download') }}">
									<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm my-1" title="Download">
									<i class="fas fa-cloud-download-alt"></i>
									</button>
									</a> -->
									
								</td>
							</tr>
							
							<tr>
								<td><a href="#" target="_blank">Civilian Personnel Advance Supervisory Course</a></td>
								<td>{{ $count_cpasc }}</td>
								<td>
									<a href="{{ route('result_cpasc') }}"  target="_blank">
									<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm" title="View">
									<i class="fas fa-folder"></i>
									</button>
									<!-- </a>
									<a href="{{ route('training_cpasc_download') }}">
									<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm my-1" title="Download">
									<i class="fas fa-cloud-download-alt"></i>
									</button>
									</a> -->
								</td>
							</tr>
							
							<tr>
								<th colspan="2" class="text-right pr-3">TOTAL</th>
								<th>{{ $total}}</th>
							</tr>
						
						</table>
					</div>
				</div>
			</div>
        </div>
      </div>
    </section>
</div>
<br/>
@endsection





