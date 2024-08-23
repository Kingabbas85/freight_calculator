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
        // $users = $zk->deviceName(); // Assuming getUser() pulls all users
        // $finger_user = $zk->getFingerprint(2); // Assuming getUser() pulls all users
        // $attendace = $zk->getAttendance(); // Assuming getUser() pulls all users
        // $writeLCD = $zk->writeLCD();
        // pre_r($users);
        // pre_r($finger_user);
        // pre_r($attendace);
        // pre_r($writeLCD);
        // die();
