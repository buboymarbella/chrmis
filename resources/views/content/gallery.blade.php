@extends('layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gallery</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gallery</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
         
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <div class="card-title">
                  Image Gallery
                </div>
              </div>
              <div class="card-body">
                <div class="row">
					@forelse ($masters as $key=>$master)
					<div class="col-sm-2">
						<a href="{{ asset('uploads/profile/'. $master->image) }}" data-toggle="lightbox" data-title="{{ $master->complete_name }}" data-gallery="gallery">
						   <img src="{{ asset('uploads/profile/'. $master->image) }}" class="img-fluid mb-2" width="150" alt="{{ $master->complete_name }}"/>
						</a>
					</div>
					@empty
					<div class="col-sm-2">
						<strong>Sorry</strong> There are no data available.
					</div>
					@endforelse
                </div>
				<div class="text-center mt-5">
				{{ $masters->links() }}
				</div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <br/>
@endsection





