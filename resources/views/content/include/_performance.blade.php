<div class="float-right clearfix my-2">
<a href="{{ route('performances.show', $masters->main_id) }}" class="btn btn-sm btn-default btn-flat pull-right"> <i class="fa fa-plus-circle"></i> &nbsp;Add Performance Records</a>
					</div>
					
					<table class="profile-table3 text-center">
						<tr>
							<td colspan="11" >
							</td>
						</tr>
						<tr>
	                        <td rowspan="2" style="width:15%;">
	                        NAME OF SUPERVISOR
	                        </td>
	                       
	                        <td colspan="2" style="width:10%;">
	                        PREPARATION OF IPCR
	                        </td>
							<td colspan="2" style="width:10%;">
	                        PERFORMANCE MONITORING AND COACHING
	                        </td>
	                        <td colspan="2" style="width:10%;">
	                        DISCUSSION OF INTERVENING ACTIVITIES
	                        </td>
							<td  colspan="2" style="width:10%;">
	                        GRADING OF IPCR
	                        </td>
							<td rowspan="2" style="width:15%;">
	                        REMARKS
	                        </td>
	                        <td rowspan="2" style="width:10%;">
	                        ACTION	
	                        </td>
	                    </tr>
	                    <tr>
	                        
	                        <td  style="width:5%;">
	                        Date of concurrence by Civ HR
	                        </td>
	                        <td  style="width:5%;">
	                        Date of concurrence by Immediate Supervisor
	                        </td>
							<td  style="width:5%;">
	                        Date of concurrence by Civ HR
	                        </td>
	                        <td  style="width:5%;">
	                        Date of concurrence by Immediate Supervisor
	                        </td>
							<td  style="width:5%;">
	                        Date of concurrence by Civ HR
	                        </td>
	                        <td  style="width:5%;">
	                        Date of concurrence by Immediate Supervisor
	                        </td>
							<td  style="width:5%;">
	                        Date of concurrence by Civ HR
	                        </td>
	                        <td  style="width:5%;">
	                        Date of concurrence by Immediate Supervisor
	                        </td>
	                       
	                    </tr>
						@forelse($performance as $key=>$ipcr)	
						<tr>
	                        <td >
	                        	{{ $ipcr->supervisor == null ? 'N/A' : $ipcr->supervisor }}
	                        </td>
	                        <td >
								@if($ipcr->ipcr_prep_chr == '1970-01-01') 
									N/A
								@elseif($ipcr->ipcr_prep_chr == NULL) 
									N/A
								@else
									{{date("d M Y", strtotime($ipcr->ipcr_prep_chr)) }}
								@endif
	                        </td>
	                        <td>
								@if($ipcr->ipcr_prep_supervisor == '1970-01-01') 
									N/A
								@elseif($ipcr->ipcr_prep_supervisor == NULL) 
									N/A
								@else
									{{date("d M Y", strtotime($ipcr->ipcr_prep_supervisor)) }}
								@endif
	                        </td>
							<td>
								@if($ipcr->coaching_chr == '1970-01-01') 
									N/A
								@elseif($ipcr->coaching_chr == NULL) 
									N/A
								@else
									{{date("d M Y", strtotime($ipcr->coaching_chr)) }}
								@endif
	                        </td>
							<td>
								@if($ipcr->coaching_supervisor == '1970-01-01') 
									N/A
								@elseif($ipcr->coaching_supervisor == NULL) 
									N/A
								@else
									{{date("d M Y", strtotime($ipcr->coaching_supervisor)) }}
								@endif
	                        </td>
							<td>
								@if($ipcr->activities_chr == '1970-01-01') 
									N/A
								@elseif($ipcr->activities_chr == NULL) 
									N/A
								@else
									{{date("d M Y", strtotime($ipcr->activities_chr)) }}
								@endif
	                        </td>
							<td>
								@if($ipcr->activities_supervisor == '1970-01-01') 
									N/A
								@elseif($ipcr->activities_supervisor == NULL) 
									N/A
								@else
									{{date("d M Y", strtotime($ipcr->activities_supervisor)) }}
								@endif
	                        </td>
							<td>
							   	@if($ipcr->grading_chr == '1970-01-01') 
									N/A
								@elseif($ipcr->grading_chr == NULL) 
									N/A
								@else
									{{date("d M Y", strtotime($ipcr->grading_chr)) }}
								@endif
	                        </td>
							<td>
							   	@if($ipcr->grading_supervisor == '1970-01-01') 
									N/A
								@elseif($ipcr->grading_supervisor == NULL) 
									N/A
								@else
									{{date("d M Y", strtotime($ipcr->grading_supervisor)) }}
								@endif
	                        </td>
							<td  >
								{{ $ipcr->remarks == null ? 'N/A' : $ipcr->remarks }}
	                        </td>
	                                                 		
	                        <td  >
								<!-- <a href="{{ route('rating_download',$ipcr->id) }}" target="_blank">
									<button style="display:inline;border:0;" type="submit" class="btn btn-warning btn-sm my-1" title="View">
									<i class="fas fa-cloud-download-alt"></i>
									</button>
								</a> -->
								<a href="{{ route('performances.edit', $ipcr->id) }}" title="Update">
								<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm" >
								<i class="fa fa-pencil-alt"> </i>
								</button>
								</a>
								<form style="display:inline;border:0;" method="post" action="{{ route('performances.destroy', $ipcr->id) }}" title="Delete">
									@method('DELETE')
									@csrf
									<button  style="display:inline;border:0;" type="submit" class="btn btn-danger btn-sm" 
									onclick="return confirm('Are you sure you to delete the record?')"><i class="fa fa-trash"> </i></a></button>
								</form>	
							</td>
	                    </tr>
						@empty
						<tr>
							<td colspan="11" class="text-center">
								<strong>Sorry</strong> There are no data available.	
							</td>
						</tr>
						@endforelse   
	    </table> 