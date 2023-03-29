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
			<h3 style="padding:0px 0px 0px 0px;margin:0px 0px 0px 0px;border-bottom:1px solid black;">CHRMIS</h3>
		</div>
		
		<table style="padding:0px 0px 0px 0px;">
			<tr>
				<th height="20" style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:5%;">#</th>
				<th height="20" style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:30%;">Name</th>
				<th height="20"  style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:20%;">Position</th>
				<th height="20"  style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:10%;">SG</th>
				<th height="20"  style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:10%;">Office</th>
				<th height="20"  style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:5%;">Blood Type</th>
			</tr>
			@forelse($masters as $key=>$record)
			<tr>
				<td>{{ $key + 1 }}</td>
				<td style="border:0px;text-align:center;font-family:normal;">{{ $record->complete_name == null ? 'N/A' : $record->complete_name }}</td>
				<td style="border:0px;text-align:center;font-family:normal;">{{ $record->position == null ? 'N/A' : $record->position }}</td>
				<td style="border:0px;text-align:center;font-family:normal;">
							@if($record->salary_grade == "")
								N/A
							@elseif(strlen($record->salary_grade) <= 1)
								{!! "SG-0".$record->salary_grade !!}
							@else
								{{ "SG-".$record->salary_grade }}
							@endif
				</td>
				<td style="border:0px;text-align:center;font-family:normal;">{{ $record->office == null ? 'N/A' : $record->office }}</td>
				<td style="border:0px;text-align:center;font-family:normal;">{{ $record->blood_type == null ? 'N/A' : $record->blood_type }}</td>
			</tr>
			@empty
				<td colspan="4" height="15" width="" style="padding-left:3px;text-align:center;"><strong>Sorry</strong> There are no data available.</td>
			@endforelse
		</table>
			
	</div>
</body>
</html>		
