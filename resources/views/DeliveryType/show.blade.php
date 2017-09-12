@extends('layouts.app')

@section('content')
<div class="widget">
	<header class="widget-header">
		<div class="col-md-6">
			<h4 class="widget-title">Show Delivery Type</h4>
		</div>
		<div class="col-md-6">
			<a href="{{ route('DeliveryType.index') }}">
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
				<label for="exampleTextInput1" class="col-sm-3 control-label"><strong>Delivery Type : </strong></label>
				<div class="col-sm-9">
					<label for="exampleTextInput1" style="text-align: left;" class="col-sm-2 control-label">{{ $deliveryType->delivery_type }}</label>
				</div>
			</div>
		</form>
	</div><!-- .widget-body -->
</div><!-- .widget -->
@endsection