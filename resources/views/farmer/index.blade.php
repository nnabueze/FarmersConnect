@extends('admin_template')
@section('content')

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>{{$title}}</h2>
		</div>

		<!-- Advanced Form Example With Validation -->
		<div class="row clearfix">
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
		                <form  action='farmers' id="wizard_with_validation" method="POST">
		                	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		                    <h3>Step 1</h3>
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
		                        <div class="form-group">
		                            <div class="">
		                      	<input name="sex" type="radio" id="radio_49" value='m' class="with-gap radio-col-black" />
		                      	<label for="radio_49">Male</label>
		                      	<input name="sex" type="radio" id="radio_491" value='f' class="with-gap radio-col-black" />
		                      	<label for="radio_491">Female</label>
		                            </div>
		                        </div>
		                        <div class="form-group form-float">
		                            <div class="form-line">
		                                <input type="text" class="form-control" name="phone" >
		                                <label class="form-label">Phone*</label>
		                            </div>
		                        </div>
		                    </fieldset>

		                    <h3>Step 2</h3>
		                    <fieldset>
		                        <div class="form-group form-float">
		                           <select name='state' class="form-control show-tick" >
		                               <option value=''>Select State</option>
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

		                    <h3>Step 1</h3>
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
		                    	       <option value='y'>No Permission</option>
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
		                </form>
		            </div>
		        </div>
		    </div>

		    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"></div>
		</div>
		<!-- #END# Advanced Form Example With Validation -->
	</div>
		
</section>
@stop
