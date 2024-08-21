<?php
include_once("includes/session.php");
include_once('database/database.php');
require('packages/PHPExcel/Classes/PHPExcel.php');
// require __DIR__ . '/packages/zkteco/vendor/autoload.php';

use Rats\Zkteco\Lib\ZKTeco;

header('Content-Type: application/json');

if (isset($_POST["action"]) && $_POST["action"] == "SaveSettings") {
    // Retrieve the form data
    $device_ip = $_POST["device_ip"];
    $device_admin_role_id = $_POST["device_admin_role_id"];

    // Update or insert `device_ip`
    $query_device_ip = "SELECT * FROM settings WHERE name = 'device_ip'";
    $result_device_ip = mysqli_query($connection, $query_device_ip);

    if (mysqli_num_rows($result_device_ip) > 0) {
        // Update existing `device_ip`
        $update_device_ip = "UPDATE settings SET val = '$device_ip', updated_at = NOW() WHERE name = 'device_ip'";
        $result_update_device_ip = mysqli_query($connection, $update_device_ip);
    } else {
        // Insert new `device_ip`
        $insert_device_ip = "INSERT INTO settings (name, val, `group`, created_at, updated_at) VALUES ('device_ip', '$device_ip', 'device', NOW(), NOW())";
        $result_insert_device_ip = mysqli_query($connection, $insert_device_ip);
    }

    // Update or insert `device_admin_role_id`
    $query_device_admin_role_id = "SELECT * FROM settings WHERE name = 'device_admin_role_id'";
    $result_device_admin_role_id = mysqli_query($connection, $query_device_admin_role_id);

    if (mysqli_num_rows($result_device_admin_role_id) > 0) {
        // Update existing `device_admin_role_id`
        $update_device_admin_role_id = "UPDATE settings SET val = '$device_admin_role_id', updated_at = NOW() WHERE name = 'device_admin_role_id'";
        $result_update_device_admin_role_id = mysqli_query($connection, $update_device_admin_role_id);
    } else {
        // Insert new `device_admin_role_id`
        $insert_device_admin_role_id = "INSERT INTO settings (name, val, `group`, created_at, updated_at) VALUES ('device_admin_role_id', '$device_admin_role_id', 'device', NOW(), NOW())";
        $result_insert_device_admin_role_id = mysqli_query($connection, $insert_device_admin_role_id);
    }

    if (($result_update_device_ip || $result_insert_device_ip) && ($result_update_device_admin_role_id || $result_insert_device_admin_role_id)) {
        echo 1;
    } else {
        echo "ERROR";
    }
}

// Preload form values from the database
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $settings = [];
    $getSettingsSQL = "SELECT name, val FROM settings WHERE name IN ('device_ip', 'device_admin_role_id')";
    $result = mysqli_query($connection, $getSettingsSQL);

    while ($row = mysqli_fetch_assoc($result)) {
        $settings[$row['name']] = $row['val'];
    }

    echo json_encode($settings);
}

/* -------------------------------------------------------------------------- */
/*                     // Import Countries                                    */
/* -------------------------------------------------------------------------- */
if (isset($_POST['importCountriesFromExcel'])) {
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
} else {
    echo json_encode(['status' => 'error', 'message' => 'Please check device connection']);
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
