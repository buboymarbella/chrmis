@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>TAT COSTING REPORT</h1>
          </div>
          <div class="col-sm-2">
            <div style="float:right"> <a href="{{ route('view_tat_records') }}"><button type="button" class="btn btn-warning btn-sm text-light">BACK TAT Cost Records</button></a></div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default col-md-8">
          <div class="card-header">
            <h3 class="card-title"></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <form class="form-horizontal" method="POST" action="{{ route('costings.store') }}"  enctype="multipart/form-data">
			@csrf
          <div class="card-body">
            <div class="row">
                <div class="col-md-12" id="data_1">
				@if ($errors->any())
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						@foreach ($errors->all() as $error)
								{{ $error }} <br/>
						@endforeach
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
                @endif
                </div>
                <div class="col-md-12" id="data_1">
                @if ($message = Session::get('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						{{ $message }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
                @endif
                </div>
				<div class="col-md-12" id="data_1">

				@if ($message = Session::get('error'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								{{ $message }}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
				@endif
				</div>

				<div class="col-md-5">
					<p style="padding-top:5px;">Select Plantilla Nr</p>
				   
					<select id="select2-dropdown"  class=" form-control select2" name="plantilla">
					  <option value="">--Select--</option>
					  @foreach($autocomplete as $item)
					  <option value="{{ $item->id }}">{{ $item->plantilla_number }}</option>
					  @endforeach
					</select>
				</div>
				
				<div class="col-md-12">
					<h4 style="padding-top:20px;">Publication of Vacancy</h4>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Cost</p>
					<input type="number" name="publication_cost"  placeholder="Cost..." class="form-control input"  value="{{ old('publication_cost') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">Start Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="publication_date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('publication_date') }}" />
					</div>
                </div>

				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">End Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="publication_date_e" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('publication_date_e') }}" />
					</div>
                </div>
				
				<div class="col-md-12">
					<h4 style="padding-top:20px;">Conduct of Local Board Deliberation</h4>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Cost</p>
					<input type="number" name="local_cost"  placeholder="Cost..." class="form-control input"  value="{{ old('local_cost') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">Start Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="local_date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('local_date') }}" />
					</div>
                </div>

				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">End Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="local_date_e" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('local_date_e') }}" />
					</div>
                </div>
				
				<div class="col-md-12">
					<h4 style="padding-top:20px;">Conduct of GHQ Board Deliberation</h4>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Cost</p>
					<input type="number" name="ghq_cost"  placeholder="Cost..." class="form-control input"  value="{{ old('ghq_cost') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">Start Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="ghq_date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('ghq_date') }}" />
					</div>
                </div>

				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">End Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="ghq_date_e" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('ghq_date_e') }}" />
					</div>
                </div>
				
				<div class="col-md-12">
					<h4 style="padding-top:20px;">Conduct of Assessment/Test</h4>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Cost</p>
					<input type="number" name="assessment_cost"  placeholder="Cost..." class="form-control input"  value="{{ old('assessment_cost') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">Start Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="assessment_date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('assessment_date') }}" />
					</div>
                </div>

				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">End Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="assessment_date_e" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('assessment_date_e') }}" />
					</div>
                </div>
				
				<div class="col-md-12">
					<h4 style="padding-top:20px;">Release of Minutes and Board Resolution</h4>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Cost</p>
					<input type="number" name="release_cost"  placeholder="Cost..." class="form-control input"  value="{{ old('release_cost') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">Start Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="release_date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('release_date') }}" />
					</div>
                </div>

				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">End Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="release_date_e" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('release_date_e') }}" />
					</div>
                </div>
				
				<div class="col-md-12">
					<h4 style="padding-top:20px;">Release of Directives</h4>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Cost</p>
					<input type="number" name="directives_cost"  placeholder="Cost..." class="form-control input"  value="{{ old('directives_cost') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">Start Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="directives_date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('directives_date') }}" />
					</div>
                </div>

				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">End Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="directives_date_e" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('directives_date_e') }}" />
					</div>
                </div>
				
				<div class="col-md-12">
					<h4 style="padding-top:20px;">Submission of Requirements</h4>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Cost</p>
					<input type="number" name="submission_cost"  placeholder="Cost..." class="form-control input"  value="{{ old('submission_cost') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">Start Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="submission_date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('submission_date') }}" />
					</div>
                </div>

				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">End Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="submission_date_e" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('submission_date_e') }}" />
					</div>
                </div>
				
				<div class="col-md-12">
					<h4 style="padding-top:20px;">Approval of Appointment</h4>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:5px;">Cost</p>
					<input type="number" name="approval_cost"  placeholder="Cost..." class="form-control input"  value="{{ old('approval_cost') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">Start Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="approval_date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('approval_date') }}" />
					</div>
                </div>

				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">End Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="approval_date_e" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('approval_date_e') }}" />
					</div>
                </div>
				
				<div class="col-md-12">
					<h4 style="padding-top:20px;">Submission of RAI to CSC</h4>
				</div>
				
				<div class="col-md-4">
					<p style="padding-top:4px;">Cost</p>
					<input type="number" name="rai_cost"  placeholder="Cost..." class="form-control input"  value="{{ old('approval_cost') }}"/>
				</div>
				
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">Start Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="rai_date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('rai_date') }}" />
					</div>
                </div>

				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;">End Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="rai_date_e" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('rai_date_e') }}" />
					</div>
                </div>
				
				<div class="col-md-12">
					<h4 style="padding-top:20px;">Name of Appointee</h4>
				</div>
				
				<div class="col-md-5" id="data_1">
                    <p style="padding-top:5px;">Last Name </p>
                    <input type="text" name="last_name"  placeholder="Last Name..." class="form-control input"  value="{{ old('last_name') }}"/>
                </div>

                <div class="col-md-5">
                  <p style="padding-top:5px;">First Name</p>
                  <input type="text" name="first_name" placeholder="First Name..." class="form-control input"  value="{{ old('first_name') }}"/>
                </div>
    
                <div class="col-md-5">
                    <p style="padding-top:5px;">Middle Name </p>
                    <input type="text" name="middle_name" placeholder="Middle Name..." class="form-control input" value="{{ old('middle_name') }}"/>
                </div>
            
                <div class="col-md-5">
                    <p style="padding-top:5px;">Extension Name</p>
                    <input type="text" name="extension_name"  placeholder="Extension Name..." class="form-control input" value="{{ old('extension_name') }}"/>
                </div>

				<div class="col-md-10">
                    <p style="padding-top:5px;">Remarks</p>
					<textarea rows="5" name="remarks" class="form-control input"></textarea>
                </div>

            </div>
				<div class="box-footer">
					
				</div>
			</div>
			
          <!-- /.card-body -->
          <div class="card-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
          </div>
        
        <!-- /.card -->
        </div>
		</form>
      </div>
    </section>
</div>
<br/>
@endsection





