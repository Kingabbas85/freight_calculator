<?php

	$onlyNumeric = "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');";
	$onlyCharacter = "this.value = this.value.replace(/[^A-Za-z ]/g, '');";
	$forLocation = "this.value = this.value.replace(/[^A-Za-z0-9 ()-]/g, '').replace(/(\--*)\-/g, '$1');";
	$forContactNo = "this.value = this.value.replace(/[^0-9+-]/g, '').replace(/(\--*)\-/g, '$1')";
	$aplhaNumericwithParenthesisandComma = "this.value = this.value.replace(/[^-A-Za-z0-9)(, ]/g, '').replace(/(\,,*)\,/g, '$1').replace(/(\, ,*)\,/g, '$1');";
	$aplhaNumericwithDash = "this.value = this.value.replace(/[^A-Za-z0-9 - ]/g, '').replace(/(\,,*)\,/g, '$1').replace(/(\, ,*)\,/g, '$1');";
	$forVendorName = "this.value = this.value.replace(/[^A-Za-z0-9) (),& -]/g, '').replace(/(\,,*)\,/g, '$1').replace(/(\&&*)\&/g, '$1').replace(/(\--*)\-/g, '$1');";
	$forAddress = "this.value = this.value.replace(/[^A-Za-z0-9) )( , & #]/g, '');";
	$forEmail = "this.value = this.value.replace(/[^A-Za-z0-9 - . @ _ ]/g, '').replace(/(\@@*)\@/g, '$1');";
	$forReferenceNo = "this.value = this.value.replace(/[^A-Za-z0-9-]/g, '').replace(/(\--*)\-/g, '$1');";
	$forInvoiceNo = "this.value = this.value.replace(/[^A-Za-z0-9- ]/g, '').replace(/(\--*)\-/g, '$1').replace(/(\  *)\ /g, '$1');";
	$allowMultipleInvoiceNo = "this.value = this.value.replace(/[^A-Za-z0-9-, ]/g, '').replace(/(\,,*)\,/g, '$1').replace(/(\  *)\ /g, '$1');";
	$forHSCode = "this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/(\--*)\-/g, '$1');";
	$forPartNo = "this.value = this.value.replace(/[^A-Za-z0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/(\--*)\-/g, '$1');";
	$forProjectName = "this.value = this.value.replace(/[^A-Za-z0-9-.,& )( / ]/g, '').replace(/(\..*)\./g, '$1').replace(/(\,,*)\,/g, '$1').replace(/(\--*)\-/g, '$1').replace(/(\&&*)\&/g, '$1');";
	
	$expectSingleAndDoubleQuote = "this.value = this.value.replace(/[^A-Za-z0-9-.,& )( _/ ]/g, '');";

	$expectQuotationSymbols = "this.value = this.value.replace(/[^A-Za-z0-9-.,&#@!$%^*;:>< )( _/ ]/g, '');";

	// $Domain = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$Domain = "http://$_SERVER[HTTP_HOST]";

	$developersList = array('junaid.khalil', 'ali.abbas', 'ksheikh');
	$approversList = array('mirfan', 'irfan.maqsood', 'ykhan', 'yaqoob.khan', 'junaid.khali');



	/**
	 * [imsNumbersFormat shorten the number and add 'K', 'M', 'B' at the end of that number]
	 * @param  [integer] $value [description]
	 * @return [string]        [description]
	 */
	function imsNumbersFormat($value) {

		if ($value < 1000) {
			// Anything less than a million
			$total = number_format($value, 2);
		} else if ($value < 1000000) {
			// Anything less than a 100 Thousand
			$total = number_format($value / 1000, 2) . 'K';
		} else if ($value < 1000000000) {
			// Anything less than a billion
			$total = number_format($value / 1000000, 2) . 'M';
		} else {
			// At least a billion
			$total = number_format($value / 1000000000, 2) . 'B';
		}
		return $total;
	}

	/**
	 * [imsCurrencyConversion converts 'PKR' currency into '$' or 'euro']
	 * @param  [integer] $value    [description]
	 * @param  [integer] $currency [description]
	 * @return [integer]           [description]
	 */
	function imsCurrencyConversion($value, $currency) {

		if ($currency == 1) {
			return $value * 175;
		} else if ($currency == 2) {
			return $value * 200;
		} else {
			return $value;
		}
	}

	/**
	 * [pre_r echo the array]
	 * @param  [type] $array [description]
	 * @return [type]        [description]
	 */
	function pre_r($array) {

		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}

	/**
	 * [count_total_months_and_days gets two dates and return an object with date details]
	 * @param  [integer] $check_in_date  [description]
	 * @param  [integer] $check_out_date [description]
	 * @return [object]                 [description]
	 */
	function count_total_months_and_days($check_in_date, $check_out_date) {

		$date1 = date_create($check_in_date);
		$date2 = date_create($check_out_date);
		$difference = date_diff($date1, $date2);
		return $difference;
	}

	/**
	 * [Domain returns the exact path of a file]
	 * @param [type] $url [file path after 'ims/']
	 * @return [string] [complete root path of a file]
	 */
	function Domain($url) {
		return $_SERVER['DOCUMENT_ROOT'].'/ims/'.$url;
	}

	if (!function_exists('str_contains')) {
		function str_contains($haystack, $needle) {
			return $needle !== '' && mb_strpos($haystack, $needle) !== false;
		}
	}

	/**
	 * [imsCheckCooStatus returns the last row of user_meta table]
	 * @param  [string] $user_name [description]
	 * @return [array]            [description]
	 */
	function imsCheckVisitModeStatus($user_name) {

		if (empty($user_name)) {
			return false;
		}
		$current_status_array = array();
		$connection = mysqli_connect("localhost", "root", "ims-admin$", "ims");

		// $user_name = 'mirfan';
		$query = "Select * FROM user_meta WHERE user_id = '$user_name' ORDER BY umeta_id DESC LIMIT 1";
		$result = mysqli_query($connection, $query);

		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$current_status_array = unserialize($row['meta_value']);
		}
		return $current_status_array;
	}

	/**
	 * [imsShowHideVisitModeOption checks if irfan sb is active or not]
	 * @param  [string] $user_name [description]
	 * @return [boolean] [description]
	 */
	function imsShowHideVisitModeOption($user_name) {

		if ($user_name == 'irfan.maqsood' || $user_name == 'mirfan' || $user_name == 'ykhan' || $user_name == 'yaqoob.khan' || $_SESSION['user_role'] == 'developer') {
			return true;
		}
		return false;
	}

	function imsDateFormat($date) {
		return date("d-M-Y", strtotime($date));
	}
	function imsDateFormatwithTime($date) {
		return date("d-M-Y H:i", strtotime($date));
	}

	function mraCreateSixDigitNumber($number) {

		if ($number <= 9) {
			$number = "00000" . $number;
		}
		if ($number > 9 && $number <= 99) {
			$number = "0000" . $number;
		}
		if ($number > 99 && $number <= 999) {
			$number = "000" . $number;
		}
		if ($number > 999 && $number <= 9999) {
			$number = "00" . $number;
		}
		if ($number > 9999 && $number <= 99999) {
			$number = "0" . $number;
		}
		return $number;
	}
	function mraCreateFourDigitNumber($number) {

		if ($number <= 9) {
			$number = "000" . $number;
		}
		if ($number > 9 && $number <= 99) {
			$number = "00" . $number;
		}
		if ($number > 99 && $number <= 999) {
			$number = "0" . $number;
		}
		return $number;
	}
	function mraCreateTwoDigitNumber($number) {

		if ($number <= 9) {
			$number = "0" . $number;
		}
		return $number;
	}

	 /**
	  * Summary of mraCurrencyUnit
	  * @param mixed $currency
	  * @return string
	  */
	function mraCurrencyUnit($currency) {

		if ($currency == 0) {
			$currencyUnit = "PKR";
		} else if ($currency == 1) {
			// $currencyUnit = "$";
			$currencyUnit = "USD";
		} else if ($currency == 2) {
			// $currencyUnit = "£";
			$currencyUnit = "GBP";
		} else if ($currency == 3) {
			// $currencyUnit = "£";
			$currencyUnit = "EUR";
		}
		return $currencyUnit;
	}
	/**
	 * [imsSendEmail sends Emails to users]
	 * @param  [string] $to          [description]
	 * @param  [string] $subject     [description]
	 * @param  [string] $message     [description]
	 * @param  [array] $attachments [description]
	 * @param  [array] $recipients  [description]
	 * @return [boolean] [description]
	 */
	function imsSendEmail($sendTo = array(), $subject, $message = '', $attachments = array(), $recipients = array()) {

		// $mail_autoload = dirname(__FILE__).DIRECTORY_SEPARATOR.'packages/phpmailer/PHPMailerAutoload.php';
		// include Domain('packages/phpmailer/PHPMailerAutoload.php');
		$include_file_path = Domain('packages/phpmailer/PHPMailerAutoload.php');
		require_once($include_file_path);

		$mail = new PHPMailer;
		// $mail->SMTPDebug = 4; // Enable verbose debug output
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'vt-mex01.venturetronics.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = 'VT-INVEN@venturetronics.com'; // SMTP username
		$mail->Password = 'WelcomeIMS_$2'; // SMTP password
		$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587; // TCP port to connect to

		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

		$mail->setFrom('VT-INVEN@venturetronics.com', 'IMS');

		$sendTo = ['junaid.khalil@venturetronics.com','ali.abbas@raythorne.com'];

		// // Sent To
		if ( !empty( $sendTo ) && is_array( $sendTo ) ) {
			foreach ( $sendTo as $to ) {
				$mail->addAddress( $to );
			}
		}
		// $mail->addAddress('junaid.khalil@venturetronics.com');

		// // Add CC
		// if ( !empty( $recipients ) && is_array( $recipients ) ) {
		// 	foreach ( $recipients as $cc ) {
		// 		$mail->addCC( $cc );
		// 	}
		// }
		$mail->addCC('junaidkhalil114@gmail.com');

		$mail->addReplyTo('no-reply@venturetronics.com');
		// $mail->addReplyTo('VT-INVEN@venturetronics.com');

		if (!empty($attachments) && is_array($attachments)) {
			foreach ($attachments as $attachment) {
				$mail->addAttachment($attachment);
			}
		}

		$message .= "<html>
					<body>
						<br><br><br>
						<div style='border-top:1px solid #D0D3D4; width:100%; padding-top:5px;'>
							<span style='font-size:16px; font-weight:600;'>
								<i> Note: </i>
							</span>
							<span>
								<i> This is a system generated email. </i>
							</span>
						</div>
					</body>
				</html>";

		$mail->isHTML(true); // Set email format to HTML

		$mail->Subject = $subject;
		$mail->Body = $message;


		// Add image in email body
		$mail->AddEmbeddedImage("./assets/Local_Items_Report/Pending Items Report - (Local).jpeg", "local_chart");
		$mail->AddEmbeddedImage("./assets/Imported_Items_Report/Pending Items Report - (Internatinal).jpeg", "import_chart");


		if (!$mail->send()) {
			return false;
		} else {
			return true;
		}
	}

	function imsCountNumberOfDays($start_date, $end_date) {

		// $intval = count_total_months_and_days($start_date, $end_date);
		// $days = $intval->d;
		$start_date = strtotime($start_date);
		$end_date = strtotime($end_date);
		$difference = $end_date - $start_date;
		$days = round($difference / (60 * 60 * 24));
		return $days;
	}

	function imsCountBusinessDays($start_date, $end_date) {

		$start__date = $start_date;
		$start_date = strtotime($start_date);
		$end_date = strtotime($end_date);
		$difference = $end_date - $start_date;
		$days = round($difference / (60 * 60 * 24));
		$working_days = 0;
		for ($i = 0; $i < $days; $i++) {
			$week_day = date("w", strtotime($start__date . ' +' . $i . ' days'));
			// Week days start from sunday at 0 index
			if ($week_day != 6 && $week_day != 0) {
				$working_days++;
			}
		}
		return $working_days;
	}


	function imsGetProgramTotal($connection, $client_id, $program_budget, $project_name, $grand_total) {

		$current_date = date('d-m-Y');
		$start_date = date('Y-m-01', strtotime($current_date));
		$end_date = date('Y-m-t', strtotime($current_date));
		$month = date('m');
		$year = date('Y');
		$dollar_rate = 0;
		$query = "Select * from conversion_rate WHERE month = '$month' && year = '$year' ";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$dollar_rate = $row['rate'];
			}
		}
		$budget = 0;
		$query2 = "Select * from budgets WHERE company_id = '$client_id' && program_budget = '$program_budget' && project_name = '$project_name' && month = '$month' && year = '$year' ";
		$result2 = mysqli_query($connection, $query2);
		if (mysqli_num_rows($result2)) {
			while ($row2 = mysqli_fetch_assoc($result2)) {
				$budget = $row2['budget'];
			}
		} else {
			$query2 = "Select * from budgets WHERE company_id = '$client_id' && program_budget = '$program_budget' && project_name = '' && month = '$month' && year = '$year' ";
			$result2 = mysqli_query($connection, $query2);
			if (mysqli_num_rows($result2)) {
				while ($row2 = mysqli_fetch_assoc($result2)) {
					$budget = $row2['budget'];
				}
			} else {
				$query2 = "Select * from budgets WHERE company_id = '$client_id' && program_budget = '' && project_name = '' && month = '$month' && year = '$year' ";
				$result2 = mysqli_query($connection, $query2);
				if (mysqli_num_rows($result2)) {
					while ($row2 = mysqli_fetch_assoc($result2)) {
						$budget = $row2['budget'];
					}
				}
			}
		}
		// return $query2;
		$this_month_total = 0;
		$calculationArray = array();
		$query3 = "Select * FROM prf_items INNER JOIN demands ON demands.demand_no = prf_items.demand_no WHERE prf_items.created_at BETWEEN '$start_date' AND '$end_date' AND demands.program_budget = '$program_budget' && demands.project_name = '$project_name'";
		$result3 = mysqli_query($connection, $query3);
		if (mysqli_num_rows($result3) > 0) {
			while ($row3 = mysqli_fetch_assoc($result3)) {
				$this_received_qty = $row3['received_qty'];
				$this_unit_price = $row3['unit_price'];
				$this_prf_tax = $row3['tax'];
				$this_demand_currency = $row3['currency'];
				$this_received_qty = round($this_received_qty, 2);
				$this_unit_price = round($this_unit_price, 3);
				$this_total_price = ($this_received_qty * $this_unit_price);
				$this_total_price = round($this_total_price, 2);
				if ($this_prf_tax) {
					$this_total_price = ($this_total_price) * (($this_prf_tax / 100) + 1);
				}
				if ($this_demand_currency == 1) {
					$this_total_price = $this_total_price * $dollar_rate;
				}
				$this_month_total = $this_month_total + $this_total_price;
			}
		}
		$this_month_total = $this_month_total + $grand_total;

		if ((($budget * $dollar_rate) <= $this_month_total) && $budget != 0) {
			$exceeded = true;
		} else {
			$exceeded = false;
		}
		if ($budget == 0 || $dollar_rate == 0) {
			$exceeded = true;
		}
		return $exceeded;
	}

	function imsGetClientBudget($connection, $grand_total, $currency) {

		$client_id = 10;
		$current_date = date('d-m-Y');
		$start_date = date('Y-m-01', strtotime($current_date));
		$end_date = date('Y-m-t', strtotime($current_date));
		$month = date('m');
		$year = date('Y');
		$dollar_rate = 0;
		$query = "Select * from conversion_rate WHERE month = '$month' && year = '$year' ";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$dollar_rate = $row['rate'];
			}
		}
		if ($currency == 0) {
			$grand_total = $grand_total / $dollar_rate;
		}
		$budget = 10000;
		$this_month_total = 0;
		$calculationArray = array();
		$query2 = "Select * FROM prf_items INNER JOIN demands ON demands.demand_no = prf_items.demand_no WHERE demands.client = '$client_id'";
		$result2 = mysqli_query($connection, $query2);
		if (mysqli_num_rows($result2) > 0) {
			while ($row2 = mysqli_fetch_assoc($result2)) {
				$this_received_qty = $row2['received_qty'];
				$this_unit_price = $row2['unit_price'];
				$this_prf_tax = $row2['tax'];
				$this_demand_currency = $row2['currency'];
				$this_received_qty = round($this_received_qty, 2);
				$this_unit_price = round($this_unit_price, 3);
				$this_total_price = ($this_received_qty * $this_unit_price);
				$this_total_price = round($this_total_price, 2);
				if ($this_prf_tax) {
					$this_total_price = ($this_total_price) * (($this_prf_tax / 100) + 1);
				}
				if ($this_demand_currency == 0) {
					$this_total_price = $this_total_price / $dollar_rate;
				}
				$this_month_total = $this_month_total + $this_total_price;
			}
		}
		$this_month_total = $this_month_total + $grand_total;
		if ((($budget * $dollar_rate) <= $this_month_total) && $budget != 0) {
			$exceeded = true;
		} else {
			$exceeded = false;
		}
		if ($budget == 0 || $dollar_rate == 0) {
			$exceeded = true;
		}
		return $exceeded;
	}

	function imsGetMonthName($month) {
		$dateObj = DateTime::createFromFormat('!m', $month);
		$monthName = $dateObj->format('F');
		// $monthName = $dateObj->format('M');
		return $monthName;
	}

	function imsYearsList() {
		$yearList = array();
		// $year_name = date('Y', strtotime('2025-06-20'));
		$year_name = date('Y');
		$start_range = 2022 - $year_name;
		for ($i = $start_range; $i < 3; $i++) {
			$yearList[] = $year_name + $i;
		}
		return $yearList;
	}

	function imsGetClientNameById($connection, $client_id) {

		$client_name = "-";
		$query = "Select * FROM clients WHERE client_id = $client_id    ";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$client_name = $row['client_name'];
			}
		}
		return $client_name;
	}


	/**
	 * Function to get DISTINCT values from a table column as options, optionally excluding specific values
	 *
	 * @param mysqli $connection - MySQL database connection
	 * @param string $table_name - Name of the table from which to fetch distinct values
	 * @param string $column_name - Name of the column to fetch distinct values
	 * @param array $excluded_values - An array of values to be excluded from the result (optional)
	 * @param array $selected - Optional: An array containing the values to be selected by default in the select picker
	 * @return string - HTML options for the select picker
	 */
	function imsGetDistintOptionsByTable($connection, $table_name, $column_name, $excluded_values = array(), $selected = array()) {

		$excluded_condition = '';
		if (!empty($excluded_values)) {
			$excluded_condition = " && $column_name NOT IN ('" . implode("','", $excluded_values) . "')";
		}

		if ($column_name == 'requested_by') {
			$column_name = 'requested_by, requester_name';
			// $value = $default_value." (".$row['requester_name'].")";
		}
		$module = $_SESSION['_module'];

		if ($module == 1) {
			$local_or_import = "WHERE local_or_import = 'import' ";
		} else {
			$local_or_import = "WHERE local_or_import = 'local' ";
		}

		$query = "SELECT DISTINCT $column_name FROM $table_name  $local_or_import $excluded_condition ORDER BY id DESC";
		$result = mysqli_query($connection, $query);
		//For  Requester by
		if ($column_name == 'requested_by, requester_name') {
			$column_name = 'requested_by';
		}

		$options = "";
		$options .= "<select data-column='$column_name' class='selectpicker form-control form-control-sm columnFilterCustom' multiple data-actions-box='false' data-live-search='true' title='Choose' id='columnFilterCustom' data-selected-text-format='count'>";

		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				// $default_value = $row[$column_name];
				// $value = $default_value;
				$default_value = $row[$column_name];
				$value = $default_value;
				// Perform any additional value modifications if needed (e.g., formatting dates, adding prefixes)
				if ($column_name == 'demand_date') {
					$default_value = date("Y-m-d", strtotime($default_value));
					$value = date("d-M-Y", strtotime($value));
				} elseif ($column_name == 'demand_no') {
					$value = "DEM-" . imsCreateFourDigitNumber($value);
				} elseif ($column_name == 'client') {
					$value = imsGetClientNameById($connection, $value);
				} elseif ($column_name == 'assign_to') {
					$parts = explode('.', $value);
					$capitalizedParts = array_map('ucfirst', $parts);
					$value = implode(' ', $capitalizedParts);
				} elseif ($column_name == 'requested_by') {
					$default_value = $row['requested_by'];
					$value = $row['requester_name'] . " (" . $default_value . ")";
				} elseif ($column_name == 'updated_at') {
					// Perform any additional modifications for this column if needed
				} else {
					$value = ucfirst($value);
				}

				// Check if the column exists in the selected array and get its selected values
				if (isset($selected[$column_name]) && is_array($selected[$column_name])) {
					$selected_values = $selected[$column_name];
					$selected_attr = in_array($default_value, $selected_values) ? 'selected' : '';
				} else {
					// If the column is not present in the selected array or no selected values for that column, set selected_attr to empty
					$selected_attr = '';
				}

				$options .= "<option value='$default_value' $selected_attr> $value </option>";
			}
		}

		$options .= "</select>";
		return $options;
	}

	function imsGetQuotationNumber($connection, $demand_no) {

		$unique_quotation_no = 1;
		$query = "Select * FROM quotations WHERE quotation_no = $demand_no ORDER BY unique_quotation_no DESC LIMIT 1";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$unique_quotation_no = isset($row['unique_quotation_no']) ? (int)$row['unique_quotation_no'] : 1;
				$unique_quotation_no = $unique_quotation_no + 1;
			}
		}
		return $unique_quotation_no;
	}

	function buildQuotationDemandWhereClause($demand_no, $value) {
		// Check if demand number is greater than DEMAND_COUNT_NUMBER
		if ($demand_no > DEMAND_COUNT_NUMBER) {
			$whereClause = "quotation_id = '$value'";
		} else {
			$whereClause = "quotation_no = '$value'";
		}

		return $whereClause;
	}

	function getQuotationIdByNumbers($connection, $quotation_no, $unique_quotation_no) {
		$quotation_id = 0;
		$query = "Select * FROM quotations WHERE quotation_no = $quotation_no AND unique_quotation_no = $unique_quotation_no";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$quotation_id = $row['Id'];
			}
		}
		return $quotation_id;
	}

	function imsGetPONumber($connection, $demand_no) {

		$unique_prf_no = 1;
		$query = "Select * FROM prfs WHERE demand_no = $demand_no ORDER BY unique_prf_no DESC LIMIT 1";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$unique_prf_no = $row['unique_prf_no'];
				$unique_prf_no = $unique_prf_no + 1;
			}
		}
		return $unique_prf_no;
	}

	function imsGetDemandNoByPoId($connection, $po_id) {
		 $query = "Select * FROM prfs WHERE Id = $po_id";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$demand_no = $row['demand_no'];
			}
		}
		return $demand_no;
	}

	function imsGetDemandNoByPoNumbner($connection, $po_no) {
		 $query = "Select * FROM prfs WHERE prf_no = $po_no";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$demand_no = $row['demand_no'];
			}
		}
		return $demand_no;
	}

	function imsGetPOIdByPoNumber($connection, $po_no) {
			$query = "Select * FROM prfs WHERE prf_no = $po_no";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$po_Id = $row['Id'];
			}
		}
		return $po_Id;
	}

	function imsGetPOById($connection, $po_id) {
		$query = "Select * FROM prfs WHERE Id = $po_id";
	$result = mysqli_query($connection, $query);
	if (mysqli_num_rows($result)) {
		while ($row = mysqli_fetch_assoc($result)) {
			return $row;
		}
	}
}


	function generateWeekArrayStartingFromMonday($currentDate) {
		
		
		// $weekArray = array('pastdue', 'prepay');
		$weekArray = array();
		// Get the current day of the week (0 for Sunday, 1 for Monday, etc.)
		$currentDayOfWeek = date('N', strtotime($currentDate));
		// Calculate the first Monday on or before the current date
		$firstMonday = date('Y-m-d', strtotime("-" . ($currentDayOfWeek - 1) . " days", strtotime($currentDate)));

		for ($i = 0; $i < 5; $i++) {
			$startDate = date('Y-m-d', strtotime("+$i weeks", strtotime($firstMonday)));
			$endDate = date('Y-m-d', strtotime("+$i weeks +4 days", strtotime($firstMonday)));

			$weekArray[] = "$startDate - $endDate";
		}

		return $weekArray;
	}


	function getColorByDueDate($dueDate) {
		$legendColors = array('118A0707', '11CC1100', '11FBC02D', '114CAF50');
		$currentDate = date("Y-m-d");
	
		// Check if $dueDate is "Prepaid"
		if ($dueDate == "Prepaid") {
			return $legendColors[0]; // First color for Prepaid
		}
	
		// Calculate the date difference
		$dateDifference = floor((strtotime($dueDate) - strtotime($currentDate)) / (60 * 60 * 24));
	
		// Determine the color based on the date difference
		if ($dateDifference <= 7) {
			return $legendColors[1]; // Second color for <= 7 days difference
		} elseif ($dateDifference <= 15) {
			return $legendColors[2]; // Third color for <= 15 days difference
		} else {
			return $legendColors[3]; // Last color for > 15 days difference
		}
	}
	



	// function mraGetVendorNamesFromVendorIds($vendors_chart_data, $vendor_ids) {

	// 	$vendor_names = array();
	// 	$vendors_chart_data_with_names = array();
    //    	$query = "Select * FROM vendors WHERE Id > '0' $vendor_ids";
    //     $result = mysqli_query($connection, $query);
	// 	return mysqli_num_rows($result);
    //     if (mysqli_num_rows($result)) {
    //         while ($row = mysqli_fetch_assoc($result)) {
    //             $vendor_id = $row['vendor_id'];
    //             $vendor_name = $row['vendor_name'];

    //             $vendor_names[$vendor_id] = $vendor_name;
    //         }
			
	// 		// // Replace vendor IDs with vendor names in the array keys
	// 		// $vendors_chart_data_with_names = array();
	// 		// foreach ($vendors_chart_data as $vendor_id => $amount) {
	// 		// 	$vendor_name = isset($vendor_names[$vendor_id]) ? $vendor_names[$vendor_id] : 'Invalid Vendor Id';
	// 		// 	$vendors_chart_data_with_names[$vendor_name] = $amount;
	// 		// }
    //     }

	// 	return $vendor_names;
	// }

	function mraGetVendorNameByVendorId($connection, $vendor_id) {

		// $vendor_names = array();
       	// $query = "Select * FROM vendors WHERE Id > '0' $vendor_ids";
        // $result = mysqli_query($connection, $query);
        // if (mysqli_num_rows($result)) {
        //     while ($row = mysqli_fetch_assoc($result)) {
        //         $vendor_id = $row['vendor_id'];
        //         $vendor_name = $row['vendor_name'];

        //         $vendor_names[$vendor_id] = $vendor_name;
        //     }
        // }
		// return $vendor_names;

       	$query = "Select * FROM vendors WHERE vendor_id = '$vendor_id'";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                return $vendor_name = ucwords($row['vendor_name']);
            }
        }
		return '';
	}

	function mraGetClientNameByClientId($connection, $quotation_no) {

       	$query = "Select * FROM quotations WHERE quotation_no = '$quotation_no'";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_assoc($result)) {
				
				$client_id = $row['client_id'];
				$query2 = "Select * FROM clients WHERE client_id = '$client_id'";
				$result2 = mysqli_query($connection, $query2);
				if (mysqli_num_rows($result2)) {
					while ($row2 = mysqli_fetch_assoc($result2)) {
						return $client_name = ucwords($row2['client_name']);
					}
				}
			}
		}

       	// $query = "Select * FROM clients WHERE client_id = '$client_id'";
        // $result = mysqli_query($connection, $query);
        // if (mysqli_num_rows($result)) {
        //     while ($row = mysqli_fetch_assoc($result)) {
        //         return $client_name = ucwords($row['client_name']);
        //     }
        // }
		return '';
	}

	/**
	 * Function to get full name of the user
	 *
	 * @param [type] $connection
	 * @param [type] $username
	 * @return string|false
	 */
	function getFullName($connection, $username)
	{
		if (isset($username)) {
			$users = "SELECT * FROM users WHERE user_name = '$username'";
			$result = mysqli_query($connection, $users);
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					$display_name = $row['display_name'];
				}
				$fullname = $display_name;
				return $fullname;
			}
		} else {
			return false;
		}
	}

	/**
	 * Function to get Product name of the product_id
	 *
	 * @param [type] $connection
	 * @param [type] $product_id
	 * @return string|false
	 */
	function getProductNameById($connection, $product_id)
	{
		if (isset($product_id)) {
			$users = "SELECT * FROM products WHERE product_sku = '$product_id'";
			$result = mysqli_query($connection, $users);
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					$display_name = $row['description'];
				}
				$fullname = $display_name;
				return $fullname;
			}
		} else {
			return false;
		}
	}

