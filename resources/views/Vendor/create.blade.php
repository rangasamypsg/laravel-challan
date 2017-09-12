@extends('layouts.app')

@section('content')
<div class="col-md-12">
	<div class="widget">
		<header class="widget-header">
			<h4 class="col-md-6 widget-title">Vendor Master</h4>
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
			<form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ route('Vendor.store') }}">
				{{ csrf_field() }} 
				<div class="col-md-6">
					<div class="form-group{{ $errors->has('vendor_name') ? ' has-error' : '' }}">
						<label for="vendor_name" class="col-md-4 control-label">Vendor Name <sup class="error">*</sup></label>
						<div class="col-md-6">
							<input id="vendor_name" type="text" class="form-control" name="vendor_name" value="{{ old('vendor_name') }}">
							@if ($errors->has('vendor_name'))
								<span class="help-block">
									<strong>{{ $errors->first('vendor_name') }}</strong>
								</span>
							@endif
						</div>
					</div>
					<div class="form-group">
						<label for="vendor_code" class="col-md-4 control-label">Vendor Code</label>
						<div class="col-md-6">
							<input id="vendor_code" type="text" class="form-control" name="vendor_code" value="{{ old('vendor_code') }}">
						</div>
					</div>
					<div class="form-group{{ $errors->has('address_line_1') ? ' has-error' : '' }}">
						<label for="address_line_1" class="col-md-4 control-label">Address Line 1 <sup class="error">*</sup></label>
						<div class="col-md-6">
							<input id="address_line_1" type="text" class="form-control" name="address_line_1" value="{{ old('address_line_1') }}">
							@if ($errors->has('address_line_1'))
								<span class="help-block">
									<strong>{{ $errors->first('address_line_1') }}</strong>
								</span>
							@endif
						</div>
					</div> 
					<div class="form-group">
						<label for="address_line_2" class="col-md-4 control-label">Address Line 2</label>
						<div class="col-md-6">
							<input id="address_line_2" type="text" class="form-control" name="address_line_2" value="{{ old('address_line_2') }}">
						</div>
					</div>
					<div class="form-group">
						<label for="city" class="col-md-4 control-label">City</label>
						<div class="col-md-6">
							<input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}">
						</div>
					</div>				 							
				</div>				
				<div class="col-md-6">
					<div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
						<label for="postal_code" class="col-md-4 control-label">Postal Code</label>
						<div class="col-md-6">
							<input maxlength='6' id="postal_code" type="text" class="form-control" name="postal_code" value="{{ old('postal_code') }}">
							@if ($errors->has('postal_code'))
								<span class="help-block">
									<strong>{{ $errors->first('postal_code') }}</strong>
								</span>
							@endif
						</div>
					</div>	
					<div class="form-group">
						<label for="state_id" class="col-md-4 control-label">State Name</label>
						<div class="col-md-6">                                    
							<?php $state_id = Input::old('state_id'); ?>
							<select class="form-control" id="state_id" name="state_id">
								<option value="">Select State</option>
								<?php foreach ($states as $key=>$state): ?>
								<option value="<?php echo $state->id; ?>" <?php
										if (isset($state_id) && Input::old('state_id') == $state->id) {
											echo 'selected="selected"';
										}
										?>><?php echo $state->state_name; ?></option>
								<?php endforeach; ?>
							</select>						 
						</div>
					</div>
					<div class="form-group">
						<label for="state_code" class="col-md-4 control-label">State Code</label>
						<div class="col-md-6">
							<input maxlength='2' id="state_code" type="text" class="form-control" name="state_code" value="{{ old('state_code') }}">
						</div>
					</div>								
					<div class="form-group{{ $errors->has('gst_number') ? ' has-error' : '' }}">
						<label for="gst_number" class="col-md-4 control-label">GST Number <sup class="error">*</sup></label>
						<div class="col-md-6">
							<input maxlength="15" id="gst_number" type="text" class="form-control" name="gst_number" value="{{ old('gst_number') }}">
							@if ($errors->has('gst_number'))
								<span class="help-block">
									<strong>{{ $errors->first('gst_number') }}</strong>
								</span>
							@endif
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<button type="submit" class="btn rounded mw-md btn-success">Save</button>
						<button type="reset" value="Reset" class="btn rounded mw-md btn-danger">Reset</button>
					</div>
				</div>														
				</div><!-- .form-group -->						
			</form>
		</div><!-- .widget-body -->
	</div><!-- .widget -->
</div><!-- END column -->
@endsection