<?php
include_once('database/database.php');
include_once('includes/session.php');


if (isset($_POST["action"]) && $_POST["action"] == "NewCountry") {
    $country_name = $_POST["country_name"];
    $country_code = $_POST["country_code"];
    $region_id = $_POST["region_id"];

    $query = "INSERT INTO countries (name, country_code, region_id) VALUES ('$country_name', '$country_code', '$region_id')";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo 1;
    } else {
        echo "ERROR: Country could not be added";
    }
}
// Edit Country
if (isset($_POST["action"]) && $_POST["action"] == "EditCountry") {
    $id = $_POST['id'];
    $country_name = $_POST["country_name"];
    $country_code = $_POST["country_code"];
    $region_id = $_POST["region_id"];

    $query = "UPDATE countries SET name = '$country_name', country_code = '$country_code', region_id = '$region_id' WHERE Id = '$id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo 1;
    } else {
        echo "ERROR: Country could not be updated.";
    }
}

// Delete Country
if (isset($_POST["action"]) && $_POST["action"] == "DeleteCountry") {
    $id = $_POST['id'];
    $query = "DELETE FROM countries WHERE Id = '$id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo 1;
    } else {
        echo "ERROR: Country could not be deleted.";
    }
}


