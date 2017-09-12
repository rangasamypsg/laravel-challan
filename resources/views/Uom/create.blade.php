@extends('layouts.app')

@section('content')
<div class="col-md-12">
	<div class="widget">
		<header class="widget-header">
			<h4 class="col-md-6 widget-title">UOM Master</h4>
			<div class="col-md-6">
				<a href="{{ route('Uom.index') }}">
					<button type="submit" class="btn btn-info btn-sm pull-right">
						<i class="fa fa-mail-reply"></i>&nbsp;&nbsp;Back
					</button>
				</a>
			</div>
		</header><!-- .widget-header -->
		<hr class="widget-separator">
		<div class="widget-body">
			<form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ route('Uom.store') }}">
				{{ csrf_field() }} 
				<div class="form-group{{ $errors->has('uom_name') ? ' has-error' : '' }}">
					<label for="uom_name" class="col-md-4 control-label">Uom Name <sup class="error">*</sup></label>
					<div class="col-md-6">
						<input id="uom_name" type="text" class="form-control" name="uom_name" value="{{ old('uom_name') }}">
						@if ($errors->has('uom_name'))
							<span class="help-block">
								<strong>{{ $errors->first('uom_name') }}</strong>
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