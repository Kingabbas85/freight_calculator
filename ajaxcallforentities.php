<?php
include_once('database/database.php');
include_once('includes/session.php');

if (isset($_POST["action"]) && $_POST["action"] == "NewEntity") {
    $country_id = $_POST['country_id'];
    $city_id = $_POST['city_id'];
    $address = $_POST['address'];
    $website = $_POST['website'];
    $phone_number = $_POST['phone_number'];

    $query = "SELECT * FROM entities WHERE country_id = '$country_id' AND city_id = '$city_id' AND address = '$address'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result)) {
        echo "ENTITY_ALREADY_EXIST";
    } else {
        $query2 = "INSERT INTO entities (country_id, city_id, address, website, phone_number, created_at, updated_at) VALUES ('$country_id', '$city_id', '$address', '$website', '$phone_number', NOW(), NOW())";
        $result2 = mysqli_query($connection, $query2);

        if ($result2) {
            echo 1;
        } else {
            echo "ERROR: Entity could not be added";
        }
    }
}

if (isset($_POST["action"]) && $_POST["action"] == "EditEntity") {
    $id = $_POST["id"];
    $country_id = $_POST['country_id'];
    $city_id = $_POST['city_id'];
    $address = $_POST['address'];
    $website = $_POST['website'];
    $phone_number = $_POST['phone_number'];

    $query = "UPDATE entities SET country_id = '$country_id', city_id = '$city_id', address = '$address', website = '$website', phone_number = '$phone_number', updated_at = NOW() WHERE id = '$id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo 1;
    } else {
        echo "ERROR: Entity could not be updated";
    }
}

if (isset($_POST["action"]) && $_POST["action"] == "DeleteEntity") {
    $id = $_POST["id"];

    $query = "DELETE FROM entities WHERE id = '$id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo 1;
    } else {
        echo "ERROR: Entity could not be deleted";
    }
}

if (isset($_POST["action"]) && $_POST["action"] == "GetCities") {
    $country_id = $_POST['country_id'];

    $query = "SELECT * FROM cities WHERE country_id = '$country_id'";
    $result = mysqli_query($connection, $query);

    $cities = "<option value=''>Select City</option>";
    while ($row = mysqli_fetch_assoc($result)) {
        $cities .= "<option value='{$row['Id']}'>{$row['name']}</option>";
    }
    echo $cities;
}
