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
  
	      <table class="example1">
                <thead>
                  <tr>
                    <th colspan="8"><h1 style="margin:0 0;padding:1px 1px;">RETIREMENT DATE</h1></th>
                  </tr>
                  <tr>
                    <th style="width:15%;">Item No.</th>
                    <th style="width:15%;">Name</th>
                    <th style="width:10%;">Unit\Office</th>
                    <th style="width:10%;">Position</th>
                    <th style="width:10%;">Salary Grade</th>
                    <th style="width:15%">Date of Birth / Age</th>
                    <th style="width:15%;">Compulsory Retirement</th>
                    <th style="width:10%;">Optional Retirement</th>
                  </tr>
                </thead>
                <tbody>
					
                  @forelse ($year_rb as $key=>$master)
                  <tr>
                    <td>{{ $master->item_number == "" ? 'N/A' : $master->item_number }}</td>
                    <td>{{ $master->complete_name == "" ? 'N/A' : $master->complete_name}}</td>
                    <td>{{ $master->office == "" ? 'N/A' : $master->office}}</td>
                    <td>{{ $master->position == null ? 'N/A' : $master->position }}</td>
                    <td>{{ $master->salary_grade == null ? 'N/A' : $master->salary_grade }}</td>
                    <td> @if($master->dob == null)
                  
                        @elseif($master->dob == '1970-01-01')
                          
                        @else
                          {{ date('m/d/Y', strtotime($master->dob)) }}
                        @endif 
                        / 
                        <?php
                        $dateOfBirth = $master->dob;
                        $today = date("Y-m-d");
                        $diff = date_diff(date_create($dateOfBirth), date_create($today));
                        $age = $diff->format('%y');

                        echo $age.' yrs old';
                        ?>
                    </td>
                    <td>{{ $master->retirement_date == null ? 'N/A' : date('d M Y',strtotime($master->retirement_date)) }}</td>
                    <td>{{ $master->optional_retire == null ? 'N/A' : date('d M Y',strtotime($master->optional_retire)) }}</td>
                    
                  </tr>
                  @empty
                    <tr>
                      <td colspan="8"><strong>Sorry</strong> There are no data available.</td>
                    </tr>
                  @endforelse
                        </tbody>
                </table>
	</div>
</div>
</body>
</html>