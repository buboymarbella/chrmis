 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('masters.index') }}" class="brand-link">
      <img src="{{ asset('images/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-heavy">CHRMIS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
           <img src="{{ asset('uploads/profile/'.Auth::user()->picture) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ strtoupper(substr(Auth::user()->first_name, 0,1)."".substr(Auth::user()->last_name, 0,1)) }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
			 
			@can('viewAny', App\User::class)
			<li class="nav-header">ADMIN MENU</li>
			<li class="nav-item">
				<a href="{{ route('users.index')}}" class="nav-link {{ (request()->is('users/create')) ? 'active' : '' }} {{ (request()->is('users')) ? 'active' : '' }}">
					<i class="nav-icon fa fa-user"></i>
					<p>Users</p>
				</a>
			</li>
			<!-- <li class="nav-item has-treeview">
            <a href="#" >
              <i class="nav-icon fa fa-user"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
				
			
				<li class="nav-item">
					<a href="{{ route('users.create')}}" class="nav-link ">
						<i class="far fa-circle nav-icon"></i>
						<p>Add User</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('users.index')}}" class="nav-link ">
						<i class="far fa-circle nav-icon"></i>
						<p>View User</p>
					</a>
				</li>
            </ul>
			</li> -->
			<li class="nav-item">
				<a href="{{ route('ctg_csv')}}" class="nav-link">
					<i class="nav-icon fas fa-table"></i>
					<p>Add CSV</p>
				</a>
			</li>
			
			<li class="nav-item">
				<a href="{{ route('view_deleted_records')}}" class="nav-link {{ (request()->is('view_deleted_records')) ? 'active' : '' }}">
					<i class="nav-icon fas fa-list"></i>
					<p>Deleted Records</p>
				</a>
			</li>

			<li class="nav-item">
				<a href="{{ route('view_logs') }}" class="nav-link">
					<i class="nav-icon fas fa-database"></i>
					<p>System Logs</p>
				</a>
			</li>

			@endcan
			@can('viewAny', App\User::class)
			<li class="nav-header">MAIN MENU</li>
			<li class="nav-item ">
				<a href="{{ route('masters.index')}}" class="nav-link {{ (request()->is('masters')) ? 'active' : '' }}">
					<i class="nav-icon fas fa-tachometer-alt"></i>
					<p>Dashboard</p>
				</a>
			</li>
			<!--
			<li class="nav-item">
				<a href="{{ route('masters.create') }}" class="nav-link {{ (request()->is('masters/create')) ? 'active' : '' }}">
					<i class="nav-icon far fa-address-card"></i>
					<p>Add CHR</p>
				</a>
			</li>
			-->
			<li class="nav-item">
				<a href="{{ route('view_records') }}" class="nav-link {{ (request()->is('view_records')) ? 'active' : '' }}">
					<i class="nav-icon fas fa-book"></i>
					<p>View CIV HR Records</p>
				</a>
			</li>

			<li class="nav-item">
				<a href="{{ route('plantillas.index') }}" class="nav-link {{ (request()->is('plantillas')) ? 'active' : '' }}">
					<i class="nav-icon fas fa-book"></i>
					<p>View Plantilla Records</p>
				</a>
			</li>
			
			<li class="nav-item">
				<a href="{{ route('view_tat_records') }}" class="nav-link {{ (request()->is('view_tat_records')) ? 'active' : '' }}">
					<i class="nav-icon fas fa-book"></i>
					<p>View TAT Cost Records</p>
				</a>
			</li>

			
			<!--
			<li class="nav-item">
				<a href="{{ route('view_tat_records') }}" class="nav-link {{ (request()->is('view_tat_records')) ? 'active' : '' }}">
					<i class="nav-icon fas fa-book"></i>
					<p>View Plantilla Pos</p>
				</a>
			</li>
			-->
			<li class="nav-header">SUB MENU</li>
			{{-- <li class="nav-item has-treeview">
            <a href="{{ route('advanced_search') }}" class="nav-link {{ (request()->is('advanced_search')) ? 'active' : '' }}">
              <i class="fas fa fa-search nav-icon"></i>
              <p>
                Advanced Search
              
              </p>
            </a> --}}
			<!--
            <ul class="nav nav-treeview">
				<li class="nav-item">
					<a href="" class="nav-link">
						<i class="far fa-circle nav-icon"></i>
						<p>Office/Unit CHR</p>
					</a>
				</li>
				
				<li class="nav-item">
					<a href="{{ route('report_personalities')}}" class="nav-link">
						<i class="far fa-circle nav-icon"></i>
						<p>CHR Records</p>
					</a>
				</li>
				
				<li class="nav-item">
					<a href="" class="nav-link">
						<i class="far fa-circle nav-icon"></i>
						<p>Blood Type</p>
					</a>
				</li>

            </ul>
			-->
          </li>
		 
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{ (request()->is('fill_up_rate_date')) ? 'active' : '' }} {{ (request()->is('training_matrix')) ? 'active' : '' }} {{ (request()->is('demographics')) ? 'active' : '' }} {{ (request()->is('staffing_plan')) ? 'active' : '' }} {{ (request()->is('tat_costing_report')) ? 'active' : '' }} {{ (request()->is('staffing_office_plan')) ? 'active' : '' }} {{ (request()->is('fill_up_rate')) ? 'active' : '' }} {{ (request()->is('training_accomp_report')) ? 'active' : '' }} {{ (request()->is('fill_up_rate_office_report')) ? 'active' : '' }} {{ (request()->is('result_training_accomp_report')) ? 'active' : '' }}{{ (request()->is('result_tat_costing_report')) ? 'active' : '' }}{{ (request()->is('demographics_result')) ? 'active' : '' }} {{ (request()->is('performance_rating')) ? 'active' : '' }} {{ (request()->is('awards_demog_date')) ? 'active' : '' }} {{ (request()->is('performances')) ? 'active' : '' }}{{ (request()->is('computer_asst_matrix')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-copy"></i>
              <p>Report</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview"  style="display:{{ (request()->is('fill_up_rate_date')) ? 'block' : '' }} {{ (request()->is('training_matrix')) ? 'block' : '' }} {{ (request()->is('demographics')) ? 'block' : '' }} {{ (request()->is('staffing_plan')) ? 'block' : '' }} {{ (request()->is('tat_costing_report')) ? 'block' : '' }} {{ (request()->is('staffing_office_plan')) ? 'block' : '' }} {{ (request()->is('fill_up_rate')) ? 'block' : '' }} {{ (request()->is('training_accomp_report')) ? 'block' : '' }} {{ (request()->is('fill_up_rate_office_report')) ? 'block' : '' }} {{ (request()->is('result_training_accomp_report')) ? 'block' : '' }}{{ (request()->is('result_tat_costing_report')) ? 'block' : '' }} {{ (request()->is('demographics_result')) ? 'block' : '' }} {{ (request()->is('performance_rating')) ? 'block' : '' }} {{ (request()->is('awards_demog_date')) ? 'block' : '' }} {{ (request()->is('performances')) ? 'block' : '' }}{{ (request()->is('computer_asst_matrix')) ? 'block' : '' }}">
				<li class="nav-item">
					<a href="{{ route('demographics') }}" class="nav-link {{ (request()->is('demographics')) ? 'active' : '' }}  {{ (request()->is('demographics_result')) ? 'active' : '' }}">
						<i class="far fa-circle nav-icon"></i>
						<p>CHR DEMOG REPORT</p>
					</a>
				</li>
				
				<li class="nav-item">
					<a href="{{ route('performance_rating') }}" class="nav-link {{ (request()->is('performance_rating')) ? 'active' : '' }}">
						<i class="far fa-circle nav-icon"></i>
						<p>PER RATING REPORT</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="{{ route('training_matrix') }}" class="nav-link {{ (request()->is('training_matrix')) ? 'active' : '' }}">
						<i class="far fa-circle nav-icon"></i>
						<p>TRAINING MATRIX</p>
					</a>
				</li>
			  
				<li class="nav-item">
					<a href="{{ route('awards_demog_date') }}" class="nav-link {{ (request()->is('awards_demog_date')) ? 'active' : '' }}">
						<i class="far fa-circle nav-icon"></i>
						<p>AWARDEES DEMOG REPORT</p>
					</a>
				</li>
			  
				<li class="nav-item">
					<a href="{{ route('training_accomp_report') }}" class="nav-link {{ (request()->is('training_accomp_report')) ? 'active' : '' }} {{ (request()->is('result_training_accomp_report')) ? 'active' : '' }}" class="nav-link">
						<i class="far fa-circle nav-icon"></i>
						<p>TRAINING ACCOMP REPORT</p>
					</a>
				</li>
				
				<li class="nav-item">
					<a href="{{ route('computer_asst_matrix') }}" class="nav-link {{ (request()->is('computer_asst_matrix')) ? 'active' : '' }}">
						<i class="far fa-circle nav-icon"></i>
						<p>COMP ASST MATRIX</p>
					</a>
				</li>
				
				<li class="nav-item">
					<a href="{{ route('fill_up_rate_date') }}" class="nav-link {{ (request()->is('fill_up_rate_date')) ? 'active' : '' }} {{ (request()->is('fill_up_rate')) ? 'active' : '' }} {{ (request()->is('fill_up_rate_office_report')) ? 'active' : '' }}">
						<i class="far fa-circle nav-icon"></i>
						<p>FILL-UP RATE REPORT</p>
					</a>
				</li>
				
				<li class="nav-item">
					<a href="{{ route('staffing_plan') }}" class="nav-link {{ (request()->is('staffing_plan')) ? 'active' : '' }} {{ (request()->is('staffing_office_plan')) ? 'active' : '' }}">
						<i class="far fa-circle nav-icon"></i>
						<p>STAFFING PLAN REPORT</p>
					</a>
				</li>
				
				<li class="nav-item">
					<a href="{{ route('tat_costing_report') }}" class="nav-link {{ (request()->is('tat_costing_report')) ? 'active' : '' }}{{ (request()->is('result_tat_costing_report')) ? 'active' : '' }}" class="nav-link">
						<i class="far fa-circle nav-icon"></i>
						<p>TAT COSTING REPORT</p>
					</a>
				</li>
				
				<li class="nav-item">
					<a href="{{ route('performances.index') }}" class="nav-link {{ (request()->is('performances')) ? 'active' : '' }}">
						<i class="far fa-circle nav-icon"></i>
						<p>PER MGT MONI REPORT</p>
					</a>
				</li>
              
            </ul>
			</li>

			<li class="nav-item">
				<a href="{{ route('image_gallery') }}" class="nav-link {{ (request()->is('image_gallery')) ? 'active' : '' }}">
					<i class="nav-icon far fa-image"></i>
					<p class="text">Pictures</p>
				</a>
			</li>
			@endcan
			<!-- <li class="nav-item">
				<a href="#" class="nav-link">
					<i class="nav-icon fas fa-map-marked-alt"></i>
					<p class="text">Map</p>
				</a>
			</li> -->

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>