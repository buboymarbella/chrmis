@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->
          <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">NO. PERMANENT CHR</span>
              <span class="info-box-number">{{ $count_chr }}<small></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">NO. CASUAL CHR</span>
              <span class="info-box-number">{{ $count_casual }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">NO. JOB ORDER CHR</span>
              <span class="info-box-number">{{ $count_job_order }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">NO. TEMPORARY CHR</span>
              <span class="info-box-number">{{ $count_temporary }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">CHR RECORDS</h5>

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
                <div class="row">
                  <div class="col-md-6">
                    <p class="text-center">
                      <strong></strong>
                    </p>

                    <div class="chart">
                      <!-- /.card-header -->
						 <div class="card-body p-0">
              {!! $barchart_bt->container() !!}
							
							<!-- /.table-responsive -->
						 </div>
						  <!-- /.card-body -->
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                 <div class="col-md-6">
                  {!! $piechart_age->container()!!}
                  {{-- <p class="text-center">
                    <strong>Age Bracket</strong>
                  </p>
				
                  <div class="progress-group">
                    <span class="progress-text"></span>
                    <a href="#">
						<span class="progress-number"><b>50 to 65<b></span> = {{ sizeof($first) }}
					</a>
					
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text"></span>
					<a href="#">
						<span class="progress-number"><b>40 to 49</b></span> = {{ sizeof($second) }}
					</a>
					
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text"></span>
					<a href="#">
						<span class="progress-number"><b>30 to 39</span> = {{ sizeof($third) }}
					</a>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text"></span>
					<a href="#">
						<span class="progress-number"><b>18 to 29 </b></span> = {{ sizeof($fourt) }}
					</a>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                    </div>
                  </div> --}}
                  <!-- /.progress-group -->
				
                </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

              </div>
			  <div class="box-footer">
              <div class="row">
                <div class="col-sm-6 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"></span>
                    <h5 class="description-header"><a href="#">{{ $count_female }}</a></h5>
                    <span class="description-text">Total Number of Female</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"></span>
                    <h5 class="description-header"><a href="#">{{ $count_male }}</a></h5>
                    <span class="description-text">Total Number of Male</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
               
              </div>
              <!-- /.row -->
            </div>
              <!-- ./card-body -->
              
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
         
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection