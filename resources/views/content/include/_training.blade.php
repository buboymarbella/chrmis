
					
					<div class="col-md-12" id="data_1">
						@if ($message = Session::get('errors'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								{{ $message }}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
						@endif
							@if ($message = Session::get('success'))
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									{{ $message }}
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
							@endif
					</div>
					<div class="float-right clearfix my-2">
					<a href="{{ route('trainings.show', $masters->main_id)}}" class="btn btn-sm btn-default btn-flat pull-right"> <i class="fa fa-plus-circle"></i> &nbsp;Add Training Records</a>
					</div>
					
					<table class="profile-table3 text-center">
						<tr>
							<td colspan="6" ></td>
						</tr>
						
	                    <tr>
	                        <td  style="width:200px;font-weight:bold">
	                            TRAINING PROGRAM
	                        </td>
	                        <td  style="width:100px;">
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
	                        <td  style="width:80px;font-weight:bold">
	                        TYPE OF LD
	                        </td>
	                        <td  style="width:200px;font-weight:bold;">
	                        CONDUCTED/SPONSORED BY
	                        </td>
	                        <td  style="width:100px;font-weight:bold">
	                        ACTION	
	                        </td>
	                    </tr>
						@forelse($training as $key=>$training)
	                    <tr>
	                        <td >
								@if($training->training_program == "CPORT")
									{!! strtoupper("Civilian Personnel Orientation/Reorientation Training") !!}
								@elseif($training->training_program == "CPBC")
									{!! strtoupper("Civilian Personnel Basic Course") !!}
								@elseif($training->training_program == "CPBSC")
									{!! strtoupper("Civilian Personnel Basic Supervisory Course") !!}
								@elseif($training->training_program == "CPASC")
									{!! strtoupper("Civilian Personnel Advance Supervisory Course") !!}
								@else
									{!! $training->training_program == null ? 'N/A' : $training->training_program !!}
								@endif
	                          
	                        </td>
	                        <td  >
	                            <table class="workexpe" style="width:100%;margin:0 0;padding:0 0;border-collapse: collapse;border:0px;height:100%;">
									<tr>
										<td  style="text-align:center;width:50%;border-right:1px solid silver;">
											{{ $training->inclusive_from == '1970-01-01' ? 'N/A' : date("m/d/Y", strtotime($training->inclusive_from)) }}
										</td>		
										<td  style="text-align:center;width:50%;">
											{{ $training->inclusive_to == '1970-01-01' ? 'N/A' : date("m/d/Y", strtotime($training->inclusive_to)) }}
										</td>															
									</tr>
								</table>		
	                        </td>
	                        <td  >
	                            {{ $training->number_hours == null ? 'N/A' : $training->number_hours }}
	                        </td>
	                        <td  >
	                            {{ $training->type_ld == null ? 'N/A' : $training->type_ld }}
	                        </td>
	                        <td  >
	                            {{ $training->conducted == null ? 'N/A' : $training->conducted }}
	                        </td>
	                        <td>
								{{-- <a href="{{ route('trainings.edit', $training->id) }}" title="Update">
								<button style="display:inline;border:0;" type="submit" class="btn btn-primary btn-sm" >
								<i class="fa fa-pencil-alt"> </i>
								</button>
								</a> --}}
								<form style="display:inline;border:0;" method="post" action="{{ route('trainings.destroy', $training->id) }}" title="Delete">
									@method('DELETE')
									@csrf
									<button  style="display:inline;border:0;" type="submit" class="btn btn-danger btn-sm" 
									onclick="return confirm('Are you sure you to delete the record?')"><i class="fa fa-trash"> </i></a></button>
								</form>	
							</td>
	                    </tr>
						@empty
						<tr>
							<td colspan="6"  style="border-top:1px solid black;padding:0 5px 0 0;margin:0;font-family: 'Arial Narrow', sans-serif;font-size:10px;text-align:center;">
								<strong>Sorry</strong> There are no data available.	
							</td>
						</tr>
	                    @endforelse 
					</table>