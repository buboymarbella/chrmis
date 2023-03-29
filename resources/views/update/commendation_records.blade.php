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
            <div style="float:right;"> <a href="{{ route('commendation', $masters->master_id)}}"><button type="button" class="btn btn-warning btn-sm text-light">BACK TO PROFILE</button></a></div>
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
          <form class="form-horizontal" method="POST" action="{{ route('commendations.update',$masters->id) }}"  enctype="multipart/form-data">
			@csrf
			@method('PUT')
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
					required value="{{ $masters->commendation == null ? 'N/A' : $masters->commendation }}"/> -->

					<select id="select4-dropdown"  class=" form-control select2" name="commendation" required>
						@if($masters->commendation == strtoupper('Commendation'))
						<option value="27">Commendation</option>
						@elseif($masters->commendation == strtoupper('President Lingkod Bayan'))
						<option value="1">President Lingkod Bayan</option>
						@elseif($masters->commendation == strtoupper('Outstanding Public'))
						<option value="2">Outstanding Public</option>
						@elseif($masters->commendation == strtoupper('Civil Service Commission Pagasa Awards'))
						<option value="3">Civil Service Commission Pagasa Awards</option>
						@elseif($masters->commendation == strtoupper('Distinguished Honor Medal'))
						<option value="4">Distinguished Honor Medal</option>
						@elseif($masters->commendation == strtoupper('Superior Honor Medal'))
						<option value="5">Superior Honor Medal</option>
						@elseif($masters->commendation == strtoupper('AFP Civilian Human Resource of the Year Award (Supervisor)'))
						<option value="6">AFP Civilian Human Resource of the Year Award (Supervisor)</option>
						@elseif($masters->commendation == strtoupper('AFP Civilian Human Resource of the Year Award (Employee)'))
						<option value="7">AFP Civilian Human Resource of the Year Award (Employee)</option>
						@elseif($masters->commendation == strtoupper('Civilian Merit Medal'))
						<option value="8">Civilian Merit Medal</option>
						@elseif($masters->commendation == strtoupper('Adjutant General Service (AGS) Badge'))
						<option value="9">Adjutant General Service (AGS) Badge</option>
						@elseif($masters->commendation == strtoupper('AFP Home Defense Badge'))
						<option value="10">AFP Home Defense Badge</option>
						@elseif($masters->commendation == strtoupper('Military Civic Acation Medal'))
						<option value="11">Military Civic Acation Medal</option>
						@elseif($masters->commendation == strtoupper('Wounded Personnel Medal'))
						<option value="12">Wounded Personnel Medal</option>
						@elseif($masters->commendation == strtoupper('Parangal sa Kapanalig ng Sandatahang Lakas ng Pilipinas (Medal & Ribbon)'))
						<option value="13">Parangal sa Kapanalig ng Sandatahang Lakas ng Pilipinas (Medal & Ribbon)</option>
						@elseif($masters->commendation == strtoupper('Retirement Award (Compulsary Retirement)'))
						<option value="14">Retirement Award (Compulsary Retirement)</option>
						@elseif($masters->commendation == strtoupper('Certificate of Honorable Service (Optional Retirement)'))
						<option value="15">Certificate of Honorable Service (Optional Retirement)</option>
						@elseif($masters->commendation == strtoupper('Productivity Enchanment Incentive'))
						<option value="16">Productivity Enchanment Incentive</option>
						@elseif($masters->commendation == strtoupper('Length of Service Incentive'))
						<option value="17">Length of Service Incentive</option>
						@elseif($masters->commendation == strtoupper('Career and Self-Development Incentive'))
						<option value="18">Career and Self-Development Incentive</option>
						@elseif($masters->commendation == strtoupper('Loyalty Incentive'))
						<option value="19">Loyalty Incentive</option>
						@elseif($masters->commendation == strtoupper('Best Employee Award'))
						<option value="20">Best Employee Award</option>
						@elseif($masters->commendation == strtoupper('Gantimpala Agad Award'))
						<option value="21">Gantimpala Agad Award</option>
						@elseif($masters->commendation == strtoupper('Exemplary Behavior Award'))
						<option value="22">Exemplary Behavior Award</option>
						@elseif($masters->commendation == strtoupper('Most Courteous Employee Award'))
						<option value="23">Most Courteous Employee Award</option>
						@elseif($masters->commendation == strtoupper('Best Organization Unit Award'))
						<option value="24">Best Organization Unit Award</option>
						@elseif($masters->commendation == strtoupper('Cost Economy Measure Award'))
						<option value="25">Cost Economy Measure Award</option>
						@elseif($masters->commendation == strtoupper('Miscellaneous Incentives'))
						<option value="26">Miscellaneous Incentives</option>
						@elseif($masters->commendation == strtoupper('DND Award'))
						<option value="28">DND Award</option>
						@elseif($masters->commendation == strtoupper('DND Award'))
						<option value="29">Major Service Award (Command Plaque)</option>
						@elseif($masters->commendation == strtoupper('DND Award'))
						<option value="30">Chief of Office Awar</option>
						@else
						<option value="">--Select--</option>
						@endif
						
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
						<option value="21">Gantimpala Agad Award</option>
						<option value="22">Exemplary Behavior Award</option>
						<option value="23">Most Courteous Employee Award</option>
						<option value="24">Best Organization Unit Award</option>
						<option value="25">Cost Economy Measure Award</option>
						<option value="26">Miscellaneous Incentives</option>
					</select>
				</div>			                       
						
				<div class="col-md-4" id="data_1">
                    <p style="padding-top:5px;"> Commendation Date</p>
        
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
						</div>
						<input type="text" name="commendation_date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask
						value="{{ $masters->commendation_date == '1970-01-01' ? 'mm/dd/yyyy' : date('m/d/Y', strtotime($masters->commendation_date)) }}" />
					</div>
                </div>
					  
				<div class="col-md-8">
					<p style="padding-top:5px;">Issued by</p>
					<input autocomplete="off"  type="text" name="issued_by"  placeholder="Issued by" class="form-control input" 
					value="{{ $masters->issued_by == null ? '' : $masters->issued_by }}"/>
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





