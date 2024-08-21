<?php
include_once('database/database.php');
include_once('includes/session.php');

if (isset($_POST["action"]) && $_POST["action"] == "NewCustomer") {
    $company_name = $_POST['company_name'];
    $contact_name = $_POST['contact_name'];
    $phone_1 = $_POST['phone_1'];
    $phone_2 = $_POST['phone_2'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $mailing_address = $_POST['mailing_address'];
    $billing_address = $_POST['billing_address'];
    $notes = $_POST['notes'];

    // Generate customer_id
    $query = "SELECT MAX(customer_id) AS max_id FROM customers";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $last_id = $row['max_id'];
    $new_id = $last_id ? 'CTR' . str_pad(substr($last_id, 3) + 1, 2, '0', STR_PAD_LEFT) : 'CTR01';

    // Insert the new customer into the database
    $query2 = "INSERT INTO customers (customer_id, company_name, contact_name, phone_1, phone_2, email, city, mailing_address, billing_address, notes, created_at, updated_at) 
               VALUES ('$new_id', '$company_name', '$contact_name', '$phone_1', '$phone_2', '$email', '$city', '$mailing_address', '$billing_address', '$notes', NOW(), NOW())";
    $result2 = mysqli_query($connection, $query2);

    if ($result2) {
        echo 1;
    } else {
        echo "ERROR: Customer could not be added";
    }
}

if (isset($_POST["action"]) && $_POST["action"] == "EditCustomer") {
    $id = $_POST["id"];
    $company_name = $_POST['company_name'];
    $contact_name = $_POST['contact_name'];
    $phone_1 = $_POST['phone_1'];
    $phone_2 = $_POST['phone_2'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $mailing_address = $_POST['mailing_address'];
    $billing_address = $_POST['billing_address'];
    $notes = $_POST['notes'];

    // Update the customer in the database
    $query = "UPDATE customers SET company_name = '$company_name', contact_name = '$contact_name', phone_1 = '$phone_1', phone_2 = '$phone_2', email = '$email', city = '$city', mailing_address = '$mailing_address', billing_address = '$billing_address', notes = '$notes', updated_at = NOW() WHERE Id = '$id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo 1;
    } else {
        echo "ERROR: Customer could not be updated";
    }
}

if (isset($_POST["action"]) && $_POST["action"] == "DeleteCustomer") {
    $id = $_POST["id"];

    // Delete the customer from the database
    $query = "DELETE FROM customers WHERE Id = '$id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo 1;
    } else {
        echo "ERROR: Customer could not be deleted";
    }
}
