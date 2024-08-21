<?php
include_once("includes/session.php");
include_once('database/database.php');

if (isset($_SESSION['user_email']) == true) {
    $id = $_GET['id'];
    $query = "SELECT * FROM entities WHERE md5(Id) = '$id'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        $country_id = $row['country_id'];
        $city_id = $row['city_id'];
        $address = $row['address'];
        $website = $row['website'];
        $phone_number = $row['phone_number'];
        $id = $row['Id'];
    } else {
        header('Location: page_not_found');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Freight Calculator - Edit Entity</title>
    <?php include_once('includes/header.php'); ?>
</head>
<body>
    <?php include_once('includes/navbar.php'); ?>
    <div class="layout" id="layout">
        <div class="inner-layout">
            <div class="d-flex justify-content-between page-heading">
                <div class="heading">Edit Entity</div>
            </div>
            <div class="line-break"></div>
            <div class="context mt-4">
                <form id="edit-entity-form" class="edit-entity-form">
                    <div class="row">
                        <div class="col-md-6 mt-1">
                            <span class="font-weight-light"><strong>Country: <i class="text-danger">*</i></strong></span>
                            <select name="country_id" id="country_id" class="form-control form-control-sm country-dropdown" required>
                                <option value="">Select Country</option>
                                <?php
                                $countries_query = "SELECT Id, name FROM countries";
                                $countries_result = mysqli_query($connection, $countries_query);
                                while ($country = mysqli_fetch_assoc($countries_result)) {
                                    $selected = ($country['Id'] == $country_id) ? 'selected' : '';
                                    echo "<option value='{$country['Id']}' $selected>{$country['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mt-1">
                            <span class="font-weight-light"><strong>City: <i class="text-danger">*</i></strong></span>
                            <select name="city_id" id="city_id" class="form-control form-control-sm city-dropdown" required>
                                <option value="">Select City</option>
                                <?php
                                $cities_query = "SELECT Id, name FROM cities WHERE country_id = '$country_id'";
                                $cities_result = mysqli_query($connection, $cities_query);
                                while ($city = mysqli_fetch_assoc($cities_result)) {
                                    $selected = ($city['Id'] == $city_id) ? 'selected' : '';
                                    echo "<option value='{$city['Id']}' $selected>{$city['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12 mt-1">
                            <span class="font-weight-light"><strong>Address: <i class="text-danger">*</i></strong></span>
                            <input type="text" name="address" id="address" class="form-control form-control-sm" value="<?php echo $address; ?>" required>
                        </div>
                        <div class="col-md-6 mt-1">
                            <span class="font-weight-light"><strong>Website:</strong></span>
                            <input type="text" name="website" id="website" class="form-control form-control-sm" value="<?php echo $website; ?>">
                        </div>
                        <div class="col-md-6 mt-1">
                            <span class="font-weight-light"><strong>Phone Number:</strong></span>
                            <input type="text" name="phone_number" id="phone_number" class="form-control form-control-sm" value="<?php echo $phone_number; ?>">
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="action" value="EditEntity">
                    <div class="text-center submit mt-4">
                        <button type="submit" class="btn btn-info submit-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript" src="js/entities.js?clear_cache=<?php echo time(); ?>"></script>
<?php
} else {
    header('location: login');
}
?>
