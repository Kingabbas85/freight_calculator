<?php
include_once("includes/session.php");
include_once('database/database.php');

if (isset($_SESSION['user_email']) == true) {
    $id = $_GET['id'];
    $query = "SELECT * FROM rates WHERE md5(Id) = '$id'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        $regions = mysqli_query($connection, "SELECT * FROM regions");
        $countries = mysqli_query($connection, "SELECT * FROM countries");
        $region_id = $row['region_id'];
        $country_id = $row['country_id'];
        $tgs_sla_zone = $row['tgs_sla_zone'];
        $tbs_priority = $row['tbs_priority'];
        $duty_tax = $row['duty_tax'];
        $customs_brokerage = $row['customs_brokerage'];
        $handling = $row['handling'];
        $ior = $row['ior'];
    } else {
        header('Location: page_not_found');
    }
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Freight Calculator - Edit Rate</title>
        <?php include_once('includes/header.php'); ?>
    </head>

    <body>
        <?php include_once('includes/navbar.php'); ?>
        <?php include_once('includes/alerts.php'); ?>
        <div class="layout" id="layout">
            <div class="inner-layout">
                <div class="d-flex justify-content-between page-heading">
                    <div> Edit Rate </div>
                </div>
                <div class="line-break"></div>

                <div class="mt-4 context">
                    <form id="edit-rate-form" class="edit-rate-form">
                        <div class="row">
                            <div class="col-md-6 mt-1">
                                <span><strong>Region:<i class="text-danger">*</i></strong></span>
                                <select name="region_id" id="region_id" class="form-control form-control-sm">
                                    <option value="">Select Region</option>
                                    <?php while ($r = mysqli_fetch_assoc($regions)) { ?>
                                        <option value="<?php echo $r['Id']; ?>" <?php if ($region_id == $r['Id']) echo 'selected'; ?>><?php echo $r['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6 mt-1">
                                <span><strong>Country:<i class="text-danger">*</i></strong></span>
                                <select name="country_id" id="country_id" class="form-control form-control-sm">
                                    <option value="">Select Country</option>
                                    <?php while ($c = mysqli_fetch_assoc($countries)) { ?>
                                        <option value="<?php echo $c['Id']; ?>" <?php if ($country_id == $c['Id']) echo 'selected'; ?>><?php echo $c['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6 mt-1">
                                <span><strong>TGS SLA Zone:<i class="text-danger">*</i></strong></span>
                                <select name="tgs_sla_zone" id="tgs_sla_zone" class="form-control form-control-sm">
                                    <option value="1" <?php if ($tgs_sla_zone == 1) echo 'selected'; ?>>1</option>
                                    <option value="2" <?php if ($tgs_sla_zone == 2) echo 'selected'; ?>>2</option>
                                    <option value="3" <?php if ($tgs_sla_zone == 3) echo 'selected'; ?>>3</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-1">
                            <span><strong>Time-Based Service Priority (TBS):<i class="text-danger">*</i></strong></span>
                                <select name="tbs_priority" id="tbs_priority" class="form-control form-control-sm">
                                    <option value="1" <?php if ($tbs_priority == 1) echo 'selected'; ?>>1</option>
                                    <option value="2" <?php if ($tbs_priority == 2) echo 'selected'; ?>>2</option>
                                    <option value="3" <?php if ($tbs_priority == 3) echo 'selected'; ?>>3</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-1">
                                <span><strong>Duty Tax:</strong></span>
                                <input type="text" name="duty_tax" class="form-control form-control-sm" value="<?php echo $duty_tax; ?>">
                            </div>
                            <div class="col-md-6 mt-1">
                                <span><strong>Customs Brokerage:</strong></span>
                                <input type="text" name="customs_brokerage" class="form-control form-control-sm" value="<?php echo $customs_brokerage; ?>">
                            </div>
                            <div class="col-md-6 mt-1">
                                <span><strong>Handling:</strong></span>
                                <input type="text" name="handling" class="form-control form-control-sm" value="<?php echo $handling; ?>">
                            </div>
                            <div class="col-md-6 mt-1">
                                <span><strong>IOR:</strong></span>
                                <input type="text" name="ior" class="form-control form-control-sm" value="<?php echo $ior; ?>">
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $row['Id']; ?>">
                        <input type="hidden" name="action" value="EditRate">
                        <div class="text-center submit mt-4">
                            <button type="submit" class="btn btn-info submit-btn">Update Rate</button>
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