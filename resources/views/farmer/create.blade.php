@extends('admin_template')
@section('content')

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>{{$title}}</h2>
		</div>

		<!-- Advanced Form Example With Validation -->
		
		<div class="row clearfix">
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="card">
				    <div class="header">
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
				        <form action="/farmers" id="frmFileUpload" class="dropzone" method="post" enctype="multipart/form-data">
				            <div class="dz-message">
				                <div class="drag-icon-cph">
				                    <i class="material-icons">touch_app</i>
				                </div>
				                <h3>Drop files here or click to upload.</h3>
				                <em>upload farmers passport</em>
				            </div>
				            <div class="fallback">
				                <input name="file" type="file" />
				            </div>
				
				    </div>
				</div>
			</div>
		    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
		    	@include('include.warning')
		    	@include('include.message')
		    	@include('include.error')
		    	<div class="card">
		    	    <div class="header">
		    	        <h2>CREATE FARMER</h2>
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
		    	        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		    	            <h3>Personal Details</h3>
		    	            <fieldset>
		    	                <div class="form-group form-float">
		    	                    <div class="form-line">
		    	                    	<label class="form-label">Fullname*</label>
		    	                        <input type="text" class="form-control" name="fullname">
		    	                        
		    	                    </div>
		    	                </div>
		    	                <div class="form-group form-float">
		    	                    <div class="form-line">
		    	                        <input type="email" class="form-control" name="email" >
		    	                        <label class="form-label">Email*</label>
		    	                    </div>
		    	                </div>
		    	                <div class="form-group form-float">
		    	                    <div class="form-line">
		    	                        <input type="text" class="form-control" name="phone" >
		    	                        <label class="form-label">Phone*</label>
		    	                    </div>
		    	                </div>

		    	                <div class="form-line">
		    	                <select name='state' class="form-control show-tick" >
		    	                    <option value=''>Select Gender</option>
		    	                    <option value=''>No Permission</option>
		    	                    <option value=''>No Permission</option>
		    	                </select>
		    	                </div>
		    	                <br />
		    	            </fieldset>

		    	            <h3>Farm Details</h3>
		    	            <fieldset>
		    	            	<br />
		    	            	<div class="form-group form-float">
		    	            	   <select name='state' class="form-control show-tick" >
		    	            	       <option value=''>Select State*</option>
		    	            	       <option value=''>No Permission</option>
		    	            	   </select>
		    	            	</div>
		    	                <div class="form-group form-float">
		    	                    <div class="form-line">
		    	                        <input type="text" class="form-control" name="phone" >
		    	                        <label class="form-label">LGA*</label>
		    	                    </div>
		    	                </div>
		    	                <div class="form-group form-float">
		    	                    <div class="form-line">
		    	                        <input type="text" class="form-control" name="phone" >
		    	                        <label class="form-label">Village*</label>
		    	                    </div>
		    	                </div>
		    	                <div class="form-group form-float">
		    	                    <div class="form-line">
		    	                        <input type="text" class="form-control" name="phone" >
		    	                        <label class="form-label">Farm Size*</label>
		    	                    </div>
		    	                </div>
		    	                <div class="form-group form-float">
		    	                   <select name='state' class="form-control show-tick" >
		    	                       <option value=''>Select Crop</option>
		    	                       <option value=''>No Permission</option>
		    	                   </select>
		    	                </div>
		    	            </fieldset>

		    	            <h3>Account Information</h3>
		    	            <fieldset>
		    	            	<div class="form-group form-float">
		    	            	    <div class="form-line">
		    	            	        <input type="text" class="form-control" name="phone" >
		    	            	        <label class="form-label">No of Pack*</label>
		    	            	    </div>
		    	            	</div>
		    	            	<div class="form-group form-float">
		    	            	   <select name='state' class="form-control show-tick" >
		    	            	       <option value=''>Select Used</option>
		    	            	       <option value='y'>YES</option>
		    	            	       <option value='n'>NO</option>
		    	            	   </select>
		    	            	</div>
		    	            	<div class="form-group form-float">
		    	            	   <select name='state' class="form-control show-tick" >
		    	            	       <option value=''>Select Bank</option>
		    	            	       <option value=''>No Permission</option>
		    	            	   </select>
		    	            	</div>
		    	            	<div class="form-group form-float">
		    	            	    <div class="form-line">
		    	            	        <input type="text" class="form-control" name="phone" >
		    	            	        <label class="form-label">Account No*</label>
		    	            	    </div>
		    	            	</div>
		    	            </fieldset>
		    	            <button type="submit" class="btn btn-warning m-t-15 waves-effect">CREATE</button>
		    	
		    	    </div>
		    	</div>
		    </div>
		</div>
	</form>
		<!-- #END# Advanced Form Example With Validation -->
	</div>
		
</section>
@stop

