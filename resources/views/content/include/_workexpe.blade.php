					
					
					<div class="float-right clearfix my-2">
						<a href="{{ route('works.show', $masters->main_id)}}" class="btn btn-sm btn-default btn-flat pull-right"> <i class="fa fa-plus-circle"></i> &nbsp;Add Work Experience Records</a>
					</div>
					
					
					
					<table width="100%" class="profile-table3 text-center">
	                    <tr>
							<td colspan="10">
								
							</td>
						</tr>
						<tr>
	                        <td width="15%">
	                            <table class="workexpe" style="width:100%;margin:0 0;padding:0 0;border-collapse: collapse;border:0px;">
									<tr>
										<td colspan="2" style="border-bottom:1px solid silver;font-weight:bold">INCLUSIVE DATES</td>
									</tr>
									<tr>
										<td style="text-align:center;width:50%;border-right:1px solid silver;">From</td>		
										<td style="text-align:center;width:50%;">To</td>															
									</tr>
								</table>		
							</td>
							
	                        <td width="12%" style="font-weight:bold">PLANTILLA NO# </td>
							<td width="13%" style="font-weight:bold"> POSITION </td>
	                        <td width="15%" style="font-weight:bold">DEPARTMENT</td>
	                        <td width="10%" style="font-weight:bold">MONTHLY SALARY</td>
	                        <td width="5%" style="font-weight:bold">SALARY GRADE</td>
							<td width="5%" style="font-weight:bold">STEP INCREMENT </td>
	                        <td width="10%" style="font-weight:bold">STATUS OF APPOINTMENT</td>
	                        <td width="5%" style="font-weight:bold">GOV'T SERVICE</td>
	                        <td width="10%" style="font-weight:bold">ACTION</td>
	                    </tr>
	                    @forelse($workexpe as $key=>$workexpe)
	                    <tr>
	                        <td>
								<table class="workexpe" style="width:100%;margin:0 0;padding:0 0;border-collapse:collapse;height:100%;">		
									<tr>
										<td  style="text-align:center;width:50%;border-right:1px solid silver;">
											{{ $workexpe->inclusive_from == null ? 'N/A' : date("m/d/Y", strtotime($workexpe->inclusive_from)) }}
										</td>	
										<td  style="text-align:center;width:50%;">
										
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
										</td>															
									</tr>
								</table>		
	                        </td>
	                        <td>
	                        {{ $workexpe->plantilla_number == null ? 'N/A' : $workexpe->plantilla_number }}
	                        </td>
							<td  >
	                        {{ $workexpe->position_title == null ? 'N/A' : $workexpe->position_title }}
	                        </td>
	                        <td>
	                        {{ $workexpe->department == null ? 'N/A' : $workexpe->department }}
	                        </td>
							<td  >
	                        {{ $workexpe->salary == null ? 'N/A' : number_format($workexpe->salary,2) }}
	                        </td>
	                        <td  >
	                        {{ $workexpe->salary_grade == null ? 'N/A' : $workexpe->salary_grade }}
	                        </td>
							<td  >
	                        {{ $workexpe->step_increment == 0 ? '0' : $workexpe->step_increment }}
	                        </td>
							<td  >
	                        {{ $workexpe->job_status == null ? 'N/A' : $workexpe->job_status }}
	                        </td>
	                        <td  >
	                        {{ $workexpe->gov_service == null ? 'N/A' : $workexpe->gov_service }}
	                        </td>
	                        <td  >
								<a href="{{ route('works.edit', $workexpe->id) }}" title="Update">
								<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm" >
								<i class="fa fa-pencil-alt"> </i>
								</button>
								</a>
								<form style="display:inline;border:0;" method="post" action="{{ route('works.destroy', $workexpe->id) }}" title="Delete">
									@method('DELETE')
									@csrf
									<button  style="display:inline;border:0;" type="submit" class="btn btn-danger btn-sm" 
									onclick="return confirm('Are you sure you to delete the record?')"><i class="fa fa-trash"> </i></a></button>
								</form>	
							</td>
	                    </tr> 
						@empty
						<tr>
							<td colspan="10">
							<strong>Sorry</strong> There are no data available.	
							</td>
						</tr>
						@endforelse
					</table>