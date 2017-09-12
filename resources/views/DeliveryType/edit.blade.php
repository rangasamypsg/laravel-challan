@extends('layouts.app')

@section('content')
<div class="col-md-12">
	<div class="widget">
		<header class="widget-header">
			<h4 class="col-md-6 widget-title">Edit Delivery Type</h4>
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
			<form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ route('DeliveryType.update', $deliveryType->id) }}">						
                {{ csrf_field() }}
                <input type="hidden" id="id" name="id" value="<?php echo $deliveryType->id ?>">							
                <div class="form-group{{ $errors->has('delivery_type') ? ' has-error' : '' }}">
                    <label for="delivery_type" class="col-md-4 control-label">Delivery Type</label>
                    <div class="col-md-6">
                        <input id="delivery_type" type="text" class="form-control" name="delivery_type" value="{{ old('delivery_type',  isset($deliveryType->delivery_type) ? $deliveryType->delivery_type : null) }}">

                        @if ($errors->has('delivery_type'))
                            <span class="help-block">
                                <strong>{{ $errors->first('delivery_type') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<button type="submit" class="btn rounded mw-md btn-success">Save</button>
						<button type="reset" value="Reset" class="btn rounded mw-md btn-danger">Reset</button>
					</div>
				</div>
            </form>	
		</div><!-- .widget-body -->
	</div><!-- .widget -->
</div><!-- END column -->
@endsection