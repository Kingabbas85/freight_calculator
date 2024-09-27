<?php
include_once("includes/session.php");
include_once('database/database.php');
require('packages/PHPExcel/Classes/PHPExcel.php');
// require __DIR__ . '/packages/zkteco/vendor/autoload.php';


header('Content-Type: application/json');

if (isset($_POST["action"]) && $_POST["action"] == "SaveSettings") {
    $default_ior = $_POST['default_ior'];
    $default_duty_tax = $_POST['default_duty_tax'];
    $default_handling_charges = $_POST['default_handling_charges'];
    $default_customs_brokerage = $_POST['default_customs_brokerage'];
    $admin_bank_charges = $_POST['admin_bank_charges'];

    // Array of settings
    $settings = [
        'default_ior' => $default_ior,
        'default_duty_tax' => $default_duty_tax,
        'default_handling_charges' => $default_handling_charges,
        'default_customs_brokerage' => $default_customs_brokerage,
        'admin_bank_charges' => $admin_bank_charges
    ];

    // Check existing settings
    $queryCheck = "SELECT name FROM settings WHERE name IN ('default_ior', 'default_duty_tax', 'default_handling_charges', 'default_customs_brokerage', 'admin_bank_charges')";
    $resultCheck = mysqli_query($connection, $queryCheck);

    // Collect existing setting names
    $existingSettings = [];
    while ($row = mysqli_fetch_assoc($resultCheck)) {
        $existingSettings[] = $row['name'];
    }

    // Loop through each setting
    foreach ($settings as $name => $value) {
        if (in_array($name, $existingSettings)) {
            // Update existing setting
            $queryUpdate = "UPDATE settings SET val = '$value' WHERE name = '$name'";
            mysqli_query($connection, $queryUpdate);
        } else {
            // Insert new setting
            $queryInsert = "INSERT INTO settings (name, val) VALUES ('$name', '$value')";
            mysqli_query($connection, $queryInsert);
        }
    }

    echo json_encode(['status' => 'success', 'message' => 'Settings saved successfully!']);
}



if (isset($_POST["getAllSettings"])) {
    $settings = [];
    $query = "SELECT * FROM settings";
    $result = mysqli_query($connection, $query);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $settings[$row['name']] = $row['val'];
    }
    
    echo json_encode($settings);
}

/* -------------------------------------------------------------------------- */
/*                     // Import Countries                                    */
/* -------------------------------------------------------------------------- */
if (isset($_POST['importCountriesFromExcel']) && $_POST["importCountriesFromExcel"] == 1) {
    // Create a new PHPExcel object

    // Load an existing spreadsheet
    $spreadsheet = PHPExcel_IOFactory::load('assets/Countries/Countries.xlsx');
    // Get the first sheet
    $sheet = $spreadsheet->getActiveSheet();
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();


    // $batchSize = 10; // Number of rows to process in each batch
    // $totalRows = $highestRow - 1; // Exclude header row
    // $numBatches = ceil($totalRows / $batchSize);

    // for ($batch = 0; $batch < $numBatches; $batch++) {
    //     $startRow = $batch * $batchSize + 2; // Start from row 2
    //     $endRow = min(($batch + 1) * $batchSize + 1, $highestRow);

        for ($row = 2; $row <= $highestRow; $row++) {
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
            //    pre_r( $rowData );
            $countryName = $rowData[0][1];
            $regionID = $rowData[0][2];
            $countryCode = $rowData[0][3];
            // die();

            // Insert into `users` table
            $query = "
                    INSERT INTO countries (name, country_code, region_id) VALUES (
                        '$countryName', '$countryCode','$regionID')";
            $result = mysqli_query($connection, $query);
            $user_id = $connection->insert_id;

            if ($result) {
            }
        }
    // }
    // $zk->disconnect();
    echo json_encode(['status' => 'success', 'message' => 'Country Imported successfully']);
}


/* -------------------------------------------------------------------------- */
/*                     // Import Rates                                    */
/* -------------------------------------------------------------------------- */

if (isset($_POST['importRatesFromExcel'])) {
    // Load the Excel file
    $spreadsheet = PHPExcel_IOFactory::load('assets/rates/rates.xlsx');
    // Get the first sheet
    $sheet = $spreadsheet->getActiveSheet();
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();
    
    // Loop through each row of the spreadsheet
    for ($row = 2; $row <= $highestRow; $row++) {
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
        
        // Map data to your database columns
        $regionID = $rowData[0][0]; // Assuming the first column is region_id
        $tgsSlaZone = $rowData[0][1]; // Assuming the second column is tgs_sla_zone
        $tbsPriority = $rowData[0][2]; // Assuming the third column is tbs_priority
        $countryID = $rowData[0][3]; // Assuming the fourth column is country_id
        $dutyTax = $rowData[0][4]; // Assuming the fifth column is duty_tax
        $customsBrokerage = $rowData[0][5]; // Assuming the sixth column is customs_brokerage
        $handling = $rowData[0][6]; // Assuming the seventh column is handling
        $ior = $rowData[0][7]; // Assuming the eighth column is ior

        // Insert data into the `rates` table
        $query = "
            INSERT INTO rates (region_id, tgs_sla_zone, tbs_priority, country_id, duty_tax, customs_brokerage, handling, ior)
            VALUES ('$regionID', '$tgsSlaZone', '$tbsPriority', '$countryID', '$dutyTax', '$customsBrokerage', '$handling', '$ior')";
        
        $result = mysqli_query($connection, $query);
        
        if (!$result) {
            // Handle query failure (e.g., log the error)
            echo json_encode(['status' => 'error', 'message' => 'Error importing data: ' . mysqli_error($connection)]);
            exit;
        }
    }

    echo json_encode(['status' => 'success', 'message' => 'Rates imported successfully']);
}


        // $users = $zk->deviceName(); // Assuming getUser() pulls all users
        // $finger_user = $zk->getFingerprint(2); // Assuming getUser() pulls all users
        // $attendace = $zk->getAttendance(); // Assuming getUser() pulls all users
        // $writeLCD = $zk->writeLCD();
        // pre_r($users);
        // pre_r($finger_user);
        // pre_r($attendace);
        // pre_r($writeLCD);
        // die();
