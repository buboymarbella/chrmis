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
	.main-div{margin: 0 auto;width:790px;padding: 1% 0;}
	
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
	.attachment_number{ padding:10% 0 3% 0;}
</style>
</head>
<body>
<div class="main-div">
		
		<table class="" style="border-collapse:collapse;width:100%;border:1px solid black;">
			<tbody>
				<tr>
					<td class="header">COMMENDATION SHEET</td>
				</tr>
				<tr>
					<td>
						<table class="content">
							<thead>
								<tr>
									<td style="width:35%;font-weight:bold;border-right:1px solid black;">
									Type of Award
									</td>
									<td  style="width:35%;font-weight:bold;border-right:1px solid black;">
									Issued by
									</td>
									<td  style="width:30%;font-weight:bold;">
									Date Issued
									</td>
								</tr>
							</thead>
							<tbody>
								@forelse($commendation as $key=>$commendation)
								<tr>
									<td style="border-top:1px solid black;border-right:1px solid black;">{{ $commendation->commendation == null ? 'N/A' : $commendation->commendation }}</td>
									<td style="border-top:1px solid black;border-right:1px solid black;">{{ $commendation->issued_by == null ? 'N/A' :$commendation->issued_by }}</td>
									<td style="border-top:1px solid black;">{{ $commendation->commendation_date == null ? 'N/A' :  date("m/d/Y", strtotime($commendation->commendation_date)) }}</td>
								</tr>
								@empty
								<tr>
									<td colspan="3" style="border-top:1px solid black">
										<strong>Sorry</strong> There are no data available.
									</td>
								</tr>
								@endforelse
							</tbody>
						</table>
					</td>
				</tr>
				
				
		</table>
		
	
</div>
</body>
</html>













