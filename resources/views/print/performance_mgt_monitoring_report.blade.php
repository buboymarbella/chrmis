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
			table th{border:1px solid black;height:320px;vertical-align: middle;}
			table td{border:1px solid black;height:20px;text-align: center;}
		</style>

</head>
<body>
	<div style="width:100%;text-align:right;font-size:12px">
	
		
		<table style="width:100%;padding:0px 0px 0px 0px;">
			<tr>
				<td colspan="15">
					
					<div style="width:100%;text-align:right;font-size:12px">
						<?php echo date("M d Y");?>
					</div>
					
					<div style="width:100%;text-align:left;padding:0px 0px 0px 0px;">
						<h3 style="padding:0px 0px 0px 0px;margin:0px 0px 0px 0px;">PERFORMANCE MANAGEMENT MONITORING REPORT</h3>
					</div>
				</td>
			</tr>
			<tr>
				<th rowspan="2" style="width:20px;"><p style="transform: rotate(270deg);">NR</th>
				<th rowspan="2" style="width:100px;"><p style="transform: rotate(270deg);">NAME</th>
				<th rowspan="2" style="width:80px;"><p style="transform: rotate(270deg);">POSITION TITLE</th>
				<th rowspan="2" style="width:80px;"><p style="transform: rotate(270deg);">OFFICE/UNIT</th>
				<th rowspan="2" style="width:50px;"><p style="transform: rotate(270deg);">SG</th>
				<th rowspan="2" style="width:100px;"><p style="transform: rotate(270deg);">NAME OF IMMEDIATE SUPERVISOR</th>
				<th colspan="2" style="width:100px;"><p style="transform: rotate(270deg);">PREPARATION OF IPCR</th>
				<th colspan="2" style="width:100px;"><p style="transform: rotate(270deg);">PERFORMANCE MONITORING AND COACHING</th>
				<th colspan="2" style="width:100px;"><p style="transform: rotate(270deg);">DISCUSSION OF INTERVENING ACTIVITIES</th>
				<th colspan="2" style="width:100px;"><p style="transform: rotate(270deg);">GRADING OF IPCR</th>
				<th rowspan="2" style="width:100px;"><p style="transform: rotate(270deg);">Remarks</th>
			</tr>
			<tr>
				<th style="width:50px;"><p style="transform: rotate(270deg);">Date of concurrence by Civ HR</th>
				<th style="width:50px;"><p style="transform: rotate(270deg);">Date of concurrence by Immediate Supervisor</th>
				<th style="width:50px;"><p style="transform: rotate(270deg);">Date of concurrence by Civ HR</th>
				<th style="width:50px;"><p style="transform: rotate(270deg);">Date of concurrence by Immediate Supervisor</th>
				<th style="width:50px;"><p style="transform: rotate(270deg);">Date of concurrence by Civ HR</th>
				<th style="width:50px;"><p style="transform: rotate(270deg);">Date of concurrence by Immediate Supervisor</th>
				
				<th style="width:50px;"><p style="transform: rotate(270deg);">Date of concurrence by Civ HR</th>
				<th style="width:50px;"><p style="transform: rotate(270deg);">Date of concurrence by Immediate Supervisor</th>
			</tr>
			@forelse ($performance as $key=>$master)
			<tr>
				<td>{{ $key +1 }}</td>
				<td>{{$master->complete_name}}</td>
				<td>{{$master->position}}</td>
				<td>{{$master->office}}</td>
				<td>{{$master->salary_grade}}</td>
				<td>{{$master->supervisor}}</td>
				@if($master->ipcr_prep_chr == '1970-01-01')
				<td style="background-color:red"></td>
				@else
				<td>{{ $master->ipcr_prep_chr == '1970-01-01' ? 'N/A' : date("m/d/Y", strtotime($master->ipcr_prep_chr)) }}</td>
				@endif

				@if($master->ipcr_prep_supervisor == '1970-01-01')
				<td style="background-color:red"></td>
				@else
				<td>{{ $master->ipcr_prep_supervisor == '1970-01-01' ? 'N/A' : date("m/d/Y", strtotime($master->ipcr_prep_supervisor)) }}</td>
				@endif

				@if($master->coaching_chr == '1970-01-01')
				<td style="background-color:red"></td>
				@else
				<td>{{ $master->coaching_chr == '1970-01-01' ? 'N/A' : date("m/d/Y", strtotime($master->coaching_chr)) }}</td>
				@endif

				@if($master->coaching_supervisor == '1970-01-01')
				<td style="background-color:red"></td>
				@else
				<td>{{ $master->coaching_supervisor == '1970-01-01' ? 'N/A' : date("m/d/Y", strtotime($master->coaching_supervisor)) }}</td>
				@endif

				@if($master->activities_chr == '1970-01-01')
				<td style="background-color:red"></td>
				@else
				<td>{{ $master->activities_chr == '1970-01-01' ? 'N/A' : date("m/d/Y", strtotime($master->activities_chr)) }}</td>
				@endif

				@if($master->activities_supervisor == '1970-01-01')
				<td style="background-color:red"></td>
				@else
				<td>{{ $master->activities_supervisor == '1970-01-01' ? 'N/A' : date("m/d/Y", strtotime($master->activities_supervisor)) }}</td>
				@endif

				@if($master->grading_chr == '1970-01-01')
				<td style="background-color:red"></td>
				@else
				<td>{{ $master->grading_chr == '1970-01-01' ? 'N/A' : date("m/d/Y", strtotime($master->grading_chr)) }}</td>
				@endif

				@if($master->grading_supervisor == '1970-01-01')
				<td style="background-color:red"></td>
				@else
				<td>{{ $master->grading_supervisor == '1970-01-01' ? 'N/A' : date("m/d/Y", strtotime($master->grading_supervisor)) }}</td>
				@endif

				<td>{{$master->remarks}}</td>
			</tr>
			@empty
				<tr>
					<td colspan="15"><strong>Sorry</strong> There are no data available.</td>
				</tr>
			@endforelse
			
		</table>
			
	</div>
</body>
</html>		
