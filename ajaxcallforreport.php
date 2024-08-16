<?php
include_once('database/database.php');
require_once("includes/helpers.php");
require('packages/PHPExcel/Classes/PHPExcel.php');


// Generate the excel report for open invoices
if (isset($_POST["getInvoiceReport"])) {
	try {

		$excelFilePath = './assets/reports/InvoicesReport.xlsx';
		$phpExcel = PHPExcel_IOFactory::load($excelFilePath);

		$phpExcel->removeSheetByIndex(1);
		$activesheet_1 = $phpExcel->createSheet(1);
		$phpExcel->removeSheetByIndex(0);
		$activesheet_1->setTitle('InvoicesList');

		// Set Header
		$activesheet_1->setCellValue('B2', 'Sr. #');
		$activesheet_1->setCellValue('C2', 'Date');
		$activesheet_1->setCellValue('D2', 'Invoice #');
		$activesheet_1->setCellValue('E2', 'Quotation #');
		$activesheet_1->setCellValue('F2', 'PO #');
		$activesheet_1->setCellValue('G2', 'Payment Mode');
		$activesheet_1->setCellValue('H2', 'Credit Terms');
		$activesheet_1->setCellValue('I2', 'Tax');
		$activesheet_1->setCellValue('J2', 'Discount');
		$activesheet_1->setCellValue('K2', 'Delivery Charges');
		$activesheet_1->setCellValue('L2', 'Grand Total');
		$activesheet_1->setCellValue('M2', 'Comment');
		$activesheet_1->setCellValue('N2', 'Generated By');

		$sr_no = 1;
		$counter = 2;
		$invoice_no_array = array();
		$query = "Select * FROM invoices WHERE status = '1' && is_closed = '0' && is_paid = '0' ORDER By invoice_no DESC";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {

				$invoice_no = $row['invoice_no'];
				$quotation_no = $row['quotation_no'];
				$payment_mode = ucfirst($row['payment_mode']);
				$credit_terms = ucfirst($row['credit_terms']);
				$tax = $row['tax'];
				$po_no = $row['po_no'];
				$discount = $row['discount'];
				$delivery_charges = $row['delivery_charges'];
				$additional_charges = $row['additional_charges'];
				$grand_total = $row['grand_total'];
				$comment = $row['comment'];
				$comment = str_replace("&#39", "", $comment);
				$comment = str_replace('&#34', '"', $comment);
				$is_closed = $row['is_closed'];
				$is_paid = $row['is_paid'];
				$date = date("d-M-Y", strtotime($row['created_at']));
				$generated_by = $row['generated_by'];
				$full_name = getFullName($connection, $generated_by);
				$invoice_no_array[] = $invoice_no;

				$counter++;
				$activesheet_1->setCellValue('B' . $counter, $sr_no);
				$activesheet_1->setCellValue('C' . $counter, $date);
				$activesheet_1->setCellValue('D' . $counter, mraCreateSixDigitNumber($invoice_no));
				$activesheet_1->setCellValue('E' . $counter, mraCreateSixDigitNumber($quotation_no));
				$activesheet_1->setCellValue('F' . $counter, $po_no);
				$activesheet_1->setCellValue('G' . $counter, $payment_mode);
				$activesheet_1->setCellValue('H' . $counter, $credit_terms);
				$activesheet_1->setCellValue('I' . $counter, $tax);
				$activesheet_1->setCellValue('J' . $counter, $discount);
				$activesheet_1->setCellValue('K' . $counter, $delivery_charges);
				$activesheet_1->setCellValue('L' . $counter, $grand_total);
				$activesheet_1->setCellValue('M' . $counter, $comment);
				$activesheet_1->setCellValue('N' . $counter, $full_name);
				// Set formatting for the price cell
				$activesheet_1->getStyle('I' . $counter)->getNumberFormat()->setFormatCode("_(PK\\R* #,##0_);_(PK\\R* (#,##0);_(PK\\R* \"-\"_);_(@_)");
				$activesheet_1->getStyle('J' . $counter)->getNumberFormat()->setFormatCode("_(PK\\R* #,##0_);_(PK\\R* (#,##0);_(PK\\R* \"-\"_);_(@_)");
				$activesheet_1->getStyle('K' . $counter)->getNumberFormat()->setFormatCode("_(PK\\R* #,##0_);_(PK\\R* (#,##0);_(PK\\R* \"-\"_);_(@_)");
				$activesheet_1->getStyle('L' . $counter)->getNumberFormat()->setFormatCode("_(PK\\R* #,##0_);_(PK\\R* (#,##0);_(PK\\R* \"-\"_);_(@_)");

				// Cell wise borders
				$bordersAll = array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
							'color' => array('argb' => 'D0D3D4')
						)
					)
				);
				$activesheet_1->getStyle('B' . $counter . ':N' . $counter)->applyFromArray($bordersAll);
				// Set row's height
				$activesheet_1->getRowDimension($counter)->setRowHeight(24);
				$sr_no++;
			}
		}

		// Get the highest row and column
		$highestRow = $activesheet_1->getHighestRow();
		$lastColumn = $activesheet_1->getHighestColumn();
		$colNumber = PHPExcel_Cell::columnIndexFromString($lastColumn);
		$colString = PHPExcel_Cell::stringFromColumnIndex($colNumber - 1);
		$highestColumn = $colString;

		// Set Border to the header row
		$bordersAll = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('argb' => 'D0D3D4')
				)
			)
		);
		$activesheet_1->getStyle('B2:' . 'N2')->applyFromArray($bordersAll);
		// Set Border Top & Bottom
		$activesheet_1->getStyle("B2:" . $highestColumn . $highestRow)->applyFromArray(
			array(
				'borders' => array(
					'top' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('rgb' => '1A5276')
					),
					'bottom' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('rgb' => '1A5276')
					),
				)
			)
		);
		// Set Border Left & Right
		$activesheet_1->getStyle('B2:' . $highestColumn . $highestRow)->applyFromArray(
			array(
				'borders' => array(
					'right' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('rgb' => '1A5276')
					),
					'left' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('rgb' => '1A5276')
					),
				)
			)
		);

		// set first row's Width
		$activesheet_1->getRowDimension(2)->setRowHeight(24);
		// set Column's Width
		$activesheet_1->getColumnDimension('A')->setWidth(2.75);
		$activesheet_1->getColumnDimension('B')->setWidth(10.75);
		$activesheet_1->getColumnDimension('C')->setWidth(15.75);
		$activesheet_1->getColumnDimension('D')->setWidth(15.75);
		$activesheet_1->getColumnDimension('E')->setWidth(15.75);
		$activesheet_1->getColumnDimension('F')->setWidth(15.75);
		$activesheet_1->getColumnDimension('G')->setWidth(18.75);
		$activesheet_1->getColumnDimension('H')->setWidth(18.75);
		$activesheet_1->getColumnDimension('I')->setWidth(15.75);
		$activesheet_1->getColumnDimension('J')->setWidth(18.75);
		$activesheet_1->getColumnDimension('K')->setWidth(18.75);
		$activesheet_1->getColumnDimension('L')->setWidth(18.75);
		$activesheet_1->getColumnDimension('M')->setWidth(50.75);
		$activesheet_1->getColumnDimension('N')->setWidth(20.75);
		$activesheet_1->getColumnDimension('O')->setWidth(2.75);

		// Formating
		$activesheet_1->getStyle('B2:' . $highestColumn . $highestRow)
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$activesheet_1->getStyle('B2:' . $highestColumn . $highestRow)
			->getAlignment()
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$activesheet_1->getStyle('B2:' . $highestColumn . $highestRow)
			->getAlignment()
			->setIndent(1);
		$activesheet_1->getStyle('B1:' . $highestColumn . $highestRow)->getAlignment()->setWrapText(true);

		// Set the font styling
		$activesheet_1->getStyle('B3:' . $highestColumn . $highestRow)->getFont()
			->setName('Verdana')
			->setSize(8)
			->getColor()
			->setRGB('000000');
		$fontStyle = array(
			'font' => array(
				'bold' => true,
				'color' => array('rgb' => 'FFFFFF'),
			),
		);
		$activesheet_1->getStyle('B2:N2')->applyFromArray($fontStyle);
		// Set styling for the header row
		$activesheet_1->getStyle('B2:N2')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('111A5276');
		// Remove the grid lines
		$activesheet_1->setShowGridlines(false);


		/* -------------------------------------------------------------------------- */
		/*                                Second Sheet                                */
		/* -------------------------------------------------------------------------- */

		
		$activesheet_2 = $phpExcel->createSheet(1);
		$activesheet_2->setTitle('InvoicesList (items-wise)');

		// Set Header
		$activesheet_2->setCellValue('B2', 'Sr. #');
		$activesheet_2->setCellValue('C2', 'Date');
		$activesheet_2->setCellValue('D2', 'Invoice #');
		$activesheet_2->setCellValue('E2', 'Product Name');
		$activesheet_2->setCellValue('F2', 'Qty');
		$activesheet_2->setCellValue('G2', 'UOM');
		$activesheet_2->setCellValue('H2', 'Unit Price');
		$activesheet_2->setCellValue('I2', 'Line Total');
		$activesheet_2->setCellValue('J2', 'Note');

		$sr_no = 1;
		$counter = 2;
		$invoice_nos = "'" . implode("','", $invoice_no_array) . "'";
		$query = "Select * FROM invoice_items WHERE invoice_no IN ($invoice_nos) && status = '1' ORDER By invoice_no DESC";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {

				$invoice_no = $row['invoice_no'];
				$product_id = $row['product_id'];
				$qty = $row['qty'];
				$uom = $row['uom'];
				$unit_price = $row['unit_price'];
				$line_total = $row['line_total'];
				$additional_note = $row['additional_note'];
				$product_full_name = getProductNameById($connection, $product_id);

				$counter++;
				$activesheet_2->setCellValue('B' . $counter, $sr_no);
				$activesheet_2->setCellValue('C' . $counter, $date);
				$activesheet_2->setCellValue('D' . $counter, mraCreateSixDigitNumber($invoice_no));
				$activesheet_2->setCellValue('E' . $counter, $product_full_name);
				$activesheet_2->setCellValue('F' . $counter, $qty);
				$activesheet_2->setCellValue('G' . $counter, $uom);
				$activesheet_2->setCellValue('H' . $counter, $unit_price);
				$activesheet_2->setCellValue('I' . $counter, $line_total);
				$activesheet_2->setCellValue('J' . $counter, $additional_note);
				// Set formatting for the price cell
				$activesheet_2->getStyle('H' . $counter)->getNumberFormat()->setFormatCode("_(PK\\R* #,##0_);_(PK\\R* (#,##0);_(PK\\R* \"-\"_);_(@_)");
				$activesheet_2->getStyle('I' . $counter)->getNumberFormat()->setFormatCode("_(PK\\R* #,##0_);_(PK\\R* (#,##0);_(PK\\R* \"-\"_);_(@_)");

				// Cell wise borders
				$bordersAll = array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
							'color' => array('argb' => 'D0D3D4')
						)
					)
				);
				$activesheet_2->getStyle('B' . $counter . ':J' . $counter)->applyFromArray($bordersAll);
				// Set row's height
				$activesheet_2->getRowDimension($counter)->setRowHeight(24);
				$sr_no++;
			}
		}

		// Get the highest row and column
		$highestRow = $activesheet_2->getHighestRow();
		$lastColumn = $activesheet_2->getHighestColumn();
		$colNumber = PHPExcel_Cell::columnIndexFromString($lastColumn);
		$colString = PHPExcel_Cell::stringFromColumnIndex($colNumber - 1);
		$highestColumn = $colString;

		// Set Border to the header row
		$bordersAll = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('argb' => 'D0D3D4')
				)
			)
		);
		$activesheet_2->getStyle('B2:' . 'J2')->applyFromArray($bordersAll);
		// Set Border Rop & Bottom
		$activesheet_2->getStyle("B2:" . $highestColumn . $highestRow)->applyFromArray(
			array(
				'borders' => array(
					'top' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('rgb' => '1A5276')
					),
					'bottom' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('rgb' => '1A5276')
					),
				)
			)
		);
		// Set Border Left & Right
		$activesheet_2->getStyle('B2:' . $highestColumn . $highestRow)->applyFromArray(
			array(
				'borders' => array(
					'right' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('rgb' => '1A5276')
					),
					'left' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('rgb' => '1A5276')
					),
				)
			)
		);

		// set first row's Width
		$activesheet_2->getRowDimension($counter)->setRowHeight(24);
		// set Column's Width
		$activesheet_2->getColumnDimension('A')->setWidth(2.75);
		$activesheet_2->getColumnDimension('B')->setWidth(10.75);
		$activesheet_2->getColumnDimension('C')->setWidth(15.75);
		$activesheet_2->getColumnDimension('D')->setWidth(15.75);
		$activesheet_2->getColumnDimension('E')->setWidth(50.75);
		$activesheet_2->getColumnDimension('F')->setWidth(15.75);
		$activesheet_2->getColumnDimension('G')->setWidth(18.75);
		$activesheet_2->getColumnDimension('H')->setWidth(18.75);
		$activesheet_2->getColumnDimension('I')->setWidth(15.75);
		$activesheet_2->getColumnDimension('J')->setWidth(18.75);
		$activesheet_2->getColumnDimension('K')->setWidth(2.75);

		// Formating
		$activesheet_2->getStyle('B2:' . $highestColumn . $highestRow)
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$activesheet_2->getStyle('B2:' . $highestColumn . $highestRow)
			->getAlignment()
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$activesheet_2->getStyle('B2:' . $highestColumn . $highestRow)
			->getAlignment()
			->setIndent(1);
		$activesheet_2->getStyle('B1:' . $highestColumn . $highestRow)->getAlignment()->setWrapText(true);


		// Set the font styling
		$activesheet_2->getStyle('B3:' . $highestColumn . $highestRow)->getFont()
			->setName('Verdana')
			->setSize(8)
			->getColor()
			->setRGB('000000');

		$fontStyle = array(
			'font' => array(
				'bold' => true,
				'color' => array('rgb' => 'FFFFFF'),
			),
		);
		$activesheet_2->getStyle('B2:J2')->applyFromArray($fontStyle);
		// Set styling for the header row
		$activesheet_2->getStyle('B2:J2')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('111A5276');
		// Remove the grid lines
		$activesheet_2->setShowGridlines(false);


		// Save the workbook
		$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
		$writer->save($excelFilePath);
	} catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}
