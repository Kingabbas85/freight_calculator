<?php
include_once('database/database.php');
include_once('includes/session.php');

if (isset($_POST["action"]) && $_POST["action"] == "NewCity") {
    $city_name = $_POST['city_name'];
    $country_id = $_POST['country_id'];

    // Check if the city already exists
    $query = "SELECT * FROM cities WHERE name = '$city_name' AND country_id = '$country_id'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result)) {
        echo "CITY_ALREADY_EXIST";
    } else {
        // Insert the new city into the database
        $query2 = "INSERT INTO cities (name, country_id, created_at, updated_at) VALUES ('$city_name', '$country_id', NOW(), NOW())";
        $result2 = mysqli_query($connection, $query2);

        if ($result2) {
            echo 1;
        } else {
            echo "ERROR: City could not be added";
        }
    }
}

if (isset($_POST["action"]) && $_POST["action"] == "EditCity") {
    $id = $_POST["id"];
    $city_name = $_POST['city_name'];
    $country_id = $_POST['country_id'];

    // Update the city in the database
    $query = "UPDATE cities SET name = '$city_name', country_id = '$country_id' WHERE Id = '$id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo 1;
    } else {
        echo "ERROR: City could not be updated";
    }
}

if (isset($_POST["action"]) && $_POST["action"] == "DeleteCity") {
    $id = $_POST["id"];

    // Delete the city from the database
    $query = "DELETE FROM cities WHERE Id = '$id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo 1;
    } else {
        echo "ERROR: City could not be deleted";
    }
}
