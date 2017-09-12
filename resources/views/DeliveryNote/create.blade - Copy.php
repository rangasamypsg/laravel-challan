@extends('layouts.app')
<!-- {{ "fdsafsd".$count = Session::has('itemscount') ? session()->get('itemscount') : 1 }} -->
<?php $count = Session::has('itemscount') ? session()->get('itemscount') : 1 ?>
@section('content')
<style type="text/css">
	.errorItems {
		border:1px solid red;
		box-shadow: 5px solid red;
	}
</style>
<script type="text/javascript">	
		function callby(opt)
		{
			//alert(opt);
			if(opt == "Returnable")
			{
				$("#vechile_number").removeAttr("disabled","disabled");
				$("#challan_number").removeAttr("disabled","disabled");
				$("#return_date").removeAttr("disabled");				
				$("#indentor_id").removeAttr("disabled","disabled");
				$("#department_id").removeAttr("disabled","disabled");
				$("#indentor_name").removeAttr("disabled");
				$("#matl_belongs_to_bkn").removeAttr("disabled","disabled");
				$("#insured").removeAttr("disabled","disabled");				 
			}
			else if(opt == "Non Returnable")
			{
				$("#vechile_number").removeAttr("disabled");
				$("#return_date").attr("disabled","disabled").val('');				
				$("#indentor_id").removeAttr("disabled");
				$("#department_id").removeAttr("disabled");
				$("#indentor_name").removeAttr("disabled");
				$("#matl_belongs_to_bkn").removeAttr("disabled");
				$("#insured").removeAttr("disabled");
											}
			else if(opt == "Delivery Note")
			{
				$("#return_date").attr("disabled","disabled").val('');
				$("#indentor_id").attr("disabled","disabled").val('');
				$("#department_id").attr("disabled","disabled").val('');
				$("#indentor_name").attr("disabled","disabled").val('');
				$("#matl_belongs_to_bkn").attr("disabled","disabled").val('');
				$("#insured").attr("disabled","disabled");			 
			}
		}		
</script>

<!-- @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->

<div class="col-md-12">
	<div class="widget">
		<header class="widget-header">
			<h4 class="col-md-6 widget-title">Delivery Note</h4>
			<div class="col-md-6">
				<a href="{{ route('DeliveryNote.index') }}">
					<button type="submit" class="btn btn-info btn-sm pull-right">
						<i class="fa fa-mail-reply"></i>&nbsp;&nbsp;Back
					</button>
				</a>
			</div>
		</header><!-- .widget-header -->
		<hr class="widget-separator">
		<div class="widget-body">
			<form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ route('DeliveryNote.store') }}">
				{{ csrf_field() }} 
				
				<div class="col-md-6">
					<div class="form-group">
						<label for="challan_date" class="col-md-4 control-label">Challan Date</label>
						<div class="col-md-6">
							<input disabled id="txt_challan_date" type="text" class="form-control" name="txt_challan_date" value="{{ date('d-m-Y') }}">
							<input id="challan_date" type="hidden" class="form-control" name="challan_date" value="{{ date('d-m-Y') }}">
						</div>
					</div>

					<div class="form-group">
						<label for="financial_year" class="col-md-4 control-label">Financial Year</label>
						<div class="col-md-6">
							<input disabled id="txt_financial_year" type="text" class="form-control" name="txt_financial_year" value="{{ date('Y') }}-{{ date('y', strtotime('+1 years')) }}">
							<input id="financial_year" type="hidden" class="form-control" name="financial_year" value="{{ date('Y') }}-{{ date('y', strtotime('+1 years')) }}">
						</div>
					</div>
					<div class="form-group{{ $errors->has('mat_will_come_back') ? ' has-error' : '' }}">
						<label for="mat_will_come_back" class="col-md-4 control-label">Material Status <sup class="error">*</sup></label>
						<div class="col-md-6">                                    
							<?php $mat_will_come_back = Input::old('mat_will_come_back'); ?>
							<select class="form-control" id="mat_will_come_back" name="mat_will_come_back" onchange="callby(this.value)">
								<option value="">Select Material Status</option>
								<?php foreach ($matComeBacks as $key=>$mat_will_come_back): ?>
								<option value="<?php echo $mat_will_come_back; ?>" <?php
										if (isset($mat_will_come_back) && Input::old('mat_will_come_back') == $mat_will_come_back) {
											echo 'selected="selected"';
										}
										?>><?php echo $mat_will_come_back; ?></option>
								<?php endforeach; ?>
							</select>
							@if ($errors->has('mat_will_come_back'))
								<span class="help-block">
									<strong>{{ $errors->first('mat_will_come_back') }}</strong>
								</span>
							@endif
						</div>
					</div>
					<div class="form-group{{ $errors->has('carrier_name') ? ' has-error' : '' }}">
						<label for="carrier_name" class="col-md-4 control-label">Carrier Name <sup class="error">*</sup></label>
						<div class="col-md-6">
							<input id="carrier_name" type="text" class="form-control" placeholder="Carrier Name" name="carrier_name" value="{{ old('carrier_name') }}">
							@if ($errors->has('carrier_name'))
								<span class="help-block">
									<strong>{{ $errors->first('carrier_name') }}</strong>
								</span>
							@endif
						</div>
					</div>														
					<div class="form-group{{ $errors->has('place') ? ' has-error' : '' }}">
						<label for="place" class="col-md-4 control-label">Place of Supply <sup class="error">*</sup></label>
						<div class="col-md-6">
							<input id="place" type="text" class="form-control" placeholder="Place of Supply" name="place" value="{{ old('place') }}">
							@if ($errors->has('place'))
								<span class="help-block">
									<strong>{{ $errors->first('place') }}</strong>
								</span>
							@endif
						</div>
					</div>
					<div class="form-group{{ $errors->has('vechile_number') ? ' has-error' : '' }}">
						<label for="vechile_number" class="col-md-4 control-label">Vechile Number <sup class="error">*</sup></label>
						<div class="col-md-6">
							<input onblur="return checkVechileNumber();" title="TN 00 BM 0000" maxlength='13' id="vechile_number" type="text" class="form-control" placeholder="Vechile Number" name="vechile_number" value="{{ old('vechile_number') }}">
							@if ($errors->has('vechile_number'))
								<span class="help-block">
									<strong>{{ $errors->first('vechile_number') }}</strong>
								</span>
							@endif
						</div>
					</div>
					<div class="form-group{{ $errors->has('return_date') ? ' has-error' : '' }}">
						<label for="return_date" class="col-md-4 control-label">Return Date <sup class="error">*</sup></label>
						<div class="col-md-6">
							<input id="return_date" type="text" class="form-control" placeholder="Return Date" name="return_date" value="{{ old('return_date') }}">
							@if ($errors->has('return_date'))
								<span class="help-block">
									<strong>{{ $errors->first('return_date') }}</strong>
								</span>
							@endif
						</div>
					</div>					
				</div>				
			    <div class="col-md-6">					
					<div class="form-group{{ $errors->has('challan_number') ? ' has-error' : '' }}">
						<label for="challan_number" class="col-md-4 control-label">Challan Number</label>
						<div class="col-md-6">
							<input readonly id="txt_challan_number" type="text" class="form-control" placeholder="Challan Number" name="txt_challan_number" value="{{ old('txt_challan_number') }}">
							<input id="challan_number" type="hidden" class="form-control" placeholder="Challan Number" name="challan_number" value="{{ old('challan_number') }}">							 
						</div>
					</div> 
					<div class="form-group{{ $errors->has('vendor_id') ? ' has-error' : '' }}">
						<label for="vendor_id" class="col-md-4 control-label">Vendor Name <sup class="error">*</sup></label>
						<div class="col-md-6">                                    
							<?php $vendor_id = Input::old('vendor_id'); ?>
							<select class="form-control" id="vendor_id" name="vendor_id">
								<option value="">Select Vendor</option>
								<?php foreach ($vendors as $key=>$vendor): ?>
								<option value="<?php echo $vendor->id; ?>" <?php
										if (isset($vendor_id) && Input::old('vendor_id') == $vendor->id) {
											echo 'selected="selected"';
										}
										?>><?php echo $vendor->vendor_name; ?></option>
								<?php endforeach; ?>
							</select>
							@if ($errors->has('vendor_id'))
								<span class="help-block">
									<strong>{{ $errors->first('vendor_id') }}</strong>
								</span>
							@endif
						</div>
					</div>
					<div class="form-group{{ $errors->has('address_line_1') ? ' has-error' : '' }}">
						<label for="address_line_1" class="col-md-4 control-label">Address Line</label>
						<div class="col-md-6">
							<textarea readonly name="address_line_1" id="address_line_1" class="form-control" cols="10" rows="2">{{ old('address_line_1') }}</textarea>
						</div>
					</div> 
					<div class="form-group{{ $errors->has('indentor_id') ? ' has-error' : '' }}">
						<label for="indentor_id" class="col-md-4 control-label">Indentor Name <sup class="error">*</sup></label>
						<div class="col-md-6">                                    
							<?php $indentor_id = Input::old('indentor_id'); ?>
							<select class="form-control" id="indentor_id" name="indentor_id">
								<option value="">Select Indentor</option>
								<?php foreach ($indentors as $key=>$indentor): ?>
								<option value="<?php echo $indentor->id; ?>" <?php
										if (isset($indentor_id) && Input::old('indentor_id') == $indentor->id) {
											echo 'selected="selected"';
										}
										?>><?php echo $indentor->indentor_name; ?></option>
								<?php endforeach; ?>
							</select>
							@if ($errors->has('indentor_id'))
								<span class="help-block">
									<strong>{{ $errors->first('indentor_id') }}</strong>
								</span>
							@endif
						</div>
					</div>
					<div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
						<label for="department_id" class="col-md-4 control-label">Indentor Department <sup class="error">*</sup></label>
						<div class="col-md-6">                                    
							<?php $department_id = Input::old('department_id'); ?>
							<select class="form-control" id="department_id" name="department_id">
								<option value="">Select Department</option>
								<?php foreach ($departments as $key=>$department): ?>
								<option value="<?php echo $department->id; ?>" <?php
										if (isset($department_id) && Input::old('department_id') == $department->id) {
											echo 'selected="selected"';
										}
										?>><?php echo $department->department_name; ?></option>
								<?php endforeach; ?>
							</select>
							@if ($errors->has('department_id'))
								<span class="help-block">
									<strong>{{ $errors->first('department_id') }}</strong>
								</span>
							@endif
						</div>
					</div>
					<div class="form-group{{ $errors->has('matl_belongs_to_bkn') ? ' has-error' : '' }}">
						<label for="matl_belongs_to_bkn" class="col-md-4 control-label">Matl Belongs to BKN <sup class="error">*</sup></label>
						<div class="col-md-6">                                    
							<?php $matl_belongs_to_bkn = Input::old('matl_belongs_to_bkn'); ?>
							<select class="form-control" id="matl_belongs_to_bkn" name="matl_belongs_to_bkn">
								<option value="">Select Materials</option>
								<?php foreach ($matBelongsToBkns as $key=>$matl_belongs_to_bkn): ?>
								<option value="<?php echo $matl_belongs_to_bkn; ?>" <?php
										if (isset($matl_belongs_to_bkn) && Input::old('matl_belongs_to_bkn') == $matl_belongs_to_bkn) {
											echo 'selected="selected"';
										}
										?>><?php echo $matl_belongs_to_bkn; ?></option>
								<?php endforeach; ?>
							</select>
							@if ($errors->has('matl_belongs_to_bkn'))
								<span class="help-block">
									<strong>{{ $errors->first('matl_belongs_to_bkn') }}</strong>
								</span>
							@endif
						</div>
					</div>
					<div class="form-group{{ $errors->has('insured') ? ' has-error' : '' }}">
						<label for="insured" class="col-md-4 control-label">Insured <sup class="error">*</sup></label>
						<div class="col-md-6">                                    
							<?php $insured = Input::old('insured'); ?>
							<select class="form-control" id="insured" name="insured">
								<option value="">Select Insured</option>
								<?php foreach ($insureds as $key=>$insured): ?>
								<option value="<?php echo $insured; ?>" <?php
										if (isset($insured) && Input::old('insured') == $insured) {
											echo 'selected="selected"';
										}
										?>><?php echo $insured; ?></option>
								<?php endforeach; ?>
							</select>
							@if ($errors->has('insured'))
								<span class="help-block">
									<strong>{{ $errors->first('insured') }}</strong>
								</span>
							@endif
						</div>
					</div>
				</div>
				<!--Table Start-->
				<div class="row">
					<div class="col-md-12">								
						<div class="widget-body">
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
									<tr valign="middle">
										<th rowspan="2">S.No</th>
										<th rowspan="2">Description</th>
										<th rowspan="2">HSN Code</th>
										<th rowspan="2">UOM</th>
										<th rowspan="2">QTY</th>
										<th rowspan="2">Rate</th>
										<th rowspan="2">Total</th>
										<th colspan="2" align="center">CGST</th>
										<th colspan="2" align="center">SGST</th>
										<th colspan="2" align="center">IGST</th>
										<th rowspan="2"><button type="button" class="btn-sm btn-success pull-right" onclick="addrow();"><i class="fa fa-plus"></i></button></th>
									</tr>
									<tr>
										<th>Percentage</th>
										<th>Amount</th>
										<th>Percentage</th>
										<th>Amount</th>
										<th>Percentage</th>
										<th>Amount</th>
									</tr>
									</thead>
									<tbody id="tid">
									<?php $j = 1; ?>
									@for ($i=0; $i < $count; $i++)
									<tr id="row_<?php echo $j; ?>">
										<td contenteditable="true">{{$j}}</td>
										<td contenteditable="true">
											<input id="description_<?php echo $j; ?>" type="text" class="form-control txt-items {{ $errors->has('deliveryItem.'.$i.'.description') ? ' errorItems' : '' }}" name="deliveryItem[{{ $i }}][description]" value="{{ old('deliveryItem.'.$i.'.description') }}" style="width:180px;">	
										</td>
										<td>
										<input id="hsn_code_<?php echo $j; ?>" type="text" class="form-control txt-items {{ $errors->has('deliveryItem.'.$i.'.hsn_code') ? ' errorItems' : '' }}" name="deliveryItem[{{ $i }}][hsn_code]" value="{{ old('deliveryItem.'.$i.'.hsn_code') }}" style="width:80px;">
										</td>
										<td>
											<select id="uom_<?php echo $j; ?>" class="form-control txt-items {{ $errors->has('deliveryItem.'.$i.'.uom') ? ' errorItems' : '' }}" name="deliveryItem[{{ $i }}][uom]" style="width:100px;">
												<option value="">Select Uom</option>
												<?php foreach ($uoms as $key=>$uom): ?>
												<option value="<?php echo $uom->id; ?>" <?php
														if (isset($uom) && Input::old('deliveryItem.'.$i.'.uom') == $uom->id) {
															echo 'selected="selected"';
														}
														?>><?php echo $uom->uom_name; ?></option>
												<?php endforeach; ?>
											</select>
										</td>
										<td><input onkeypress="return isNumber(event)"  onblur="totalCalculation(<?php echo $j;?>)" id="qty_<?php echo $j; ?>" type="text" class="form-control qty {{ $errors->has('deliveryItem.'.$i.'.qty') ? ' errorItems' : '' }}" name="deliveryItem[{{ $i }}][qty]" value="{{ old('deliveryItem.'.$i.'.qty') }}" style="width:60px;"></td>
										<td><input onkeypress="return isNumberKey(this, event)"  onblur="totalCalculation(<?php echo $j;?>)" id="rate_<?php echo $j; ?>" type="text" class="form-control rate {{ $errors->has('deliveryItem.'.$i.'.rate') ? ' errorItems' : '' }}" name="deliveryItem[{{ $i }}][rate]" value="{{ old('deliveryItem.'.$i.'.rate') }}" style="width:60px;"></td>
										<td><input id="total_<?php echo $j; ?>" type="hidden" class="form-control" name="deliveryItem[{{ $i }}][total]" value="{{ old('deliveryItem.'.$i.'.total') }}" style="width:60px;"><input readonly id="txt_total_<?php echo $j; ?>" type="text" class="form-control total" name="deliveryItem[{{ $i }}][txt_total]" value="{{ old('deliveryItem.'.$i.'.txt_total') }}" style="width:80px;"></td>
										<td><input onkeypress="return isNumberKey(this, event)" onblur="cGSTTotCalculation(<?php echo $j;?>)" id="c_percentage_<?php echo $j; ?>" type="text" class="form-control cPercentage {{ $errors->has('deliveryItem.'.$i.'.c_percentage') ? ' errorItems' : '' }}" name="deliveryItem[{{ $i }}][c_percentage]" value="{{ old('deliveryItem.'.$i.'.c_percentage') }}"></td>
										<td><input readonly id="txt_c_amount_<?php echo $j; ?>" type="text" class="form-control" name="deliveryItem[{{ $i }}][txt_c_amount]" value="{{ old('deliveryItem.'.$i.'.txt_c_amount') }}" style="width:80px;"><input id="c_amount_<?php echo $j; ?>" type="hidden" class="form-control cgstTotal" name="deliveryItem[{{ $i }}][c_amount]" value="{{ old('deliveryItem.'.$i.'.c_amount') }}"></td>
										<td><input onkeypress="return isNumberKey(this, event)" onblur="sGSTTotCalculation(<?php echo $j;?>)" id="s_percentage_<?php echo $j; ?>" type="text" class="form-control sPercentage {{ $errors->has('deliveryItem.'.$i.'.s_percentage') ? ' errorItems' : '' }}" name="deliveryItem[{{ $i }}][s_percentage]" value="{{ old('deliveryItem.'.$i.'.s_percentage') }}"></td>
										<td><input readonly id="txt_s_amount_<?php echo $j; ?>" type="text" class="form-control" name="deliveryItem[{{ $i }}][txt_s_amount]" value="{{ old('deliveryItem.'.$i.'.txt_s_amount') }}" style="width:80px;"><input id="s_amount_<?php echo $j; ?>" type="hidden" class="form-control sgstTotal" name="deliveryItem[{{ $i }}][s_amount]" value="{{ old('deliveryItem.'.$i.'.s_amount') }}"></td>
										<td><input onkeypress="return isNumberKey(this, event)" onblur="iGSTTotCalculation(<?php echo $j;?>)" id="i_percentage_<?php echo $j; ?>" type="text" class="form-control iPercentage {{ $errors->has('deliveryItem.'.$i.'.i_percentage') ? ' errorItems' : '' }}" name="deliveryItem[{{ $i }}][i_percentage]" value="{{ old('deliveryItem.'.$i.'.i_percentage') }}"></td>
										<td><input readonly id="txt_i_amount_<?php echo $j; ?>" type="text" class="form-control" name="deliveryItem[{{ $i }}][txt_i_amount]" value="{{ old('deliveryItem.'.$i.'.txt_i_amount') }}" style="width:80px;"><input id="i_amount_<?php echo $j; ?>" type="hidden" class="form-control igstTotal" name="deliveryItem[{{ $i }}][i_amount]" value="{{ old('deliveryItem.'.$i.'.i_amount') }}"></td>
										<td>@if($j > 1)<button type="button" class="btn-sm btn-danger" onclick="remove(<?php echo $j; ?>)"><i class='fa fa-remove'></i></button>@endif</td>
									</tr>
									<?php $j++ ; ?>
									@endfor
									<input type="hidden" value=1 id="units">
									</tbody>
									</tfoot>
									<tr>
										<td><?php $k = 0; ?></td>
										<td colspan="3"></td>
										<td colspan="2" style="text-align:right;"><strong>Sub Total</strong></td>
										<td> 
										<input readonly id="sub_total" type="text" class="form-control" name="deliveryItem[{{ $k }}][sub_total]" value="{{ old('deliveryItem.'.$k.'.sub_total') }}" style="width:80px;">
										<input id="txt_sub_total" type="hidden" class="form-control allGstTotal" name="deliveryItem[{{ $k }}][txt_sub_total]" value="{{ old('deliveryItem.'.$k.'.txt_sub_total') }}" style="width:80px;"></td>
										<td><strong>CGST Amount</strong></td>
										<td>
										<input readonly id="cgst_total" type="text" class="form-control" name="deliveryItem[{{ $k }}][cgst_total]" value="{{ old('deliveryItem.'.$k.'.cgst_total') }}" style="width:80px;">
										<input id="txt_cgst_total" type="hidden" class="form-control allGstTotal" name="deliveryItem[{{ $k }}][txt_cgst_total]" value="{{ old('deliveryItem.'.$k.'.txt_cgst_total') }}" style="width:80px;"></td>
										<td><strong>SGST Amount</strong></td>
										<td><!--<span id="sgst_total"></span>-->
										<input readonly id="sgst_total" type="text" class="form-control" name="deliveryItem[{{ $k }}][sgst_total]" value="{{ old('deliveryItem.'.$k.'.sgst_total') }}" style="width:80px;">
										<input id="txt_sgst_total" type="hidden" class="form-control allGstTotal" name="deliveryItem[{{ $k }}][txt_sgst_total]" value="{{ old('deliveryItem.'.$k.'.txt_sgst_total') }}" style="width:80px;"></td>
										<td><strong>IGST Amount</strong></td>
										<td><!--<span id="igst_total"></span>-->
										<input readonly id="igst_total" type="text" class="form-control" name="deliveryItem[{{ $k }}][igst_total]" value="{{ old('deliveryItem.'.$k.'.igst_total') }}" style="width:80px;">
										<input id="txt_igst_total" type="hidden" class="form-control allGstTotal" name="deliveryItem[{{ $k }}][txt_igst_total]" value="{{ old('deliveryItem.'.$k.'.txt_igst_total') }}" style="width:80px;"></td>
										<td></td>
									</tr>
									<tr>
										<td></td>
										<td colspan="6" style="text-align:right;"><strong>Grant Total</strong></td>
										<td colspan="1"><!--<span id="all_gst_total"></span>-->
										<input readonly id="all_gst_total" type="text" class="form-control" name="deliveryItem[{{ $k }}][all_gst_total]" value="{{ old('deliveryItem.'.$k.'.all_gst_total') }}" _style="width:60px;">
										<input id="txt_all_gst_total" type="hidden" class="form-control" name="deliveryItem[{{ $k }}][txt_all_gst_total]" value="{{ old('deliveryItem.'.$k.'.txt_all_gst_total') }}" _style="width:60px;"></td>
										<td colspan="6"></td>
									</tr>
									</tfoot>
								</table>
							</div>
						</div>								
					</div>
				</div>
				<!-- End Table-->
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
<script type="text/javascript">
	$("#vendor_id").change(function(e){
		e.preventDefault();
		var _token = $("input[name='_token']").val();
		var vendorId = $("#vendor_id").val();
		//alert(departmentId);
		$.ajax({
			url: "{{URL::TO('/delivery_note/vendor_list')}}",
			type:'POST',
			data: { _token:_token, vendorId:vendorId },
			dataType: 'JSON',
			success: function(data) {
				//alert(data.department_name);
				if(data.status == "success"){
					$("#address_line_1").val(data.vendor_details); 	                	
				}else{
					//alert('Please select i');
				} 
			}
		});
	}); 
	
	$("#mat_will_come_back").change(function(e){
		e.preventDefault();
		var _token = $("input[name='_token']").val();
		var material_id = $("#mat_will_come_back").val();
		$.ajax({
			url: "{{URL::TO('/delivery_note/material')}}",
			type:'POST',
			data: { _token:_token, material_id:material_id },
			dataType: 'JSON',
			success: function(data) {
				//alert(data.challan_number);
				if(data.status == "success"){
					$("#challan_number").val(data.challan_number); 	                	
					$("#txt_challan_number").val(data.challan_number); 	                	
				}else{
					//alert('Please select i');
				} 
			}
		});
	}); 
	
	$(document).ready(function(){
		//var indentorId = $("#indentor_id").val();
		//alert(indentorId);
		$('#vendor_id').trigger('change');
		$('#mat_will_come_back').trigger('change');
	}); 

	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}

	function isNumberKey(txt, evt) {

		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode == 46) {
			//Check if the text already contains the . character
			if (txt.value.indexOf('.') === -1) {
				return true;
			} else {
				return false;
			}
		} else {
			if (charCode > 31
				&& (charCode < 48 || charCode > 57))
				return false;
		}
		return true;
	}


	function addrow() {
		var unit=$("#units").val();
		//alert(unit);
		unit++;								
		$("#tid").append("<tr id='row_"+unit+"'><td>"+unit+"</td><td><input id='description_"+unit+"' type='text' class='form-control' name='deliveryItem["+unit+"][description]' value=''></td><td><input id='hsn_code_"+unit+"' type='text' class='form-control' name='deliveryItem["+unit+"][hsn_code]' value=''></td><td><select id='uom_"+unit+"' class='form-control' name='deliveryItem["+unit+"][uom]'><option value=\"\">Select Uom</option><?php foreach ($uoms as $key=>$uom): ?><option value=\"<?php echo $uom->id; ?>\" <?php if (isset($uom) && Input::old('uom') == $uom->id) { echo 'selected=\"selected\"'; } ?>><?php echo $uom->uom_name; ?></option><?php endforeach; ?></select></td><td><input onkeypress='return isNumber(event)' onblur='totalCalculation("+unit+")' id='qty_"+unit+"' type='text' class='form-control qty' name='deliveryItem["+unit+"][qty]' value=''></td><td><input onkeypress='return isNumberKey(this, event)' onblur='totalCalculation("+unit+")' id='rate_"+unit+"' type='text' class='form-control rate' name='deliveryItem["+unit+"][rate]' value=''></td><td><input disabled id='txt_total_"+unit+"' type='text' class='form-control' name='deliveryItem["+unit+"][txt_total]' value=''><input id='total_"+unit+"' type='hidden' class='form-control total' name='deliveryItem["+unit+"][total]' value=''></td><td><input onkeypress='return isNumberKey(this, event)' onblur='cGSTTotCalculation("+unit+")' id='c_percentage_"+unit+"' type='text' class='form-control cPercentage' name='deliveryItem["+unit+"][c_percentage]' value=''></td><td><input disabled id='txt_c_amount_"+unit+"' type='text' class='form-control' name='deliveryItem["+unit+"][txt_c_amount]' value=''><input id='c_amount_"+unit+"' type='hidden' class='form-control cgstTotal' name='deliveryItem["+unit+"][c_amount]' value=''></td><td><input onkeypress='return isNumberKey(this, event)' onblur='sGSTTotCalculation("+unit+")' id='s_percentage_"+unit+"' type='text' class='form-control' name='deliveryItem["+unit+"][s_percentage]' value=''></td><td><input disabled id='txt_s_amount_"+unit+"' type='text' class='form-control' name='deliveryItem["+unit+"][txt_s_amount]' value=''><input id='s_amount_"+unit+"' type='hidden' class='form-control sgstTotal' name='deliveryItem["+unit+"][s_amount]' value=''>   </td><td><input onkeypress='return isNumberKey(this, event)' onblur='iGSTTotCalculation("+unit+")' id='i_percentage_"+unit+"' type='text' class='form-control' name='deliveryItem["+unit+"][i_percentage]' value=''></td><td><input disabled id='txt_i_amount_"+unit+"' type='text' class='form-control' name='deliveryItem["+unit+"][txt_i_amount]' value=''><input id='i_amount_"+unit+"' type='hidden' class='form-control igstTotal' name='deliveryItem["+unit+"][i_amount]' value=''></td><td><button type='button' class='btn-sm btn-danger' onclick='remove("+unit+")'><i class='fa fa-remove'></i></button></td></tr>");		
		$("#units").val(unit);
	}	
	function remove(id){
		
		$("#row_"+id).remove();
		deleteTotalCalculation();
				 
	}

	$(document).ready(function(){

		//this calculates values automatically 
		//subTotalCalculation();

		$(".total").on("keydown keyup", function() {
			subTotalCalculation();
		});

		 $( "#return_date" ).datepicker({
            minDate: 0
          });
	});

	function totalCalculation(id){

		   //alert("total" + id);

		   var total = 0; 
		   var qty = jQuery("input[id=qty_"+id+"]").val();	
		   var rate = jQuery("input[id=rate_"+id+"]").val();
		   var total = qty * rate;
		   jQuery("input[id=total_"+id+"]").val(total.toFixed(2));
		   jQuery("input[id=txt_total_"+id+"]").val(total.toFixed(2));
		   //alert("Total " + total);
		   subTotalCalculation();
		   cGSTTotCalculation(id);
		   sGSTTotCalculation(id);
		   iGSTTotCalculation(id);
		   allGsTSubTotalCalculation();
	}

	function cGSTTotCalculation(id){
		   var cGstTotal = 0; 
		   var total = jQuery("input[id=total_"+id+"]").val();
		   var cPercentage = jQuery("input[id=c_percentage_"+id+"]").val();
		   var cGstTotal = total * cPercentage / 100;
		   //alert("CGST Total " + total + cPercentage + cGstTotal);	
		   jQuery("input[id=c_amount_"+id+"]").val(cGstTotal.toFixed(2));
		   jQuery("input[id=txt_c_amount_"+id+"]").val(cGstTotal.toFixed(2));

		   cGstSubTotalCalculation();
		   allGsTSubTotalCalculation();	   	   		   	
	}

	function sGSTTotCalculation(id){
		   var sGstTotal = 0; 
		   var total = jQuery("input[id=total_"+id+"]").val();
		   var sPercentage = jQuery("input[id=s_percentage_"+id+"]").val();
		   var sGstTotal = total * sPercentage / 100;
		   jQuery("input[id=s_amount_"+id+"]").val(sGstTotal.toFixed(2));
		   jQuery("input[id=txt_s_amount_"+id+"]").val(sGstTotal.toFixed(2));
		   //alert("SGST Total " + sGstTotal);

		   sGstSubTotalCalculation();
		   allGsTSubTotalCalculation();	   	   		   	
	}

	function iGSTTotCalculation(id){
		   var iGstTotal = 0; 
		   var total = jQuery("input[id=total_"+id+"]").val();
		   var iPercentage = jQuery("input[id=i_percentage_"+id+"]").val();
		   var iGstTotal = total * iPercentage / 100;
		   jQuery("input[id=i_amount_"+id+"]").val(iGstTotal.toFixed(2));
		   jQuery("input[id=txt_i_amount_"+id+"]").val(iGstTotal.toFixed(2));
		   //alert("IGST Total " + iGstTotal);
		   
		   iGstSubTotalCalculation();
		   allGsTSubTotalCalculation();	   	   		   	
	}

	function subTotalCalculation() {
		
		var sum = 0;
		//iterate through each textboxes and add the values
		$(".total").each(function() {
			//add only if the value is number
			if (!isNaN(this.value) && this.value.length != 0) {
				//alert(parseFloat(this.value));
				sum += parseFloat(this.value);
			}			 
		});

		//$("#sub_total").html(sum.toFixed(2));
		$("#sub_total").val(sum.toFixed(2));
		$("#txt_sub_total").val(sum.toFixed(2));
	}

	function cGstSubTotalCalculation() {
		
		var sum = 0;
		//iterate through each textboxes and add the values
		$(".cgstTotal").each(function() {
			//add only if the value is number
			if (!isNaN(this.value) && this.value.length != 0) {
				//alert(parseFloat(this.value));
				sum += parseFloat(this.value);
			}			 
		});

		//$("#cgst_total").html(sum.toFixed(2));
		$("#cgst_total").val(sum.toFixed(2));
		$("#txt_cgst_total").val(sum.toFixed(2));
	}

	function sGstSubTotalCalculation() {
		
		var sum = 0;
		//iterate through each textboxes and add the values
		$(".sgstTotal").each(function() {
			//add only if the value is number
			if (!isNaN(this.value) && this.value.length != 0) {
				//alert(parseFloat(this.value));
				sum += parseFloat(this.value);
			}			 
		});

		//$("#sgst_total").html(sum.toFixed(2));
		$("#sgst_total").val(sum.toFixed(2));
		$("#txt_sgst_total").val(sum.toFixed(2));
	}

	function iGstSubTotalCalculation() {
		
		var sum = 0;
		//iterate through each textboxes and add the values
		$(".igstTotal").each(function() {
			//add only if the value is number
			if (!isNaN(this.value) && this.value.length != 0) {
				//alert(parseFloat(this.value));
				sum += parseFloat(this.value);
			}			 
		});

		//$("#igst_total").html(sum.toFixed(2));
		$("#igst_total").val(sum.toFixed(2));
		$("#txt_igst_total").val(sum.toFixed(2));
	}

	function allGsTSubTotalCalculation() {
		
		var sum = 0;
		//iterate through each textboxes and add the values
		$(".allGstTotal").each(function() {
			//add only if the value is number
			if (!isNaN(this.value) && this.value.length != 0) {
				//alert(parseFloat(this.value));
				sum += parseFloat(this.value);
			}			 
		});

		//$("#all_gst_total").html(sum.toFixed(2));
		$("#all_gst_total").val(sum.toFixed(2));
		$("#txt_all_gst_total").val(sum.toFixed(2));
	}

	function deleteTotalCalculation() {
		//alert('deleteTotalCalculation');
		var totSum = cgstSum = sgstSum = igstSum = allGstSum = 0;
		
		//iterate through each textboxes and add the values
		$(".total").each(function() {
			//add only if the value is number
			if (!isNaN(this.value) && this.value.length != 0) {
				//alert(parseFloat(this.value));
				totSum += parseFloat(this.value);
			}			 
		});
		
		//iterate through each textboxes and add the values
		$(".cgstTotal").each(function() {
			//add only if the value is number
			if (!isNaN(this.value) && this.value.length != 0) {
				//alert(parseFloat(this.value));
				cgstSum += parseFloat(this.value);
			}			 
		});

		//iterate through each textboxes and add the values
		$(".sgstTotal").each(function() {
			//add only if the value is number
			if (!isNaN(this.value) && this.value.length != 0) {
				//alert(parseFloat(this.value));
				sgstSum += parseFloat(this.value);
			}			 
		});
		
		//iterate through each textboxes and add the values
		$(".igstTotal").each(function() {
			//add only if the value is number
			if (!isNaN(this.value) && this.value.length != 0) {
				//alert(parseFloat(this.value));
				igstSum += parseFloat(this.value);
			}			 
		});

		$("#sub_total").val(totSum.toFixed(2));
		$("#txt_sub_total").val(totSum.toFixed(2));

		$("#cgst_total").val(cgstSum.toFixed(2));
		$("#txt_cgst_total").val(cgstSum.toFixed(2));

		$("#sgst_total").val(sgstSum.toFixed(2));
		$("#txt_sgst_total").val(sgstSum.toFixed(2));

		$("#igst_total").val(igstSum.toFixed(2));
		$("#txt_igst_total").val(igstSum.toFixed(2));

		//iterate through each textboxes and add the values
		$(".allGstTotal").each(function() {
			//add only if the value is number
			if (!isNaN(this.value) && this.value.length != 0) {
				//alert(parseFloat(this.value));
				allGstSum += parseFloat(this.value);
			}			 
		});

		$("#all_gst_total").val(allGstSum.toFixed(2));
		$("#txt_all_gst_total").val(allGstSum.toFixed(2));
	}

</script>	

@endsection


