<?php
require('invoice.php');
if(isset($_POST['phone'])) {
	$errors = array();
	if(isset($_POST['our_company'])) {
		$our_company = trim($_POST['our_company']);
	} else {
		$errors[] = "Our company name should not be empty"; 
	}
	if(isset($_POST['invoice_title'])) {
		$invoice_title = trim($_POST['invoice_title']);
	} else {
		$errors[] = "Our company name should not be empty"; 
	}
	if(isset($_POST['our_address'])) {
		$our_addr = trim($_POST['our_address']);
	} else {
		$errors[] = "Our company address should not be empty"; 
	}
	if(isset($_POST['phone'])) {
		$our_phone = trim($_POST['phone']);
		$our_phone = "+91 ".$our_phone;
	} else {
		$errors[] = "Our company phone number should not be empty"; 
	}
	if(isset($_POST['tin'])) {
		$our_tin = trim($_POST['tin']);
	} else {
		$errors[] = "Our company TIN number should not be empty"; 
	}
	if(isset($_POST['order_date'])) {
		$order_date = trim($_POST['order_date']);
		$order_date = date("d/m/Y",strtotime($order_date));
	} else {
		$errors[] = "Order date should not be empty"; 
	}
	if(isset($_POST['order_number'])) {
		$order_number = trim($_POST['order_number']);
	} else {
		$errors[] = "Order number should not be empty"; 
	}
	if(isset($_POST['billing_company'])) {
		$billing_company = trim($_POST['billing_company']);
	} else {
		$errors[] = "Billing company name should not be empty"; 
	}
	if(isset($_POST['billing_address'])) {
		$billing_address = trim($_POST['billing_address']);
	} else {
		$errors[] = "Billing address should not be empty"; 
	}
	if(isset($_POST['billing_city'])) {
		$billing_city = trim($_POST['billing_city']);
	} else {
		$errors[] = "Billing city name should not be empty"; 
	}
	if(isset($_POST['billing_tin'])) {
		$billing_tin = trim($_POST['billing_tin']);
	} else {
		$errors[] = "Billing TIN number should not be empty"; 
	}
	
	if(isset($_POST['billing_pin'])) {
		$billing_pin = trim($_POST['billing_pin']);
	} else {
		$errors[] = "Billing location PIN code should not be empty"; 
	}
	if(isset($_POST['billing_country'])) {
		$billing_country = trim($_POST['billing_country']);
	} else {
		$errors[] = "Billing country name should not be empty"; 
	}
	if(isset($_POST['shipping_company'])) {
		$shipping_company = trim($_POST['shipping_company']);
	} else {
		$errors[] = "Shipping company should not be empty"; 
	}
	if(isset($_POST['shipping_addr'])) {
		$shipping_addr = trim($_POST['shipping_addr']);
	} else {
		$errors[] = "Shipping address should not be empty"; 
	}
	if(isset($_POST['shipping_city'])) {
		$shipping_city = trim($_POST['shipping_city']);
	} else {
		$errors[] = "Shipping city name should not be empty"; 
	}
	if(isset($_POST['shipping_pin'])) {
		$shipping_pin = trim($_POST['shipping_pin']);
	} else {
		$errors[] = "Shipping location PIN code should not be empty"; 
	}
	if(isset($_POST['shipping_country'])) {
		$shipping_country = trim($_POST['shipping_country']);
	} else {
		$errors[] = "Shipping country name should not be empty"; 
	}
	if(isset($_POST['our_bank_name'])) {
		$our_bank_name = trim($_POST['our_bank_name']);
	} else {
		$errors[] = "Our Bank name should not be empty"; 
	}
	if(isset($_POST['our_ifsc_code'])) {
		$our_ifsc_code = trim($_POST['our_ifsc_code']);
	} else {
		$errors[] = "Our Bank IFSC code should not be empty"; 
	}
	if(isset($_POST['our_banck_ac'])) {
		$our_banck_ac = trim($_POST['our_banck_ac']);
	} else {
		$errors[] = "Our Bank AC number should not be empty"; 
	}
	if(isset($_POST['our_swift_code'])) {
		$our_swift_code = trim($_POST['our_swift_code']);
	} else {
		$errors[] = "Our Bank SWIFT code should not be empty"; 
	}
	//Central Excise in Percentage(%)
	if(isset($_POST['central_excise'])) {
		$central_excise = trim($_POST['central_excise']);
	} else {
		$errors[] = "Central Excise Percentage(%) value should not be empty"; 
	}
	//Central Excise in INR(Rs)
	if(isset($_POST['central_excise_rs'])) {
		$central_excise_rs = trim($_POST['central_excise_rs']);
	} else {
		$errors[] = "Central Excise amount in INR should not be empty";
	}
	//VAT in Percentage(%)
	if(isset($_POST['vat'])) {
		$vat = trim($_POST['vat']);
	} else {
		$errors[] = "VAT amount in percentage(%) should not be empty"; 
	}
	if(isset($_POST['vat_rupees'])) {
		$vat_rupees = trim($_POST['vat_rupees']);
	} else {
		$errors[] = "VAT amount in INR should not be empty"; 
	}
	if(isset($_POST['freight'])) {
		$freight = trim($_POST['freight']);
	} else {
		$errors[] = "Freight amount should not be empty"; 
	}
	if(isset($_POST['sub_total'])) {
		$sub_total = trim($_POST['sub_total']);
	} else {
		$errors[] = "Subtotal amount should not be empty"; 
	}
	if(isset($_POST['final_amount'])) {
		$final_amount = trim($_POST['final_amount']);
	} else {
		$errors[] = "Final amount should not be empty"; 
	}
	if(sizeof($errors)==0) {
		$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
		$pdf->AddPage();
		$pdf->addSociete($our_company,"5th floor, Sri Hari Towers, NH5 Frontage Rd,\n" ."K P Nagar, Vijayawada - 520008, Andhra Pradesh, India\nPhone : ".$our_phone);
		//$pdf->companyDetails("TIN : ".$our_tin);
		//$pdf->temporaire( "Devis temporaire" ); //Watermark text
		$pdf->addDate( "Date : ".$order_date."\nOrder Number : ".$order_number."\nTIN : ".$our_tin);
		// Set font
		$pdf->SetFont('Arial','B',18);
		// Move to 8 cm to the right
		$pdf->Cell(80);
		// Centred text in a framed 20*10 mm cell and line break
		$pdf->Cell(20,20,$invoice_title,0,1,'C');
		$pdf->SetFont('Arial','B',12);
		// Move to 8 cm to the right
		$pdf->Cell(15);
		// Centred text in a framed 20*10 mm cell and line break
		$pdf->Cell(20,5,'Customer Information',0,1,'C');
		$billing_addr2 = !empty($_POST['billing_address2'])?"\n".$_POST['billing_address2']:"";
		$shipping_addr2 = !empty($_POST['shipping_address2'])?"\n".$_POST['shipping_address2']:"";
		$pdf->addBillingAddr($billing_company."\n".$billing_address.$billing_addr2."\n".$billing_city." - ".$billing_pin."\n".$billing_country.", TIN: ".$billing_tin);
		$pdf->addShippingAddr($shipping_company."\n".$shipping_addr.$shipping_addr2."\n".$shipping_city." - ".$shipping_pin."\n".$shipping_country);
		$cols=array( "Sno"    => 23,
					 "Description"  => 78,
					 "Qty"     => 22,
					 "Rate/Unit (INR)"      => 26,
					 "Amount (INR)" => 41);
		$pdf->addCols( $cols);
		$cols=array("Sno"    => "C",
					 "Description"  => "C",
					 "Qty"     => "C",
					 "Rate/Unit (INR)"      => "C",
					 "Amount (INR)" => "C");
		$pdf->addLineFormat( $cols);
		$pdf->addLineFormat($cols);
		$y    = 100;
		$sno = 1;
		$decript_arry = $_POST['item_description'];
		$quantity = $_POST['quantity'];
		$unit_cost = $_POST['unit_cost'];
		$total_amount = $_POST['total_amount'];
		foreach($decript_arry AS $key=>$val) {
			
			$line = array( "Sno"    => $sno,
               "Description"  => $decript_arry[$key],
               "Qty"     => $quantity[$key],
               "Rate/Unit (INR)"      => $unit_cost[$key],
               "Amount (INR)" => $total_amount[$key]);
			$size = $pdf->addLine( $y, $line );
			$y   += $size + 4;
			$sno++;
		}
		$bank_details = array("bank_name"=>$our_bank_name,"our_ifsc_code"=>$our_ifsc_code,"our_banck_ac"=>$our_banck_ac,"our_swift_code"=>$our_swift_code);
		$sub_total_details = array("central_excise"=>$central_excise,"central_excise_rs"=>$central_excise_rs,"vat"=>$vat,"vat_rupees"=>$vat_rupees,"freight"=>$freight,"sub_total"=>$sub_total,"final_amount"=>$final_amount);
		$pdf->addBanckDetails($bank_details);
		$pdf->addSubTotals($sub_total_details);
		$time = time();
		$file_name = "SOP".$time.".pdf";
		$pdf->Output($file_name,"D");
	} else {
		foreach($errors AS $err) {
			echo $err."<br>";
		}
	}
}
?>
