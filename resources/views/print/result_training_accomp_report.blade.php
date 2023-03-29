@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-10">
            <div style="float:left"><h1>TRAINING ACCOMPLISHMENT REPORT</h1></div>
            <div style="float:right;padding-right:15px;"> <a href="{{ route('training_accomp_report')}}"><button type="button" class="btn btn-warning btn-sm text-light"><< BACK</button></a></div>
          </div>
          <div class="col-sm-6">
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row col-md-10">
        <div class="col-12">
         
				
				{{-- <div class="card-body table-responsive p-0" style="">
				<table id="example1" class="table table-head-fixed text-nowrap text-center">

					<tr>
            <th>GUAs</th>
						<th>Level</th>
						<th>Actual Filled Positions</th>
						<th>Target Nr of Hours of LDI</th>
						<th>Actual Nr of Hours of LDI</th>
						<th>% Accomp</th>
					</tr>
					<tr>
            <th rowspan="4">
              <a href="{{route('fill_up_rate_office_report','COORDINATING_STAFF')}}">Joint Staff Wide</a><br/>
              <a href="{{route('fill_up_rate_office_report','PERSONAL_STAFF')}}">Personal Staff Wide</a><br/>
              <a href="{{route('fill_up_rate_office_report','SPECIAL_STAFF')}}">Special Staff Wide</a><br/>
              <a href="{{route('fill_up_rate_office_report','AFPWSSUS')}}">AFPWSSU's</a><br/>
              <a href="{{route('fill_up_rate_office_report','UNIFIED_COMMAND')}}">Unified Commands</a><br/>
              <a href="#">Key Budgetary Units</a><br/>
              <a href="#">Office/Units</a><br/>
            </th>
						<th>2nd Level Supervisory<br/>(SG-18 and above)</td>
						<td>{{ $second_supervisory }}</td>
						<td>{{ $supervisory }}</td>
						<td>{{ array_sum($second_level_actual_supervisory) }}</td>
						<th>{{ $total_supervisory."%" }}</th>
						
						
					</tr>
					
					<tr>
						<th>2nd Level Technical<br/>(SG-10 to 17)</th>
						<td>{{ $second_tech }}</td>
						<td>{{ $tech}}</td>
						<td>{{ array_sum($second_level_actual_tech) }}</td>
						<th>{{ $total_tech."%"}}</th>
					</tr>
					
					
					<tr>
						<th>1st Level<br/>(SG-1 to 14)</th>
						<td>{{ $first_level }}</td>
						<td>{{ $first}}</td>
						<td>{{ array_sum($second_level_actual_first) }}</td>
						<th>{{ $total_first."%" }}</th>
					</tr>

          <tr>
						<th>Total</th>
						<th>{{ $second_supervisory +  $second_tech + $first_level}}</th>
						<th>{{ $supervisory +  $tech + $first}}</th>
						<th>{{ $total_actual_level}}</th>
						<th>{{ $total_supervisory +  $total_tech + $total_first."%"}}</th>
					</tr>
					<!--
					<tr>
						<th>Average TAT Efficiency Rate</th>
						<td>88.89%</td>
					</tr>
					<tr>
						<th>Average Recruitment Cost from Publication to Onboarding</th>
						<td>PhP 150.00</td>
					</tr>
					-->
					
				</table>
				</div> --}}

        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-list"></i>
             
            </h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-5 col-sm-3">
                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="false">GUAs</a>
                  <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="true">Joint Staff Wide</a>
                  <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Personal Staff Wide</a>
                  <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Special Staff Wide</a>
                  
                  <a class="nav-link" id="vert-tabs-afpsus-tab" data-toggle="pill" href="#vert-tabs-afpsus" role="tab" aria-controls="vert-tabs-afpsus" aria-selected="false">AFPWSSU's</a>
                  <a class="nav-link" id="vert-tabs-uc-tab" data-toggle="pill" href="#vert-tabs-uc" role="tab" aria-controls="vert-tabs-uc" aria-selected="false">Unified Commands</a>
                  {{-- <a class="nav-link" id="vert-tabs-key-tab" data-toggle="pill" href="#vert-tabs-key" role="tab" aria-controls="vert-tabs-key" aria-selected="false">Key Budgetary Units</a>
                  <a class="nav-link" id="vert-tabs-office-tab" data-toggle="pill" href="#vert-tabs-office" role="tab" aria-controls="vert-tabs-office" aria-selected="false">Office/Units</a> --}}
                </div>
              </div>
              <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                  <div class="tab-pane text-left active show fade" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                    <div class="card-body table-responsive p-0" style="">
                    
                    <table id="example1" class="table table-head-fixed text-nowrap text-center">
                      <tr>
                        <th colspan="6"> <h3>GUAs</h3></th>
                      </tr>
                      <tr>
                        <th>Level</th>
                        <th>Actual Filled Positions</th>
                        <th>Target Nr of Hours of LDI</th>
                        <th>Actual Nr of Hours of LDI</th>
                        <th>Exceed/Drop</th>
                        <th>% Accomp</th>
                      </tr>
                      <tr>
                       
                        <th>2nd Level Supervisory<br/>(SG-18 and above)</td>
                        <td>{{ $second_supervisory }}</td>
                        <td>{{ $supervisory }}</td>
                        <td>{{ array_sum($second_level_actual_supervisory) }}</td>
                        <td>{{ array_sum($second_level_actual_supervisory) - $supervisory }}</td>
                        <th>
                          @if($total_supervisory > 100)
                            100%
                          @else
                            {{ $total_supervisory."%" }}
                          @endif
                        </th>
                        
                        
                      </tr>
                      
                      <tr>
                        <th>2nd Level Technical<br/>(SG-10 to 17)</th>
                        <td>{{ $second_tech }}</td>
                        <td>{{ $tech}}</td>
                        <td>{{ array_sum($second_level_actual_tech) }}</td>
                        <td>{{ array_sum($second_level_actual_tech) - $tech }}</td>
                        <th>
                          @if($total_tech > 100)
                            100%
                          @else
                            {{ $total_tech."%" }}
                          @endif
                        </th>
                      </tr>
                      
                      
                      <tr>
                        <th>1st Level<br/>(SG-1 to 14)</th>
                        <td>{{ $first_level }}</td>
                        <td>{{ $first}}</td>
                        <td>{{ array_sum($second_level_actual_first) }}</td>
                        <td>{{ array_sum($second_level_actual_first) - $first }}</td>
                        <th>
                          @if($total_first > 100)
                            100%
                          @else
                            {{ $total_first."%" }}
                          @endif
                        </th>
                      </tr>
            
                      <tr>
                        <th>Total</th>
                        <th>{{ $second_supervisory +  $second_tech + $first_level}}</th>
                        <th>{{ $total_actual_one}}</th>
                        <th>{{ $total_actual_level}}</th>
                        <th>{{ $total_actual_level - $total_actual_one}}</th>
                        <th>
                          @if($total_all_one > 100)
                            100%
                          @else
                            {{ $total_all_one."%" }}
                          @endif
                        </th>
                      </tr>
                     
                    </table>
                  </div>
                  </div>
                  <div class="tab-pane fade " id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                    <div class="card-body table-responsive p-0" style="">
                      <table id="example1" class="table table-head-fixed text-nowrap text-center">
                        <tr>
                          <th colspan="6"> <h3>Joint Staff Wide</h3></th>
                        </tr>
                        <tr>
                          <th>Level</th>
                          <th>Actual Filled Positions</th>
                          <th>Target Nr of Hours of LDI</th>
                          <th>Actual Nr of Hours of LDI</th>
                          <th>Exceed/Drop</th>
                          <th>% Accomp</th>
                        </tr>
                        <tr>
                        
                          <th>2nd Level Supervisory<br/>(SG-18 and above)</td>
                          <td>{{ $second_supervisory_cs }}</td>
                          <td>{{ $supervisory_cs }}</td>
                          <td>{{ array_sum($second_level_actual_supervisory_cs) }}</td>
                          <td>{{ array_sum($second_level_actual_supervisory_cs) - $supervisory_cs }}</td>
                          <th>{{ $total_supervisory_cs."%" }}</th>
                          
                          
                        </tr>
                        
                        <tr>
                          <th>2nd Level Technical<br/>(SG-10 to 17)</th>
                          <td>{{ $second_tech_cs }}</td>
                          <td>{{ $tech_cs}}</td>
                          <td>{{ array_sum($second_level_actual_tech_cs)}}</td>
                          <td>{{ array_sum($second_level_actual_tech_cs) - $tech_cs}}</td>
                          <th>{{ $total_tech_cs."%"}}</th>
                        </tr>
                        
                        
                        <tr>
                          <th>1st Level<br/>(SG-1 to 14)</th>
                          <td>{{ $first_level_cs }}</td>
                          <td>{{ $first_cs}}</td>
                          <td>{{ array_sum($second_level_actual_first_cs) }}</td>
                          <td>{{ array_sum($second_level_actual_first_cs) - $first_cs}}</td>
                          <th>{{ $total_first_cs."%" }}</th>
                        </tr>
              
                        <tr>
                          <th>Total</th>
                          <th>{{ $second_supervisory_cs +  $second_tech_cs + $first_level_cs}}</th>
                          <th>{{ $supervisory_cs +  $tech_cs + $first_cs}}</th>
                          <th>{{ $total_actual_level_cs}}</th>
                          <th>{{ $total_actual_level_cs - ($supervisory_cs +  $tech_cs + $first_cs)}}</th>
                          <th>
                            @if($total_all_two > 100)
                              100%
                            @else
                              {{ $total_all_two."%" }}
                            @endif
                          </th>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                    <div class="card-body table-responsive p-0" style="">
                      <table id="example1" class="table table-head-fixed text-nowrap text-center">
                        <tr>
                          <th colspan="6"> <h3>Personal Staff Wide</h3></th>
                        </tr>
                        <tr>
                          <th>Level</th>
                          <th>Actual Filled Positions</th>
                          <th>Target Nr of Hours of LDI</th>
                          <th>Actual Nr of Hours of LDI</th>
                          <th>Exceed/Drop</th>
                          <th>% Accomp</th>
                        </tr>
                        <tr>
                        
                          <th>2nd Level Supervisory<br/>(SG-18 and above)</td>
                          <td>{{ $second_supervisory_ps }}</td>
                          <td>{{ $supervisory_ps }}</td>
                          <td>{{ array_sum($second_level_actual_supervisory_ps) }}</td>
                          <td>{{ array_sum($second_level_actual_supervisory_ps) - $supervisory_ps }}</td>
                          <th>{{ $total_supervisory_ps."%" }}</th>
                          
                          
                        </tr>
                        
                        <tr>
                          <th>2nd Level Technical<br/>(SG-10 to 17)</th>
                          <td>{{ $second_tech_ps }}</td>
                          <td>{{ $tech_ps}}</td>
                          <td>{{ array_sum($second_level_actual_tech_ps) }}</td>
                          <td>{{ array_sum($second_level_actual_tech_ps) - $tech_ps}}</td>
                          <th>{{ $total_tech_ps."%"}}</th>
                        </tr>
                        
                        
                        <tr>
                          <th>1st Level<br/>(SG-1 to 14)</th>
                          <td>{{ $first_level_ps }}</td>
                          <td>{{ $first_ps}}</td>
                          <td>{{ array_sum($second_level_actual_first_ps) }}</td>
                          <td>{{ array_sum($second_level_actual_first_ps) - $first_ps}}</td>
                          <th>{{ $total_first_ps."%" }}</th>
                        </tr>
              
                        <tr>
                          <th>Total</th>
                          <th>{{ $second_supervisory_ps +  $second_tech_ps + $first_level_ps}}</th>
                          <th>{{ $supervisory_ps +  $tech_ps + $first_ps}}</th>
                          <th>{{ $total_actual_level_ps}}</th>
                          <th>{{ $total_actual_level_ps - ($supervisory_ps +  $tech_ps + $first_ps)}}</th>
                          <th>
                            @if($total_all_three > 100)
                              100%
                            @else
                              {{ $total_all_three."%" }}
                            @endif
                          </th>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                    <div class="card-body table-responsive p-0" style="">
                      <table id="example1" class="table table-head-fixed text-nowrap text-center">
                        <tr>
                          <th colspan="6"> <h3>Special Staff Wide</h3></th>
                        </tr>
                        <tr>
                          <th>Level</th>
                          <th>Actual Filled Positions</th>
                          <th>Target Nr of Hours of LDI</th>
                          <th>Actual Nr of Hours of LDI</th>
                          <th>Exceed/Drop</th>
                          <th>% Accomp</th>
                        </tr>
                        <tr>
                        
                          <th>2nd Level Supervisory<br/>(SG-18 and above)</td>
                          <td>{{ $second_supervisory_ss }}</td>
                          <td>{{ $supervisory_ss }}</td>
                          <td>{{ array_sum($second_level_actual_supervisory_ss) }}</td>
                          <td>{{ array_sum($second_level_actual_supervisory_ss) - $supervisory_ss}}</td>
                          <th>{{ $total_supervisory_ss."%" }}</th>
                          
                          
                        </tr>
                        
                        <tr>
                          <th>2nd Level Technical<br/>(SG-10 to 17)</th>
                          <td>{{ $second_tech_ss }}</td>
                          <td>{{ $tech_ss}}</td>
                          <td>{{ array_sum($second_level_actual_tech_ss) }}</td>
                          <td>{{ array_sum($second_level_actual_tech_ss) - $tech_ss }}</td>
                          <th>{{ $total_tech_ss."%"}}</th>
                        </tr>
                        
                        
                        <tr>
                          <th>1st Level<br/>(SG-1 to 14)</th>
                          <td>{{ $first_level_ss }}</td>
                          <td>{{ $first_ss}}</td>
                          <td>{{ array_sum($second_level_actual_first_ss) }}</td>
                          <td>{{ array_sum($second_level_actual_first_ss) - $first_ss }}</td>
                          <th>{{ $total_first_ss."%" }}</th>
                        </tr>
              
                        <tr>
                          <th>Total</th>
                          <th>{{ $second_supervisory_ss +  $second_tech_ss + $first_level_ss}}</th>
                          <th>{{ $supervisory_ss +  $tech_ss + $first_ss}}</th>
                          <th>{{ $total_actual_level_ss}}</th>
                          <th>{{ $total_actual_level_ss - ($supervisory_ss +  $tech_ss + $first_ss)}}</th>
                          <th>
                            @if($total_all_four > 100)
                              100%
                            @else
                              {{ $total_all_four."%" }}
                            @endif
                          </th>
                        </tr>
                      </table>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="vert-tabs-afpsus" role="tabpanel" aria-labelledby="vert-tabs-afpsus-tab">
                    <div class="card-body table-responsive p-0" style="">
                      <table id="example1" class="table table-head-fixed text-nowrap text-center">
                        <tr>
                          <th colspan="6"> <h3>AFPWSSU's</h3></th>
                        </tr>
                        <tr>
                          <th>Level</th>
                          <th>Actual Filled Positions</th>
                          <th>Target Nr of Hours of LDI</th>
                          <th>Actual Nr of Hours of LDI</th>
                          <th>Exceed/Drop</th>
                          <th>% Accomp</th>
                        </tr>
                        <tr>
                        
                          <th>2nd Level Supervisory<br/>(SG-18 and above)</td>
                          <td>{{ $second_supervisory_a }}</td>
                          <td>{{ $supervisory_a }}</td>
                          <td>{{ array_sum($second_level_actual_supervisory_a) }}</td>
                          <td>{{ array_sum($second_level_actual_supervisory_a) - $supervisory_a}}</td>
                          <th>{{ $total_supervisory_a."%" }}</th>
                          
                          
                        </tr>
                        
                        <tr>
                          <th>2nd Level Technical<br/>(SG-10 to 17)</th>
                          <td>{{ $second_tech_a }}</td>
                          <td>{{ $tech_a }}</td>
                          <td>{{ array_sum($second_level_actual_tech_a) }}</td>
                          <td>{{ array_sum($second_level_actual_tech_a) - $tech_a }}</td>
                          <th>{{ $total_tech_a."%"}}</th>
                        </tr>
                        
                        
                        <tr>
                          <th>1st Level<br/>(SG-1 to 14)</th>
                          <td>{{ $first_level_a }}</td>
                          <td>{{ $first_a}}</td>
                          <td>{{ array_sum($second_level_actual_first_a) }}</td>
                          <td>{{ array_sum($second_level_actual_first_a) - $first_a }}</td>
                          <th>{{ $total_first_a."%" }}</th>
                        </tr>
              
                        <tr>
                          <th>Total</th>
                          <th>{{ $second_supervisory_a +  $second_tech_a + $first_level_a}}</th>
                          <th>{{ $supervisory_a +  $tech_a + $first_a}}</th>
                          <th>{{ $total_actual_level_a}}</th>
                          <th>{{ $total_actual_level_a - ($supervisory_a +  $tech_a + $first_a)}}</th>
                          <th>
                            @if($total_all_five > 100)
                              100%
                            @else
                              {{ $total_all_five."%" }}
                            @endif
                          </th>
                        </tr>
                      </table>
                    </div>
                </div>
                  <div class="tab-pane fade" id="vert-tabs-uc" role="tabpanel" aria-labelledby="vert-tabs-uc-tab">
                    <div class="card-body table-responsive p-0" style="">
                      <table id="example1" class="table table-head-fixed text-nowrap text-center">
                        <tr>
                          <th colspan="6"> <h3>Unified Command</h3></th>
                        </tr>
                        <tr>
                          <th>Level</th>
                          <th>Actual Filled Positions</th>
                          <th>Target Nr of Hours of LDI</th>
                          <th>Actual Nr of Hours of LDI</th>
                          <th>Exceed/Drop</th>
                          <th>% Accomp</th>
                        </tr>
                        <tr>
                        
                          <th>2nd Level Supervisory<br/>(SG-18 and above)</td>
                          <td>{{ $second_supervisory_uc }}</td>
                          <td>{{ $supervisory_uc }}</td>
                          <td>{{ array_sum($second_level_actual_supervisory_uc) }}</td>
                          <td>{{ array_sum($second_level_actual_supervisory_uc) - $supervisory_uc }}</td>
                          <th>{{ $total_supervisory_uc."%" }}</th>
                          
                          
                        </tr>
                        
                        <tr>
                          <th>2nd Level Technical<br/>(SG-10 to 17)</th>
                          <td>{{ $second_tech_uc }}</td>
                          <td>{{ $tech_uc}}</td>
                          <td>{{ array_sum($second_level_actual_tech_uc) }}</td>
                          <td>{{ array_sum($second_level_actual_tech_uc) - $tech_uc}}</td>
                          <th>{{ $total_tech_uc."%"}}</th>
                        </tr>
                        
                        
                        <tr>
                          <th>1st Level<br/>(SG-1 to 14)</th>
                          <td>{{ $first_level_uc }}</td>
                          <td>{{ $first_uc}}</td>
                          <td>{{ array_sum($second_level_actual_first_uc) }}</td>
                          <td>{{ array_sum($second_level_actual_first_uc) - $first_uc }}</td>
                          <th>{{ $total_first_uc."%" }}</th>
                        </tr>
              
                        <tr>
                          <th>Total</th>
                          <th>{{ $second_supervisory_uc +  $second_tech_uc + $first_level_uc}}</th>
                          <th>{{ $supervisory_uc +  $tech_uc + $first_uc}}</th>
                          <th>{{ $total_actual_level_uc}}</th>
                          <th>{{ $total_actual_level_uc - ($supervisory_uc +  $tech_uc + $first_uc) }}</th>
                          <th>
                            @if($total_all_six > 100)
                              100%
                            @else
                              {{ $total_all_six."%" }}
                            @endif
                          </th>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-key" role="tabpanel" aria-labelledby="vert-tabs-key-tab">
                     key
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-office" role="tabpanel" aria-labelledby="vert-tabs-office-tab">
                    office
                </div>
              </div>
            </div>
            
          </div>
          <!-- /.card -->
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





