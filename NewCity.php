<?php
include_once("includes/session.php");
include_once('database/database.php');

if (isset($_SESSION['user_email']) == true) {
    $countriesQuery = "SELECT Id, name FROM countries";
    $countriesResult = mysqli_query($connection, $countriesQuery);
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Add New City</title>
        <?php include_once('includes/header.php'); ?>
    </head>
    
    <body>
        <?php include_once('includes/navbar.php'); ?>
        <?php include_once('includes/alerts.php'); ?>
        <div class="layout" id="layout">
            <div class="inner-layout">
                <div class="d-flex justify-content-between page-heading">
                    <div>Add New City</div>
                </div>
                <div class="line-break"></div>

                <div class="mt-4 context">
                    <form id="city-form" class="city-form">
                        <div class="row">
                            <div class="col-md-6 mt-1">
                                <label for="country_id"><strong>Country:<i class="text-danger">*</i></strong></label>
                                <select name="country_id" id="country_id" class="form-control form-control-sm country_id">
                                    <option value="">Select Country</option>
                                    <?php while ($country = mysqli_fetch_assoc($countriesResult)) { ?>
                                        <option value="<?php echo $country['Id']; ?>"><?php echo $country['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6 mt-1">
                                <label for="city_name"><strong>City Name:<i class="text-danger">*</i></strong></label>
                                <input type="text" name="city_name" id="city_name" class="form-control form-control-sm city_name">
                            </div>
                        </div>
                        <input type="hidden" name="action" class="action" value="NewCity">
                        <div class="text-center submit mt-4">
                            <button type="submit" class="btn btn-info submit-btn">Add City</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="js/cities.js?clear_cache=<?php echo time(); ?>"></script>

    </html>
<?php
} else {
    header('location: login');
}
?>
