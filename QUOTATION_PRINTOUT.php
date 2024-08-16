<?php
	include_once("includes/session.php");
	include_once('database/database.php');
	include_once("packages/fpdf/fpdf.php");

	$id = $_POST['id'];
	$subtotal = $tax = $discount = $delivery_charges = 0;
	$quotation_no = $client_id = $payment_mode = $credit_terms = $currency_unit = $date = '';
	$query = "Select * FROM quotations WHERE quotation_no = '$id'";
	$result = mysqli_query($connection, $query);
	if (mysqli_num_rows($result)) {
		while ($row = mysqli_fetch_assoc($result)) {
			$quotation_no = $row['quotation_no'];
			$client_id = $row['client_id'];
			$payment_mode = ucfirst($row['payment_mode']);
			$credit_terms = ucfirst($row['credit_terms']);
			$tax = $row['tax'];
			$discount = $row['discount'];
			$delivery_charges = $row['delivery_charges'];
			$grand_total = $row['grand_total'];
			$currency = $row['currency'];
			$currency_unit = mraCurrencyUnit($currency);
			$date = date("d/m/Y", strtotime($row['created_at']));
		}
	}

	$client_name = $client_contact_name = $client_address = $client_contact_no = $client_ntn = '';
	$query2 = "Select * FROM clients WHERE client_id = '$client_id'";
	$result2 = mysqli_query($connection, $query2);
	if (mysqli_num_rows($result2)) {
		while ($row2 = mysqli_fetch_assoc($result2)) {
			$client_id = $row2['client_id'];
			$client_name = ucfirst($row2['client_name']);
			$client_contact_name = ucfirst($row2['contact_name']);
			$client_address = $row2['address'];
			$client_contact_no = $row2['contact_no'];
			$client_ntn = $row2['ntn_number'];
		}
	}
	if ($client_name == "") {
		$client_name = "-";
	}
	if ($client_contact_name == "") {
		$client_contact_name = "-";
	}
	if ($client_address == "") {
		$client_address = "-";
	}
	if ($client_contact_no == "") {
		$client_contact_no = "-";
	}
	if ($client_ntn == "") {
		$client_ntn = "-";
	}


	class myPDF extends FPDF {

		// public $companylogo;
		// public function passDataToClass($companylogo) {
		// 	$this->companylogo = $companylogo;
		// }
		function header() {
			
			// Page heading
			$this->SetDrawColor(202,202,202);
			$this->SetFont('helvetica', 'B', 32);
			$this->Cell(200,2,'',0,1,'');	
			$this->Cell(200,1,'','LRT',1,'');	
			$this->Cell(200,20,'MRA Technologies','LRB',1);
			$this->Image("images/mra_logo.jpg", 186, 8, 18, 18);

			// Watermark
			$this->Image("images/mra_watermark.png", 37.5, 74, 140, 134);
		}
		function footer() {

			// Terms and conditions
			$this->SetFillColor(250,250,250);
			$this->SetDrawColor(202, 202, 202);
    		$this->setY(-26);
			$this->setFont("helvetica","",9);
    		$this->Cell(200,1,'',"",1,'L', true);
    		$this->Cell(200,4,'Make all checks payable to MRA Technologies',"",1,'L', true);
    		$this->Cell(200,4,'If you have any questions concerning this quotation, Contact  Email, muhammadsameer.mra@gmail.com',"",1,'L', true);
    		$this->Cell(200,1,'',"",1,'L', true);

			// // Thank you
    		// $this->setY(-15);
			// $this->setFont("helvetica","B",12);
    		// $this->Cell(200,6,'THANK YOU FOR YOUR BUSINESS',"0",0,'C');

			// Page no
			$this->setY(-8);
			$this->Cell(20,4,'',0,0,"R");
			$this->setFont("helvetica","I",7);
			// $this->Cell(160,4.5,'This is the system-generated document, no signature required','',0,"C");
			$this->Cell(160,4.5,'','',0,"C");
			$this->setFont("helvetica","B",6);
			$this->Cell(24,4,'Page '.$this->PageNo().' / {nb}',0,1,"R");
		}
	}

	$pdf = new myPDF();

	$pdf->SetMargins(5, 5);
	$pdf->AliasNbPages();
	$pdf->AddPage("P","A4",0);

	$pdf->SetDrawColor(202,202,202);

	// Above quotation heading
	$pdf->SetFont('helvetica', 'B', 8.5);
	$pdf->Cell(32,6.5,'To:','LB',0,'L');
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(104,6.5,$client_contact_name,'LRB',0,'L');
	$pdf->SetFont('helvetica', 'B', 8.5);
	$pdf->Cell(32,6.5,'','LRB',0,'L');
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(32,6.5,'','RB',1,'L');
	
	$pdf->SetFont('helvetica', 'B', 8.5);
	$pdf->Cell(32,6.5,'Company:','LB',0,'L');
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(104,6.5,$client_name,'LRB',0,'L');
	$pdf->SetFont('helvetica', 'B', 8.5);
	$pdf->Cell(32,6.5,'DATE','LRB',0,'L');
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(32,6.5,$date,'RB',1,'L');

	$pdf->SetFont('helvetica', 'B', 8.5);
	$pdf->Cell(32,6.5,'Address:','LB',0,'L');
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(104,6.5,$client_address,'LRB',0,'L');
	$pdf->SetFont('helvetica', 'B', 8.5);
	$pdf->Cell(32,6.5,'Quotation #','LRB',0,'L');
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(32,6.5,mraCreateSixDigitNumber($quotation_no),'RB',1,'L');

	$pdf->SetFont('helvetica', 'B', 8.5);
	$pdf->Cell(32,6.5,'Phone:','LB',0,'L');
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(104,6.5,$client_contact_no,'LRB',0,'L');
	$pdf->SetFont('helvetica', 'B', 8.5);
	$pdf->Cell(32,6.5,'PO #','LRB',0,'L');
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(32,6.5,'-','RB',1,'L');

	$pdf->SetFont('helvetica', 'B', 8.5);
	$pdf->Cell(32,6.5,'NTN #:','LB',0,'L');
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(104,6.5,$client_ntn,'LRB',0,'L');
	$pdf->SetFont('helvetica', 'B', 8.5);
	$pdf->Cell(32,6.5,'Payment Term','LRB',0,'L');
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(32,6.5,$credit_terms,'RB',1,'L');


	// Quotation Heading
	$pdf->SetFillColor(250,250,250);
	$pdf->SetFont('helvetica', 'B', 20);
	$pdf->Cell(200,11.5,'Quotation','1',1,'C', false);


	// Table Heading
	$pdf->SetDrawColor(0,0,0);
	$pdf->SetFont('helvetica', 'B', 8.5);
	$pdf->Cell(14,8,'Sr. #','1',0,'C');
	$pdf->Cell(88,8,'Description','TB',0,'C');
	$pdf->Cell(16,8,'Quantity','LTB',0,'C');
	$pdf->Cell(16,8,'UOM','1',0,'C');
	$pdf->Cell(30,8,'Unit Price','TB',0,'C');
	$pdf->Cell(36,8,'Total','1',1,'C');

	$counter = 1;
	$query3 = "Select * FROM quotation_items WHERE quotation_no = '$quotation_no'";
	$result3 = mysqli_query($connection, $query3);
	if (mysqli_num_rows($result3)) {
		while ($row3 = mysqli_fetch_assoc($result3)) {
			
			$quotation_no = $row3['quotation_no'];
			$product_id = $row3['product_id'];
			$query4 = "Select * FROM products WHERE product_sku = '$product_id'";
			$result4 = mysqli_query($connection, $query4);
			if (mysqli_num_rows($result4)) {
				while ($row4 = mysqli_fetch_assoc($result4)) {
					$description = $row4['description'];
					$specification = $row4['specification'];
				}

				if ($specification) {
					$description = $description." - (".$specification.")";
				}
			}
			$qty = $row3['qty'];
			$uom = $row3['uom'];
			$unit_price = $row3['unit_price'];
			$line_total = $row3['line_total'];
			$subtotal += $line_total;


			// $description = $description.$description;

			// Wraptext code start
			$cellWidth=88;//wrapped cell width
			if($pdf->GetStringWidth($description) < $cellWidth){
				$line=1;
			}else{
				
				$textLength=strlen($description);	//total text length
				$startChar=0;		//character start position for each line
				$maxChar=0;			//maximum character in a line, to be incremented later
				$textArray=array();	//to hold the strings for each line
				$tmpString="";		//to hold the string for a line (temporary)
				
				while($startChar < $textLength){ //loop until end of text
					//loop until maximum character reached
					while( 
					$pdf->GetStringWidth( $tmpString ) < ($cellWidth-10) &&
					($startChar+$maxChar) < $textLength ) {
						$maxChar++;
						$tmpString=substr($description,$startChar,$maxChar);
					}
					$startChar=$startChar+$maxChar;
					//then add it into the array so we know how many line are needed
					array_push($textArray,$tmpString);
					//reset maxChar and tmpString
					$maxChar=0;
					$tmpString='';
					
				}
				//get number of line
				$line=count($textArray);
			}

			// Line items
			$pdf->SetFont('helvetica', '', 7);
			$pdf->SetDrawColor(202,202,202);
			$pdf->Cell(14,7,$counter++,'LBR',0,'C');

			// $pdf->Cell(88,7,$description,'LB',0,'L');
			$xPos=$pdf->GetX();
			$yPos=$pdf->GetY();
			if ($pdf->GetStringWidth( $description ) > 92) {
				$pdf->MultiCell($cellWidth,3.5, $description,'BR',0);
			} else {
				$pdf->MultiCell($cellWidth,7, $description,'BR',0);
			}
			$pdf->SetXY($xPos + $cellWidth , $yPos);

			$pdf->Cell(16,7,$qty,'LRB',0,'C');
			$pdf->Cell(16,7,$uom,'LRB',0,'C');
			// Unit price
			$pdf->Cell(0.5,7,'','B',0,'L');
			$pdf->Cell(7.5,7,$currency_unit,'B',0,'L');
			$pdf->Cell(21.5,7,number_format($unit_price, 2),'B',0,'R');
			$pdf->Cell(0.5,7,'','RB',0,'C');
			// Line total
			$pdf->Cell(0.5,7,'','B',0,'L');
			$pdf->Cell(7.5,7,$currency_unit,'B',0,'L');
			$pdf->Cell(27.5,7,number_format($line_total, 2),'B',0,'R');
			$pdf->Cell(0.5,7,'','RB',1,'C');
		}
	}

	// Set empty rows
	for ($i=0; $i < (20-$counter); $i++) { 
		
		// $pdf->SetDrawColor(0,0,0);
		// $pdf->Cell(0.2,7,'','L',0,'C');

		$pdf->SetDrawColor(202,202,202);
		$pdf->Cell(14,7,'','LB',0,'C');
		$pdf->Cell(88,7,'','LB',0,'C');
		$pdf->Cell(16,7,'','LRB',0,'C');
		$pdf->Cell(16,7,'','LRB',0,'C');
		$pdf->Cell(30,7,'','RB',0,'C');
		$pdf->Cell(36,7,'','RB',1,'C');

		// $pdf->SetDrawColor(0,0,0);
		// $pdf->Cell(2,7,'','L',1,'C');
	}


	// Subtotal
	$pdf->SetDrawColor(202,202,202);
	$pdf->SetFont('helvetica', 'B', 8);
	$pdf->Cell(14,8,'','LB',0,'R');
	$pdf->Cell(88,8,'','LB',0,'R');
	$pdf->Cell(16,8,'','LB',0,'R');
	$pdf->SetDrawColor(0,0,0);
	$pdf->Cell(44,8,'SUBTOTAL','LT',0,'R');
	$pdf->Cell(2,8,'','TR',0,'R');
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(0.5,8,'','T',0,'L');
	$pdf->Cell(7.5,8,$currency_unit,'T',0,'L');
	$pdf->Cell(27.5,8,number_format($subtotal, 2),'T',0,'R');
	$pdf->Cell(0.5,8,'','RB',1,'C');

	// Tax
	$pdf->SetDrawColor(202,202,202);
	$pdf->SetFont('helvetica', 'B', 8);
	$pdf->Cell(14,8,'','LB',0,'R');
	$pdf->Cell(88,8,'','LB',0,'R');
	$pdf->Cell(16,8,'','LB',0,'R');
	$pdf->SetDrawColor(0,0,0);
	$pdf->Cell(44,8,'TAX','LT',0,'R');
	$pdf->Cell(2,8,'','TR',0,'R');
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(0.5,8,'','T',0,'L');
	$pdf->Cell(7.5,8,$currency_unit,'T',0,'L');
	$pdf->Cell(27.5,8,number_format($tax, 2),'T',0,'R');
	$pdf->Cell(0.5,8,'','RB',1,'C');

	// Discount
	$pdf->SetDrawColor(202,202,202);
	$pdf->SetFont('helvetica', 'B', 8);
	$pdf->Cell(14,8,'','LB',0,'R');
	$pdf->Cell(88,8,'','LB',0,'R');
	$pdf->Cell(16,8,'','LB',0,'R');
	$pdf->SetDrawColor(0,0,0);
	$pdf->Cell(44,8,'DISCOUNT','LT',0,'R');
	$pdf->Cell(2,8,'','TR',0,'R');
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(0.5,8,'','T',0,'L');
	$pdf->Cell(7.5,8,$currency_unit,'T',0,'L');
	$pdf->Cell(27.5,8,number_format($discount, 2),'T',0,'R');
	$pdf->Cell(0.5,8,'','RB',1,'C');
	
	// Delivery charges
	$pdf->SetDrawColor(202,202,202);
	$pdf->SetFont('helvetica', 'B', 8);
	$pdf->Cell(14,8,'','LB',0,'R');
	$pdf->Cell(88,8,'','LB',0,'R');
	$pdf->Cell(16,8,'','LB',0,'R');
	$pdf->SetDrawColor(0,0,0);
	$pdf->Cell(44,8,'DELIVERY CHARGES','LT',0,'R');
	$pdf->Cell(2,8,'','TR',0,'R');
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(0.5,8,'','T',0,'L');
	$pdf->Cell(7.5,8,$currency_unit,'T',0,'L');
	$pdf->Cell(27.5,8,number_format($delivery_charges, 2),'T',0,'R');
	$pdf->Cell(0.5,8,'','RB',1,'C');
	
	// Grand total
	$grand_total = $subtotal + $tax + $delivery_charges - $discount;
	$pdf->SetDrawColor(202,202,202);
	$pdf->SetFont('helvetica', 'B', 8);
	$pdf->Cell(14,8,'','LB',0,'R');
	$pdf->Cell(88,8,'','LB',0,'R');
	$pdf->Cell(16,8,'','LB',0,'R');
	$pdf->SetDrawColor(0,0,0);
	$pdf->Cell(44,8,'GRAND TOTAL','TL',0,'R');
	$pdf->Cell(2,8,'','TR',0,'R');
	$pdf->Cell(0.5,8,'','T',0,'L');
	$pdf->Cell(7.5,8,$currency_unit,'T',0,'L');
	$pdf->Cell(27.5,8,number_format($grand_total, 2),'T',0,'R');
	$pdf->Cell(0.5,8,'','RB',1,'C');
	// Set border bottom
	$pdf->Cell(118,1,'','0',0,'C');
	$pdf->Cell(82,1,'','T',1,'C');


	$pdf->SetXY(5, 80);
	$pdf->Cell(200,133,'','1',0,'C');


	// Save file into directory
	$quotation_no = "QT_".mraCreateSixDigitNumber($quotation_no).".pdf";
	$pdf->Output("assets/quotations/".$quotation_no,"F");

	$filePath = "assets/quotations/".$quotation_no;
	if (file_exists($filePath)) {
		echo 1;
	} else {
		echo "NOT_SAVED";
	}
	// $pdf->output();
?>