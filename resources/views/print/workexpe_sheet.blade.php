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
	.main-div{margin: 0 auto;width:790px;padding: 5% 0;}
	
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
	
	.content{
		background:white;
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
	
	.c1{
		font-weight:bold;
		font-style:italic;
		padding-left:15px;
		font-size:12pt;font-family:"Arial","sans-serif";
		mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
	}
	
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
	.attachment_number{ padding:10% 0 3% 0;}
	.attachment_number1{ padding:6% 0 3% 0;}
	.signature { text-align:center;font-size:12pt;font-family:"Arial","sans-serif";}
</style>
</head>
<body>
<div class="main-div">
		@forelse($workexpe as $key=>$workexpe)
		<table width="" class="" style="border-collapse:collapse;width:100%;border:1px solid black;">
			<tbody>
				<tr>
					<td class="header">WORK EXPERIENCE SHEET</td>
				</tr>
				<tr>
					<td class="instruction">
						<table>
							<tr>
								<td class="c1">Instructions:</td>
								<td class="c2">1.</td>
								<td class="c3">
									Include only the work experiences relevant to the position being applied to.
								</td>
							</tr>
							
							<tr style="">
								<td class="c1"></td>
								<td class="c4">2.</td>
								<td class="c5">
									Theduration should include start and finish dates, if known, month in abbreviated form, 
									if known, and year in full. For the current position, use the word Present, e.g., 1998-Present. 
									Work experience should be listed from most recent first.  
								</td>
							</tr>
						</table>
					</td>
				</tr>
				
				<tr>
					<td class="content">
						<table style="border-collapse:collapse;width:100%;margin-top:2%;">
							<tr>
								<td class="d1">
									<ul>
										<li>Duration: 
											{{ $workexpe->inclusive_from == null ? 'N/A' : date("m/d/Y", strtotime($workexpe->inclusive_from)) }} - 
											@if($workexpe->inclusive_to == "" && $workexpe->inclusive_from == "1970-01-01")
												N/A
											@elseif($workexpe->inclusive_to == "" && $workexpe->inclusive_from == "1970-01-01" )
												N/A
											@elseif($workexpe->inclusive_to == null && $workexpe->inclusive_from != "1970-01-01" )
												PRESENT
											@elseif($workexpe->inclusive_to == "" && $workexpe->inclusive_from != "0000-00-00" )
												PRESENT
											@elseif($workexpe->inclusive_to != "" && $workexpe->inclusive_from != "1970-01-01")
												{{ date("m/d/Y", strtotime($workexpe->inclusive_to)) }}
											@elseif($workexpe->inclusive_to != "" && $workexpe->inclusive_from != "0000-00-00")
												{{ date("m/d/Y", strtotime($workexpe->inclusive_to)) }}
											@else
												{{ date("m/d/Y", strtotime($workexpe->inclusive_to)) }}
											@endif
										</li>
										<li>Position: {{ $workexpe->position_title == null ? 'N/A' : $workexpe->position_title }}</li>
										<li>Name of Office/Unit: {{ $workexpe->department == null ? 'N/A' : $workexpe->department }}</li>
										<li>Immediate Supervisor: {{ $workexpe->supervisor == null ? 'N/A' : $workexpe->supervisor }}</li>
										<li>Name of Agency/Organization and Location: {{ $workexpe->agency == null ? 'N/A' :$workexpe->agency }}</li>
									</ul>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				
				<tr>
					<td class="summary-content">
						<table style="border-collapse:collapse;width:100%;padding-top:10px;">
							<tr>
								<td class="d1">
									<ul style="margin:0 0;">
										<li>Summary of Actual Duties:</li>
									</ul>
								</td>
							</tr>
							
							<tr>
								<td class="d2" style="">
									<ul style="margin:0 0;">
										<li style="list-style-type: circle;">{{ $workexpe->duties == null ? 'N/A' : $workexpe->duties }}</li>
									</ul>
								</td>
							</tr>
							
						</table>
					</td>
				</tr>
				
				<tr>
					<td class="attachment_number">
						<table style="border-collapse:collapse;width:100%;">
							<tr>
								<td class="a1">
									Attachment to CS Form No. 212
								</td>
							</tr>
							
							
							
						</table>
					</td>
				</tr>
				
				
			</tbody>
		</table>
		
		<table style="border-collapse:collapse;width:100%;margin:0 0 0 0;">
			<tr>
					<td class="attachment_number1">
						<table style="border-collapse:collapse;width:100%;">
							<tr>
								<td width="85%">
									
								</td>
								<td class="signature">
									________________________________ <br/>
									(Signature over Printed Name
									of Employee/Applicant)<br/><br/>
									Date:_____________________
									
								</td>
							</tr>
						</table>
					</td>
				</tr>
			
		</table>
									
		<div style='page-break-after: always;'> </div>
		@empty
		<table style="border-collapse:collapse;width:100%;margin:0 0 0 0;">
			<tr>
				<td style="text-align:center"><strong>Sorry</strong> There are no data available.</td>
			</tr>
		</table>
		@endforelse
	
</div>
</body>
</html>













