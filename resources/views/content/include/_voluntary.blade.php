
					<div class="float-right clearfix my-2">
					<a href="{{ route('voluntaries.show', $masters->main_id)}}" class="btn btn-sm btn-default btn-flat pull-right"> <i class="fa fa-plus-circle"></i> &nbsp;Add Voluntary Org Records</a>
					</div>
					
					<table class="profile-table3 text-center">
						<tr>
							<td colspan="5"  style="">
							</td>
						</tr>
						
	                    <tr>
	                        <td style="width:200px;font-weight:bold"> NAME OF ORGANIZATION</td>
							<td width="100">
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
	                        <td  style="width:80px;font-weight:bold">
	                        NUMBER OF HOURS
	                        </td>
	                        <td  style="width:200px;font-weight:bold">
	                        POSITION/NATURE OF WORK</td>
	                        <td  style="width:100px;font-weight:bold;">
	                        ACTION	
	                        </td>
	                    </tr>
	                    @forelse($voluntary as $key=>$voluntary)
	                    <tr>
	                        <td >
	                        {{ $voluntary->name_organization == null ? 'N/A' : $voluntary->name_organization }}
	                        </td>
							<td>
								<table class="workexpe" style="width:100%;margin:0 0;padding:0 0;border-collapse: collapse;border:0px;height:100%;">
									<tr>
										<td  style="text-align:center;width:50%;border-right:1px solid silver;">
											@if($voluntary->inclusive_from == null)
												N/A
											@elseif($voluntary->inclusive_from == "1970-01-01")
												N/A
											@elseif($voluntary->inclusive_from == "0000-00-00")
												N/A
											@else
												{{ date("m/d/Y", strtotime($voluntary->inclusive_from)) }}
											@endif
										</td>		
										<td  style="text-align:center;width:50%;">
											@if($voluntary->inclusive_to == "" && $voluntary->inclusive_from == "1970-01-01")
												N/A
											@elseif($voluntary->inclusive_to == "" && $voluntary->inclusive_from == "1970-01-01" )
												N/A
											@elseif($voluntary->inclusive_to == null && $voluntary->inclusive_from != "1970-01-01" )
												PRESENT
											@elseif($voluntary->inclusive_to == "" && $voluntary->inclusive_from != "0000-00-00" )
												PRESENT
											@elseif($voluntary->inclusive_to != "" && $voluntary->inclusive_from != "1970-01-01" || $voluntary->inclusive_from != "0000-00-00")
												{{ date("m/d/Y", strtotime($voluntary->inclusive_to)) }}
											@elseif($voluntary->inclusive_to != "" && $voluntary->inclusive_from != "0000-00-00")
												{{ date("m/d/Y", strtotime($voluntary->inclusive_to)) }}
											@else
												{{ date("m/d/Y", strtotime($voluntary->inclusive_to)) }}
											@endif
										</td>															
									</tr>
								</table>		
							</td>
							<td  >
							{{ $voluntary->hour_number == null ? 'N/A' : $voluntary->hour_number }}
							</td>
							<td  >
							{{ $voluntary->position == null ? 'N/A' : $voluntary->position }}
							</td>
							<td  >
								<a href="{{ route('voluntaries.edit', $voluntary->id) }}" title="Update">
								<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm" >
								<i class="fa fa-pencil-alt"> </i>
								</button>
								</a>
								<form style="display:inline;border:0;" method="post" action="{{ route('voluntaries.destroy', $voluntary->id) }}" title="Delete">
									@method('DELETE')
									@csrf
									<button  style="display:inline;border:0;" type="submit" class="btn btn-danger btn-sm" 
									onclick="return confirm('Are you sure you to delete the record?')"><i class="fa fa-trash"> </i></a></button>
								</form>	
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="5"  style="border-top:1px solid black;padding:0 5px 0 0;margin:0;font-family: 'Arial Narrow', sans-serif;font-size:10px;text-align:center;">
							<strong>Sorry</strong> There are no data available.	
							</td>
						</tr>
	                    @endforelse
					</table>