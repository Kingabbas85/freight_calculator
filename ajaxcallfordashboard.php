<?php
	include_once("includes/session.php");
	include_once('database/database.php');

    if (isset($_POST['getDashboardData'])) {
        
        $selected_days = $_POST['selected_days'];
        $start_date = $_POST['start_date']." 00:00:00";
        $end_date = $_POST['end_date']." 23:59:59";
        // $arr_vendor_ids = $_POST['vendor_ids'];
        // $arr_client_ids = $_POST['client_ids'];

        $vendor_ids = '';
        if (isset($_POST['vendor_ids'])) {
            $vendor_ids = "'".implode( "','", $_POST['vendor_ids'])."'";
            $vendor_ids = "&& vendor_id IN ($vendor_ids)";
        }
        // echo $vendor_ids;

        $client_ids = '';
        if (isset($_POST['client_ids'])) {
            $client_ids = "'".implode( "','", $_POST['client_ids'])."'";
            $client_ids = "&& client_id IN ($client_ids)";
        }
        // echo $client_ids;
        
        $to_pay = 0;
        $vendors_chart_data = array();
        if ($selected_days == 0) {
            $query = "Select * FROM purchases WHERE status = '1' && is_closed = '0' && is_paid = '0' $vendor_ids";
        } else {
            $query = "Select * FROM purchases WHERE created_at BETWEEN '$start_date' AND '$end_date' && status = '1' && is_closed = '0' && is_paid = '0' $vendor_ids";
        }
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $to_pay += $row['grand_total'];
                
                $vendor_id = $row['vendor_id'];
                $grand_total = $row['grand_total'];

                $vendor_name = mraGetVendorNameByVendorId($connection, $vendor_id);
                if (!array_key_exists($vendor_name, $vendors_chart_data)) {
                    $vendors_chart_data[$vendor_name] = $grand_total;
                } else {
                    $vendors_chart_data[$vendor_name] += $grand_total;
                }
            }
        }
        arsort($vendors_chart_data);


        $to_receive = 0;
        $clients_chart_data = array();
        if ($selected_days == 0) {
            // $query = "Select * FROM invoices WHERE status = '1' && is_closed = '0' && is_paid = '0' $client_ids";
            $query = "Select *, invoices.grand_total AS inv_grandtotal FROM invoices INNER JOIN quotations ON invoices.quotation_no = quotations.quotation_no WHERE invoices.status = '1' && invoices.is_closed = '0' && invoices.is_paid = '0' $client_ids";
        } else {
            $query = "Select *, invoices.grand_total AS inv_grandtotal FROM invoices INNER JOIN quotations ON invoices.quotation_no = quotations.quotation_no WHERE invoices.created_at BETWEEN '$start_date' AND '$end_date' && invoices.status = '1' && invoices.is_closed = '0' && invoices.is_paid = '0' $client_ids";
        }
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $to_receive += $row['inv_grandtotal'];

                $quotation_no = $row['quotation_no'];
                $grand_total = $row['inv_grandtotal'];

                $client_name = mraGetClientNameByClientId($connection, $quotation_no);
                if (!array_key_exists($client_name, $clients_chart_data)) {
                    $clients_chart_data[$client_name] = $grand_total;
                } else {
                    $clients_chart_data[$client_name] += $grand_total;
                }
            }
        }
        arsort($clients_chart_data);

        $array = array();
        $array['to_pay'] = number_format($to_pay, 2);
        $array['to_receive'] = number_format($to_receive, 2);
        $array['vendors_breakdown'] = $vendors_chart_data;
        $array['clients_breakdown'] = $clients_chart_data;

        echo json_encode($array);

        // echo number_format($to_pay, 2);
        // echo number_format($to_receive, 2);
    }
?>