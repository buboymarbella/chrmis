
					<div class="float-right clearfix my-2">
						<a href="{{ route('eligibilities.show', $masters->main_id)}}" class="btn btn-sm btn-default btn-flat pull-right"> <i class="fa fa-plus-circle"></i> &nbsp;Add Eligibility Records</a>
					</div>
					<table class="profile-table3 text-center">
						<tr>
							<td colspan="7"  class="name2" style="">
							</td>
						</tr>
						
						<tr>
							<td width="180" rowspan="2" class="name2">
								CAREER SERVICE/ RA 1080 (BOARD/ BAR) <br/>UNDER SPECIAL LAWS/ CES/ CSEE <br/>BARANGAY ELIGIBILITY / DRIVER'S LICENSE
							</td>
							<td width="90" rowspan="2" style="font-weight:bold">RATING <br/>(If Applicable)</td>
							<td width="100" rowspan="2" style="font-weight:bold">DATE OF<br/>EXAMINATION/<br/> CONFERMENT</td>
							<td width="180" rowspan="2" style="font-weight:bold">PLACE OF EXAMINATION / CONFERMENT</td>
							<td width="200" colspan="2" style="font-weight:bold">LICENSE (if applicable)</td>
							<td width="90" rowspan="2" style="font-weight:bold">ACTION</td>
						</tr>
						
						<tr>
							<td width="65" style="" class="name2">NUMBER</td>
							<td width="65" style="" class="name2">Date of Validity</td>
						</tr>
						
						@forelse($eligibility as $key=>$eligibility)
						<tr>
							<td  class="answer"  >
							{{ $eligibility->eligibility == null ? 'N/A' : $eligibility->eligibility }}
							</td>
							<td   class="answer" >
							{{ $eligibility->rating == null ? 'N/A' : $eligibility->rating }}
							</td>
							<td  class="answer" >
							@if($eligibility->date_examination == '1970-01-01' || $eligibility->date_examination == '1970-01-01') 
								N/A
							@elseif($eligibility->date_examination == NULL || $eligibility->date_examination == NULL) 
								N/A
							@else
								{{date("d M Y", strtotime($eligibility->date_examination))}}
							@endif
							</td>
							<td  class="answer" >
							{{ $eligibility->examination_place == null ? 'N/A' : $eligibility->examination_place }}
							</td>
							<td  class="answer" >
							{{ $eligibility->license_number == null ? 'N/A' : $eligibility->license_number }}
							</td>
							<td  class="answer" style="">
							@if($eligibility->license_validity == '1970-01-01' || $eligibility->license_validity == '1970-01-01') 
								N/A
							@elseif($eligibility->license_validity == NULL || $eligibility->license_validity == NULL) 
								N/A
							@else
								{{date("d M Y", strtotime($eligibility->license_validity))}}
							@endif
							</td>
							<td  class="answer" style="margin:0;">
	                            <a href="{{ route('eligibilities.edit', $eligibility->id) }}" title="Update">
								<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm" >
								<i class="fa fa-pencil-alt"> </i>
								</button>
								</a>
								<form style="display:inline;border:0;" method="post" action="{{ route('eligibilities.destroy', $eligibility->id) }}" title="Delete">
									@method('DELETE')
									@csrf
									<button  style="display:inline;border:0;" type="submit" class="btn btn-danger btn-sm" 
									onclick="return confirm('Are you sure you to delete the record?')"><i class="fa fa-trash"> </i></a></button>
								</form>							
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="7"  class="name2">
							<strong>Sorry</strong> There are no data available.				
							</td>
						</tr>
						@endforelse
					</table>