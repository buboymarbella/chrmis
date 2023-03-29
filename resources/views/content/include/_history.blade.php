					<div class="float-right clearfix my-2">
						<a href="{{ route('voluntaries.show', $masters->main_id)}}" class="btn btn-sm btn-default btn-flat pull-right"> <i class="fa fa-plus-circle"></i> &nbsp;Add Plantilla History</a>
					</div>
					
					<table class="profile-table3 text-center">
					<tr>
							<td colspan="9">
								
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
							<td width="20%" style="font-weight:bold">PLANTILLA </td>
	                        <td width="20%" style="font-weight:bold">POSITION </td>
	                        <td width="20%" style="font-weight:bold">DEPARTMENT/UNIT/OFFICE</td>
	                        <td width="10%" style="font-weight:bold">MONTHLY SALARY</td>
	                        <td width="10%" style="font-weight:bold">SALARY GRADE</td>
	                    </tr>
						@forelse($history as $key=>$workexpe)
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
	                        {{ $workexpe->item_number == null ? 'N/A' : $workexpe->item_number }}
	                        </td>
							<td>
	                        {{ $workexpe->position_title == null ? 'N/A' : $workexpe->position_title }}
	                        </td>
	                        <td  >
	                        {{ $workexpe->department == null ? 'N/A' : $workexpe->department }}
	                        </td>
							<td  >
	                        {{ $workexpe->salary == null ? 'N/A' : number_format($workexpe->salary,2) }}
	                        </td>
	                        <td>
	                        {{ $workexpe->salary_grade == null ? 'N/A' : $workexpe->salary_grade }}
	                        </td>
						
						</tr>
						@empty
						<tr>
							<td colspan="6">
							<strong>Sorry</strong> There are no data available.	
							</td>
						</tr>
						@endforelse
						
	                    
						
					</table>