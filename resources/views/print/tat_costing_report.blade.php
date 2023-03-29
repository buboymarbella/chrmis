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
			<h1 style="margin:0 0;padding:1px 1px;">TAT COSTING REPORT</h1>
	      	<table class="example1">
                <thead>
                  
				  <thead>
				  	<tr>
						<th style="width:5%;">Plantilla #</th>
						<th style="width:5%">Position</th>
						<th style="width:5%;">Office/SG</th>
						<th style="width:5%;">Pub Vacancy Duration</th>
						<th style="width:5%;">Local Delib Duration</th>
						<th style="width:5%;">GHQ Delib Duration</th>
						<th style="width:5%;">Assessment Test Duration</th>
						<th style="width:5%;">Board Resolution Duration</th>
						<th style="width:5%;">Directives Duration</th>
						<th style="width:5%;">Requirements Duration</th>
						<th style="width:5%;">Appointment Duration</th>
						<th style="width:5%;">Sub of RAI Duration</th>
						<th style="width:3%;">Total Cost</th>
						<th style="width:5%;">Duration</th>
						<th style="width:5%;">Status</th>
					</tr>
                  </thead>
                  <tbody>
					@forelse ($masters as $key=>$master)
					<tr>
						<td>{{ $master->plantilla_number == "" ? 'N/A' : $master->plantilla_number }}</td>
						<td>{{ $master->position == null ? 'N/A' : $master->position }}</td>
						<td>{{ $master->office == "" ? 'N/A' : $master->office}} / 
							@if($master->salary_grade == "")
								N/A
							@elseif(strlen($master->salary_grade) <= 1)
								{!! "SG-0".$master->salary_grade !!}
							@else
								{{ "SG-".$master->salary_grade }}
							@endif
						
						</td>
						<td>@if($master->publication_date == '1970-01-01' || $master->publication_date == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->publication_date == NULL || $master->publication_date == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->publication_date)) }}
							@endif
							/
							@if($master->publication_date_e == '1970-01-01' || $master->publication_date_e == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->publication_date_e == NULL || $master->publication_date_e == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->publication_date_e)) }}
							@endif
						</td>
						<td>@if($master->local_delib_date == '1970-01-01' || $master->local_delib_date == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->local_delib_date == NULL || $master->local_delib_date == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->publication_date)) }}
							@endif
							/
							@if($master->local_delib_date_e == '1970-01-01' || $master->local_delib_date_e == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->local_delib_date_e == NULL || $master->local_delib_date_e == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->local_delib_date_e)) }}
							@endif
						</td>
						<td>@if($master->ghq_delib_date	 == '1970-01-01' || $master->ghq_delib_date	 == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->ghq_delib_date	 == NULL || $master->ghq_delib_date	 == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->ghq_delib_date	)) }}
							@endif
							/
							@if($master->ghq_delib_date_e == '1970-01-01' || $master->ghq_delib_date_e == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->ghq_delib_date_e == NULL || $master->ghq_delib_date_e == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->ghq_delib_date_e)) }}
							@endif
						</td>
						<td>@if($master->assestment_date == '1970-01-01' || $master->assestment_date == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->assestment_date == NULL || $master->assestment_date == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->assestment_date)) }}
							@endif
							/
							@if($master->assestment_date_e == '1970-01-01' || $master->assestment_date_e == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->assestment_date_e == NULL || $master->assestment_date_e == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->assestment_date_e)) }}
							@endif
						</td>
						<td>@if($master->resolution_date == '1970-01-01' || $master->resolution_date == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->resolution_date == NULL || $master->resolution_date == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->resolution_date)) }}
							@endif
							/
							@if($master->resolution_date_e == '1970-01-01' || $master->resolution_date_e == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->resolution_date_e == NULL || $master->resolution_date_e == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->resolution_date_e)) }}
							@endif
						</td>
						<td>@if($master->directive_date == '1970-01-01' || $master->directive_date == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->directive_date == NULL || $master->directive_date == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->directive_date)) }}
							@endif
							/
							@if($master->directive_date_e == '1970-01-01' || $master->directive_date_e == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->directive_date_e == NULL || $master->directive_date_e == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->directive_date_e)) }}
							@endif
						</td>
						<td>@if($master->requirement_date == '1970-01-01' || $master->requirement_date == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->requirement_date == NULL || $master->requirement_date == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->requirement_date)) }}
							@endif
							/
							@if($master->requirement_date_e == '1970-01-01' || $master->requirement_date_e == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->publication_date_e == NULL || $master->requirement_date_e == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->requirement_date_e)) }}
							@endif
						</td>
						<td>@if($master->appointment_date == '1970-01-01' || $master->appointment_date == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->appointment_date == NULL || $master->appointment_date == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->appointment_date)) }}
							@endif
							/
							@if($master->appointment_date_e == '1970-01-01' || $master->appointment_date_e == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->appointment_date_e == NULL || $master->appointment_date_e == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->appointment_date_e)) }}
							@endif
						</td>
						<td>
							@if($master->rai_date == '1970-01-01' || $master->rai_date == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->rai_date == NULL || $master->rai_date == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->rai_date)) }}
							@endif
							/
							@if($master->rai_date_e == '1970-01-01' || $master->rai_date_e == '1970-01-01') 
								<span class="text-warning">N/A</span>
							@elseif($master->rai_date_e == NULL || $master->rai_date_e == NULL) 
								<span class="text-warning">N/A</span>
							@else
								{{date("d M Y", strtotime($master->rai_date_e)) }}
							@endif
						</td>
						<td>Php {{ $master->summary_cost == null ? '0' : number_format($master->summary_cost,2) }}</td>
						<td>
							@if($master->status == "PENDING")
								<span class="text-warning">{{ $master->status }}</span>
							@elseif($master->status == "")
								<span class="text-warning">PENDING</span>
							@else
								<span class="text-primary">{{ $master->summary_date == null ? '0' : $master->summary_date ." day/s" }}</span>
							@endif
						</td>
						<td>@if($master->status == "PENDING")
								<span class="text-danger">{{ $master->status }}</span>
							@elseif($master->status == "")
								<span class="text-danger">PENDING</span>
							@else
								<span class="text-primary">{{ $master->status }}</span>
							@endif
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="9"><strong>Sorry</strong> There are no data available.</td>
					</tr>
					@endforelse
                        </tbody>
                </table>
	</div>
</div>
</body>
</html>