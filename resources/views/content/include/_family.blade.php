<table class="profile-table1">
						@forelse ($family as $key=>$family)
						<tr>
							<th width="170" class="pl-3">SPOUSE SURNAME</th>
							<td colspan="3" class="pl-2" >{{ $family->last_name == null ? 'N/A' : $family->last_name }}
								<div class="float-right pr-2">
									<a href="{{ route('families.edit', $family->master_id) }}"><i class="fa fa-edit"></i>&nbsp;UPDATE</a>
								</div>
							</tr>
							<tr>
								<th class="pl-3">FIRST NAME</th>
								<td class="pl-2" width="300" colspan="3">{{ $family->first_name == null ? 'N/A' : $family->first_name }}</td>
							</tr>
							<tr>
								<th class="pl-3">MIDDLE NAME</th>
								<td class="pl-2">{{ $family->middle_name == null ? 'N/A' : $family->middle_name }}</td>
								<th class="pl-3" width="170">Extension Name</th>
								<td class="pl-2">{{ $family->extension_name == null ? 'N/A' : $family->extension_name }}</td>
							</tr>
							
							<tr>
								<th class="pl-3">OCCUPATION</th>
								<td class="pl-2" colspan="3">{{ $family->occupation == null ? 'N/A' : $family->occupation }}</td>
							</tr>
							
							<tr>
								<th class="pl-3">EMPLOYER/BUSINESS NAME</th>
								<td class="pl-2" colspan="3">{{ $family->employer == null ? 'N/A' : $family->employer }}</td>
							</tr>
																					
							<tr>
								<th class="pl-3">BUSINESS ADD RECORDRESS</th>
								<td colspan="3" class="pl-2">{{ $family->business_addr == null ? 'N/A' : $family->business_addr }}</td>
							</tr>
							
							<tr>
								<th class="pl-3">TELEPHONE NO.</th>
								<td colspan="3" class="pl-2">{{ $family->telephone_no == null ? 'N/A' : $family->telephone_no }}</td>
							</tr>
																					
							<tr>
								<th class="pl-3">FATHER SURNAME</th>
								<td class="pl-2" colspan ="3">{{ $family->flast_name == null ? 'N/A' : $family->flast_name }}</td>
							</tr>
							
							<tr>
								<th class="pl-3">FIRST NAME</th>
								<td colspan ="3" class="pl-2">{{ $family->ffirst_name == null ? 'N/A' : $family->ffirst_name }}</td>
							</tr>
							
							<tr>
								<th class="pl-3">MIDDLE NAME</th>
								<td class="pl-2">{{ $family->fmiddle_name == null ? 'N/A' : $family->fmiddle_name }}</td>
								<th class="pl-3">Extension Name</td>
								<td class="pl-2">{{ $family->fextension_name == null ? 'N/A' : $family->fextension_name }}</td>
							</tr>
							
							<tr>
								<th class="pl-3">MOTHER MAIDEN NAME</th>
								<td class="pl-2" colspan ="3">{{ $family->mmaiden_name == null ? 'N/A' : $family->mmaiden_name }}</td>
							</tr>
							
							<tr>
								<th class="pl-3">LAST NAME</th>
								<td class="pl-2" colspan ="3">{{ $family->mlast_name == null ? 'N/A' : $family->mlast_name }}</td>
							</tr>
							
							<tr>
								<th class="pl-3">FIRST NAME</th>
								<td class="pl-2" colspan ="3">{{ $family->mfirst_name == null ? 'N/A' : $family->mfirst_name }}</td>
							</tr>
							
							<tr>
								<th class="pl-3">MIDDLE NAME</th>
								<td class="pl-2" colspan ="3">{{ $family->mmiddle_name == null ? 'N/A' : $family->mmiddle_name }}</td>
							</tr>				
						@empty
						<tr>
							<td colspan="2" class="text-center"><strong>Sorry</strong> There are no data available.<br/>
							<a href="{{ route('families.show', $masters->main_id) }}" class="btn btn-sm btn-default btn-flat pull-right my-2" title="Add Family"> <i class="fa fa-plus-circle"></i> &nbsp;Add Family Records</a></td>
						</tr>
						@endforelse
						<!-- end of spouse -->					
				</table>
				<div class="float-right clearfix my-2">
					<a href="{{ route('childrens.show', $masters->main_id)}}" class="btn btn-sm btn-default btn-flat pull-right" title="Add Sibling"> <i class="fa fa-plus-circle"></i> &nbsp;Add Children Records</a>
				</div>
					<table class="profile-table1 text-center">
						<tr >
							<th colspan="4" >CHILDREN</th>
						</tr>
						<tr>
							<th>Name</th>
							<th>Date of Birth</th>
							<th>Action</th>
						</tr>
						@forelse ($child as $key=>$child)
						<tr >
							<td style="width:40%">{{ $child->child_name == null ? 'N/A' : $child->child_name}}</td>
							<td style="width:40%">{{ $child->dob == '1970-01-01' ? 'N/A' : date("m/d/Y", strtotime($child->dob))}}</td>
							<td style="width:20%">
								<a href="{{ route('childrens.edit', $child->id) }}" title="Update">
								<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm" >
								<i class="fa fa-pencil-alt"> </i>
								</button>
								</a>
								<form style="display:inline;border:0;" method="post" action="{{ route('childrens.destroy', $child->id) }}" title="Delete">
									@method('DELETE')
									@csrf
									<button  style="display:inline;border:0;" type="submit" class="btn btn-danger btn-sm" 
									onclick="return confirm('Are you sure you to delete the record?')"><i class="fa fa-trash"> </i></a></button>
								</form>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="4" class="text-center"><strong>Sorry</strong> There are no data available.</td>
						</tr>
						@endforelse
					</table>