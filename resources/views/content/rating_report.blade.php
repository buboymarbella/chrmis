@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
	  <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>PERFORMANCE RATING REPORT</h1>
          </div>
          <div class="col-sm-6">
            <div style="float:right"> <a href="{{ route('performance_rating') }}"><button type="button" class="btn btn-warning btn-sm text-light">BACK PERFORMANCE RATING</button></a></div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">

			<!-- LINE CHART -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  	<table style="width:100%">
					  	<tr>
							<td colspan="2" style="text-align:center">Total Plantillas</td>
						</tr>
						<tr>
							<td style="width:60%;padding-left:2px;">{{$office1}}</td> 
							<td style="text-align:center">{{$count_all}}</td>
						</tr>
						<tr>
							<td style="padding-left:2px;">Filled</td>
							<td style="text-align:center">{{ $count_filled }}</td>
						</tr>
						<tr>
							<td style="padding-left:2px;">Vacant</td>
							<td style="text-align:center">{{ $count_vacant }}</td>
						</tr>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:40%;padding-left:2px;">Outstanding</td>
							<td style="text-align:center">{{ $count_outstanding }}</td>
						</tr>
						<tr>
							<td style="padding-left:2px;">Very Satisfactory</td>
							<td style="text-align:center"> {{ $count_vsatisfactory }}</td>
						</tr>
						<tr>
							<td style="padding-left:2px;">Satisfactory</td>
							<td style="text-align:center">{{ $count_satisfactory }} </td>
						</tr>
						<tr>
							<td style="padding-left:2px;">Unsatisfatory</td>
							<td style="text-align:center">{{ $count_unsatisfactory }}</td>
						</tr>
						<tr>
							<td style="padding-left:2px;">Poor</td>
							<td style="text-align:center">{{ $count_poor }}</td>
						</tr>
						<tr>
							<td style="padding-left:2px;">Civ HR with Outstanding and Very Satisfactory Rating shall be prioritized for promotion and/or conferment of incentives.</td>
							<td style="text-align:center">
							<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-xl2">
								View List
							</button>
							</td>
						</tr>
						<tr>
							<td style="padding-left:2px;">Civ HR with Satisfactory Rating shall undergo coaching.</td>
							<td style="text-align:center">
							<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-xl">
							View List
                			</button>
							</td>
						</tr>
						<tr>
							<td style="padding-left:2px;">Civ HR with Poor and Unsatisfactory Rating shall be prioritized for learning and development interventions and coaching/counselling.</td>
							<td style="text-align:center">
							<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-xl1">
								View List
                			</button>
							</td>
						</tr>
					</table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-8">
            
		   <!-- PIE CHART -->
		   <div class="card">
              <div class="card-header">
                <h3 class="card-title">Performance Rating Percentage Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- BAR CHART -->
           
			<canvas id="barChart"style="visibility: hidden;" ></canvas>
			<canvas id="stackedBarChart" style="visibility: hidden;"></canvas>
			<canvas id="donutChart" style="visibility: hidden;"></canvas>
			<canvas id="lineChart" style="visibility: hidden;"></canvas>
			<canvas id="areaChart" style="visibility: hidden;"></canvas>
                
          </div>
          <!-- /.col (RIGHT) -->
		 
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  	<div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Outstanding and Very Satisfactory Rating</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> &nbsp;Close</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
      <!-- /.modal -->

	<div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Satisfactory Rating</h3>

                <!-- <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
				 	<tr>
				  		<th width="30%">Name</th>
						<th width="30%">Position Title</th>
						<th width="20%">SG</th>
						<th width="20%">Office/Unit</th>
						<th width="10%">Rating</th>
                    </tr>
                  </thead>
                  <tbody>
				  	@forelse ($get_satifactory as $key=>$ov)
                    <tr>
                      <td>{{$ov->complete_name}}</td>
                      <td>{{$ov->position}}</td>
                      <td>{{$ov->salary_grade}}</td>
                      <td>{{$ov->office}}</td>
                      <td>{{$ov->n_rating}}</td>
                    </tr>
					@empty
						<tr>
							<td colspan="5" style="text-align:center"><strong>Sorry</strong> There are no data available.</td>
						</tr>
					@endforelse
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i> &nbsp;Close</button>
              <form action="/download_result_satisfactory" method="POST" enctype="multipart/form-data" target="_blank">
              @csrf
                <button type="submit" class="btn btn-tool ">
                  
                    <i class="fa fa-download"></i> &nbsp;Download Excel
                </button>

                <button type="submit" class="btn btn-tool ">
                  
                    <i class="fa fa-download"></i> &nbsp;Download PDF
                </button>
                <input type="text" name="satisfactory" value="satisfactory" hidden>
                <input type="text" name="office" value="{{ $office }}" hidden>
                <input type="text" name="startDate" value="{{ $startDate }}" hidden>
                <input type="text" name="endDate" value="{{ $endDate }}" hidden>
              </form>
              <!-- <button type="button" class="btn btn-primary"></button> -->
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

	<div class="modal fade" id="modal-xl1">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Poor and Unsatisfatory Rating</h3>

                <!-- <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
				  	<tr>
				  		<th width="30%">Name</th>
						<th width="30%">Position Title</th>
						<th width="20%">SG</th>
						<th width="20%">Office/Unit</th>
						<th width="10%">Rating</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
					@forelse ($get_unsatisfactory_poor as $key=>$ov)
                    <tr>
                      <td>{{$ov->complete_name}}</td>
                      <td>{{$ov->position}}</td>
                      <td>{{$ov->salary_grade}}</td>
                      <td>{{$ov->office}}</td>
                      <td>{{$ov->n_rating}}</td>
                    </tr>
					@empty
						<tr>
							<td colspan="5" style="text-align:center"><strong>Sorry</strong> There are no data available.</td>
						</tr>
					@endforelse
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> &nbsp;Close</button>
              <form action="{{ route('download_result_poor') }}" method="POST" enctype="multipart/form-data" target="_blank">
                <button type="submit" class="btn btn-tool ">
                  @csrf
                    <i class="fa fa-download"></i> &nbsp;Download Excel
                </button>
                <button type="submit" class="btn btn-tool ">
                  
                  <i class="fa fa-download"></i> &nbsp;Download PDF
              </button>
                <input type="text" name="poor" value="poor" hidden>
                <input type="text" name="office" value="{{ $office }}" hidden>
                <input type="text" name="startDate" value="{{ $startDate }}" hidden>
                <input type="text" name="endDate" value="{{ $endDate }}" hidden>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

	<div class="modal fade" id="modal-xl2">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Outstanding and Very Satisfactory Rating</h3>

                <!-- <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
				  <tr>
                      <th width="30%">Name</th>
                      <th width="30%">Position Title</th>
                      <th width="20%">SG</th>
                      <th width="20%">Office/Unit</th>
					  <th width="10%">Rating</th>
                    </tr>
                  </thead>
                  <tbody>
				 	@forelse ($get_outstanding_vsatisfactory as $key=>$ov)
                    <tr>
                      <td>{{$ov->complete_name}}</td>
                      <td>{{$ov->position}}</td>
                      <td>{{$ov->salary_grade}}</td>
                      <td>{{$ov->office}}</td>
                      <td>{{$ov->n_rating}}</td>
                    </tr>
					@empty
						<tr>
							<td colspan="5" style="text-align:center"><strong>Sorry</strong> There are no data available.</td>
						</tr>
					@endforelse
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> &nbsp;Close</button>
              <form action="{{ route('download_result_outstanding') }}" method="POST" enctype="multipart/form-data" target="_blank">
              <button type="submit" class="btn btn-tool ">
                @csrf
                
                  <i class="fa fa-download"></i> &nbsp;Download Excel
              </button>
              <button type="submit" class="btn btn-tool ">
                  
                  <i class="fa fa-download"></i> &nbsp;Download PDF
              </button>
              <input type="text" name="outstanding" value="outstanding" hidden>
              <input type="text" name="office" value="{{ $office }}" hidden>
              <input type="text" name="startDate" value="{{ $startDate }}" hidden>
              <input type="text" name="endDate" value="{{ $endDate }}" hidden>
            </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

@push('js')
<script src="{{ asset('admin-lte/plugins/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('admin-lte/plugins/flot/jquery.flot.js') }}"></script>

  <script src="{{ asset('admin-lte/plugins/flot/plugins/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('admin-lte/plugins/flot/plugins/jquery.flot.pie.js') }}"></script>
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    // new Chart(areaChartCanvas, {
    //   type: 'line',
    //   data: areaChartData,
    //   options: areaChartOptions
    // })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    // var lineChart = new Chart(lineChartCanvas, {
    //   type: 'line',
    //   data: lineChartData,
    //   options: lineChartOptions
    // })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Outstanding',
          'Very Satisfactory',
          'Satisfactory',
          'Unsatisfatory',
          'Poor',
      ],
      datasets: [
        {
          data: [{{ $count_outstanding_percent }},{{ $count_vsatisfactory_percent }},{{ $count_satisfactory_percent }},{{ $count_unsatisfactory_percent}},{{ $count_poor_percent }}],
          backgroundColor : ['#000080', '#87CEEB', '#808080', '#FFA500', '#FF4500'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    // new Chart(donutChartCanvas, {
    //   type: 'doughnut',
    //   data: donutData,
    //   options: donutOptions
    // })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    // new Chart(barChartCanvas, {
    //   type: 'bar',
    //   data: barChartData,
    //   options: barChartOptions
    // })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    // new Chart(stackedBarChartCanvas, {
    //   type: 'bar',
    //   data: stackedBarChartData,
    //   options: stackedBarChartOptions
    // })
  })
</script>
@endpush



