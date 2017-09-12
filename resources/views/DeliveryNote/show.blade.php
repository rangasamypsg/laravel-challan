@extends('layouts.app')

@section('content')
<?php
//echo "<pre>";
//print_r($deliveryNote);
?>
<div class="col-md-12">
	<div class="widget p-lg">
		<div class="widget-body">
			<div class="table-responsive" id="divToPrint">
				<table class="table table-bordered" style="table-layout: fixed;overflow: auto;">
					<tr>
						<th colspan="2">DELIVERY CHALLAN</th>
						<th colspan="2">ORIGINAL / DUPLICATE / TRIPLICATE</th>										
					</tr>
					<tbody>
						<tr>
							<td colspan="2" rowspan="3"><strong>Bradken India Private Limited,</strong><br> No. 191/3 & 191/4, Chettipalayam-Palladam Rd., Orathukuppai Village, Chettipalayam, Coimbatore 641201, TN, India.</td>									
							<th>Financial Year</th>
							<td>{{ (($deliveryNote->financial_year) ? $deliveryNote->financial_year : '')  }}</td>										
						</tr>
						<tr>
							
							<th>Challan No:</th>
							<td>{{ (($deliveryNote->challan_number) ? $deliveryNote->challan_number : '')  }}</td>										
						</tr>
						<tr>
																
							<th>Challan Date:</th>
							<td>{{ (($deliveryNote->challan_date) ? $deliveryNote->challan_date : '')  }}</td>										
						</tr>
						<tr>
							<th>PAN Number:</th>
							<td>AAGCB1555J</td>
							<!--<th>Currency:</th>
							<td>{{ (($deliveryNote->challan_date) ? $deliveryNote->challan_date : '')  }}</td> -->
							<th>Vechile No:</th>
							<td>{{ (($deliveryNote->vechile_number) ? $deliveryNote->vechile_number : '')  }}</td>																			
						</tr>
						<tr>
							<th>GST Number:</th>
							<td>33AAGCB1555J1Z</td>
							<th>Place of Supply:</th>
							<td>{{ (($deliveryNote->place) ? $deliveryNote->place : '')  }}</td>
						</tr>
						<tr>
							<th>CIN Number:</th>
							<td>U13203TZ2015FTC028156</td>
							<th>GST Number:</th>
							<td>{{ (($deliveryNote->gst_number) ? $deliveryNote->gst_number : '')  }}</td>	
						</tr>
						<tr>
							<th colspan="2">NAME & ADDRESS OF CONSIGNEE</th>										
							<th>@if($deliveryNote->indentor_name !='') Indentor: @endif</th>
							<td>@if($deliveryNote->indentor_name !='') {{ (($deliveryNote->indentor_name) ? $deliveryNote->indentor_name : '')  }} @endif</td>	
						</tr>
						<tr>
							<th>Vendor Name:</th>
							<td>{{ $deliveryNote->vendor_name }}</td>	
							<th>@if($deliveryNote->department_name !='') Indentor Department: @endif</th>
							<td>@if($deliveryNote->department_name !='') {{ (($deliveryNote->department_name) ? $deliveryNote->department_name : '')  }} @endif </td>
						</tr>
						<tr>
							<th>Carrier Name:</th>
							<td>{{ (($deliveryNote->carrier_name) ? $deliveryNote->carrier_name : '')  }}</td>	
							<th>@if($deliveryNote->insured !='') Insured: @endif</th>
							<td>@if($deliveryNote->insured !='') {{ (($deliveryNote->insured) ? $deliveryNote->insured : '')  }} @endif</td>
						</tr>
						<tr>
							<th>Address</th>
							<td>{{ (($deliveryNote->address_line_1) ? $deliveryNote->address_line_1 : '')  }} {{ (($deliveryNote->address_line_2) ? $deliveryNote->address_line_2 : '')  }} {{ (($deliveryNote->postal_code) ? $deliveryNote->postal_code : '')  }}</td>	
							<th>@if($deliveryNote->matl_belongs_to_bkn !='') Matl Belongs to BKN: @endif</th>
							<td>@if($deliveryNote->matl_belongs_to_bkn !='') {{ (($deliveryNote->matl_belongs_to_bkn) ? $deliveryNote->matl_belongs_to_bkn : '')  }} @endif</td>
						</tr>
						<tr>
							<th>State:</th>
							<td>{{ (($deliveryNote->state_name) ? $deliveryNote->state_name : '')  }}</td>	
							<td rowspan="3" colspan="2">REGISTRED OFFICE<br><strong>Bradken India Private Limited</strong>,<br>No. 191/3 & 191/4, Chettipalayam-Palladam Rd., Orathukuppai Village, Chettipalayam, Coimbatore 641201, TN, India.		</td>										
						</tr>
						<tr>
							<th>State Code:</th>
							<td>{{ (($deliveryNote->state_code) ? $deliveryNote->state_code : '')  }}</td>							
						</tr>
						<tr>										
							<th>GSTIN Number:</th>
							<td>{{ (($deliveryNote->gst_number) ? $deliveryNote->gst_number : '')  }}</td>
						</tr>
					</tbody>								
				</table>
				<br>
				<table class="table table-bordered">
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
						</tr>
						<tr>										
							<td>Percentage</td>
							<td>Amount</td>
							<td>Percentage</td>
							<td>Amount</td>
							<td>Percentage</td>
							<td>Amount</td>
						</tr>

						@foreach ($deliveryItems as $key => $deliveryItem) 
						<tr>
							<td>{{ ++$key }}</td>
							<td>{{ (($deliveryItem->description) ? $deliveryItem->description : '')  }}</td>
							<td>{{ (($deliveryItem->hsn_code) ? $deliveryItem->hsn_code : '')  }}</td>
							<td>{{ (($deliveryItem->uom_name) ? $deliveryItem->uom_name : '')  }}</td>
							<td>{{ (($deliveryItem->qty) ? $deliveryItem->qty : '')  }}</td>
							<td>{{ (($deliveryItem->rate) ? $deliveryItem->rate : '')  }}</td>
							<td>{{ (($deliveryItem->total) ? sprintf("%01.2f", $deliveryItem->total) : '')  }}</td>
							<td>{{ (($deliveryItem->c_percentage) ? $deliveryItem->c_percentage : '')  }}</td>
							<td>{{ (($deliveryItem->c_amount) ? sprintf("%01.2f", $deliveryItem->c_amount) : '')  }}</td>
							<td>{{ (($deliveryItem->s_percentage) ? $deliveryItem->s_percentage : '')  }}</td>
							<td>{{ (($deliveryItem->s_amount) ? sprintf("%01.2f", $deliveryItem->s_amount) : '')  }}</td>
							<td>{{ (($deliveryItem->i_percentage) ? $deliveryItem->i_percentage : '')  }}</td>
							<td>{{ (($deliveryItem->i_amount) ? sprintf("%01.2f", $deliveryItem->i_amount) : '')  }}</td>										
						</tr>
						@endforeach
						<tr>
							<td></td>
							<td colspan="4" align="right"><strong>Total Amount</strong></td>
							<td colspan="2">{{ (($deliveryItems[0]->sub_total) ? sprintf("%01.2f", $deliveryItems[0]->sub_total) : '')  }}</td>
							<td><strong>CGST Amount</strong></td>
							<td>{{ (($deliveryItems[0]->cgst_total) ? sprintf("%01.2f", $deliveryItems[0]->cgst_total) : '')  }}</td>
							<td><strong>SGST Amount</strong></td>
							<td>{{ (($deliveryItems[0]->sgst_total) ? sprintf("%01.2f", $deliveryItems[0]->sgst_total) : '')  }}</td>
							<td><strong>IGST Amount</strong></td>										
							<td>{{ (($deliveryItems[0]->igst_total) ? sprintf("%01.2f", $deliveryItems[0]->igst_total) : '')  }}</td>
						</tr>						
						<tr>
							<td></td>
							<td colspan="6" align="right"><strong>Grant Total Amount</strong></td>
							<td colspan="7">{{ (($deliveryItems[0]->all_gst_total) ? sprintf("%01.2f", $deliveryItems[0]->all_gst_total) : '')  }}</td>
						</tr>
						<tr>
							<th colspan="5">Expected Duration of Processing / Manufacturing</th>
							<td colspan="2">{{ date('d-m-Y') }}</td>
							<th colspan="3">Nature of Job Work Processing:</th>
							<td colspan="3">Machining & Painting</td>
						</tr>
						<tr>
							<td colspan="1">Place:</td>
							<td colspan="3">Coimbatore</td>
							<td colspan="5"></td>
							<td colspan="5"></td>
						</tr>
						<tr>
							<td colspan="1">Date:</td>
							<td colspan="3">{{ date('d-m-Y') }}</td>
							<td colspan="5"></td>
							<td colspan="5"></td>
						</tr>
						<tr>
							<th colspan="7">Declaration:</th>
							<td colspan="6" rowspan="2">Note: 1. Goods will be deemed to have been received correctly, if any discrepancy is not intimated to us within 24 hours of the receipt of material.<br>2. Not for sale, tranfer of goods to Sub contractors for Job Works Only.</td>										
						</tr>
						<tr>
							<td colspan="7">We declare that this Challan shows the actual price of the goods and services described and that all particulars are true and correct.</td>																				
						</tr>
						<tr>
							<td colspan="7" rowspan="2"><br><br></td>
							<td colspan="6" rowspan="2"><br><br></td>										
						</tr>
						<tr>
									
						</tr>									
						<tr>
							<th colspan="7">Authorised Signature</th>
							<th colspan="6">For Bradken India Private Limited</td>					
						</tr>
					</table>
			</div>
			<div class="row">
				<div class="col-sm-3 col-sm-push-9">									
					<div class="m-t-lg">
						<!--<button type="button" class="btn btn-md btn-primary m-r-lg">Send Invoice</button>-->
						<!--<button type="button" class="btn btn-md btn-default" name="print" onclick="PrintDiv();">Print</button>-->
					</div>
				</div>
			</div>
		</div>
	</div>								
</div>
<script type="text/javascript">
	function PrintDiv() {    
        var divToPrint = document.getElementById('divToPrint');
        var popupWin = window.open('', '_blank', 'width=300,height=300');
        popupWin.document.open();
        popupWin.document.write('<p style="text-align:center;"><img src="{{ asset('assets/images/invoice-logo.png') }}" style="height: 50px;"></p>');
        popupWin.document.write('<h2 style="font-family: Open Sans, sans-serif;color: #c8b5a1;text-align: center;">BRADKEN - DELIVERY CHALLAN</h2>');
        popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');        
        popupWin.document.write('<style type="text/css">table{width: 100%; text-align: center; margin: auto;} td{border:1px solid black; border-collapse: collapse;} th{border:1px solid black; border-collapse: collapse; background-color: #DCE6F2;} h1,h2,h3,h4,h5,h6{text-align: center;}</style>');
        popupWin.document.close();  
    }
</script>
@endsection