<div class="float-right clearfix my-2">
					<a href="{{ route('answers.edit', $masters->main_id) }}" class="btn btn-sm btn-default btn-flat pull-right"> <i class="fa fa-pencil-alt"></i> &nbsp;Update Other Info Records</a>
					</div>
					
               
					<table class="profile-table1" >
						<tr>
							<td colspan="5" >
							</td>
						</tr>
													
						<tr>
							<td class="text-center" class="number" valign="top"  width="20" >34.</td>
							<td width="460" class="answer0">
								Are you related by consanguinity or affinity to the appointing or recommending authority, or to 
								the chief of bureau or office or to the person who has immediate supervision over you in the Office, 						 
								Bureau or Department where you will be apppointed,</td>
							<td width="420" style="border-right:1px solid black;"></td>
						</tr>
						<tr>
							<td class="text-center" valign="middle"  width="20"></td>
							<td width="" class="answer0">a. within the third degree?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;border-right:1px solid black;">
								
								<?php if($answer->a34 == "Yes"){ ?>
								<input type="checkbox" disabled checked name="vehicle1" value="Bike">Yes
								<input type="checkbox" disabled name="vehicle2" value="Car">No
								<?php }elseif($answer->a34 == "No"){ ?>
								<input type="checkbox" disabled name="vehicle1" value="Bike">Yes
								<input type="checkbox" disabled checked name="vehicle2" value="Car">No
								<?php }else{?>
								<input type="checkbox" disabled name="vehicle1" value="Bike">Yes
								<input type="checkbox" disabled name="vehicle2" value="Car">No
								<?php }?>
								
							</td>
						</tr>
						<tr>
							<td class="text-center" class="number" valign="middle"  width="20" ></td>
							<td width="" class="answer0">b. within the fourth degree (for Local Government Unit - Career Employees)?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;border-right:1px solid black;">
								
								<?php if($answer->b34 == "Yes"){ ?>
									<input type="checkbox" disabled checked name="vehicle1" value="Bike" />Yes
									<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }elseif($answer->b34 == "No"){ ?>
									<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
									<input type="checkbox" disabled checked name="vehicle2" value="Car" />No
								<?php }else{?>
									<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
									<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }?>
								
							</td>
						</tr>
						<tr>
							<td class="text-center" class="number" valign="middle"  width="20" ></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;border-right:1px solid black;"> 
								If YES, give details: <br/>
								<?php if($answer->ab34_yes == null){  echo "N/A";}else{ echo $answer->ab34_yes;}?>
							</td>
						</tr>
						
						<tr>
							<td  class="text-center" valign="center"  width="20" >35.</td>
							<td width="" class="answer0">a. Have you ever been found guilty of any administrative offense?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;border-right:1px solid black;">
								
								<?php if($answer->a35 == "Yes"){ ?>
									<input type="checkbox" disabled checked name="vehicle1" value="Bike" />Yes
									<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }elseif($answer->a35 == "No"){ ?>
									<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
									<input type="checkbox" disabled checked name="vehicle2" value="Car" />No
								<?php }else{?>
									<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
									<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }?>
								
							</td>
						</tr>
						
						<tr>
							<td class="text-center"  valign="middle"  width="20" style="text-align:center;"></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;border-right:1px solid black;"> 
								If YES, give details: <br/>
								<?php if($answer->a35_yes == null){  echo "N/A";}else{ echo $answer->a35_yes;}?>
							</td>
						</tr>
						
						
						
						<tr>
							<td  class="text-center" valign="center"  width="20" ></td>
							<td width="" class="answer0">b. Have you been criminally charged before any court?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;border-right:1px solid black;">
								
								<?php if($answer->b35 == "Yes"){ ?>
								<input type="checkbox" disabled checked name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }elseif($answer->b35 == "No"){ ?>
								<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled checked name="vehicle2" value="Car" />No
								<?php }else{?>
								<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }?>
								
							</td>
						</tr>
						
						<tr>
							<td class="text-center" class="number" valign="middle"  width="20"></td>
							<td width="" style="" class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;border-right:1px solid black;"> If YES, give details: <br/>
									<table style="border:0px border-collapse:collapse;text-align:right;">
										<tr >
											<td style="border:0px">Date Filed</td> 
											<td style="padding-left:10px;border:0px;">
												<?php if($answer->b35_date == null){  echo "N/A";}else{ echo  date('m/d/Y', strtotime($answer->b35_date));}?>
											</td>
										</tr>
										<tr >
											<td style="border:0px">Status of Case/s:</td>
											<td style="padding-left:10px;border:0px;">
												<?php if($answer->b35_status == null){  echo "N/A";}else{ echo $answer->b35_status;}?>
											</td>
										</tr>
										
									</table>
							</td>
						</tr>
						
						<tr>
							<td  class="number" valign="top"  width="20" >36.</td>
							<td width="" valign="top" class="answer0">
								Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?
							</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;border-right:1px solid black;">
								<?php if($answer->a36 == "Yes"){ ?>
									<input type="checkbox" disabled checked name="vehicle1" value="Bike" />Yes
									<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }elseif($answer->a36 == "No"){ ?>
									<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
									<input type="checkbox" disabled checked name="vehicle2" value="Car" />No
								<?php }else{?>
									<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
									<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }?>
							</td>
						</tr>
						
						<tr>
							<td class="text-center"  valign="middle"  width="20"></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;border-right:1px solid black;"> 
								If YES, give details: <br/>
								<?php if($answer->a36_yes == null){  echo "N/A";}else{ echo $answer->a36_yes;}?>
							</td>
						</tr>
						
						<tr>
							<td  class="text-center" valign="top"  width="20" >37.</td>
							<td width="" style="border-top:1px solid black;" valign="top" class="answer0">
								Have you ever been separated from the service in any of the following modes: resignation, retirement, dropped from the rolls, dismissal, termination, end of 
								term, finished contract or phased out (abolition) in the public or private sector?
							</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;border-right:1px solid black;">
								
								<?php if($answer->a37 == "Yes"){ ?>
									<input type="checkbox" disabled checked name="vehicle1" value="Bike" />Yes
									<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }elseif($answer->a37 == "No"){ ?>
									<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
									<input type="checkbox" disabled checked name="vehicle2" value="Car" />No
								<?php }else{?>
									<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
									<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }?>
								
							</td>
						</tr>
						
						<tr>
							<td class="text-center"  valign="middle"  width="20"></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;border-bottom:1px solid black;border-right:1px solid black;"> 
							If YES, give details: <br/>
							<?php if($answer->a37_yes == null){  echo "N/A";}else{ echo $answer->a37_yes;}?>
							</td>
						</tr>
						
						<tr>
							<td  class="text-center" valign="top"  width="20" >38.</td>
							<td width="" style="border-top:1px solid black;" valign="top" class="answer0">a. Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;border-right:1px solid black;">
								
								<?php if($answer->a38 == "Yes"){ ?>
								<input type="checkbox" disabled checked name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }elseif($answer->a38 == "No"){ ?>
								<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled checked  name="vehicle2" value="Car" />No
								<?php }else{?>
								<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }?>
								
							</td>
						</tr>
						
						<tr>
							<td class="text-center"  valign="middle"  width="20"></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;border-right:1px solid black;"> 
							If YES, give details: <br/>
							<?php if($answer->a38_yes == null){  echo "N/A";}else{ echo $answer->a38_yes;}?>
							</td>
						</tr>
						
						<tr>
							<td  class="text-center" valign="top"  width="20"></td>
							<td width="" style="" valign="top" class="answer0">b. Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;border-right:1px solid black;">
								
								<?php if($answer->b38 == "Yes"){ ?>
								<input type="checkbox" disabled checked name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }elseif($answer->b38 == "No"){ ?>
								<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled checked name="vehicle2" value="Car" />No
								<?php }else{?>
								<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }?>
								
							</td>
						</tr>
						
						<tr>
							<td class="text-center"  valign="middle"  width="20"></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;border-bottom:1px solid black;border-right:1px solid black;"> If YES, give details: <br/>
							<?php if($answer->b38_yes == null){  echo "N/A";}else{ echo $answer->b38_yes;}?>
							</td>
						</tr>
						
						<tr>
							<td  class="text-center" valign="top"  width="20" >39.</td>
							<td width="" style="border-top:1px solid black;" valign="top" class="answer0">Have you acquired the status of an immigrant or permanent resident of another country?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;border-right:1px solid black;">
								<?php if($answer->a39 == "Yes"){ ?>
								<input type="checkbox" disabled checked name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }elseif($answer->a39 == "No"){ ?>
								<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled checked name="vehicle2" value="Car" />No
								<?php }else{?>
								<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }?>
							</td>
						</tr>
						
						<tr>
							<td class="text-center"  valign="middle"  width="20" ></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;border-bottom:1px solid black;border-right:1px solid black;">
							If YES, give details (country): <br/>
							<?php if($answer->a39_yes == null){  echo "N/A";}else{ echo $answer->a39_yes;}?>
							</td>
						</tr>
						<!-- 39 -->
						<tr>
							<td  class="text-center" valign="top"  width="20" >40.</td>
							<td width="" style="border-top:1px solid black;" valign="top" class="answer0">Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons 
							(RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:</td>
							<td width="" style="border-right:1px solid black;">
							</td>
						</tr>
						
						<tr>
							<td class="text-center"  valign="middle"  width="20"></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;border-right:1px solid black;"> 
							</td>
						</tr>
						
						
						<tr>
							<td  class="text-center" valign="top"  width="20">a</td>
							<td width="" style="" valign="top" class="answer0">Are you a member of any indigenous group?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;border-right:1px solid black;">
								
								<?php if($answer->a40 == "Yes"){ ?>
								<input type="checkbox" disabled checked name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }elseif($answer->a40 == "No"){ ?>
								<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled checked name="vehicle2" value="Car" />No
								<?php }else{?>
								<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }?>
								
							</td>
						</tr>
						
						<tr>
							<td class="text-center" valign="middle"  width="20"></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;border-right:1px solid black;"> 
							If YES, give details: <br/>
							<?php if($answer->a40_yes == null){  echo "N/A";}else{ echo $answer->a40_yes;}?>
							</td>
						</tr>
						
						<tr>
							<td  class="text-center" valign="top"  width="20">b</td>
							<td width="" style="" valign="top" class="answer0">Are you a person with disability?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;border-right:1px solid black;">
								
								<?php if($answer->b40 == "Yes"){ ?>
								<input type="checkbox" disabled checked name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }elseif($answer->b40 == "No"){ ?>
								<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled checked name="vehicle2" value="Car" />No
								<?php }else{?>
								<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }?>
								
							</td>
						</tr>
						
						<tr>
							<td class="text-center" valign="middle"  width="20"></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;border-right:1px solid black;"> 
							If YES, please specify ID No: <br/>
							<?php if($answer->b40_yes == null){  echo "N/A";}else{ echo $answer->b40_yes;}?>
							</td>
						</tr>
						
						<tr>
							<td  class="text-center" valign="top"  width="20">c</td>
							<td width="" style="" valign="top" class="answer0">Are you a solo parent?</td>
							<td width="" style="padding-left:40px;font-size: 10.0pt;border-right:1px solid black;">
								
								<?php if($answer->c40 == "Yes"){ ?>
								<input type="checkbox" disabled checked name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }elseif($answer->c40 == "No"){ ?>
								<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled checked name="vehicle2" value="Car" />No
								<?php }else{?>
								<input type="checkbox" disabled name="vehicle1" value="Bike" />Yes
								<input type="checkbox" disabled name="vehicle2" value="Car" />No
								<?php }?>
								
							</td>
						</tr>
						
						<tr>
							<td class="text-center"  valign="middle"  width="20"></td>
							<td width="" style=""class="answer0"></td>
							<td class="yes" width="" style="padding-left:35px;padding-top:5px;border-right:1px solid black;"> 
							If YES, please specify ID No: <br/>
							<?php if($answer->c40_yes == null){  echo "N/A";}else{ echo $answer->c40_yes;}?>
							</td>
						</tr>
					</table> 