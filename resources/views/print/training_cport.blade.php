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
			table td,th{border:0px solid black;padding:5px 0px 5px 0px;text-align:center;}
			 
		</style>

</head>
<body>
	<div style="width:100%;text-align:right;font-size:12px">
	
		<div style="width:100%;text-align:right;font-size:12px">
			<?php echo date("M d Y");?>
		</div>
		
		<div style="width:100%;text-align:left;padding:0px 0px 0px 0px;">
			<h3 style="padding:0px 0px 0px 0px;margin:0px 0px 0px 0px;border-bottom:1px solid black;">CPORT</h3>
		</div>
		
		<table style="padding:0px 0px 0px 0px;">
			<tr>
				<th height="20" style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:5%;">NR</th>
				<th height="20"  style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:25%;">NAME</th>
				<th height="20"  style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:25%;">POSITION TITLE</th>
				<th height="20"  style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:10%;">SG</th>
				<th height="20"  style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:10%;">OFFICE/UNIT</th>
				<th height="20"  style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:10%;">DATE OF APPT</th>
				<th height="20"  style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:15%;">TARGET BATCH FOR CPORT</th>
			</tr>
			@forelse ($training as $key=>$master)
			<tr>
				<td style="border:0px;text-align:center;font-family:normal;">{{ $key + 1 }}</td>
				<td style="border:0px;text-align:center;font-family:normal;">{{ $master->complete_name == "" ? 'N/A' : $master->complete_name }}</td>
				<td style="border:0px;text-align:center;font-family:normal;">{{ $master->position == "" ? 'N/A' : $master->position }}</td>
				<td style="border:0px;text-align:center;font-family:normal;">
					@if($master->salary_grade == "")
						N/A
					@elseif(strlen($master->salary_grade) <= 1)
						{!! "SG-0".$master->salary_grade !!}
					@else
						{{ "SG-".$master->salary_grade }}
					@endif
				
				</td>
				<td style="border:0px;text-align:center;font-family:normal;">{{ $master->office == "" ? 'N/A' : $master->office }}</td>
				<td style="border:0px;text-align:center;font-family:normal;">{{ $master->date_hired == null ? 'N/A' : date("m/d/Y", strtotime($master->date_hired)) }}</td>
				<td style="border:0px;text-align:center;font-family:normal;word-wrap: break-word;">N/A</td>
			</tr>
			@empty
			<tr>
				<td colspan="7"><strong>Sorry</strong> There are no data available.</td>
			</tr>
			@endforelse
		</table>
			
	</div>
</body>
</html>		
