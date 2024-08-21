<?php
include_once("includes/session.php");
include_once('database/database.php');

if (isset($_SESSION['user_email']) == true) {
    $regions = mysqli_query($connection, "SELECT * FROM regions");
    $countries = mysqli_query($connection, "SELECT * FROM countries");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Freight Calculator - New Rate</title>
    <?php include_once('includes/header.php'); ?>
</head>
<body>
    <?php include_once('includes/navbar.php'); ?>
    <?php include_once('includes/alerts.php'); ?>

    <div class="layout" id="layout">
        <div class="inner-layout">
            <div class="d-flex justify-content-between page-heading">
                <div> Add New Rate </div>
            </div>
            <div class="line-break"></div>

            <div class="mt-4 context">
                <form id="rate-form" class="rate-form">
                    <div class="row">
                        <div class="col-md-6 mt-1">
                            <span><strong>Region:<i class="text-danger">*</i></strong></span>
                            <select name="region_id" id="region_id" class="form-control form-control-sm">
                                <option value="">Select Region</option>
                                <?php while($row = mysqli_fetch_assoc($regions)) { ?>
                                    <option value="<?php echo $row['Id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mt-1">
                            <span><strong>Country:<i class="text-danger">*</i></strong></span>
                            <select name="country_id" id="country_id" class="form-control form-control-sm">
                                <option value="">Select Country</option>
                                <?php while($row = mysqli_fetch_assoc($countries)) { ?>
                                    <option value="<?php echo $row['Id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mt-1">
                            <span><strong>TGS SLA Zone:<i class="text-danger">*</i></strong></span>
                            <select name="tgs_sla_zone" id="tgs_sla_zone" class="form-control form-control-sm">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-1">
                            <span><strong>Time-Based Service Priority (TBS):<i class="text-danger">*</i></strong></span>
                            <select name="tbs_priority" id="tbs_priority" class="form-control form-control-sm">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-1">
                            <span><strong>Duty Tax:</strong></span>
                            <input type="text" name="duty_tax" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6 mt-1">
                            <span><strong>Customs Brokerage:</strong></span>
                            <input type="text" name="customs_brokerage" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6 mt-1">
                            <span><strong>Handling:</strong></span>
                            <input type="text" name="handling" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6 mt-1">
                            <span><strong>IOR:</strong></span>
                            <input type="text" name="ior" class="form-control form-control-sm">
                        </div>
                    </div>
                    <input type="hidden" name="action" value="NewRate">
                    <div class="text-center submit mt-4">
                        <button type="submit" class="btn btn-info submit-btn">Add Rate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript" src="js/rates.js?clear_cache=<?php echo time(); ?>"></script>
<?php
} else {
    header('location: login');
}
?>
