@extends('admin_template')
@section('content')

<section class="content">
	<div class="container-fluid">

		<!-- Advanced Form Example With Validation -->
		
	<!-- File Upload | Drag & Drop OR With Click & Choose -->
	<div class="row clearfix">
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	        <div class="card">
	            <div class="header">
	                <h2>
	                    FAMERS CSV UPLOAD 
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
	                <form action="csv" id="frmFileUpload" class="dropzone" method="post" enctype="multipart/form-data">
	                    <div class="dz-message">
	                        <div class="drag-icon-cph">
	                            <i class="material-icons">touch_app</i>
	                        </div>
	                        <h3>Drop files here or click to upload.</h3>
	                        <em>Upload farmers CSV</em>
	                    </div>
	                    <div class="fallback">
	                        <input name="file" type="file" multiple />
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- #END# File Upload | Drag & Drop OR With Click & Choose -->
	</div>
		
</section>
@stop

