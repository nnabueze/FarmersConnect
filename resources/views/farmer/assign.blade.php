@extends('admin_template')
@section('content')

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>{{$title}}</h2>
		</div>



		<!-- Exportable Table -->
		<div class="row clearfix">
		    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		        <div class="card">
		            <div class="header">
		                <h2>
		                    ASSIGNING FARMERS
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
		            	<form action='assign' method='POST'>
		            		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		                <table class="table table-bordered table-striped table-hover" id="users-table1">
		                    <thead>
		                        <tr>
		                        	<th><input type="checkbox" id="remember_me_3">
                                        <label for="remember_me_3"></label>
		                        	</th>
		                        	<th>Full Name</th>
		                        	<th>Email</th>
		                        	<th>Phone</th>
		                        	<th>State</th>
		                        	
		                        </tr>
		                    </thead>
		                </table>
		                <br />
		                <div class="form-group">
		                	<select name='role' class="form-control show-tick">
		                		<option value=''>Select Scheme</option>
		                	    <option value=''></option>
		                	</select>
		                </div>
		                <button type="submit" class="btn btn-warning pull-right waves-effect">ASSIGN SCHEME</button>
		                <br />
		            	</form>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- #END# Exportable Table -->
	</div>
</section>
@stop

@push('scripts')
<script>
$(function() {
   var table = $('#users-table1').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('assign.data') !!}',
        columns: [
        	{data: 'action', name: 'action', orderable: false, searchable: false},
            { data: 'fullname', name: 'fullname' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'state', name: 'state' },

            
        ]
    });

   // Handle click on "Select all" control
   $('#remember_me_3').on('click', function(){
      // Get all rows with search applied
      var rows = table.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });
});
</script>
@endpush
