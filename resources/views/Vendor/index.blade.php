@extends('layouts.app')

@section('content')
<div class="widget">
	@if ($message = Session::get('success'))
			<div class="alert alert-success">
				<p>{{ $message }}</p>
			</div>
		@endif
	<header class="widget-header">										
		<h4 class="col-md-6 widget-title">Vendor Details</h4>
		<h4 class="col-md-6 widget-title pull-right"><a href="{{ route('Vendor.create') }}"><button type="button" class="btn-sm btn-success pull-right"><i class="fa fa-plus"></i>&nbsp;&nbsp;ADD NEW</button></a></h4>
	</header><!-- .widget-header -->
		<hr class="widget-separator">
		<div class="widget-body">
			<div class="table-responsive">
				<table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>No</th>
							<th>Vendor Name</th>
							<th>vendor Code</th>
							<th>GST Number</th>
							<th width="280px">Action</th>							
						</tr>
					</thead>								
					<tbody>
						@if (count($vendors) > 0)		
							@foreach ($vendors as $key => $vendor)
							<tr>
								<td>{{ ++$key }}</td>
								<td>{{ $vendor->vendor_name }}</td>
								<td>{{ (($vendor->vendor_code) ? $vendor->vendor_code : '--') }}</td>
								<td>{{ $vendor->gst_number }}</td>
								<td>
									<a data-toggle="tooltip" data-placement="top" data-original-title="View Data" class="btn btn-info" href="{{ route('Vendor.show',$vendor->id) }}"><i class="fa fa-eye"></i> Show</a>
									<a data-toggle="tooltip" data-placement="top" data-original-title="Edit Data" class="btn btn-primary"href="{{ route('Vendor.edit',$vendor->id) }}"><i class="fa fa-pencil"></i> Edit</a>
									{!! Form::open(['method' => 'DELETE','route' => ['Vendor.destroy', $vendor->id],'style'=>'display:inline']) !!}
									{!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
											'type' => 'button',
											'data-toggle'  => 'modal',
											'data-target' => '#confirmDelete', 
											//'data-title' => 'Delete User',
											//'data-message' => 'Are you sure you want to delete this user ?',
											'data-placement' => 'top',
											'data-original-title' => 'Delete Data',
											'class' => 'btn btn-danger',
											'title' => 'Delete Post',
											//'onclick'=>'return confirm("Confirm delete?")'
									)) !!}
									{!! Form::close() !!}
								</td>
							</tr>
							@endforeach
						@endif										
					</tbody>
				</table>
			</div>
		</div><!-- .widget-body -->
	</div><!-- .widget -->
</div><!-- END column -->
@endsection





