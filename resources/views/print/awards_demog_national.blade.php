<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="PIPS">
        <meta name="keyword" content="records of Interest Profiling System">
        <meta name="author" content="archie">
	<title>CHRMIS</title>
<style>
	@page { margin: 0; }
	body{margin:5px 5px 5px 5px;}
	.main-div{margin: 0 auto;width:100%;padding: 1% 0; content: "";display: table;clear: both;}
	
	.header{
		border-bottom:1px solid black;
		border:solid windowtext 1.0pt;
		mso-border-alt:solid windowtext .5pt;
		mso-border-bottom-alt:solid windowtext 1.0pt;
		background:#969696;padding:0in 5.4pt 0in 5.4pt;height:26.0pt;
		text-align:center;
		color:white;
		font-weight:bold;
		font-size:14pt;font-family:"Arial Narrow","sans-serif";
		mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
		font-style:italic;
	}
	
	.instruction{
		background:#EAEAEA;
		border-bottom:1px solid black;
	}
	
	.summary-content{
		background:white;
	}
	
	.a1{
		font-weight:bold;
		font-style:italic;
		padding-left:15px;
		font-size:11pt;font-family:"Arial","sans-serif";
		mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
	}
	
	.content{
		font-size:12pt;font-family:"Arial","sans-serif";
		mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
		width:100%;text-align:center;
		background:white;
		border-collapse:collapse;
	}
	
	.content td{ height:28px;}
	
	.c2{
		font-weight:bold;
		font-style:italic;
		padding-left:15px;
		width:5%;
		font-size:12pt;font-family:"Arial","sans-serif";
		mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
	}
	
	.c3{
		font-style:italic;
		padding-left:2px;
		font-size:12pt;
		font-family:"Arial","sans-serif";
		width:80%;
	}
	
	.c4{
		font-style:italic;
		vertical-align: text-top;
		padding-left:15px;
		padding-top:15px;
		font-size:12pt;font-family:"Arial","sans-serif";
		mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
	}
	
	.c5{
		font-style:italic;
		padding-left:2px;
		font-size:12pt;
		white-space: normal;
		padding-top:12px;
		font-family:"Arial","sans-serif";
	}
	.d1 li {
			margin-bottom: 5px;
		}
	.d1{
		padding-left:5%;
		font-family:"Arial","sans-serif";
		font-size:12pt;
	}
	.d2{padding:10px 0 0px 10%;font-family:"Arial","sans-serif";
		font-size:12pt;text-align:justify;padding-right:15px;}
	.d2 ul:nth-of-type(2) {
		list-style-type: circle;
	}
	.example1 {width: 100%; border-collapse:collapse;border 1px solid black}
  	.example1 td,th{border:1px solid black;padding:2px 2px 2px 2px; text-align:center;}
	.attachment_number{ padding:10% 0 3% 0;}
</style>
</head>
<body>
<div class="main-div">
	
	<div style="float: right;width: 100%;text-align:center">
			<h1 style="margin:0 0;padding:1px 1px;">NATIONAL AWARDS YEAR "{{  $date_commendation }}"</h1>
	      	<table class="example1">
                <thead>
				  <thead>
				  	<tr>
						<th style="width:30%;">Name</th>
						<th style="width:15%;">Position Title</th>
						<th style="width:5%;">SG</th>
						<th style="width:5%;">Office/Unit</th>
						<th style="width:5%;">Sex</th>
						<th style="width:30%;">Title of Award/Incentive</th>
						<th style="width:10%;">Date of Conferment of Award/Incentive</th>
					</tr>
                  </thead>
                  <tbody>
				  @forelse ($national_awards as $master)	
					<tr>
						<td>{{ $master->complete_name == "" ? 'N/A' : $master->complete_name }}</td>
						<td>{{ $master->position == null ? 'N/A' : $master->position }}</td>
						<td>{{ $master->salary_grade == "" ? 'N/A' : $master->salary_grade}} </td>
						<td>{{ $master->office == "" ? 'N/A' : $master->office}} </td>
						<td>{{ $master->gender == null ? 'N/A' : $master->gender }}</td>
						<td>{{ $master->commendation == null ? 'N/A' : $master->commendation }}</td>
						<td>
							@if($master->commendation_date == '1970-01-01' || $master->commendation_date == '1970-01-01') 
								N/A
							@elseif($master->commendation_date == NULL || $master->commendation_date == NULL) 
								N/A
							@else
								{{date("d M Y", strtotime($master->commendation_date)) }}
							@endif
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="7"><strong>Sorry</strong> There are no data available.</td>
					</tr>
					@endforelse
                        </tbody>
                </table>
	</div>
</div>
</body>
</html>