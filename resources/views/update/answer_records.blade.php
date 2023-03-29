@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-8">
			<div style="float:left"><h1>Other Information</h1></div>
			<div style="float:right"> <a href="{{ route('other_info', $masters->master_id)}}"><button type="button" class="btn btn-warning btn-sm text-light">BACK TO PROFILE</button></a></div>
          </div>
          <div class="col-sm-4">
           
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content col-md-8">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title"></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <form class="form-horizontal" method="POST" action="{{ route('answers.update',$masters->master_id) }}"  enctype="multipart/form-data">
			@csrf
			@method('PUT')
          <div class="card-body">
            <div class="row">
                <div class="col-md-12" id="data_1">
				@if ($errors->any())
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						@foreach ($errors->all() as $error)
								{{ $error }}
						@endforeach
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
                @endif
                </div>
                <div class="col-md-12" id="data_1">
                @if ($message = Session::get('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						{{ $message }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
                @endif
                </div>
				
				<div class="col-md-12">
					<table class="main-tabl" width="100%" style="border-collapse:collapse;border:1px solid black;">
						<tr>
							<td class="number" class="number" valign="top" height="30" width="20" style="text-align:center;">34.</td>
							<td width="460" class="answer0">Are you related by consanguinity or affinity to the appointing or recommending authority, or to 
							the chief of bureau or office or to the person who has immediate supervision over you in the Office, 						 
								Bureau or Department where you will be apppointed,</td>
							<td width="420"></td>
						</tr>
						<tr>
							<td class="number" class="number" valign="middle" height="30" width="20" style="text-align:center;"></td>
							<td width="" class="answer0">a. within the third degree?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;">
							<?php if($answer->a34 == "Yes"){ ?>	
								<input type="radio" checked name="a34" value="Yes" />&nbsp;Yes
								<input type="radio" name="a34" value="No" /> &nbsp;No
							<?php }else{ ?>
								<input type="radio" name="a34" value="Yes" />&nbsp;Yes
								<input type="radio" checked name="a34" value="No" /> &nbsp;No
							<?php }?>
							</td>
						</tr>
						<tr>
							<td class="number" class="number" valign="middle" height="30" width="20" style="text-align:center;"></td>
							<td width="" class="answer0">b. within the fourth degree (for Local Government Unit - Noeer Employees)?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;">
							<?php if($answer->b34 == "Yes"){ ?>	
								<input type="radio" name="b34" id="Yes123" checked  value="Yes" onclick="enableTextbox()"/>&nbsp;Yes
								<input type="radio" name="b34" id="No123" value="No" onclick="enableTextbox()"/>&nbsp;No
							<?php }else{ ?>
								<input type="radio" name="b34" id="Yes123" value="Yes" onclick="enableTextbox()"/>&nbsp;Yes
								<input type="radio" name="b34" id="No123" checked  value="No" onclick="enableTextbox()"/>&nbsp;No
							<?php }?>
							</td>
						</tr>
						<tr>
							<td class="number" class="number" valign="middle" height="30" width="20" style="text-align:center;"></td>
							<td width="" style="border-bottom:1px solid black" class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;border-bottom:1px solid black;padding-right:5px;padding-bottom:5px;"> 
							<?php if($answer->b34 == "Yes"){ ?>	
							<input type="text" required name="ab34_yes" id="ab34_yes" placeholder="If YES, give details" class="form-control input "
								value="{{ $answer->ab34_yes }}"/>
							<?php }else{ ?>
								<input type="text" required name="ab34_yes" id="ab34_yes" placeholder="If YES, give details" class="form-control input " disabled="disabled"
								value="{{ $answer->ab34_yes }}"/>
							<?php }?>
						</tr>
						
						<tr>
							<td  class="number" valign="center" height="30" width="20" style="text-align:center;border-top:1px solid black;">35.</td>
							<td width="" class="answer0">a. Have you ever been found guilty of any administrative offense?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;">
							<?php if($answer->a35 == "Yes"){ ?>	
								<input type="radio" id="Yes2" checked name="a35" value="Yes" onclick="enableTextbox()" />&nbsp;Yes
								<input type="radio" id="No2" name="a35" value="No" onclick="enableTextbox()" />&nbsp;No
							<?php }else{ ?>
								<input type="radio" id="Yes2"  name="a35" value="Yes" onclick="enableTextbox()" />&nbsp;Yes
								<input type="radio" id="No2" checked name="a35" value="No" onclick="enableTextbox()" />&nbsp;No
							<?php }?>
							
							</td>
						</tr>
						
						<tr>
							<td class="number"  valign="middle"  width="20" style="text-align:center;"></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;padding-right:5px;padding-bottom:5px;">
							<?php if($answer->a35 == "Yes"){ ?>	
							<input type="text" required name="a35_yes" id="a35_yes" placeholder="If YES, give details" class="form-control input "
								value="{{ $answer->a35_yes }}" />
							<?php }else{ ?>
							<input type="text" required name="a35_yes" id="a35_yes" placeholder="If YES, give details" class="form-control input " disabled="disabled"
								value="{{ $answer->a35_yes }}" />
							<?php }?>
							</td>
						</tr>
						
						<tr>
							<td  class="number" valign="center" height="30" width="20" style=""></td>
							<td width="" class="answer0">b. Have you been criminally charged before any court?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;">
							<?php if($answer->b35 == "Yes"){ ?>	
								<input type="radio" name="b35" checked id="Yes1" value="Yes" onclick="enableTextbox()" />&nbsp;Yes
								<input type="radio" name="b35" id="No1" value="No" onclick="enableTextbox()" />&nbsp;No
							<?php }else{ ?>
								<input type="radio" name="b35" id="Yes1" value="Yes" onclick="enableTextbox()" />&nbsp;Yes
								<input type="radio" name="b35" checked id="No1" value="No" onclick="enableTextbox()" />&nbsp;No
							<?php }?>
							</td>
						</tr>
						
						<tr>
							<td class="number" class="number" valign="middle" height="30" width="20" style="text-align:center;"></td>
							<td width="" style="border-bottom:1px solid black"class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;border-bottom:1px solid black;"> If YES, give details: <br/>
									<table style="border-collapse:collapse;text-align:right;width:100%;margin-top:5px;">
										<tr>
											<td style="padding-bottom:5px;padding-right:5px" width="80">Date Filed:</td>
											<td style="padding-right:5px;padding-bottom:5px;">
												<?php if($answer->b35 == "Yes"){ ?>
													<div class="input-group">
														<div class="input-group-prepend">
														  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
														</div>
														<input type="text" name="b35_date" class="form-control input" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
														value="{{ $answer->b35_date }}" style="margin-bottom:5px;width:100%;"/>
													</div>
												<?php }else{ ?>
													<div class="input-group">
														<div class="input-group-prepend">
														  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
														</div>
														<input type="date" required name="b35_date" id="b35_date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
														disabled="disabled" value="{{ $answer->b35_date }}" />
													</div>
												<?php }?>
											</td> 
										</tr>
										<tr>
											<td style="padding-bottom:5px;padding-right:5px">Status of Case/s:</td>
											<td style="padding-right:5px;padding-bottom:5px;">
												<?php if($answer->b35 == "Yes"){ ?>
													<input type="text" required name="b35_status" id="b35_status" placeholder="Status of Case/s" class="form-control input " 
													value="{{ $answer->b35_status }}" style="margin-right:5px;width:100%;"/>
												<?php }else{ ?>
													<input type="text" required disabled="disabled" name="b35_status" id="b35_status" placeholder="Status of Case/s" class="form-control input " 
													value="{{ $answer->b35_status }}" style="margin-right:5px;width:100%;"/>
												<?php }?>
											</td>
										</tr>
										
									</table>
							</td>
						</tr>
						
						<tr>
							<td  class="number" valign="top" height="30" width="20" style="text-align:center;border-top:1px solid black;">36.</td>
							<td width="" valign="top" class="answer0">Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;">
								<?php if($answer->a36 == "Yes"){ ?>
									<input type="radio" name="a36" checked id="Yes3" value="Yes" onclick="enableTextbox()" />&nbsp;Yes
									<input type="radio" name="a36" id="No3" value="No" onclick="enableTextbox()" />&nbsp;No
								<?php }else{ ?>
									<input type="radio" name="a36" id="Yes3" value="Yes" onclick="enableTextbox()" />&nbsp;Yes
									<input type="radio" name="a36" checked id="No3" value="No" onclick="enableTextbox()" />&nbsp;No
								<?php }?>
							</td>
						</tr>
						
						<tr>
							<td class="number"  valign="middle" height="30" width="20" style="text-align:center;"></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;border-bottom:1px solid black;padding-right:5px;padding-bottom:5px;"> 
								<?php if($answer->a36 == "Yes"){ ?>
									<input type="text" required name="a36_yes" id="a36_yes" placeholder=" If YES, give details" class="form-control input"
									value="{{ $answer->a36_yes }}" style="margin-right:5px;width:100%;"/>
								<?php }else{ ?>
									<input type="text" required name="a36_yes" id="a36_yes" placeholder=" If YES, give details" class="form-control input " disabled="disabled"
									value="{{ $answer->a36_yes }}" style="margin-right:5px;width:100%;"/>
								<?php }?>
							</td>
						</tr>
						
						<tr>
							<td  class="number" valign="top" height="30" width="20" style="text-align:center;border-top:1px solid black;">37.</td>
							<td width="" style="border-top:1px solid black;" valign="top" class="answer0">Have you ever been separated from the service in any of the following modes: resignation, retirement, dropped from the rolls, dismissal, termination, end of 
							term, finished contract or phased out (abolition) in the public or private sector?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;">
								<?php if($answer->a37 == "Yes"){ ?>
									<input type="radio" name="a37" checked id="Yes4" value="Yes" onclick="enableTextbox()" />&nbsp;Yes
									<input type="radio" name="a37" id="No4" value="No" onclick="enableTextbox()" />&nbsp;No
								<?php }else{ ?>	
									<input type="radio" name="a37" id="Yes4" value="Yes" onclick="enableTextbox()" />&nbsp;Yes
									<input type="radio" name="a37" checked id="No4" value="No" onclick="enableTextbox()" />&nbsp;No
								<?php }?>
							</td>
						</tr>
						
						<tr>
							<td class="number"  valign="middle" height="30" width="20" style="text-align:center;"></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;border-bottom:1px solid black;padding-right:5px;padding-bottom:5px;">
								<?php if($answer->a37 == "Yes"){ ?>
									<input type="text" required name="a37_yes" id="a37_yes" placeholder=" If YES, give details" class="form-control input "
									value="{{ $answer->a37_yes }}" style="margin-right:5px;width:100%;"/>
								<?php }else{ ?>	
									<input type="text" required name="a37_yes" id="a37_yes" placeholder=" If YES, give details" class="form-control input " disabled="disabled"
									value="{{ $answer->a37_yes }}" style="margin-right:5px;width:100%;"/>
								<?php }?>
							</td>
						</tr>
						
						<tr>
							<td  class="number" valign="top" height="30" width="20" style="text-align:center;border-top:1px solid black;">38.</td>
							<td width="" style="border-top:1px solid black;" valign="top" class="answer0">a. Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;">
								<?php if($answer->a38 == "Yes"){ ?>
									<input type="radio" name="a38" checked id="Yes5" value="Yes" onclick="enableTextbox()" />&nbsp;Yes
									<input type="radio" name="a38" id="No5" value="No" onclick="enableTextbox()" />&nbsp;No
								<?php }else{ ?>	
									<input type="radio" name="a38" id="Yes5" value="Yes" onclick="enableTextbox()" />&nbsp;Yes
									<input type="radio" name="a38" checked id="No5" value="No" onclick="enableTextbox()" />&nbsp;No
								<?php }?>
							</td>
						</tr>
						
						<tr>
							<td class="number"  valign="middle" height="30" width="20" style="text-align:center;"></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;padding-right:5px;"> 
								<?php if($answer->a38 == "Yes"){ ?>
									<input type="text" required name="a38_yes" id="a38_yes" placeholder=" If YES, give details" class="form-control input "
									value="{{ $answer->a38_yes }}" style="margin-right:5px;width:100%;"/>
								<?php }else{ ?>	
									<input type="text" required name="a38_yes" id="a38_yes" placeholder=" If YES, give details" class="form-control input " disabled="disabled"
									value="{{ $answer->a38_yes }}" style="margin-right:5px;width:100%;"/>
								<?php }?>
							</td>
						</tr>
						
						<tr>
							<td  class="number" valign="top" height="30" width="20" style="text-align:center;"></td>
							<td width="" style="" valign="top" class="answer0">b. Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;">
								<?php if($answer->b38 == "Yes"){ ?>
									<input type="radio" name="b38" checked id="Yes6" value="Yes" onclick="enableTextbox()" />&nbsp;Yes
									<input type="radio" name="b38" id="No6" value="No" onclick="enableTextbox()" />&nbsp;No
								<?php }else{ ?>	
									<input type="radio" name="b38" id="Yes6" value="Yes" onclick="enableTextbox()" />&nbsp;Yes
									<input type="radio" name="b38" checked id="No6" value="No" onclick="enableTextbox()" />&nbsp;No
								<?php }?>
							</td>
						</tr>
						
						<tr>
							<td class="number"  valign="middle" height="30" width="20" style="text-align:center;"></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;border-bottom:1px solid black;padding-right:5px;"> 
								<?php if($answer->b38 == "Yes"){ ?>
									<input type="text" required name="b38_yes" id="b38_yes" placeholder=" If YES, give details" class="form-control input " 
									value="{{ $answer->b38_yes }}" style="margin-right:5px;width:100%;"/>
								<?php }else{ ?>	
									<input type="text" required name="b38_yes" id="b38_yes" placeholder=" If YES, give details" class="form-control input " disabled="disabled"
									value="{{ $answer->b38_yes }}" style="margin-right:5px;width:100%;"/>
								<?php }?>
								
							</td>
						</tr>
						
						<tr>
							<td  class="number" valign="top" height="30" width="20" style="text-align:center;border-top:1px solid black;">39.</td>
							<td width="" style="border-top:1px solid black;" valign="top" class="answer0">Have you acquired the status of an immigrant or permanent resident of another country?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;">
								<?php if($answer->a39 == "Yes"){ ?>
									<input type="radio" name="a39" checked id="Yes7" value="Yes" onclick="enableTextbox()" />&nbsp;Yes
									<input type="radio" name="a39" id="No7" value="No" onclick="enableTextbox()" />&nbsp;No
								<?php }else{ ?>	
									<input type="radio" name="a39" id="Yes7" value="Yes" onclick="enableTextbox()" />&nbsp;Yes
									<input type="radio" name="a39" checked id="No7" value="No" onclick="enableTextbox()" />&nbsp;No
								<?php }?>
							</td>
						</tr>
						
						<tr>
							<td class="number"  valign="middle" height="30" width="20" style="text-align:center;padding-right:5px;"></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;border-bottom:1px solid black;padding-right:5px;padding-bottom:5px;">
								<?php if($answer->a39 == "Yes"){ ?>
									<input type="text" required name="a39_yes" id="a39_yes" placeholder=" If YES, give details (country) " class="form-control input "
									value="{{ $answer->a39_yes }}" style="margin-right:5px;width:100%;"/>
								<?php }else{ ?>	
									<input type="text" required name="a39_yes" id="a39_yes" placeholder=" If YES, give details (country) " class="form-control input " disabled="disabled"
									value="{{ $answer->a39_yes }}" style="margin-right:5px;width:100%;"/>
								<?php }?>
							</td>
						</tr>
						<!-- 39 -->
						<tr>
							<td  class="number" valign="top" height="30" width="20" style="text-align:center;border-top:1px solid black;">40.</td>
							<td width="" style="border-top:1px solid black;" valign="top" class="answer0">
								Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Nota for Disabled Persons 
								(RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:
							</td>
							<td width="" style="">
							</td>
						</tr>
						
						<tr>
							<td class="number"  valign="middle" height="30" width="20" style="text-align:center;"></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;"> 
							</td>
						</tr>
						
						
						<tr>
							<td  class="number" valign="top" height="30" width="20" style="text-align:center;">a</td>
							<td width="" style="" valign="top" class="answer0">Are you a member of any indigenous group?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;">
								<?php if($answer->a40 == "Yes"){ ?>
									<input type="radio" checked name="a40" id="Yes8" value="Yes" onclick="enableTextbox()" />&nbsp;Yes
									<input type="radio" name="a40" id="No8" value="No" onclick="enableTextbox()" />&nbsp;No
								<?php }else{ ?>
									<input type="radio" name="a40" id="Yes8" value="Yes" onclick="enableTextbox()" />&nbsp;Yes
									<input type="radio" checked name="a40" id="No8" value="No" onclick="enableTextbox()" />&nbsp;No
								<?php }?>
							</td>
						</tr>
						
						<tr>
							<td class="number"  valign="middle" height="30" width="20" style="text-align:center;"></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;padding-right:5px;"> 
								<?php if($answer->a40 == "Yes"){ ?>
									<input type="text" required name="a40_yes" id="a40_yes" placeholder=" If YES, give details" class="form-control input "
									value="{{ $answer->a40_yes }}" style="margin-right:5px;width:100%;"/>
								<?php }else{ ?>
									<input type="text" required name="a40_yes" id="a40_yes" placeholder=" If YES, give details" class="form-control input " disabled="disabled"
									value="{{ $answer->a40_yes }}" style="margin-right:5px;width:100%;"/>
								<?php }?>
							</td>
						</tr>
						
						<tr>
							<td  class="number" valign="top" height="30" width="20" style="text-align:center;">b</td>
							<td width="" style="" valign="top" class="answer0">Are you a person with disability?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;">
								<?php if($answer->b40 == "Yes"){ ?>
									<input type="radio" name="b40" id="Yes9" checked value="Yes" onclick="enableTextbox()" />&nbsp;Yes
									<input type="radio" name="b40" id="No9" value="No" onclick="enableTextbox()" />&nbsp;No
								<?php }else{ ?>
									<input type="radio" name="b40" id="Yes9" value="Yes" onclick="enableTextbox()" />&nbsp;Yes
									<input type="radio" name="b40" id="No9" checked value="No" onclick="enableTextbox()" />&nbsp;No
								<?php }?>
							</td>
						</tr>
						
						<tr>
							<td class="number"  valign="middle" height="30" width="20" style="text-align:center;"></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;padding-right:5px;">
								<?php if($answer->b40 == "Yes"){ ?>
									<input type="text" required name="b40_yes" id="b40_yes" placeholder=" If YES, give details" class="form-control input "
									value="{{ $answer->b40_yes }}" style="margin-right:5px;width:100%;"/>
								<?php }else{ ?>
									<input type="text" required name="b40_yes" id="b40_yes" placeholder=" If YES, give details" class="form-control input " disabled="disabled"
									value="{{ $answer->b40_yes }}" style="margin-right:5px;width:100%;"/>
								<?php }?>
							</td>
						</tr>
						
						<tr>
							<td  class="number" valign="top" height="30" width="20" style="text-align:center;">c</td>
							<td width="" style="" valign="top" class="answer0">Are you a solo parent?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;">
								<?php if($answer->c40 == "Yes"){ ?>
									<input type="radio" name="c40" checked id="Yes10" value="Yes" onclick="enableTextbox()" />&nbsp;Yes
									<input type="radio" name="c40" id="No10" value="No" onclick="enableTextbox()" />&nbsp;No
								<?php }else{ ?>
									<input type="radio" name="c40" id="Yes10" value="Yes" onclick="enableTextbox()" />&nbsp;Yes
									<input type="radio" name="c40" checked id="No10" value="No" onclick="enableTextbox()" />&nbsp;No
								<?php }?>
							</td>
						</tr>
						
						<tr>
							<td class="number"  valign="middle" height="30" width="20" style="text-align:center;"></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;padding-right:5px;padding-bottom:5px;">
								<?php if($answer->c40 == "Yes"){ ?>
								<input type="text" required name="c40_yes" id="c40_yes" placeholder=" If YES, give details" class="form-control input "
								value="{{ $answer->c40_yes }}" style="margin-right:5px;width:100%;"/>
								<?php }else{ ?>
								<input type="text" required name="c40_yes" id="c40_yes" placeholder=" If YES, give details" class="form-control input " disabled="disabled"
								value="{{ $answer->c40_yes }}" style="margin-right:5px;width:100%;"/>
								<?php }?>
							</td>
						</tr>
			
					<!-- 40 -->
					</table>
				</div>
				
			</div>
					<div class="box-footer">
						
					</div>
			</div>
			
          <!-- /.card-body -->
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
        
        <!-- /.card -->
        </div>
		</form>
      </div>
    </section>
</div>
<br/>
@endsection





