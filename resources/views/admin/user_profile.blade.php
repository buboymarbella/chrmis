@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('masters.index')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('uploads/profile/'.$masters->picture) }}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ $masters->complete_name }}</h3>

                <p class="text-muted text-center">{{ $masters->acc_lvl }}</p>

                <ul class=" list-group list-group-unbordered mb-3">
					<li class="list-group-item">
						<b>Unit/Office</b> <a class="float-right">{{ $masters->office == null ? 'N/A' : $masters->office }}</a>
					</li>
					
					<li class="list-group-item">
						<b>Position</b> <a class="float-right">{{ $masters->position == null ? 'N/A' : $masters->position }}</a>
					</li>
					
					<li class="list-group-item">
						<b>Branch</b> <a class="float-right">{{ $masters->branch == null ? 'N/A' : $masters->branch }}</a>
					</li>
					
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Print</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<li class="list-group-item">
						<a href="#" target="_blank"><i class="fa fa-print"></i>&nbsp;PRINT INFO</a>&nbsp;&nbsp; 
					</li>
					
				</div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
			</div>
          <!-- /.col -->
			<div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
					<li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Personal Info</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
						<div class="user-block"></div>
						<!-- start of table-->
						<div class="float-right mb-2">
							<a href="{{ route('users.edit', $masters->id) }}" class="btn btn-sm btn-default btn-flat pull-right" title="Update Records"> 
							<i class="fas fa-pencil-alt"></i> &nbsp;Update Records</a>
							<a href="{{ route('usernames.edit', $masters->id) }}" class="btn btn-sm btn-default btn-flat pull-right"><i class="fa fa-envelope"></i> &nbsp;Change Email</a>
							<a href="{{ route('passwords.edit', $masters->id) }}" class="btn btn-sm btn-default btn-flat pull-right"><i class="fa fa-key"></i> &nbsp;Change Password</a>
						</div>
						
						<table class="profile-table1">
							<tr>
								<th class="pl-3">SURNAME</th>
								<td class="pl-2" colspan="3" >{{ $masters == null ? 'N/A' : $masters->last_name }}
								
							</tr>
							<tr>
								<th class="pl-3" >FIRST NAME</th>
								<td class="pl-2" colspan ="3" >{{ $masters == null ? 'N/A' : $masters->first_name }}</td>
							</tr>
							<tr>
								<th class="pl-3" >MIDDLE NAME</th>
								<td class="pl-2" colspan ="3" >{{ $masters == null ? 'N/A' : $masters->middle_name }}</td>
							</tr>
							.<tr>
								<th class="pl-3" >Office</th>
								<td class="pl-2"  >{{ $masters == null ? 'N/A' : $masters->office }}</td>
								<th class="pl-3"  >Position</th>
								<td class="pl-2"  >{{ $masters == null ? 'N/A' : $masters->position }}</td>
							</tr>
															
							<tr>
								<th class="pl-3" >Access level</th>
								<td class="pl-2"  >{{ $masters == null ? '' : $masters->acc_lvl }}</td>
								<th class="pl-3"  >Email</th>
								<td class="pl-2"  >{{ $masters == null ? 'N/A' : $masters->email }}</td>
							</tr>
						</table>
						<!-- end of table-->
                    </div>
                    <!-- /. end personal info -->

                    <!-- Post -->
                    <div class="post clearfix">
						
                      <!-- /.user-block -->
						
                    </div>
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post">
					  
                      <!-- /.user-block -->
					
						
                    <div class="m-wrap">
						
					</div>
                      <!-- /.row -->

                    </div>
                    <!-- /.post -->
                </div>
                  <!-- /.tab-pane -->
                <div class="tab-pane" id="educ">
					
					
                </div>
                  <!-- /end family -->
				  
				<div class="tab-pane" id="orelative">
					
					
					
				</div>
                  <!-- / end relative -->
				  
				<div class="tab-pane" id="associate">
					
					
				</div>
                  <!-- / end affiliation -->
				  
				<div class="tab-pane" id="activities">
					
					
                </div>
                <!-- / end activities -->
				
				<div class="tab-pane" id="vehicle">
					
					
                </div>
                <!-- / end vehicle -->
				
				<div class="tab-pane" id="case">
					
                </div>
                <!-- / end case -->
				
				<div class="tab-pane" id="social">
					
                </div>
                <!-- / end social media -->
				  
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</br>
@endsection





