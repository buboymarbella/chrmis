
					<div class="float-right clearfix my-2">
						<a href="{{ route('commendations.show', $masters->main_id)}}" class="btn btn-sm btn-default btn-flat pull-right"> <i class="fa fa-plus-circle"></i> &nbsp;Add Commendation Record</a>
					</div>
					
					<table class="profile-table3 text-center">
	                    <tr>
							<td colspan="4">
							</td>
						</tr>
						
						<tr>
	                        <td  style="width:200px;font-weight:bold;">
	                        Type of Award
	                        </td>
							<td  style="width:100px;font-weight:bold;">
	                        Issued by
	                        </td>
							<td  style="width:100px;font-weight:bold;">
	                        Date Issued
	                        </td>
	                        <td  style="width:100px;font-weight:bold;">
	                        ACTION	
	                         </td>
						</tr>
						@forelse($commendation as $key=>$commendation)
						<tr>
							<td>{{ $commendation->commendation == null ? 'N/A' : $commendation->commendation }}</td>
							<td>{{ $commendation->issued_by == null ? 'N/A' :$commendation->issued_by }}</td>
							<td>{{ $commendation->commendation_date == '1970-01-01' ? 'N/A' :  date("m/d/Y", strtotime($commendation->commendation_date)) }}</td>
							<td  >
								<a href="{{ route('commendations.edit', $commendation->id) }}" title="Update">
								<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm" >
								<i class="fa fa-pencil-alt"> </i>
								</button>
								</a>
								<form style="display:inline;border:0;" method="post" action="{{ route('commendations.destroy', $commendation->id) }}" title="Delete">
									@method('DELETE')
									@csrf
									<button  style="display:inline;border:0;" type="submit" class="btn btn-danger btn-sm" 
									onclick="return confirm('Are you sure you to delete the record?')"><i class="fa fa-trash"> </i></a></button>
								</form>	
							</td>
	                    <tr>
						@empty
						<tr>
							<td colspan="4"  style="border-top:1px solid black;padding:0 5px 0 0;margin:0;font-family: 'Arial Narrow', sans-serif;font-size:10px;text-align:center;">
								<strong>Sorry</strong> There are no data available.	
							</td>
						</tr>
						@endforelse   
					</table>