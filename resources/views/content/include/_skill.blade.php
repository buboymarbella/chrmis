<div class="float-right clearfix my-2">
					<a href="{{ route('others.show', $masters->main_id)}}" class="btn btn-sm btn-default btn-flat pull-right"> <i class="fa fa-plus-circle"></i> &nbsp;Add Skill/Recog/Assoc Records</a>
					</div>
					
					<table class="profile-table3 text-center">
						<tr>
							<td colspan="4">
							</td>
						</tr>
						
						<tr>
	                        <td  style="width:200px;">
	                        SPECIAL SKILLS
	                        </td>
	                        <td  style="width:300px;">
	                        NON-ACADEMIC RECOGNITION
	                        </td>
	                        <td  style="width:200px;">
	                        MEMBER OF ASSOCIATION
	                        </td>
	                        <td  style="width:100px;">
	                        ACTION	
	                        </td>
	                    </tr>
	                    @forelse($other as $other=>$skill)
	                    <tr>
	                        <td >
	                        {{ $skill->skills == null ? 'N/A' : $skill->skills }}
	                        </td>
	                        <td  >
	                        {{ $skill->recognition == null ? 'N/A' : $skill->recognition }}
	                        </td>
	                        <td  >
	                        {{ $skill->association_member == null ? 'N/A' : $skill->association_member }}
	                        </td>
	                        <td  >
								<a href="{{ route('others.edit', $skill->id) }}" title="Update">
								<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm" >
								<i class="fa fa-pencil-alt"> </i>
								</button>
								</a>
								<form style="display:inline;border:0;" method="post" action="{{ route('others.destroy', $skill->id) }}" title="Delete">
									@method('DELETE')
									@csrf
									<button  style="display:inline;border:0;" type="submit" class="btn btn-danger btn-sm" 
									onclick="return confirm('Are you sure you to delete the record?')"><i class="fa fa-trash"> </i></a></button>
								</form>	
							</td>
	                    </tr>
						@empty
						<tr>
							<td colspan="4"  style="border-top:1px solid black;padding:0 5px 0 0;margin:0;font-family: 'Arial Narrow', sans-serif;font-size:10px;text-align:center;">
								<strong>Sorry</strong> There are no data available.	
							</td>
						</tr>
	                    @endforelse  
					</table> 