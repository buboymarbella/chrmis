<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="PIPS">
        <meta name="keyword" content="records of Interest Profiling System">
        <meta name="author" content="archie">
        <title>{{ config('app.name', 'Laravel') }}</title>
		<link type="image/x-icon" src="D:\xampp\htdocs\search\public\image\ceisd.png" rel="icon" />
		<style>
			html,body{margin:10px 10px 10px 10px;padding:0;}
			.container{width:100%;margin:0 0 0 0;padding:0 0 0 0;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;}
			table{border-collapse:collapse;width:100%;font-size:12px;}
			table td,th{border:1px solid black;padding:5px 0px 5px 0px;text-align:center;}
			 
		</style>

</head>
<body>
	<div style="width:100%;text-align:right;font-size:12px">
        <div tyle="width:100%;text-align:center;"> <h3>STAFFING PLAN REPORT</h3></div>
				<table id="example1" class="table table-head-fixed text-nowrap text-center">
          <thead>
          
					<tr>
						<th style="width:15%;">Plantilla #</th>
						<th style="width:15%;">Position Title</th>
						<th style="width:5%;">SG</th>
						<th style="width:5%;">Office/Unit</th>
						<th style="width:10%;">Staff Action</th>
						<th style="width:10%;">Sourcing Method</th>
						<th style="width:10%;">Start/End Date</th>
						<th style="width:10%;">Classification Level</th>
						<th style="width:10%;">Status</th>
					</tr>
                </thead>
                <tbody>
          @forelse ($plantilla as $key=>$master)
					<tr>
						<td>{{ $master->plantilla_number == "" ? 'N/A' : $master->plantilla_number }}</td>
						<td>{{ $master->title == null ? 'N/A' : $master->title }}</td>
						<td>{{ $master->sg == "" ? 'N/A' : $master->sg}} </td>
						<td>{{ $master->office == "" ? 'N/A' : $master->office}} </td>
						<td>@if($master->staff_action == "fill" || $master->staff_action == "FILL")
								Fill-up
							@elseif($master->staff_action == "transfer")
								Transfer
							@elseif($master->staff_action == "abolish")
								Abolish
							@elseif($master->staff_action == "retitle")
								Retitle
							@elseif($master->staff_action == "under_study")
								Under Study
							@else
								N/A
							@endif
						</td>
						<td>{{ $master->sourcing_method == null ? 'N/A' : $master->sourcing_method }}</td>
						<td>@if($master->start_date == '1970-01-01' || $master->end_date == '1970-01-01') 
								N/A
							@elseif($master->start_date == NULL || $master->end_date == NULL) 
								N/A
							@else
								{{date("d M Y", strtotime($master->start_date)) }} / {{date("d M Y", strtotime($master->end_date)) }}
							@endif
						</td>
						<td>@if($master->level_class == "2ND_TECH")
								2nd Level Technical
							@elseif($master->level_class == "2ND_SUPERVISORY")
								2nd Level Supervisory
							@elseif($master->level_class == "1ST")
								1ST LEVEL
							@else
								N/A
							@endif
						</td>
						<td>{{ $master->status == null ? 'N/A' : $master->status }}</td>
						
					</tr>
					@empty
						<tr>
							<td colspan="6"><strong>Sorry</strong> There are no data available.</td>
						</tr>
					@endforelse
                </tbody>
				</table>
      </div>
    </body>
    </html>	