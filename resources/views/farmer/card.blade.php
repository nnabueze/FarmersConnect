@extends('admin_template')
@section('content')

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>{{$title}}</h2>
		</div>

		<!-- Bordered Table -->

		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				@include('include.message')
				@include('include.warning')
				@include('include.error')
				<div class="card">
					<div class="header">
						<h2>
							User Page
							<small>Manage User on the platform</small>
						</h2>
						<ul class="header-dropdown m-r--5">
							<li class="dropdown">
								<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<i class="material-icons">more_vert</i>
								</a>
								<ul class="dropdown-menu pull-right">
									<li><a href="javascript:void(0);">Action</a></li>
									<li><a href="javascript:void(0);">Another action</a></li>
									<li><a href="javascript:void(0);">Something else here</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="body">
							<div class='row'>
								<div class='col-xs-6 col-md-4'>
									<a href="javascript:void(0);" class="thumbnail">
									    <img src="http://placehold.it/500x300" class="img-responsive">
									</a>
								</div>
								<div class='col-xs-6 col-md-4'>
									<table class="table">
									    
									    <tbody>
									        <tr>
									            <td>Name:</td>
									            <td>{{$farmer->fullname}}</td>
									        </tr>
									        <tr>
									            <td>Name:</td>
									            <td>{{$farmer->fullname}}</td>
									        </tr>

									    </tbody>
									</table>
								</div>
								<div class='col-xs-6 col-md-4'>
										<a href="javascript:void(0);" class="thumbnail">
										    <img src="http://placehold.it/500x300" class="img-responsive">
										</a>
								</div>
							</div>
							<button type="button" class="btn btn-default waves-effect"><i class="material-icons">fingerprint</i>&nbsp;Print</button>
					</div>
				</div>
			</div><!-- End of First Colum -->
		</div>

		</section>

		@stop
