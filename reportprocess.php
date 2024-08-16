<?php
	include_once("includes/session.php");
	include_once('database/database.php');
	require('packages/PHPExcel/Classes/PHPExcel.php');

	if(isset($_POST["action"]) && $_POST["action"] == "projectReport") {
		
		$company = $_POST["company"];
		$program_budget = $_POST["program_budget"];
		$project_name = $_POST["project_name"];
		$team_name = $_POST["team_name"];
		$user_name = $_POST["user_name"];
		$start_date = $_POST["start_date"];
		$end_date = $_POST["end_date"];
		$vendor_id = $_POST["vendor_id"];
		$_module = $_POST["_module"];
		$sourcing = $_POST["sourcing"];
		$withInvoices = $_POST["with_invoices"];
		$withPRFs = $_POST["with_prfs"];

		$zipname = './assets/reports/PRFReport.zip';
		if (file_exists($zipname)) {
			unlink($zipname);
		}
		if ($withInvoices || $withPRFs) {
		    $zip = new ZipArchive;
		}
		

		if ($_module == "PRF") {

			// PRFs Report
			$counter = 1;
			$filterByClient = "";
			$filterByProgram = "";
			$filterByProject = "";
			$filterByTeam = "";
			$filterByUser = "";
			$filterByDate = "";
			$filterByVendor = "";
			if ($company != null) {
				$filterByClient = "&& demands.client = '$company' ";
			}
			if ($program_budget != null) {
				$filterByProgram = "&& demands.program_budget = '$program_budget' ";
			}
			if ($project_name != null) {
				$filterByProject = "&& demands.project_name = '$project_name' ";
			}
			if ($team_name != null) {
				$filterByTeam = "&& demands.team_name = '$team_name' ";
			}
			if ($user_name != null) {
				$filterByUser = "&& demands.requested_by = '$user_name' ";
			}
			if ($start_date != "" && $end_date != "") {
				$filterByDate = "&& prf_items.created_at between '$start_date' AND '$end_date' ";
			}
			if ($vendor_id != null) {
				$filterByVendor = "&& prf_items.vendor_id = '$vendor_id' ";
			}

			if ($sourcing == 0) {
				$filterBySourcing = "&& demands.local_or_import = 'local' ";
			} else if ($sourcing == 1) {
				$filterBySourcing = "&& demands.local_or_import = 'import' ";
			} else {
				$filterBySourcing = "";
			}

			// Create Excel Sheet
		    $phpExcel = PHPExcel_IOFactory::load('./assets/reports/PRFReport.xlsx');

		    $activesheet = $phpExcel->getActiveSheet();
		    $activesheet = $phpExcel->createSheet(1);
		    $phpExcel->removeSheetByIndex(0);
		    $activesheet->setTitle('PRFReport');

		    // Excel Heading
		    $headingArray = array('Sr. No', 'PRF No', 'PRF Date', 'Demand No', 'Demand Date', 'PO No', 'Description', 'UOM', 'Quantity', 'Unit Price', 'Total', 'Tax', 'Total Price (With Tax)', 'Vendor', 'Requester', 'Project', 'Item Type', 'MFG', 'MFG PN', 'HS code', 'Price', 'Stock', 'Location', 'Souring');
		    for ($i=0; $i < count($headingArray); $i++) { 
		    	$activesheet->setCellValue(chr($i+65).'1', $headingArray[$i]);
		    }

		    $query = "Select *, prf_items.created_at AS prf_date, prf_items.vendor_id AS prf_vendor_id FROM prf_items INNER JOIN demands ON demands.demand_no = prf_items.demand_no WHERE prf_items.status = 1 $filterByClient $filterBySourcing $filterByProgram $filterByProject $filterByTeam $filterByUser $filterByDate $filterByVendor ORDER BY prf_no DESC";
			$result = mysqli_query($connection, $query);
			if (mysqli_num_rows($result) > 0) {
				while ( $row = mysqli_fetch_assoc($result) ) {

					// PRF items table
					$pro_id = $row['pro_id'];
					$product_id = $row['product_id'];
					$prf_no = $row['prf_no'];
					$prf_date = date("d-m-Y", strtotime($row['prf_date']));
					$demand_no = $row['demand_no'];
					$demand_date = date("d-m-Y", strtotime($row['demand_date']));
					$po_number = $row['po_number'];
					$qty = round($row['received_qty'], 10);
					$unit_price = round($row['unit_price'], 10);
					$total_price = $qty * $unit_price;
					$tax = $row['tax'];
					$vendor_id = $row['prf_vendor_id'];
					$file_name = $row['file_name'];

					// Demands table
					$currency = $row['currency'];
					$requester = $row['requester_name'];
					$program_budget = $row['program_budget'];
					$project_name = $row['project_name'];
					if ($project_name != "" && $project_name != "-") {
						$project = $program_budget ." - (".$project_name.")";
					} else {
						$project = $program_budget;
					}
					if ($program_budget == "") {
						$project = ucfirst($project_name);
					}
					$sourcing = $row['local_or_import'];


					$query2 = "Select * FROM products WHERE product_sku = '$product_id' ";
					$result2 = mysqli_query($connection, $query2);
					if (mysqli_num_rows($result2) > 0) {
						while ($row2 = mysqli_fetch_assoc($result2)) {

							$product_name = ucwords($row2['product_name']);
							$specification = ucfirst($row2['specification']);
							$description = $product_name;
							if ($specification != "") {
								$description = $product_name . " - (" . $specification.")";
							}
							$uom = $row2['uom'];
							$item_type = ucfirst($row2['item_type']);
							$mfg = $row2['mfg'];
							$mfg_pn = $row2['mfg_pn'];
							$hs_code = $row2['hs_code'];

							$price = $row2['last_purchase_price'];
							$stock = $row2['pro_stock'];
							$location = $row2['location'];
						}
					}

					$vendor_name = "";
					$query3 = "Select * FROM vendors WHERE vendor_id = '$vendor_id' ";
					$result3 = mysqli_query($connection, $query3);
					if (mysqli_num_rows($result3) > 0) {
						while ($row3 = mysqli_fetch_assoc($result3)) {
							$vendor_name = ucwords($row3['vendor_name']);
						}
					}


					$activesheet->setCellValue('A'.$counter+1, $counter++);
					$activesheet->setCellValue('B'.$counter, $prf_no);
					$activesheet->setCellValue('C'.$counter, $prf_date);
					$activesheet->setCellValue('D'.$counter, $demand_no);
					$activesheet->setCellValue('E'.$counter, $demand_date);
					$activesheet->setCellValue('F'.$counter, $po_number);
					$activesheet->setCellValue('G'.$counter, $description);
					$activesheet->setCellValue('H'.$counter, $uom);
					$activesheet->setCellValue('I'.$counter, round($qty, 4));
					$activesheet->setCellValue('J'.$counter, $unit_price);
					$activesheet->setCellValue('K'.$counter, $total_price);
					$activesheet->setCellValue('L'.$counter, $total_price * ($tax / 100));
					$activesheet->setCellValue('M'.$counter, ($total_price * ( ($tax / 100) + 1)));
					$activesheet->setCellValue('N'.$counter, $vendor_name);
					$activesheet->setCellValue('O'.$counter, $requester);
					$activesheet->setCellValue('P'.$counter, $project);
					$activesheet->setCellValue('Q'.$counter, $item_type);
					$activesheet->setCellValue('R'.$counter, $mfg);
					$activesheet->setCellValue('S'.$counter, $mfg_pn);
					$activesheet->setCellValue('T'.$counter, $hs_code);
					$activesheet->setCellValue('U'.$counter, $price);
					$activesheet->setCellValue('V'.$counter, $stock);
					$activesheet->setCellValue('W'.$counter, $location);
					$activesheet->setCellValue('X'.$counter, $sourcing);

					if ($currency == 1) {
						$activesheet->getStyle('J'.$counter)->getNumberFormat()->setFormatCode("_($* #,##0_);_($* (#,##0);_($* _);_(@_)");
						$activesheet->getStyle('K'.$counter)->getNumberFormat()->setFormatCode("_($* #,##0_);_($* (#,##0);_($* _);_(@_)");

						if ($tax == 0) {
							$activesheet->getStyle('L'.$counter)->getNumberFormat()->setFormatCode("_(* #,##0_);_(* (#,##0);_(* -_);_(@_)");
						} else {
							$activesheet->getStyle('L'.$counter)->getNumberFormat()->setFormatCode("_($* #,##0_);_($* (#,##0);_($* _);_(@_)");
						}
						$activesheet->getStyle('M'.$counter)->getNumberFormat()->setFormatCode("_($* #,##0_);_($* (#,##0);_($* _);_(@_)");
						
						if ($price == 0) {
							$activesheet->getStyle('U'.$counter)->getNumberFormat()->setFormatCode("_-* #,##0_-;-* #,##0_-;_-* -_-;_-@_-");
						} else {
							$activesheet->getStyle('U'.$counter)->getNumberFormat()->setFormatCode("_($* #,##0_);_($* (#,##0);_($* _);_(@_)");
						}
						if ($stock == 0) {
							$activesheet->getStyle('U'.$counter)->getNumberFormat()->setFormatCode("_-* #,##0_-;-* #,##0_-;_-* -_-;_-@_-");
						} else {
							$activesheet->getStyle('U'.$counter)->getNumberFormat()->setFormatCode("_($* #,##0_);_($* (#,##0);_($* _);_(@_)");
						}

					} else {

						$activesheet->getStyle('J'.$counter)->getNumberFormat()->setFormatCode("_(PKR* #,##0_);_(PKR* (#,##0);_(PKR* _);_(@_)");
						$activesheet->getStyle('K'.$counter)->getNumberFormat()->setFormatCode("_(PKR* #,##0_);_(PKR* (#,##0);_(PKR* _);_(@_)");
						
						if ($tax == 0) {
							$activesheet->getStyle('L'.$counter)->getNumberFormat()->setFormatCode("_(* #,##0_);_(* (#,##0);_(* -_);_(@_)");
						} else {
							$activesheet->getStyle('L'.$counter)->getNumberFormat()->setFormatCode("_(PKR* #,##0_);_(PKR* (#,##0);_(PKR* _);_(@_)");
						}

						$activesheet->getStyle('M'.$counter)->getNumberFormat()->setFormatCode("_(PKR* #,##0_);_(PKR* (#,##0);_(PKR* _);_(@_)");

						if ($price == 0) {
							$activesheet->getStyle('U'.$counter)->getNumberFormat()->setFormatCode("_-* #,##0_-;-* #,##0_-;_-* -_-;_-@_-");
						} else {
							$activesheet->getStyle('U'.$counter)->getNumberFormat()->setFormatCode("_(PKR* #,##0_);_(PKR* (#,##0);_(PKR* _);_(@_)");
						}
					}
					if ($stock == 0) {
						$activesheet->getStyle('V'.$counter)->getNumberFormat()->setFormatCode("_-* #,##0_-;-* #,##0_-;_-* -_-;_-@_-");
					}


					if ($withInvoices) {

						$file_path = "./assets/delivery_chalans/".$file_name;
						if ($file_name != "") {

							if (file_exists("./assets/delivery_chalans/".$file_name)) {
								
								if ($zip->open($zipname, ZipArchive::CREATE) == TRUE) {

							    	$zip->addFile($file_path, "Invoices/".$file_name);
									$zip->close();
								}
							}
						}
					}

					if ($withPRFs) {

						$file_path = "./assets/prfs/PRF_".imsCreateFourDigitNumber($prf_no).".pdf";
						$file_name = "PRF_".imsCreateFourDigitNumber($prf_no).".pdf";
						if (file_exists( $file_path )) {
							
							if ($zip->open($zipname, ZipArchive::CREATE) == TRUE) {

						    	$zip->addFile($file_path, "PRFs/".$file_name);
								$zip->close();
							}
						}
					}

				}
			}


			$activesheet->insertNewRowBefore(1, 1)->getRowDimension('1')->setRowHeight(15);
		    $activesheet->insertNewColumnBefore('A', 1);

			$highestRow = $activesheet->getHighestRow();
		    foreach (range('2', $highestRow) as $row) {
		        $activesheet->getRowDimension($row)->setRowHeight(24);
		    }

		    $highestColumn = $activesheet->getHighestColumn();
		    $columsWidthArray = array(2.75, 8.75, 13.75, 13.75, 13.75, 15.75, 13.75, 100.75, 12.75, 13.75, 16.75, 16.75, 16.75, 20.75, 30.75, 25.75, 40.75, 15.75, 15.75, 15.75, 15.75, 15.75, 15.75, 15.75, 15.75, 2.75);
		    for ($i=0; $i < count($columsWidthArray); $i++) { 
		    	$activesheet->getColumnDimension( chr($i+65) )->setWidth( $columsWidthArray[$i] );
		    }
		   
		    $activesheet->setShowGridlines(false);
		    $activesheet->getStyle('B2:'.$highestColumn.$highestRow)
		                ->getAlignment()
		                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		    $activesheet->getStyle('B2:'.$highestColumn.$highestRow)
		                ->getAlignment()
		                ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		    $activesheet->getStyle('B2:'.$highestColumn.$highestRow)
		                ->getAlignment()
		                ->setIndent(1);

		    $bordersAll = array(
		        'borders' => array(
		            'allborders' => array(
		                'style' => PHPExcel_Style_Border::BORDER_THIN,
		                'color' => array( 'argb' => 'D0D3D4' )
		            )
		        )
		    );
		    $activesheet->getStyle('B2:'.$highestColumn.$highestRow)->applyFromArray($bordersAll);

		    $activesheet->getStyle('B2:'.$highestColumn.'2')->getFont()->setBold(true)
                                ->setName('Verdana')
                                ->setSize(8)
                                ->getColor()
                                ->setRGB('FFFFFF');
            $activesheet->getStyle('B2:'.$highestColumn.'2')->getFill()
            					->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
            					->getStartColor()
            					->setARGB('111A5276');

		    $activesheet->getStyle('B3:'.$highestColumn.$highestRow)->getFont()->setBold(false)
		                                ->setName('Verdana')
		                                ->setSize(8)
		                                ->getColor()
		                                ->setRGB('000000');
		    $activesheet->getStyle('B1:'.$highestColumn.$highestRow)->getAlignment()->setWrapText(true); 

		    // Set Border Top & Bottom
		    $activesheet->getStyle("B2:".$highestColumn.$highestRow)->applyFromArray(
		        array(
		            'borders' => array(
		                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 
		                    'color' => array('rgb' => '1A5276')
		                ),
		                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 
		                    'color' => array('rgb' => '1A5276')
		                ),
		            )
		        )
		    );
		    // Set Border Left & Right
		    $activesheet->getStyle('B2:'.$highestColumn.$highestRow)->applyFromArray(
		        array(
		            'borders' => array(
		                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 
		                    'color' => array('rgb' => '1A5276')
		                ),
		                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 
		                    'color' => array('rgb' => '1A5276')
		                ),
		            )
		        )
		    ); 

		    $activesheet->getStyle('N3:N'.$highestRow)->getFill()
            					->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
            					->getStartColor()
            					->setARGB('11F7F9F9');
            $activesheet->getStyle('N3:N'.$highestRow)->getFont()->setBold(true)
		                                ->setName('Verdana')
		                                ->setSize(8)
		                                ->getColor()
		                                ->setRGB('000000');


			$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
		    $writer->save('./assets/reports/PRFReport.xlsx');


		    if ($withInvoices || $withPRFs) {
			    if (file_exists("./assets/reports/PRFReport.xlsx")) {
													
					if ($zip->open($zipname, ZipArchive::CREATE) == TRUE) {

				    	$zip->addFile("./assets/reports/PRFReport.xlsx", 'PRFReport.xlsx');
						$zip->close();
					}
				}
		    }

		} else {
			
			// Demands Report
			$filterByClient = "";
			$filterByProgram = "";
			$filterByProject = "";
			$filterByTeam = "";
			$filterByUser = "";
			$filterByDate = "";
			$filterBySourcing = "";
			if ($company != null) {
				$filterByClient = "&& client = '$company' ";
			}
			if ($program_budget != null) {
				$filterByProgram = "&& program_budget = '$program_budget' ";
			}
			if ($project_name != null) {
				$filterByProject = "&& project_name = '$project_name' ";
			}
			if ($team_name != null) {
				$filterByTeam = "&& team_name = '$team_name' ";
			}
			if ($user_name != null) {
				$filterByUser = "&& requested_by = '$user_name' ";
			}
			if ($start_date != "" && $end_date != "") {
				$filterByDate = "&& demand_date between '$start_date' and '$end_date' ";
			}

			if ($sourcing == 0) {
				$filterBySourcing = "&& local_or_import = 'local' ";
			} else if ($sourcing == 1) {
				$filterBySourcing = "&& local_or_import = 'import' ";
			} else {
				$filterBySourcing = "";
			}
			

			// Create Excel Sheet
		    $phpExcel = PHPExcel_IOFactory::load('./assets/reports/DemandReport.xlsx');

		    // $activesheet = $phpExcel->getActiveSheet();
		    $activesheet = $phpExcel->createSheet(1);
		    $phpExcel->removeSheetByIndex(0);
		    $activesheet->setTitle('DemandReport');


		    // Excel Heading
		    $headingArray = array('Sr. No', 'Demand No', 'Date', 'Requester', 'Campus', 'Team', 'Project', 'Description', 'UOM', 'Quantity', 'Status');
		    for ($i=0; $i < count($headingArray); $i++) { 
		    	$activesheet->setCellValue(chr($i+65).'1', $headingArray[$i]);
		    }

			$counter = 1;
			$query = "Select * FROM demands WHERE status <> 'deleted' $filterByClient $filterBySourcing $filterByProgram $filterByProject $filterByTeam $filterByUser $filterByDate ORDER By demand_no DESC ";
			$result = mysqli_query($connection, $query);
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					
					$demand_no = $row['demand_no'];
					$date = date('d/m/y', strtotime($row['demand_date']) );
					$requester = $row['requester_name'];
					$campus_name = $row['campus_name'];
					$team_name = $row['team_name'];
					$program_budget = $row['program_budget'];
					$project_name = $row['project_name'];
					if ($project_name != "" && $project_name != "-") {
						$project = $program_budget ." - (".$project_name.")";
					} else {
						$project = $program_budget;
					}

					if ($program_budget == "") {
						$project = ucfirst($project_name);
					}

					$query2 = "Select * FROM demand_products WHERE demand_no = $demand_no ";
					$result2 = mysqli_query($connection, $query2);
					if (mysqli_num_rows($result2) > 0) {
						while ($row2 = mysqli_fetch_assoc($result2)) {

							$product_id = $row2['product_id'];
							$qty = $row2['approve_qty'];
							if ($qty == 0) {
								$qty = $row2['qty'];
							}
							$status = ucwords($row2['status']);

							$query3 = "Select * FROM products WHERE product_sku = '$product_id' ";
							$result3 = mysqli_query($connection, $query3);
							if (mysqli_num_rows($result3) > 0) {
								while ($row3 = mysqli_fetch_assoc($result3)) {

									$product_name = ucwords($row3['product_name']);
									$specification = ucfirst($row3['specification']);
									$description = $product_name;
									if ($specification != "") {
										$description = $product_name . " - (" . $specification.")";
									}
									$uom = $row3['uom'];
								}
							}
							
							$activesheet->setCellValue('A'.$counter+1, $counter++);
			                $activesheet->setCellValue('B'.$counter, $demand_no);
			                $activesheet->setCellValue('C'.$counter, $date);
			                $activesheet->setCellValue('D'.$counter, $requester);
			                $activesheet->setCellValue('E'.$counter, $campus_name);
			                $activesheet->setCellValue('F'.$counter, ucwords($team_name));
			                $activesheet->setCellValue('G'.$counter, $project);
			                $activesheet->setCellValue('H'.$counter, $description);                
							$activesheet->setCellValue('I'.$counter, $uom);              
			                $activesheet->setCellValue('J'.$counter, $qty);
			                $activesheet->setCellValue('K'.$counter, $status);
						}
					}
				}
			}

		    $activesheet->insertNewRowBefore(1, 1)->getRowDimension('1')->setRowHeight(15);
		    $activesheet->insertNewColumnBefore('A', 1);

			$highestRow = $activesheet->getHighestRow();
		    foreach (range('2', $highestRow) as $row) {
		        $activesheet->getRowDimension($row)->setRowHeight(24);
		    }

		    $highestColumn = $activesheet->getHighestColumn();
		    $columsWidthArray = array(2.75, 8.75, 13.75, 12.75, 25.75, 12.75, 20.75, 40.75, 100.75, 10.75, 13.75, 28.75, 2.75);
		    for ($i=0; $i < count($columsWidthArray); $i++) { 
		    	$activesheet->getColumnDimension( chr($i+65) )->setWidth( $columsWidthArray[$i] );
		    }
		   
		    $activesheet->setShowGridlines(false);
		    $activesheet->getStyle('B2:'.$highestColumn.$highestRow)
		                ->getAlignment()
		                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		    $activesheet->getStyle('B2:'.$highestColumn.$highestRow)
		                ->getAlignment()
		                ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		    $activesheet->getStyle('B2:'.$highestColumn.$highestRow)
		                ->getAlignment()
		                ->setIndent(1);

		    $bordersAll = array(
		        'borders' => array(
		            'allborders' => array(
		                'style' => PHPExcel_Style_Border::BORDER_THIN,
		                'color' => array( 'argb' => 'D0D3D4' )
		            )
		        )
		    );
		    $activesheet->getStyle('B2:'.$highestColumn.$highestRow)->applyFromArray($bordersAll);

		    $activesheet->getStyle('B2:'.$highestColumn.'2')->getFont()->setBold(true)
                                ->setName('Verdana')
                                ->setSize(8)
                                ->getColor()
                                ->setRGB('FFFFFF');
            $activesheet->getStyle('B2:'.$highestColumn.'2')->getFill()
            					->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
            					->getStartColor()
            					->setARGB('111A5276');


		    $activesheet->getStyle('B3:'.$highestColumn.$highestRow)->getFont()->setBold(false)
		                                ->setName('Verdana')
		                                ->setSize(8)
		                                ->getColor()
		                                ->setRGB('000000');
		    $activesheet->getStyle('B1:'.$highestColumn.$highestRow)->getAlignment()->setWrapText(true);

		    // Set Border Top & Bottom
		    $activesheet->getStyle("B2:".$highestColumn.$highestRow)->applyFromArray(
		        array(
		            'borders' => array(
		                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 
		                    'color' => array('rgb' => '1A5276')
		                ),
		                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 
		                    'color' => array('rgb' => '1A5276')
		                ),
		            )
		        )
		    );
		    // Set Border Left & Right
		    $activesheet->getStyle('B2:'.$highestColumn.$highestRow)->applyFromArray(
		        array(
		            'borders' => array(
		                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 
		                    'color' => array('rgb' => '1A5276')
		                ),
		                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 
		                    'color' => array('rgb' => '1A5276')
		                ),
		            )
		        )
		    );                      

		    $writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
		    $writer->save('./assets/reports/DemandReport.xlsx');
		}
	}
?>