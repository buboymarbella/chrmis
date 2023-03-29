@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
            <div style="float:left"><h1>Awards & Commendation</h1></div>
            <div style="float:right;"> <a href="{{ route('commendation', $master->main_id)}}"><button type="button" class="btn btn-warning btn-sm text-light">BACK TO PROFILE</button></a></div>
          </div>
          <div class="col-sm-6">
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default col-md-6">
          <div class="card-header">
            <h3 class="card-title"></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <form class="form-horizontal" method="POST" action="{{ route('commendations.store') }}"  enctype="multipart/form-data">
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
				
				<div class="col-md-12" >
					<p style="padding-top:5px;">Awards & Commendation</p>
					<!-- <input autocomplete="off" type="text" name="commendation" placeholder="Commendation" class="form-control input" 
					required value="{{ old('commendation') }}"/>  -->
            <select id="select4-dropdown"  class=" form-control select2" name="commendation" require>
						  <option value="">--Select--</option>
              <option value="27">Commendation</option>
              <option value="1">President Lingkod Bayan</option>
              <option value="2">Outstanding Public</option>
              <option value="3">Civil Service Commission Pagasa Awards</option>
              <option value="4">Distinguished Honor Medal</option>
              <option value="5">Superior Honor Medal</option>
              <option value="6">AFP Civilian Human Resource of the Year Award (Supervisor)</option>
              <option value="7">AFP Civilian Human Resource of the Year Award (Employee)</option>
              <option value="8">Civilian Merit Medal</option>
              <option value="9">Adjutant General Service (AGS) Badge</option>
              <option value="10">AFP Home Defense Badge</option>
              <option value="11">Military Civic Acation Medal</option>
              <option value="12">Wounded Personnel Medal</option>
              <option value="13">Parangal sa Kapanalig ng Sandatahang Lakas ng Pilipinas (Medal & Ribbon)</option>
              <option value="14">Retirement Award (Compulsary Retirement)</option>
              <option value="15">Certificate of Honorable Service (Optional Retirement)</option>
              <option value="16">Productivity Enchanment Incentive</option>
              <option value="17">Length of Service Incentive</option>
              <option value="18">Career and Self-Development Incentive</option>
              <option value="19">Loyalty Incentive</option>
              <option value="20">Best Employee Award</option>
              <option value="21">Gantimpala Agad Award </option>
              <option value="22">Exemplary Behavior Award</option>
              <option value="23">Most Courteous Employee Award</option>
              <option value="24">Best Organization Unit Award</option>
              <option value="25">Cost Economy Measure Award</option>
              <option value="26">Miscellaneous Incentives</option>
              <option value="28">DND Award</option>
              <option value="29">Major Service Award (Command Plaque)</option>
              <option value="30">Chief of Office Award</option>
            </select>
				</div>			                       
						
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;"> Commendation Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="commendation_date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ old('commendation_date') }}" />
					</div>
                </div>
					  
				<div class="col-md-8">
					<p style="padding-top:5px;">Issued by</p>
					<input autocomplete="off"  type="text" name="issued_by"  placeholder="Issued by" class="form-control input" 
					value="{{ old('issued_by') }}"/>
				</div>

				</div>
					<div class="box-footer">
						
					</div>
			</div>
			
          <!-- /.card-body -->
          <div class="card-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
				<input type="hidden" name="master_id" placeholder="" class="form-control input" readonly value="{{ Illuminate\Support\Facades\Crypt::encrypt($master->main_id)  }}"/>
          </div>
        
        <!-- /.card -->
        </div>
		</form>
      </div>
    </section>
</div>
<br/>
@endsection





