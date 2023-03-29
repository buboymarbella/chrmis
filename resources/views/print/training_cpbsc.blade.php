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
			<h3 style="padding:0px 0px 0px 0px;margin:0px 0px 0px 0px;border-bottom:1px solid black;">CPBSC</h3>
		</div>
		
		<table style="padding:0px 0px 0px 0px;">
			<tr>
				<th height="20" style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:30px;">NR</th>
				<th height="20"  style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:150px;">NAME</th>
				<th height="20"  style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:100px;">POSITION TITLE</th>
				<th height="20"  style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:50px;">SG</th>
				<th height="20"  style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:100px;">OFFICE/UNIT</th>
				<th height="20"  style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:100px;">DATE CPBC</th>
				<th height="20"  style="border-left:0px;border-rigth:0px; border-top:1px solid black; border-bottom:1px solid black;width:80px;">NUM RATING FOR THE  SEM</th>
			</tr>
			@forelse ($masters as $key=>$master)
			<tr>
				<td style="border:0px;text-align:center;font-family:normal;">{{ $key + 1 }}</td>
				<td style="border:0px;text-align:center;font-family:normal;"><a href="{{ route('masters.show', $master->main_id) }}">{{ $master->complete_name == "" ? 'N/A' : $master->complete_name}}</a></td>
				<td style="border:0px;text-align:center;font-family:normal;">{{ $master->position == null ? 'N/A' : $master->position }}</td>
				<td style="border:0px;text-align:center;font-family:normal;">
							@if($master->salary_grade == "")
								N/A
							@elseif(strlen($master->salary_grade) <= 1)
								{!! "SG-0".$master->salary_grade !!}
							@else
								{{ "SG-".$master->salary_grade }}
							@endif
				</td>
				<td style="border:0px;text-align:center;font-family:normal;">{{ $master->office == "" ? 'N/A' : $master->office}}</td>
				<td style="border:0px;text-align:center;font-family:normal;word-wrap: break-word;">{{ $master->inclusive_to == null ? 'N/A' : date("m/d/Y", strtotime($master->inclusive_to)) }}</td>
				<td style="border:0px;text-align:center;font-family:normal;word-wrap: break-word;">{{ $master->n_rating == null ? 'N/A' :  $master->n_rating }}</td>
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
