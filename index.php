<?php
include "generate_invoice.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Invoice | Eruvaka Technologies</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div id="page-wrap" class="invoice-body">
		<form method="post" action="" id="invoice_form">
		<div id="identity">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-7">
							<div id="logo" class="pull-left">
								  <div id="logoctr">
									<a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
									<a href="javascript:;" id="save-logo" title="Save changes">Save</a>
									|
									<a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
									<a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
								  </div>

								  <div id="logohelp">
									<input id="imageloc" type="text" size="50" value="" /><br />
									(max width: 540px, max height: 100px)
								  </div>
								  <img id="image" src="images/logo.png" alt="logo" />
							</div>
						</div>
						<div class="col-md-5">
							<div class="pull-right form-horizontal">
								  <div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
									<div class="col-sm-6">
									  <input type="text" class="ph_input" value='9908963863' id="phone" name="phone" placeholder="Phone">
									</div>
								  </div>
								  <div class="form-group">
									<label for="inputPassword3" class="col-sm-2 control-label">TIN</label>
									<div class="col-sm-6">
									  <input type="text" class="ph_input" value='37218872778' id="tin" name="tin" placeholder="TIN">
									</div>
								  </div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-7">
							<input type="text" id="our_company" name="our_company" value="Eruvaka Technologies Pvt Ltd"/>
							<textarea name="our_address" id="our_address">5th floor, Sri Hari Towers, NH5 Frontage Rd, K P Nagar, Vijayawada - 520008, India</textarea>
						</div>
						<div class="col-md-5">
							<div class="pull-right form-horizontal">
								  <div class="form-group">
									<label for="inputEmail3" class="col-sm-4 control-label">Date</label>
									<div class="col-sm-8">
									  <input value='<?php echo date("Y-m-d"); ?>' style="width: 50%" name="order_date" id="order_date" placeholder='Date' type='text'>
									</div>
								  </div>
								  <div class="form-group">
									<label for="inputPassword3" class="col-sm-4 control-label">Invoice #</label>
									<div class="col-sm-8">
									  <input value='1234567890' style="width: 50%" name="order_number" id="order_number" placeholder='Quotation number' type='text'>
									</div>
								  </div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<label style="width:100%; text-align:center;"><input style=" width:50%; margin:20px 25% 0; text-align:center;  line-height:30px; font-size:20px; font-weight:bold;" value="Proforma Invoice" name="invoice_title" id="invoice_title" type="text" placeholder="Proforma Invoice"/></label>
				</div>
			</div>
		</div>
		
		<div style="clear:both"></div>
		<br>
		<div id="customer">
			<div class='row'>
				<div class='col-md-6'>
					<h4 style="margin-top: 0px;">Billing Address</h4>
					<div class='form-row'>
					  <div class='col-xs-12 form-group required'>
						<input name="billing_company" id="billing_company" placeholder="Company name" type='text'>
					  </div>
					</div>
					 <div class='form-row'>
					  <div class='col-xs-12 form-group card required'>
						<input name="billing_address" id="billing_address" placeholder="Address line 1" type='text'>
					  </div>
					</div>
					<div class='form-row'>
					  <div class='col-xs-12 form-group card required'>
						<input name="billing_address2" id="billing_address2" placeholder="Address line 2 (Optional)" type='text'>
					  </div>
					</div>
					<div class='form-row'>
					  <div class='col-xs-7 form-group cvc required'>
						<input name="billing_city" id="billing_city" class='city' placeholder='City' type='text'>
					  </div>
					  <div class='col-xs-5 form-group expiration required'>
						<input name="billing_pin" id="billing_pin" class='allownumeric' placeholder='PIN Code' type='text'>
					  </div>
					</div>
					<div class='form-row'>
					  <div class='col-xs-7 form-group card required'>
						<input name="billing_country" id="billing_country" placeholder="Country" type='text'>
					  </div>
					  <div class='col-xs-5 form-group card required'>
						<input name="billing_tin" id="billing_tin" placeholder="TIN" type='text'>
					  </div>
					</div>
					<div class="form-row">
						<div class="form-group col-xs-12">
						  <div class="checkbox">
							<label>
							  <input style="width: auto;" type="checkbox" class="same_as_billing"> Shipping Address same as Billing Address
							</label>
						  </div>
						</div>
					</div>
				</div>
				<div class='col-md-6'>
					<h4 style="margin-top: 0px;">Shipping Address</h4>
					<div class='form-row'>
					  <div class='col-xs-12 form-group required'>
						<input name="shipping_company" id="shipping_company" placeholder="Company name" type='text'>
					  </div>
					</div>
					 <div class='form-row'>
					  <div class='col-xs-12 form-group card required'>
						<input name="shipping_addr" id="shipping_addr" placeholder="Address line 1" type='text'>
					  </div>
					</div>
					<div class='form-row'>
					  <div class='col-xs-12 form-group card required'>
						<input name="shipping_address2" id="shipping_address2" placeholder="Address line 2 (Optional)" type='text'>
					  </div>
					</div>
					<div class='form-row'>
					  <div class='col-xs-7 form-group cvc required'>
						<input name="shipping_city" id="shipping_city" class='city' placeholder='City' type='text'>
					  </div>
					  <div class='col-xs-5 form-group expiration required'>
						<input name="shipping_pin" id="shipping_pin" class='allownumeric' placeholder='PIN Code' type='text'>
					  </div>
					</div>
					<div class='form-row'>
					  <div class='col-xs-12 form-group card required'>
						<input name="shipping_country" id="shipping_country" placeholder="Country" type='text'>
					  </div>
					</div>
				</div>
			</div>		
		</div>
		
		<table id="items">
		
		  <tr>
		      <th>SNO</th>
		      <th>Description</th>
			  <th>Quantity</th>
		      <th>Rate/Unit (INR)</th>
		      <th>Amount (INR)</th>
		  </tr>
		  
		  <tr class="item-row">
		      <td class="item-name"><div class="delete-wpr"><span class="sno">1</span><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>
		      <td class="description"><textarea name="item_description[]" class="item-description"></textarea></td>
		      <td><input type="text" name="quantity[]" value="0" class="qty allownumeric" placeholder="Quantity"/></td>
			  <td><input type="text" name="unit_cost[]" value="0" class="price allownumeric" placeholder="Rate/Unit"/></td>
		      <td><span class="amount">0.0</span><input type="hidden" class="total-amount" name="total_amount[]"/></td>
		  </tr>
		  
		  <tr id="hiderow">
		    <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row"><b>Add a row</b></a></td>
		  </tr>
		  
		  <tr>
		    <td colspan="2" class="blank">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Bank</label>
					<div class="col-sm-10">
					  <input id="our_bank_name" name="our_bank_name" value="Eruvaka Technologies Pvt Ltd,HDFC Bank,Vijayawada" placeholder='Bank name, Branch' type='text'>
					</div>
				</div>
			</td>
		    <td colspan="2" class="total-line">Subtotal (INR)</td>
		    <td class="total-value"><div id="subtotal">0.0</div><input type="hidden" name="sub_total" id="sub_total"/></td>
		  </tr>
		  <tr>
			<td colspan="2" class="blank">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">IFSC</label>
					<div class="col-sm-10">
					  <input id="our_ifsc_code" value='HDFC0000109' name="our_ifsc_code" style="width: 50%" placeholder='IFSC CODE' type='text'>
					</div>
				</div>
			</td>
		    <td colspan="2" class="total-line">Central Excise (%)</td>
		    <td class="total-value"><input placeholder='Excise' class="allownumeric" style="width: 40%" name="central_excise" value="0" id="central_excise" type='text'>=<span class="excise_rs">INR0.0</span><input type="hidden" name="central_excise_rs" id="central_excise_rs"/></td>
		  </tr>
		  <tr>
		    <td colspan="2" class="blank">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">A/C No</label>
					<div class="col-sm-10">
					  <input id="our_banck_ac" name="our_banck_ac" class="allownumeric" value='50200001403834' style="width: 50%" placeholder='A/C number' type='text'>
					</div>
				</div>
			</td>
		    <td colspan="2" class="total-line">VAT/CST (%)</td>
		    <td class="total-value"><input placeholder='VAT/CST' class="allownumeric" style="width: 40%" value="0" name="vat" id="vat" type='text'>=<span class="vat_rs">INR0.0</span><input type="hidden" name="vat_rupees" id="vat_rupees" /></td>
		  </tr>
		  <tr>
		    <td colspan="2" class="blank">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">SWIFT</label>
					<div class="col-sm-10">
					  <input name="our_swift_code" id="our_swift_code" value='HDFCINBB' style="width: 50%" placeholder='SWIFT Code' type='text'>
					</div>
				</div>
		    <td colspan="2" class="total-line">Freight (INR)</td>
		    <td class="total-value"><input placeholder='Freight' style="width: 40%" class="allownumeric" name="freight" id="freight" value="0" type='text'><input type="hidden" name="freight_rupees" id="freight_rupees" /></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Total (INR)</td>
		      <td class="total-value balance"><div class="final_total_amount">0.0</div> <input type="hidden" class="final-total-amount" name="final_amount"/></td>
		  </tr>
		
		</table>
		<br>
		<!--<form method="post" action="generate_invoice.php" id="download_invoice_pdf">
			<input type="hidden" name="form_serialize_data" class="serialize_data"/>
		</form>-->
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-primary" type="button" name="generate_invoice_pdf" id="generate_pdf">Generate Invoice</button>
				<button class="btn btn-default" type="button">Cancel</button>
			</div>
		</div>
		</form>
		<!--<div id="terms">
		  <h5>Terms</h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>-->
	
	</div>
	<link rel="stylesheet" href="css/datepicker.css">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/invoice.js"></script>
  </body>
</html>