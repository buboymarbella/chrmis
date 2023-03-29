<table class="profile-table2 text-center">
						
						<tr>
							<th width="100">LEVEL</th>
							<th width="280">NAME OF SCHOOL<br/><small>(Write in full)</small></th>
							<th width="214">DEGREE COURSE <br/><small>(Write in full)</small></th>
							<th colspan="2" width="150">
								PERIOD OF ATTENDANCE					
							</th>
							<th width="80">UNITS <br/>EARNED</th>
							<th width="80">YEAR<br/> GRAD</th>
							<th width="80">HONORS RECEIVED</th>
							<th width="100">Action</th>
						</tr>
						
						<tr>
							<td class="educ"></td>
							<td class="educ"></td>
							<td class="educ"></td>
							<td width="50">From</td>
							<td width="50">To</td>
							<td class="educ"></td>
							<td class="educ"></td>
							<td class="educ"></td>
							<td class="educ"></td>
						</tr>
						
						<tr>	
							<th>ELEMENTARY</th>
							<td>{{ $education_elem->name_school == null ? 'N/A' : $education_elem->name_school }}</td>
							<td>ELEMENTARY</td>
							<td>{{ $education_elem->period_from == null ? 'N/A' : $education_elem->period_from }}</td>
							<td>{{ $education_elem->period_to == null ? 'N/A' : $education_elem->period_to }}</td>
							<td>N/A</td>
							<td>{{ $education_elem->year_graduated == null ? 'N/A' : $education_elem->year_graduated }}</td>
							<td >{{ $education_elem->honor_received == null ? 'N/A' : $education_elem->honor_received }}</td>
							<td rowspan="2">
								<a title="Update Record" class="btn btn-primary btn-sm" href="{{ route('educations.edit', $education_elem->master_id) }}">
									<i class="fa fa-pencil-alt"></i> 
								</a>
							</td>
						</tr>
						
						<tr>	
							<th>SECONDARY</th>
							<td>{{ $education_high->high_name_school == null ? 'N/A' : $education_high->high_name_school }}</td>
							<td>SECONDARY</td>
							<td>{{ $education_high->high_period_from == null ? 'N/A' : $education_high->high_period_from }}	</td>
							<td>{{ $education_high->high_period_to == null ? 'N/A' : $education_high->high_period_to }}</td>
							<td>N/A</td>
							<td>{{ $education_high->high_year_graduated == null ? 'N/A' : $education_high->high_year_graduated }}</td>
							<td>{{ $education_high->high_honor_received == null ? 'N/A' : $education_high->high_honor_received }}
							</td>
						</tr>
						
					</table>
					
					<div class="clearfix py-2">
						<a href="{{ route('vocationals.show', $masters->main_id) }}" class="btn btn-sm btn-default btn-flat float-right"> <i class="fa fa-plus-circle"></i> &nbsp;Add Vocational Records</a>
					</div>
					
                    <table class="profile-table2 text-center">
						
						<tr>
							<th width="100">LEVEL</th>
							<th width="280">NAME OF SCHOOL<br/><small>(Write in full)</small></th>
							<th width="214">DEGREE COURSE <br/><small>(Write in full)</small></th>
							<th colspan="2" width="150">
								PERIOD OF ATTENDANCE					
							</th>
							<th width="80">UNITS <br/>EARNED</th>
							<th width="80">YEAR<br/> GRAD</th>
							<th width="80">HONORS RECEIVED</th>
							<th width="100">Action</th>
						</tr>
						
						<tr>
							<td class="educ"></td>
							<td class="educ"></td>
							<td class="educ"></td>
							<td width="50">From</td>
							<td width="50">To</td>
							<td class="educ"></td>
							<td class="educ"></td>
							<td class="educ"></td>
							<td class="educ"></td>
						</tr>
					@forelse ($vocational as $key=>$vocational)
						<tr>	
						<th>VOCATIONAL</th>
						<td>{{ $vocational->name_school == null ? 'N/A' : $vocational->name_school }}</td>
						<td >{{ $vocational->course == null ? 'N/A' : $vocational->course }}</td>
						<td>{{ $vocational->period_from == null ? 'N/A' : $vocational->period_from }}</td>
						<td>{{ $vocational->period_to == null ? 'N/A' : $vocational->period_to }}</td>
						<td >{{ $vocational->units_earned == null ? 'N/A' : $vocational->units_earned }}</td>
						<td >{{ $vocational->year_graduated == null ? 'N/A' : $vocational->year_graduated }}</td>
						<td >{{ $vocational->honor_received == null ? 'N/A' : $vocational->honor_received }}</td>
						<td class="answer" rowspan="">
							<a title="Update Record" class="btn btn-primary btn-sm" href="{{ route('vocationals.edit', $vocational->id) }}"><i class="fa fa-pencil-alt"></i><br/></a>					
							<form style="display:inline;border:0;" method="post" action="{{ route('vocationals.destroy', $vocational->id) }}">
									@method('DELETE')
									@csrf
									<button title="Delete" style="display:inline;border:0;" type="submit" class="btn btn-danger btn-sm" 
									onclick="return confirm('Are you sure you to delete the record?')"><i class="fa fa-trash"> </i></button>
							</form>     
						</td>
					</tr>
						@empty
							<tr>
								<td colspan="9" class="text-center"><strong>Sorry</strong> There are no data available.<br/>
							</tr>
						@endforelse		
					</table>
				
					<div class="clearfix py-2">
						<a href="{{ route('colleges.show', $masters->main_id) }}" class="btn btn-sm btn-default btn-flat float-right"> <i class="fa fa-plus-circle"></i> &nbsp;Add College Records</a>
					</div>
					
                    <table class="profile-table2 text-center">
						
						<tr>
							<th width="100">LEVEL</th>
							<th width="280">NAME OF SCHOOL<br/><small>(Write in full)</small></th>
							<th width="214">DEGREE COURSE <br/><small>(Write in full)</small></th>
							<th colspan="2" width="150">
								PERIOD OF ATTENDANCE					
							</th>
							<th width="80">UNITS <br/>EARNED</th>
							<th width="80">YEAR<br/> GRAD</th>
							<th width="80">HONORS RECEIVED</th>
							<th width="100">Action</th>
						</tr>
						
						<tr>
							<td class="educ"></td>
							<td class="educ"></td>
							<td class="educ"></td>
							<td width="50">From</td>
							<td width="50">To</td>
							<td class="educ"></td>
							<td class="educ"></td>
							<td class="educ"></td>
							<td class="educ"></td>
						</tr>
						@forelse ($college as $key=>$college)
						<tr>	
							<th>COLLEGE</th>
							<td >
							{{ $college->name_school == null ? 'N/A' : $college->name_school }}
							</td>
							<td >
							{{ $college->course == null ? 'N/A' : $college->course }}
							</td>
							<td>
							{{ $college->period_from == null ? 'N/A' : $college->period_from }}
							</td>
							<td>
							{{ $college->period_to == null ? 'N/A' : $college->period_to }}
							</td>
							<td >
							{{ $college->units_earned == null ? 'N/A' : $college->units_earned }}
							</td>
							<td >
							{{ $college->year_graduated == null ? 'N/A' : $college->year_graduated }}
							</td>
							<td >
							{{ $college->honor_received == null ? 'N/A' : $college->honor_received }}
							</td>
							<td class="answer" rowspan="">
								<a title="Update Record" class="btn btn-primary btn-sm" href="{{ route('colleges.edit',$college->id) }}"><i class="fa fa-pencil-alt"></i><br/></a>					
								<form style="display:inline;border:0;" method="post" action="{{ route('colleges.destroy', $college->id) }}">
									@method('DELETE')
									@csrf
									<button title="Delete" style="display:inline;border:0;" type="submit" class="btn btn-danger btn-sm" 
									onclick="return confirm('Are you sure you to delete the record?')"><i class="fa fa-trash"> </i></button>
								</form>
							</td>
						</tr>
						@empty
							<tr>
								<td colspan="9" class="text-center"><strong>Sorry</strong> There are no data available.<br/>
							</tr>
						@endforelse		
					</table>
				
					<div class="clearfix py-2">
						<a href="{{ route('graduates.show', $masters->main_id) }}" class="btn btn-sm btn-default btn-flat float-right"> <i class="fa fa-plus-circle"></i> &nbsp;Add Graduate Studies Records</a>
					</div>
					
                    <table class="profile-table2 text-center">
						
						<tr>
							<th width="100">LEVEL</th>
							<th width="280">NAME OF SCHOOL<br/><small>(Write in full)</small></th>
							<th width="214">DEGREE COURSE <br/><small>(Write in full)</small></th>
							<th colspan="2" width="150">
								PERIOD OF ATTENDANCE					
							</th>
							<th width="80">UNITS <br/>EARNED</th>
							<th width="80">YEAR<br/> GRAD</th>
							<th width="80">HONORS RECEIVED</th>
							<th width="100">Action</th>
						</tr>
						
						<tr>
							<td class="educ"></td>
							<td class="educ"></td>
							<td class="educ"></td>
							<td width="50">From</td>
							<td width="50">To</td>
							<td class="educ"></td>
							<td class="educ"></td>
							<td class="educ"></td>
							<td class="educ"></td>
						</tr>
						@forelse ($graduate as $key=>$graduate)
						<tr>
							<th>GRADUATE STUDIES </th>
							<td >
							{{ $graduate->name_school == null ? 'N/A' : $graduate->name_school }}
							</td>
							<td >
							{{ $graduate->course == null ? 'N/A' : $graduate->course }}
							</td>
							<td>
							{{ $graduate->period_from == null ? 'N/A' : $graduate->period_from }}
							</td>
							<td>
							{{ $graduate->period_to == null ? 'N/A' : $graduate->period_to }}
							</td>
							<td >
							{{ $graduate->units_earned == null ? 'N/A' : $graduate->units_earned }}
							</td>
							<td >
							{{ $graduate->year_graduated == null ? 'N/A' : $graduate->year_graduated }}
							</td>
							<td >
							{{ $graduate->honor_received == null ? 'N/A' : $graduate->honor_received }}
							</td>
							<td>
								<a title="Update Record" class="btn btn-primary btn-sm" href="{{ route('graduates.edit', $graduate->id) }}"><i class="fa fa-pencil-alt"></i><br/></a>					
								<form style="display:inline;border:0;" method="post" action="{{ route('graduates.destroy', $graduate->id) }}">
									@method('DELETE')
									@csrf
									<button title="Delete" style="display:inline;border:0;" type="submit" class="btn btn-danger btn-sm" 
									onclick="return confirm('Are you sure you to delete the record?')"><i class="fa fa-trash"> </i></button>
								</form>   
							</td>
						</tr>
						@empty
							<tr>
								<td colspan="9" class="text-center"><strong>Sorry</strong> There are no data available.<br/>
							</tr>
						@endforelse		
					</table>