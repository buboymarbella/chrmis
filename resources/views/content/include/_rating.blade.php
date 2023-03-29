<div class="float-right clearfix my-2">
					<a href="{{ route('ratings.show', $masters->main_id) }}" class="btn btn-sm btn-default btn-flat pull-right"> <i class="fa fa-plus-circle"></i> &nbsp;Add IPCR Records</a>
					</div>
					
					<table class="profile-table3 text-center">
						<tr>
							<td colspan="5" >
							</td>
						</tr>
						
	                    <tr>
	                        <td  style="width:100px;">
	                        Numerical Ratings
	                        </td>
	                        <td  style="width:300px;">
	                        Adjective Ratings
	                        </td>
	                        <td  style="width:100px;">
	                        Start Date Assestment
	                        </td>
							<td  style="width:100px;">
	                        End Date Assestment
	                        </td>
	                        <td  style="width:300px;">
	                        ACTION	
	                        </td>
	                    </tr>
						@forelse($rating as $key=>$ipcr)	
						<tr>
	                        <td >
	                        {{ $ipcr->n_rating == null ? 'N/A' : $ipcr->n_rating }}
	                        </td>
	                        <td  >
	                        {{ $ipcr->a_rating == null ? 'N/A' : $ipcr->a_rating }}
	                        </td>
	                        <td  >
	                            {{ $ipcr->s_assessment == '1970-01-01' ? 'N/A' : date("m/d/Y", strtotime($ipcr->s_assessment)) }}
	                        </td>
							<td  >
	                           {{ $ipcr->e_assessment == '1970-01-01' ? 'N/A' : date("m/d/Y", strtotime($ipcr->e_assessment)) }}
	                        </td>
	                                                 		
	                        <td  >
								<a href="{{ route('rating_download',$ipcr->id) }}" target="_blank">
									<button style="display:inline;border:0;" type="submit" class="btn btn-warning btn-sm my-1" title="View">
									<i class="fas fa-cloud-download-alt"></i>
									</button>
								</a>
								<a href="{{ route('ratings.edit', $ipcr->id) }}" title="Update">
								<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm" >
								<i class="fa fa-pencil-alt"> </i>
								</button>
								</a>
								<form style="display:inline;border:0;" method="post" action="{{ route('ratings.destroy', $ipcr->id) }}" title="Delete">
									@method('DELETE')
									@csrf
									<button  style="display:inline;border:0;" type="submit" class="btn btn-danger btn-sm" 
									onclick="return confirm('Are you sure you to delete the record?')"><i class="fa fa-trash"> </i></a></button>
								</form>	
							</td>
	                    </tr>
						@empty
						<tr>
							<td colspan="5"   class="text-center">
								<strong>Sorry</strong> There are no data available.	
							</td>
						</tr>
						@endforelse   
	                                </table> 