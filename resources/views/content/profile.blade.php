@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div style="float:left"> <h1>Profile</h1></div>
            <div style="float:right"> <a href="{{ route('view_records')}}"><button type="button" class="btn btn-warning btn-sm text-light">Back to CHR Records</button></a></div>
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
                       src="{{ asset('uploads/profile/'.$photo->image) }}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ $masters->complete_name }}</h3>

                <p class="text-muted text-center">{{ $masters->employ_stat }}</p>

                <ul class=" list-group list-group-unbordered mb-3">
					<li class="list-group-item">
						<b>Item Number</b> <a class="float-right">{{ $masters->item_number == null ? 'N/A' : $masters->item_number }}</a>
					</li>
					
					<li class="list-group-item">
						<b>Salary Grade</b> <a class="float-right">
							@if($masters->salary_grade == "")
								N/A
							@elseif(strlen($masters->salary_grade) <= 1)
								{!! "SG-0".$masters->salary_grade !!}
							@else
								{{ "SG-".$masters->salary_grade }}
							@endif
						</a>
					</li>
					
					<li class="list-group-item">
						<b>Office</b> <a class="float-right">{{ $masters->office == null ? 'N/A' : $masters->office }}</a>
					</li>
					
					<li class="list-group-item">
						<b>Position</b> <a class="float-right">{{ $masters->position == null ? 'N/A' : $masters->position }}</a>
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
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<li class="list-group-item">
						<a href="{{ route('print_pds_page1',$masters->main_id) }}" target="_blank"><i class="fa fa-print"></i>&nbsp;PRINT PDS PAGE ONE</a>&nbsp;&nbsp; 
					</li>
					
					<li class="list-group-item" >
						<a href="{{ route('print_pds_page2',$masters->main_id) }}" target="_blank"><i class="fa fa-print"></i>&nbsp;PRINT PDS PAGE TWO</a>&nbsp;&nbsp; 
					</li>
					
					<li class="list-group-item" >
						<a href="{{ route('print_pds_page3',$masters->main_id) }}" target="_blank"><i class="fa fa-print"></i>&nbsp;PRINT PDS PAGE THREE</a>&nbsp;&nbsp; 
					</li>
					
					<li class="list-group-item" >
						<a href="{{ route('print_pds_page4',$masters->main_id) }}" target="_blank"><i class="fa fa-print"></i>&nbsp;PRINT PDS PAGE FOUR</a>&nbsp;&nbsp; 
					</li>
					
					<li class="list-group-item" >
						<a href="{{ route('print_pds_page5',$masters->main_id) }}" target="_blank"><i class="fa fa-print"></i>&nbsp;PRINT WORK EXPE SHEET</a>&nbsp;&nbsp; 
					</li>
					
					<li class="list-group-item" >
						<a href="{{ route('print_pds_page6',$masters->main_id) }}" target="_blank"><i class="fa fa-print"></i>&nbsp;PRINT COMMENDATION</a>&nbsp;&nbsp; 
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
					<li class="nav-item"><a class='nav-link {{ (request()->is("masters/$masters->main_id")) ? "active" : "" }}' href="#activity" data-toggle="tab">Personal Info</a></li>
					<li class="nav-item"><a class='nav-link {{ (request()->is("education/$masters->main_id")) ? "active" : "" }}' href="#educ" data-toggle="tab">Education</a></li>
					<li class="nav-item"><a class='nav-link {{ (request()->is("families_records/$masters->main_id")) ? "active" : "" }}' href="#family" data-toggle="tab">Family</a></li>
					<li class="nav-item"><a class='nav-link {{ (request()->is("eligibility/$masters->main_id")) ? "active" : "" }}' href="#eligibility" data-toggle="tab">Eligibility</a></li>
					<li class="nav-item"><a class='nav-link {{ (request()->is("workexpe/$masters->main_id")) ? "active" : "" }}' href="#work" data-toggle="tab">Work Expe</a></li>
					<li class="nav-item"><a class='nav-link {{ (request()->is("voluntary/$masters->main_id")) ? "active" : "" }}' href="#voluntary" data-toggle="tab">Voluntary Org</a></li>
					<li class="nav-item"><a class='nav-link {{ (request()->is("training/$masters->main_id")) ? "active" : "" }}' href="#training" data-toggle="tab">Training</a></li>
					<li class="nav-item"><a class='nav-link {{ (request()->is("skills/$masters->main_id")) ? "active" : "" }}' href="#skill" data-toggle="tab">Skill/Recog/Assoc</a></li>
					<li class="nav-item"><a class='nav-link {{ (request()->is("commendation/$masters->main_id")) ? "active" : "" }}' href="#commendation" data-toggle="tab">Commendation Details</a></li>
					<li class="nav-item"><a class='nav-link {{ (request()->is("other_info/$masters->main_id")) ? "active" : "" }}' href="#other" data-toggle="tab">Other Info</a></li>
					<li class="nav-item"><a class='nav-link {{ (request()->is("issued/$masters->main_id")) ? "active" : "" }}' href="#issue" data-toggle="tab">Gov't Issued ID</a></li>
					<li class="nav-item"><a class='nav-link {{ (request()->is("reference/$masters->main_id")) ? "active" : "" }}' href="#reference" data-toggle="tab">Reference</a></li>
					<li class="nav-item"><a class='nav-link {{ (request()->is("rating/$masters->main_id")) ? "active" : "" }}' href="#rating" data-toggle="tab">IPCR</a></li>
          <li class="nav-item"><a class='nav-link {{ (request()->is("performance/$masters->main_id")) ? "active" : "" }}' href="#performance" data-toggle="tab">Performance Monitoring</a></li>
          <!-- <li class="nav-item"><a class='nav-link {{ (request()->is("performance/$masters->main_id")) ? "active" : "" }}' href="#history" data-toggle="tab">Plantilla History</a></li> -->
					@if (!\Gate::allows('isIsafp', Auth::user()->acc_lvl ) || !\Gate::allows('isIsafp', Auth::user()->office )) 
					
					@else
					<li class="nav-item"><a class='nav-link {{ (request()->is("longpay/$masters->main_id")) ? "active" : "" }}' href="#longpay" data-toggle="tab">Long Pay</a></li>
					@endif
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class='{{ (request()->is("masters/$masters->main_id")) ? "active" : "" }} tab-pane' id="activity">
                    <!-- Post -->
                    <div class="post">
						<div class="user-block"></div>
						@include ('content/include._personal_info', [
                            'masters' => $masters
                        ])
                    </div>
                    <!-- /. end personal info -->

                </div>
                  <!-- /.tab-pane -->
                <div class='{{ (request()->is("education/$masters->main_id")) ? "active" : "" }} tab-pane' id="educ">
					@include ('content/include._education', [
                            'education_elem' => $education_elem,
							'education_high' => $education_high,
							'vocational' => $vocational,
							'college' => $college,
							'graduate' => $graduate
                        ])
                </div>
                  <!-- /.end education -->
				  
				<div class='{{ (request()->is("families_records/$masters->main_id")) ? "active" : "" }} tab-pane' id="family">
					@include ('content/include._family', [
                            'family' => $family,
							'child' => $child
                        ])
                </div>
                  <!-- /end family -->
				  
				<div class='{{ (request()->is("eligibility/$masters->main_id")) ? "active" : "" }} tab-pane' id="eligibility">
					@include ('content/include._eligibility', [
                            'eligibility' => $eligibility
                        ])
					
                </div>
                  <!-- / end eligiblity -->
				  
				<div class='{{ (request()->is("workexpe/$masters->main_id")) ? "active" : "" }} tab-pane' id="work">
					@include ('content/include._workexpe', [
                            'workexpe' => $workexpe
                        ])
				
        </div>
                  <!-- / end workexpe-->
				  
				<div class='{{ (request()->is("voluntary/$masters->main_id")) ? "active" : "" }} tab-pane' id="voluntary">
					@include ('content/include._voluntary', [
                            'voluntary' => $voluntary
                        ])
				</div>
                <!-- / end voluntary -->

        <!-- <div class='{{ (request()->is("history/$masters->main_id")) ? "active" : "" }} tab-pane' id="history">
					@include ('content/include._history', [
                            'history' => $history 
                        ])
				</div> -->
				  
				<div class='{{ (request()->is("training/$masters->main_id")) ? "active" : "" }} tab-pane' id="training">
					@include ('content/include._training', [
                            'training' => $training
                        ])
				
                </div>
                <!-- / end activities -->
				
				<div class='{{ (request()->is("skills/$masters->main_id")) ? "active" : "" }} tab-pane' id="skill">
					@include ('content/include._skill', [
                            'other' => $other
                        ])
                </div>
                <!-- / end skills -->
				
				<div class='{{ (request()->is("commendation/$masters->main_id")) ? "active" : "" }} tab-pane' id="commendation">
					@include ('content/include._commendation', [
                            'commendation' => $commendation
                        ])
				
                </div>
                <!-- / end commendation -->
				
				<div class='{{ (request()->is("other_info/$masters->main_id")) ? "active" : "" }} tab-pane' id="other">
					@include ('content/include._answer', [
                            'answer' => $answer
                        ])
                </div>
				
                <!-- / end other_info -->
				<div class='{{ (request()->is("issued/$masters->main_id")) ? "active" : "" }} tab-pane' id="issue">
					@include ('content/include._issue', [
                            'issue' => $issue
                        ])
                </div>
				<!-- gov issued-->
				
				<div class='{{ (request()->is("reference/$masters->main_id")) ? "active" : "" }} tab-pane' id="reference">
					@include ('content/include._reference', [
                            'reference' => $reference
                        ])
                </div>
                <!-- / end reference -->
				
				<div class='{{ (request()->is("rating/$masters->main_id")) ? "active" : "" }} tab-pane' id="rating">
					@include ('content/include._rating', [
                            'rating' => $rating
                        ])
        </div>

        <div class='{{ (request()->is("performance/$masters->main_id")) ? "active" : "" }} tab-pane' id="performance">
					@include ('content/include._performance', [
                            'performance' => $performance
                        ])
        </div>
				
				<div class='{{ (request()->is("longpay/$masters->main_id")) ? "active" : "" }} tab-pane' id="longpay">
					@include ('content/include._longpay', [
                            'first_long_pay' => $first_long_pay,
							'second_long_pay' => $second_long_pay,
							'third_long_pay' => $third_long_pay,
							'forth_long_pay' => $forth_long_pay,
							'fifth_long_pay' => $fifth_long_pay
                        ])
                </div>
                <!-- / end ratings -->
				  
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
<br/>
@endsection





