@extends('layouts.app')

@section('content')
<div class="widget">
	<header class="widget-header">
		<div class="col-md-6">
			<h4 class="widget-title">Show Vendor</h4>
		</div>
		<div class="col-md-6">
			<a href="{{ route('Vendor.index') }}">
				<button type="submit" class="btn btn-info btn-sm pull-right">
					<i class="fa fa-mail-reply"></i>&nbsp;&nbsp;Back
				</button>
			</a>
		</div>
	</header><!-- .widget-header -->
	<hr class="widget-separator">
	<div class="widget-body">
		
		<form class="form-horizontal">
			<div class="form-group">
				<label for="exampleTextInput1" class="col-sm-3 control-label"><strong>Vendor Name : </strong></label>
				<div class="col-sm-9">
					<label for="exampleTextInput1" style="text-align: left;" class="col-sm-2 control-label">{{ $vendor->vendor_name }}</label>
				</div>
			</div>

			<div class="form-group">
				<label for="exampleTextInput1" class="col-sm-3 control-label"><strong>vendor_code : </strong></label>
				<div class="col-sm-9">
					<label for="exampleTextInput1" style="text-align: left;" class="col-sm-2 control-label">{{ (($vendor->vendor_code) ? $vendor->vendor_code : '--') }}</label>
				</div>
			</div>

			<div class="form-group">
				<label for="exampleTextInput1" class="col-sm-3 control-label"><strong>Address line 1 : </strong></label>
				<div class="col-sm-9">
					<label for="exampleTextInput1" style="text-align: left;" class="col-sm-2 control-label">{{ (($vendor->address_line_1) ? $vendor->address_line_1 : '--') }}</label>
				</div>
			</div>	

			<div class="form-group">
				<label for="exampleTextInput1" class="col-sm-3 control-label"><strong>Address line 2 : </strong></label>
				<div class="col-sm-9">
					<label for="exampleTextInput1" style="text-align: left;" class="col-sm-2 control-label">{{ (($vendor->address_line_2) ? $vendor->address_line_2 : '--') }}</label>
				</div>
			</div>

			<div class="form-group">
				<label for="exampleTextInput1" class="col-sm-3 control-label"><strong>City : </strong></label>
				<div class="col-sm-9">
					<label for="exampleTextInput1" style="text-align: left;" class="col-sm-2 control-label">{{ (($vendor->city) ? $vendor->city : '--') }}</label>
				</div>
			</div>	
			
			<div class="form-group">
				<label for="exampleTextInput1" class="col-sm-3 control-label"><strong>Postal Code : </strong></label>
				<div class="col-sm-9">
					<label for="exampleTextInput1" style="text-align: left;" class="col-sm-2 control-label">{{ (($vendor->postal_code) ? $vendor->postal_code : '--') }}</label>
				</div>
			</div>

			<div class="form-group">
				<label for="exampleTextInput1" class="col-sm-3 control-label"><strong>State Code : </strong></label>
				<div class="col-sm-9">
					<label for="exampleTextInput1" style="text-align: left;" class="col-sm-2 control-label">{{ (($vendor->state_code) ? $vendor->state_code : '--') }}</label>
				</div>
			</div>

			<div class="form-group">
				<label for="exampleTextInput1" class="col-sm-3 control-label"><strong>GST Number : </strong></label>
				<div class="col-sm-9">
					<label for="exampleTextInput1" style="text-align: left;" class="col-sm-2 control-label">{{ (($vendor->gst_number) ? $vendor->gst_number : '--') }}</label>
				</div>
			</div>

		</form>
	</div><!-- .widget-body -->
</div><!-- .widget -->
@endsection