@extends('layouts.app')

@section('content')
<div class="widget">
	@if ($message = Session::get('success'))
			<div class="alert alert-success">
				<p>{{ $message }}</p>
			</div>
		@endif
	<header class="widget-header">										
		<h4 class="col-md-6 widget-title">Non Returnable Reports Details</h4>
	</header><!-- .widget-header -->
		<hr class="widget-separator">
		<div class="widget-body">
			<div class="table-responsive">
				<table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>S.No.</th>
							<th>Challan Date</th>
							<th>Vendor Name</th>
							<th>Challan Number</th>
							<th>Action</th>							
						</tr>
					</thead>								
					<tbody>
						@if (count($delivery_notes) > 0)		
							@foreach ($delivery_notes as $key => $delivery_note)
							<tr>
								<td>{{ ++$key }}</td>
								<td>{{ $delivery_note->challan_date }}</td>
								<td>{{ $delivery_note->vendor_name }}</td>
								<td>{{ $delivery_note->challan_number }}</td>
								<td>
									<a data-toggle="tooltip" data-placement="top" data-original-title="View Data" class="btn btn-info" href="{{ route('DeliveryNote.show',$delivery_note->id) }}"><i class="fa fa-eye"></i> Show</a>
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


