<?php
include_once('database/database.php');
include_once('includes/session.php');


if (isset($_POST["action"]) && $_POST["action"] == "NewRegion") {
    $region_name = $_POST['region_name'];

    $query = "Select * FROM regions WHERE name = '$region_name'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result)) {

        echo "REGION_ALREADY_EXIST";
    } else {
        
        $query2 = "Insert INTO regions (name) 
                VALUES ( '$region_name')";
        $result2 = mysqli_query($connection, $query2);

        if ($result2) {
            echo 1;
        } else {
            echo "ERROR: User does not set in the device";
        }
    }
}
if (isset($_POST["action"]) && $_POST["action"] == "EditRegion") {

    $id = $_POST["id"];

    $region_name = $_POST['region_name'];

    $query = "UPDATE regions SET name = '$region_name' WHERE Id = '$id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo 1;
    } else {
        echo "ERROR: Region does not update";
    }
}

if (isset($_POST["action"]) && $_POST["action"] == "DeleteRegion") {
    $id = $_POST["id"];

    $query = "DELETE FROM regions WHERE Id = '$id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo 1;
    } else {
        echo "ERROR: Region could not be deleted";
    }
}

