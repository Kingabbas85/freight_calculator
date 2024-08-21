<?php
include_once("includes/session.php");
include_once('database/database.php');

if (isset($_SESSION['user_email']) == true) {

    $id = $_GET['id']; 
    $query = "SELECT * FROM countries WHERE md5(Id) = '$id'";
    $result = mysqli_query($connection, $query);
    $country = mysqli_fetch_assoc($result);

    if (!$country) {
        header("location: Countries.php");
        exit;
    }
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Freight Calculator - Edit Country</title>
        <?php include_once('includes/header.php'); ?>
    </head>

    <body>

        <?php include_once('includes/navbar.php'); ?>
        <?php include_once('includes/alerts.php'); ?>

        <div class="layout" id="layout">
            <div class="inner-layout">
                <div class="d-flex justify-content-between page-heading">
                    <div>Edit Country</div>
                </div>
                <div class="line-break"></div>

                <div class="mt-4 context">
                    <form id="edit-country-form" class="edit-country-form">

                        <div class="row">
                            <!-- Country Name -->
                            <div class="col-md-6 mt-1">
                                <span class="font-weight-light">
                                    <strong> Country Name:<i class="text-danger">*</i></strong>
                                    <input type="text" name="country_name" value="<?php echo $country['name']; ?>" id="country_name" placeholder="Enter Country name" class="form-control form-control-sm country_name" maxlength="24">
                                </span>
                            </div>

                            <!-- Country Code -->
                            <div class="col-md-6 mt-1">
                                <span class="font-weight-light">
                                    <strong> Country Code:<i class="text-danger">*</i></strong>
                                    <input type="text" name="country_code" value="<?php echo $country['country_code']; ?>" id="country_code" placeholder="Enter Country code" class="form-control form-control-sm country_code" maxlength="10">
                                </span>
                            </div>

                            <!-- Region Dropdown -->
                            <div class="col-md-6 mt-1">
                                <span class="font-weight-light">
                                    <strong> Region:<i class="text-danger">*</i></strong>
                                    <select name="region_id" id="region_id" class="form-control form-control-sm region_id">
                                        <option value="">Select Region</option>
                                        <?php
                                        $regionQuery = "SELECT Id, name FROM regions ORDER BY name ASC";
                                        $regionResult = mysqli_query($connection, $regionQuery);
                                        if (mysqli_num_rows($regionResult)) {
                                            while ($row = mysqli_fetch_assoc($regionResult)) {
                                                $selected = $row['Id'] == $country['region_id'] ? "selected" : "";
                                                echo '<option value="' . $row['Id'] . '" ' . $selected . '>' . ucwords($row['name']) . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </span>
                            </div>

                        </div>

                        <input type="hidden" name="id" value="<?php echo $country['Id']; ?>">
                        <input type="hidden" name="action" value="EditCountry">
                        <div class="text-center submit mt-4">
                            <button type="submit" class="btn btn-info submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="js/countries.js?clear_cache=<?php echo time(); ?>"></script>

    </body>

    </html>

<?php
} else {
    header('location: login');
}
?>
