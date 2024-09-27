<?php
    include_once('database/database.php');    
    include_once('includes/helpers.php');    
    
    if (isset($_POST["getDutyTaxes"]) && $_POST["getDutyTaxes"] == 1) {
        
        $rates_values = array();

        $default_ior = getDefaultValuesByName($connection,'default_ior');
        $default_duty_tax = getDefaultValuesByName($connection,'default_duty_tax');
        $default_handling_charges = getDefaultValuesByName($connection,'default_handling_charges');
        $default_customs_brokerage = getDefaultValuesByName($connection,'default_customs_brokerage');
        $admin_bank_charges = getDefaultValuesByName($connection,'admin_bank_charges');

        $ship_to = $_POST["ship_to"];
        $query = "SELECT * FROM rates WHERE country_id = '$ship_to'";
        $result = mysqli_query($connection, $query);
        if ($result) {
            $row = mysqli_fetch_array($result);

            $rates_values['duty_tax'] = (isset($row['duty_tax']) && $row['duty_tax'] !=0) ? $row['duty_tax'] : $default_duty_tax ;
            $rates_values['customs_brokerage'] = (isset($row['customs_brokerage']) &&  $row['customs_brokerage'] !=0) ? $row['customs_brokerage'] : $default_customs_brokerage ;
            $rates_values['handling'] = (isset($row['handling']) && $row['handling'] !=0 ) ? $row['handling'] : $default_handling_charges ;
            $rates_values['ior'] =( isset($row['ior']) && $row['ior'] !=0) ? $row['ior'] : $default_ior ;
            $rates_values['admin_bank_charges'] = $admin_bank_charges;
            echo json_encode(['status' => 'success', 'message' =>  $rates_values]);
        } else {
            echo json_encode(['status' => 'error', 'message' =>  "Something went wrong"]);
        }
    }
?>