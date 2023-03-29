<table class="profile-table1">
						@forelse ($issue as $key=>$issue)
							<tr>
								<td width="200" class="pl-3">Government Issue Id</td>
								<td class="pl-2" >{{ $issue->gov_issue == null ? 'N/A' : $issue->gov_issue }}
									<div class="float-right pr-2">
										<a href="{{ route('issues.edit', $issue->id) }}"><i class="fa fa-edit"></i>&nbsp;UPDATE</a>
									</div>
								</td>
							</tr>
							<tr>
								<td class="pl-3">ID/License/Passport No.</td>
								<td class="pl-2" >{{ $issue->license_number == null ? 'N/A' : $issue->license_number }}</td>
							</tr>
							
							<tr>
								<td class="pl-3">Date/Place of Issuance</td>
								<td class="pl-2">{{ $issue->place_issue == null ? 'N/A' : $issue->place_issue }}</td>
							</tr>
							
						@empty
						<tr>
							<td colspan="2" class="text-center"><strong>Sorry</strong> There are no data available.<br/>
							<a href="{{ route('issues.show', $masters->main_id) }}" class="btn btn-sm btn-default btn-flat pull-right my-2" title="Add Gov't Issued ID"> <i class="fa fa-plus-circle"></i> &nbsp;Add Gov't Issued ID Records</a></td>
						</tr>
						@endforelse
						<!-- end of spouse -->					
					</table>