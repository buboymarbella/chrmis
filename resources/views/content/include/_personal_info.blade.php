<!-- start of table-->
						<div class="float-right mb-2">
							<a href="{{ route('masters.edit', $masters->main_id) }}" class="btn btn-sm btn-default btn-flat pull-right" title="Update Records"> 
							<i class="fas fa-pencil-alt"></i> &nbsp;Update Personal Records</a>
							<a href="{{ route('addresses.edit', $masters->main_id) }}" class="btn btn-sm btn-default btn-flat pull-right" title="Update Records"> 
							<i class="fas fa-pencil-alt"></i> &nbsp;Update Address Records</a>
						</div>
						
						<table class="profile-table1">
							<tr>
								<th class="pl-3" width="150px">FIRST NAME</th>
								<td class="pl-2">{{ $masters->first_name == null ? 'N/A' : $masters->first_name }}</td>
								<th class="pl-3" width="150px">LAST NAME</th>
								<td class="pl-2">{{ $masters->last_name == null ? 'N/A' : $masters->last_name }}</td>
							</tr>
							
							<tr>
								<th class="pl-3">MIDDLE NAME</th>
								<td class="pl-2" width="280px">{{ $masters->middle_name == null ? 'N/A' : $masters->middle_name }}</td>
								<th class="pl-3" width="150px">Extension Name</th>
								<td class="pl-2">{{ $masters->extension_name == null ? 'N/A' : $masters->extension_name }}</td>
							</tr>
													
							<tr style="">
								<th class="pl-3">DOB(mm/dd/yyyy)/Age</th>
								<td class="pl-2">
									@if($masters->dob  == null)
										N/A
									@elseif($masters->dob  == '1970-01-01')
										N/A
									@else
										{{ date("m/d/Y", strtotime($masters->dob)) }} / {{ $age }}
									@endif
								</td>
								<th class="pl-3">Residential Address </th>
								<td class="pl-2" valign="top" rowspan="3">
								{{ $address->residential_brgy == null ? 'N/A' : $address->residential_house ." ". $address->residential_street." ". $address->residential_subdivision." ". $address->residential_brgy." ". $address->residential_city." ". $address->residential_province}}
								</td>
							</tr>
													
							<tr style="">
								<th class="pl-3">Office/Unit</th>
								<td class="pl-2">{{ $masters->office == null ? 'N/A' : $masters->office }}</td>
								<td ></td>
							</tr>
													
							<tr style="">
								<th class="pl-3">Employement Status / Position</th>
								<td class="pl-2">
									{{ $masters->employ_stat == null ? 'N/A' : $masters->employ_stat }}&nbsp;/&nbsp;{{ $masters->position == null ? 'N/A' : $masters->position }}</td>
								<td ></td>
							</tr>
													
							<tr style="">
								<th class="pl-3">Salary Grade</th>
								<td class="pl-2">
									@if($masters->salary_grade == "")
										N/A
									@elseif(strlen($masters->salary_grade) <= 1)
										{!! "SG-0".$masters->salary_grade !!}
									@else
										{{ "SG-".$masters->salary_grade }}
									@endif
								</td>
								<th class="pl-3">Zip Code</th>
								<td class="pl-2" valign="top">
									{{ $address->residential_zipcode == null ? 'N/A' : $address->residential_zipcode }}
								</td>
							</tr>
													
							<tr style="">
								<th class="pl-3">Date of Orig App / Year of Service</th>
								<td class="pl-2">
									@if($masters->date_hired == null)
										N/A
									@elseif($masters->date_hired == '1970-01-01')
										N/A
									@else
										{{ date("m/d/Y", strtotime($masters->date_hired)) }} / {{ $masters->year_service }}
									@endif
								</td>
								<th class="pl-3">Permanent Address</th>
								<td class="pl-2" valign="top" rowspan="3">
									{{ $address->permanent_brgy == null ? 'N/A' : $address->permanent_house ." ". $address->permanent_street." ". $address->permanent_subdivision." ". $address->permanent_brgy." ". $address->permanent_city." ". $address->permanent_province}}
								</td>
							</tr>
													
							<tr style="">
								<th class="pl-3">Place of Birth</th>
								<td class="pl-2">{{ $masters->pob == null ? 'N/A' : $masters->pob }}</td>
								<td ></td>
							</tr>
													
							<tr style="">
								<th class="pl-3">Gender</th>
								<td class="pl-2">{{ $masters->gender == null ? 'N/A' : $masters->gender }}</td>
								<td ></td>
							</tr>
													
							<tr style="">
								<th class="pl-3">Civil Status</th>
								<td class="pl-2">{{ $masters->civil_status == null ? 'N/A' : $masters->civil_status }}</td>
								<th class="pl-3">Zip Code</th>
								<td class="pl-2" valign="top">{{ $address->permanent_zipcode == null ? 'N/A' : $address->permanent_zipcode }}</td>
							</tr>
													
							<tr style="">
								
								<th class="pl-3">Citizenship</td>
								@if($citizenship == "Dual Citizenship")
									<td class="pl-2">{{ $citizenship == null ? 'N/A' : $citizenship ." / ". $naturalize}} </td>
								@else
									<td class="pl-2">{{ $citizenship == null ? 'N/A' : $citizenship }} </td>
								@endif
								<th class="pl-3">Dual Citizenship<br/><small style="color:blue;">(INDICATE COUNTRY)</small></th>
								<td class="pl-2">{{ $masters->dual_citizen == null ? 'N/A' : $masters->dual_citizen }}</td>
							</tr>
													
							<tr style="">
								<th class="pl-3">Weight</td>
								<td class="pl-2">{{ $masters->weight == null ? 'N/A' : $masters->weight }}</td>
								<th class="pl-3">Height</td>
								<td class="pl-2">{{ $masters->height == null ? 'N/A' : $masters->height }}</td>
								
							</tr>
													
							<tr style="">
								<th class="pl-3">Telephone Number</td>
								<td class="pl-2">{{ $masters->telephone_no == null ? 'N/A' : $masters->telephone_no }}</td>
								<th class="pl-3">Cellphone Number</th>
								<td class="pl-2">{{ $masters->cellphone_no == null ? 'N/A' : $masters->cellphone_no }}</td>
							</tr>
													
							<tr style="">
								<th class="pl-3">Religion</th>
								<td class="pl-2">{{ $masters->religion == null ? 'N/A' : $masters->religion }}</td>
								<th class="pl-3">Blood Type</th>
								<td class="pl-2">{{ $masters->blood_type == null ? 'N/A' : $masters->blood_type }}</td>
							</tr>
													
							<tr style="">
								<th class="pl-3">Email Address</td>
								<td class="pl-2">{{ $masters->email_address == null ? 'N/A' : $masters->email_address }}</td>
								<th class="pl-3">Tin Number</th>
								<td class="pl-2" >{{ $identification->tin_number == null ? 'N/A' : $identification->tin_number }}</td>
							</tr>
													
							<tr style="">
								<th class="pl-3">GSIS Number</td>
								<td class="pl-2">{{ $identification->gsis_number == null ? 'N/A' : $identification->gsis_number }}</td>
								<th class="pl-3">Philhealth Number</th>
								<td class="pl-2" >{{ $identification->philhealth_number == null ? 'N/A' : $identification->philhealth_number }}</td>
							</tr>
													
							<tr style="">
								<th class="pl-3">SSS Number</th>
								<td class="pl-2">{{ $identification->sss_number == null ? 'N/A' : $identification->sss_number }}</td>
								<th class="pl-3">Pag-ibig Number</th>
								<td class="pl-2" >{{ $identification->pagibig_number == null ? 'N/A' : $identification->pagibig_number }}</td>
							</tr>
													
							<tr style="">
								<th class="pl-3">BP Number</th>
								<td class="pl-2">{{ $identification->bp_number == null ? 'N/A' : $identification->bp_number }}</td>
								<td></td><td></td>
							</tr>
												
						</table>
						<!-- end of table-->