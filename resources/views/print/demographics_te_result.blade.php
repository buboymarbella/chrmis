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
	.main-div{margin: 0 auto;width:790px;padding: 1% 0; content: "";display: table;clear: both;}
	
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
	.example1 {border-collapse:collapse;border 1px solid black}
  	.example1 td,th{border:1px solid black;padding:2px 2px 2px 2px; text-align:center;}
	.attachment_number{ padding:10% 0 3% 0;}
</style>
</head>
<body onload="setTimeout(function(){window.print()},2000)">
<div class="main-div">
	<div style="width:100%;text-align:center"><h1>ELIGIBILITIES</h1></div>
	<div style="float: left;width: 60%;">
          {!! $demographics_eligibility->container() !!}
	</div>
	<div style="float: right;width: 30%;" onload="display()">
	<table class="example1">
  <tr>
						<th>Total Number of Civ HR</th>
						<td>{{ $master_count }}</td>
					</tr>
					<tr>
						<th>Career Service Professional </th>
						<td>{{$eligibility_csp}}</td>
					</tr>
					
					<tr>
						<th>RA1080 Bar</th>
						<td>{{$eligibility_cssp}}</td>
					</tr>

          <tr>
						<th>RA1080 Board</th>
						<td>{{$eligibility_board}}</td>
					</tr>

          <tr>
						<th>RA7883-Barangay Health Worker Eligibility</th>
						<td>{{$eligibility_barangay_nutrition}}</td>
					</tr>

          <tr>
						<th>PD1569-Barangay Nutrition Scholar Eligibility</th>
						<td>{{$eligibility_barangay_nutrition}}</td>
					</tr>

          <tr>
						<th>RA7160-Barangay Official Eligibility</th>
						<td>{{$eligibility_barangay_official}}</td>
					</tr>

          <tr>
						<th>CSC Res.1302714-Foreign School Honor Graduate Eligibility</th>
						<td>{{$eligibility_fhonor_grad}}</td>
					</tr>

          <tr>
						<th>PD907-Honor Graduate Eligibility</th>
						<td>{{$eligibility_honor_grad}}</td>
					</tr>

          <tr>
						<th>RA10156-Sanggunian Member Eligibility</th>
						<td>{{$eligibility_sanggunian}}</td>
					</tr>

          <tr>
						<th>PD997-Scientific and Technological Specialist Eligibility</th>
						<td>{{$eligibility_scientific}}</td>
					</tr>

          <tr>
						<th>CSC MC11,s.1996, as Amended-Skills Eligibility</th>
						<td>{{$eligibility_skills}}</td>
					</tr>
          
          <tr>
						<th>EO 132/790-Veteran Preference Rating</th>
						<td>{{$eligibility_veteran}}</td>
					</tr>

          <tr>
						<th>CSC Res.90-083-Electronic Data Processing Specialist Eligibility</th>
						<td>{{$eligibility_veteran}}</td>
					</tr>

          <tr>
						<th>OTHERS</th>
						<td>{{$eligibility_edp}}</td>
					</tr>

				</table>
	</div>
</div>
<script src="{{ LarapexChart::cdn() }}"></script>
@if(empty($demographics_eligibility))
	<p></p>
@else
	{{ $demographics_eligibility->script()}}
@endif
</body>
</html>