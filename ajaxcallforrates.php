<?php
include_once('database/database.php');
include_once('includes/session.php');

if (isset($_POST["action"])) {
    if ($_POST["action"] == "NewRate") {
        $region_id = $_POST['region_id'];
        $country_id = $_POST['country_id'];
        $tgs_sla_zone = $_POST['tgs_sla_zone'];
        $tbs_priority = $_POST['tbs_priority'];
        $duty_tax = $_POST['duty_tax'];
        $customs_brokerage = $_POST['customs_brokerage'];
        $handling = $_POST['handling'];
        $ior = $_POST['ior'];

        $query = "SELECT * FROM rates WHERE region_id = '$region_id' AND country_id = '$country_id' AND tgs_sla_zone = '$tgs_sla_zone' AND tbs_priority = '$tbs_priority'";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result)) {
            echo "RATE_ALREADY_EXIST";
        } else {
            $query2 = "INSERT INTO rates (region_id, country_id, tgs_sla_zone, tbs_priority, duty_tax, customs_brokerage, handling, ior) 
                       VALUES ('$region_id', '$country_id', '$tgs_sla_zone', '$tbs_priority', '$duty_tax', '$customs_brokerage', '$handling', '$ior')";
            $result2 = mysqli_query($connection, $query2);
            echo $result2 ? 1 : "ERROR: Rate could not be added";
        }
    }

    if ($_POST["action"] == "EditRate") {
        $id = $_POST["id"];
        $region_id = $_POST['region_id'];
        $country_id = $_POST['country_id'];
        $tgs_sla_zone = $_POST['tgs_sla_zone'];
        $tbs_priority = $_POST['tbs_priority'];
        $duty_tax = $_POST['duty_tax'];
        $customs_brokerage = $_POST['customs_brokerage'];
        $handling = $_POST['handling'];
        $ior = $_POST['ior'];

        $query = "UPDATE rates SET region_id = '$region_id', country_id = '$country_id', tgs_sla_zone = '$tgs_sla_zone', tbs_priority = '$tbs_priority', 
                  duty_tax = '$duty_tax', customs_brokerage = '$customs_brokerage', handling = '$handling', ior = '$ior' WHERE Id = '$id'";
        $result = mysqli_query($connection, $query);
        echo $result ? 1 : "ERROR: Rate could not be updated";
    }

    if ($_POST["action"] == "DeleteRate") {
        $id = $_POST["id"];
        $query = "DELETE FROM rates WHERE Id = '$id'";
        $result = mysqli_query($connection, $query);
        echo $result ? 1 : "ERROR: Rate could not be deleted";
    }

    if ($_POST['action'] == 'getCountriesByRegion') {
        $regionId = $_POST['region_id'];
        $query = "SELECT Id, name FROM countries WHERE region_id = '$regionId'";
        $result = mysqli_query($connection, $query);
    
        if (mysqli_num_rows($result) > 0) {
            echo '<option value="">Select Country</option>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['Id'] . '">' . $row['name'] . '</option>';
            }
        } else {
            echo '<option value="">No countries available</option>';
        }
    }
}
?>
