
					<div class="float-right clearfix my-2">
					<a href="{{ route('references.show', $masters->main_id) }}" class="btn btn-sm btn-default btn-flat pull-right"> <i class="fa fa-plus-circle"></i> &nbsp;Add Reference Records</a>
					</div>
					
					<table class="profile-table3 text-center">
						<tr>
	                        <td  style="width:200px;">
	                        NAME
	                        </td>
	                        <td  style="width:300px;">
	                        ADDRESS
	                        </td>
							<td  style="width:200px;">
	                        TEL N0.
	                        </td>
							<td  style="width:100px;">
	                        ACTION	
	                        </td>								
	                    </tr>
						@forelse($reference as $key=>$reference)
	                    <tr>
	                        <td >
	                        {{ $reference->name == null ? 'N/A' : $reference->name }}
	                        </td>
	                        <td  >
	                        {{ $reference->address == null ? 'N/A' : $reference->address }}
	                        </td>
							<td  >
							{{ $reference->telephone_no == null ? 'N/A' : $reference->telephone_no }}
	                        </td>
							<td  >
	                            <a href="{{ route('references.edit', $reference->id) }}" title="Update">
								<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm" >
								<i class="fa fa-pencil-alt"> </i>
								</button>
								</a>
								<form style="display:inline;border:0;" method="post" action="{{ route('references.destroy', $reference->id) }}" title="Delete">
									@method('DELETE')
									@csrf
									<button  style="display:inline;border:0;" type="submit" class="btn btn-danger btn-sm" 
									onclick="return confirm('Are you sure you to delete the record?')"><i class="fa fa-trash"> </i></a></button>
								</form>	
	                        </td>
						</tr>
						@empty
	                    @endforelse  
						<tr>
							<td colspan="4" class="text-center">
								<strong>Sorry</strong> There are no data available.	
							</td>
						</tr>
	                </table> 