<?php
include_once("includes/session.php");
include_once('database/database.php');
require('packages/PHPExcel/Classes/PHPExcel.php');
require __DIR__ . '/packages/zkteco/vendor/autoload.php';

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

if (isset($_POST["testConnectionButton"])) {
    $device_con = testDeviceConnection($connection);

    if ($device_con == 'success') {
        echo json_encode(['status' => 'success', 'message' => 'Device is connected successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to connect to the ZKTeco device.']);
    }
}
/* -------------------------------------------------------------------------- */
/*                     // Export Device Users Report                          */
/* -------------------------------------------------------------------------- */
if (isset($_POST['ExportDeviceUsers'])) {
    // Create a new PHPExcel object
    $phpExcel = new PHPExcel();

    // Set the active sheet index to the first sheet
    $phpExcel->setActiveSheetIndex(0);

    // Get the active sheet
    $activesheet = $phpExcel->getActiveSheet();

    // Set the title of the sheet
    $activesheet->setTitle('ZKteco Device Users');

    // Set the headers for the Excel sheet
    $activesheet->setCellValue('A1', 'ID');
    $activesheet->setCellValue('B1', 'User Numbers (UID)');
    $activesheet->setCellValue('C1', 'Device User ID');
    $activesheet->setCellValue('D1', 'Name');
    $activesheet->setCellValue('E1', 'Role');
    $activesheet->setCellValue('F1', 'Card Number');


    // Styling the Header
    $activesheet->getStyle('A1:F1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('1e445e');
    $activesheet->getStyle('A1:F1')->getAlignment()->setIndent(1);
    $styleArray = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => 'FFFFFF'),
            'size' => 10,
            'name' => 'Verdana'
        )
    );
    $phpExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray);

    // Fetch data from the database
    $query = "SELECT * FROM device_users ORDER BY  name  ASC";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $rowNumber = 2; // Start from the second row since the first row is for headers
        $counter = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $activesheet->setCellValue('A' . $rowNumber, $counter);
            $activesheet->setCellValue('B' . $rowNumber, $row['uid']);
            $activesheet->setCellValue('C' . $rowNumber, $row['userid']);
            $activesheet->setCellValue('D' . $rowNumber, $row['name']);
            $activesheet->setCellValue('E' . $rowNumber, ($row['role'] != '0') ? 'Super Admin' : 0);
            $activesheet->setCellValue('F' . $rowNumber, $row['cardno']);

            $rowNumber++;
            $counter++;
        }
    }
    // Formating
    $highestRow = $activesheet->getHighestRow() + 1;
    $lastColumn = $activesheet->getHighestColumn();

    $colNumber = PHPExcel_Cell::columnIndexFromString($lastColumn);
    $colString = PHPExcel_Cell::stringFromColumnIndex($colNumber);

    $activesheet->insertNewRowBefore(1, 1)->getRowDimension('1')->setRowHeight(15);
    $activesheet->insertNewColumnBefore('A', 1)->getColumnDimension('A')->setWidth(2.75);
    $activesheet->setShowGridlines(false);
    foreach (range('2', $highestRow) as $rowNumber) {
        $activesheet->getRowDimension($rowNumber)->setRowHeight(24);
    }
    $activesheet->getStyle('A1:' . $colString . $highestRow)
        ->getAlignment()
        ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $activesheet->getStyle('C1:' . $colString . $highestRow)
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    // Setting Width of the Columns
    $activesheet->getColumnDimension('B')->setWidth(20.75);
    $activesheet->getColumnDimension('C')->setWidth(22.75);
    $activesheet->getColumnDimension('D')->setWidth(20.75);
    $activesheet->getColumnDimension('E')->setWidth(45.75);
    $activesheet->getColumnDimension('F')->setWidth(20.75);
    $activesheet->getColumnDimension('G')->setWidth(20.75);
    $activesheet->getColumnDimension('H')->setWidth(2.75);

    // Border All
    $bordersAll = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('argb' => 'D0D3D4')
            )
        )
    );
    $activesheet->getStyle('A2:' . $colString . $highestRow)->applyFromArray($bordersAll);
    $styleArray = array(
        'font'  => array(
            'size'  => 8,
            'name'  => 'Verdana'
        )
    );
    $activesheet->getStyle('A2:' . $colString . $highestRow)->applyFromArray($styleArray);
    // Set Border Top & Bottom
    $activesheet->getStyle("A2:" . $colString . $highestRow)->applyFromArray(
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
    $activesheet->getStyle('A2:' . $colString . $highestRow)->applyFromArray(
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


    // Save Excel file
    $fileName = 'DeviceUsers.xlsx';
    $filePath = 'assets/reports/' . $fileName;
    $writer = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
    $writer->save($filePath);

    // Prepare the response
    $response = array(
        'success' => true,
        'filepath' => $filePath, // Adjust the path accordingly
        'filename' => $fileName
    );

    // Set response headers and output the response in JSON format
    header('Content-Type: application/json');
    echo json_encode($response);
}

/* -------------------------------------------------------------------------- */
/*                     // Import Device Users Report                          */
/* -------------------------------------------------------------------------- */
if (isset($_POST['importUsersFromExcel'])) {
    // Create a new PHPExcel object

    // Load an existing spreadsheet
    $spreadsheet = PHPExcel_IOFactory::load('assets/users/Users.xlsx');
    // Get the first sheet
    $sheet = $spreadsheet->getActiveSheet();
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    $deviceIp = getSettingValue($connection, 'device_ip');

    $zk = new ZKTeco($deviceIp);
    $ret = $zk->connect();
    if ($ret) {

        $zk->clearUsers();
        // Temporarily disable foreign key checks
        mysqli_query($connection, "SET FOREIGN_KEY_CHECKS = 0");

        // Truncate the `users` and `user_has_role` tables
        $truncateUserHasRoleSQL = "TRUNCATE TABLE user_has_role";
        $truncateUsersSQL = "TRUNCATE TABLE users";

        if (!mysqli_query($connection, $truncateUserHasRoleSQL) || !mysqli_query($connection, $truncateUsersSQL)) {
            echo json_encode([
                'success' => false,
                'message' => 'Error truncating tables: ' . mysqli_error($connection)
            ]);
            exit;
        }
        // Re-enable foreign key checks
        mysqli_query($connection, "SET FOREIGN_KEY_CHECKS = 1");


        $batchSize = 10; // Number of rows to process in each batch
        $totalRows = $highestRow - 1; // Exclude header row
        $numBatches = ceil($totalRows / $batchSize);

        for ($batch = 0; $batch < $numBatches; $batch++) {
            $startRow = $batch * $batchSize + 2; // Start from row 2
            $endRow = min(($batch + 1) * $batchSize + 1, $highestRow);

            for ($row = $startRow; $row <= $endRow; $row++) {
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                //    pre_r( $rowData );
                $displayName = $rowData[0][1];
                $userName = $rowData[0][2];
                $email = $rowData[0][3];
                $password = $rowData[0][4]; // Encrypt passwod
                $report_to = $rowData[0][5];
                $zkId = $rowData[0][6];
                $teamId = $rowData[0][7];
                $designationId = $rowData[0][8];
                $cardNo = intval($rowData[0][9]);
                // die();

                // Insert into `users` table
                $query = "
                    INSERT INTO users (display_name, user_name, email, password, user_role, report_to, active, zk_id, team_id, designation_id, card_no) VALUES (
                        '$displayName', '$userName', '$email', '$password', 'user', '$report_to', '1', '$zkId', '$teamId', '$designationId', '$cardNo')";
                $result = mysqli_query($connection, $query);
                $user_id = $connection->insert_id;

                if ($result) {
                    if ($row <= 3) {
                        // First two users
                        $roleId = 1;
                        $devicePassword = '11223344';
                        $userRole = 14;
                    } else {
                        // Remaining users
                        $roleId = 3;
                        $devicePassword = '';
                        $userRole = 0;
                    }
                    $zk->enableDevice();
                    // Adding User in device 
                    $test = $zk->setUser($user_id, $user_id, $displayName, $devicePassword, $userRole, $cardNo);
                    // Insert into `user_has_role` table

                    $roleQuery = "
                        INSERT INTO user_has_role (user_id, role_id) 
                        VALUES ($user_id, $roleId)";
                    $roleResult = mysqli_query($connection, $roleQuery);

                    // Update `profiles` table if email matches
                    $profileUpdateQuery = "
                        UPDATE profiles 
                        SET user_name = '$userName',
                        report_to = '$report_to'
                        WHERE email = '$email'";
                    $profileUpdateResult = mysqli_query($connection, $profileUpdateQuery);
                }
            }
        }
        // $zk->disconnect();
        echo json_encode(['status' => 'success', 'message' => 'User Imported successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Please check device connection']);
    }
}

if (isset($_POST["ZKtechoClearUser"])) {
    $deviceIp = getSettingValue($connection, 'device_ip');
    // $devicePassword = '1346'; // Replace with the actual device password
    $zk = new ZKTeco($deviceIp);
    $ret = $zk->connect();

    if ($ret) {
        $zk->enableDevice();
        // Clear All Users
        $clearUsers = $zk->clearUsers();
        $adminClear = $zk->clearAdmin();
        // if ($clearUsers || $adminClear) {

        echo json_encode(['status' => 'success', 'message' => 'All users have been cleared from the device.']);
        // } else {
        //     echo json_encode(['status' => 'error', 'message' => 'Failed to clear users from the device.']);
        // }
    }
}
if (isset($_POST["ZKtechoPullUsers"])) {
    $deviceIp = getSettingValue($connection, 'device_ip');
    // $devicePassword = '1346'; // Replace with the actual device password
    $zk = new ZKTeco($deviceIp);
    $ret = $zk->connect();

    if ($ret) {
        $zk->enableDevice();


        // Clear existing users from the table
        $clearUsersQuery = "TRUNCATE TABLE device_users";
        mysqli_query($connection, $clearUsersQuery);
        // Pull All Users
        $users = $zk->getUser(); // Assuming getUser() pulls all users
        if ($users) {
            try {
                // Insert users into the database
                foreach ($users as $user) {
                    $uid = $user['uid'];
                    $userid = $user['userid'];
                    $name = $user['name'];
                    $role = $user['role'];
                    $cardno = $user['cardno'];

                    $insertQuery = "
                        INSERT INTO device_users (uid, userid, name, role, cardno)
                        VALUES ('$uid', '$userid', '$name', '$role', '$cardno')
                    ";
                    mysqli_query($connection, $insertQuery);
                }
                if ($ret) {
                    echo json_encode(['status' => 'success', 'message' => 'All users have been pulled and stored in the database.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to connect to the ZKTeco device.']);
                }
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            } finally {
                if (isset($zk)) {
                    $zk->disconnect();
                }
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to connect to the ZKTeco device.']);
        }
    }
}
if (isset($_POST["ZKtechoPushUsers"])) {
    $deviceIp = getSettingValue($connection, 'device_ip');
    // $devicePassword = '1346'; // Replace with the actual device password
    $zk = new ZKTeco($deviceIp);
    $ret = $zk->connect();

    if ($ret) {
        // Push All Users to Device
        $query = "SELECT * FROM users"; // Adjust this query to fit your user schema
        $result = mysqli_query($connection, $query);

        if (!$result) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to fetch users from the database.']);
        }

        while ($user = mysqli_fetch_assoc($result)) {
            $id = $user['Id']; // Adjust to your actual user ID field for the ZK device
            $zk_id = $user['zk_id']; // Adjust to your actual user ID field for the ZK device
            $display_name = $user['display_name']; // Adjust to your actual username field
            $card_number = isset($user["card_no"]) ? $user["card_no"] : 0;
            $password = ''; // ZKTeco devices often do not use passwords for user records
            $role = '0'; // Adjust according to your needs
            if ($id < 3) {
                // First two users
                $device_admin_password = '11223344';
                $device_role = 14;
            } else {
                // Remaining users
                $device_admin_password = '';
                $device_role = 0;
            }
            $zk->enableDevice();


            $test  = $zk->setUser($zk_id, $zk_id, $display_name, $device_admin_password, $device_role, $card_number);
        }
        echo json_encode(['status' => 'success', 'message' => 'All users have been pushed to the device.']);
    }else{

        echo json_encode(['status' => 'error', 'message' => 'Please check device connection']);
    }
} 
if (isset($_POST["ZKtechoRemoveUser"])) {

    $deviceIp = getSettingValue($connection, 'device_ip');
    $zk = new ZKTeco($deviceIp);
    $ret = $zk->connect();

    if ($ret) {
        $zk->enableDevice();
        
        // Assuming you are passing the user ID to remove
        $userId = $_POST['user_id'];
        $removeUser = $zk->removeUser($userId); // Replace with the actual method to delete a user

        $query3 = "DELETE FROM users  WHERE Id = '$userId'";
        $result = mysqli_query($connection, $query3);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'User has been removed from the device.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to remove user from the device.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to connect to the ZKTeco device.']);
    }
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
