<?php
include_once("includes/session.php");
include_once('database/database.php');

// Fetch data for dropdowns
$entities = mysqli_query($connection, "SELECT * FROM entities");
$countries = mysqli_query($connection, "SELECT * FROM countries");
$rates_countries_query = "SELECT * FROM rates";
$rates_countries = mysqli_query($connection, $rates_countries_query);
// pre_r($rates_countries);
// die();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="apple-touch-icon" sizes="76x76" href="images/fc_logo.png">

    <title>Freight Cost Calculator</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="images/fc_logo.png" />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
    <style>
        body {
            background-image: url('assets/img/warehousing.jpeg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            box-sizing: border-box;
        }
    </style>
</head>


<body>
    <div style="overflow-y:auto">
        <!--   Creative Tim Branding   -->
        <?php


        if (!isset($_SESSION["loggedIn"])) {
            $link = 'login';
        } else {
            $link = 'dashboard';
        }

        ?>
        <a href="<?php echo $link; ?>">
            <div class="logo-container">
                <div class="logo">
                    <img src="images/fc_logo_bg.png">
                </div>
                <div class="brand">
                    Freight Calculator
                </div>
            </div>
        </a>
        <!--   Big container   -->
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <!--      Wizard container        -->
                    <div class="wizard-container">
                        <div class="card wizard-card" data-color="red" id="wizard">
                            <form action="" method="">
                                <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

                                <div class="wizard-header">
                                    <h3 class="wizard-title">
                                        Freight Cost Calculator
                                    </h3>
                                    <h5>Note: Variable charges depend on factors such as cargo value, storage duration, part specifications, and destination country regulations.</h5>
                                </div>
                                <div class="wizard-navigation">
                                    <ul>
                                        <li><a href="#shipping_details" data-toggle="tab">Shipping Details</a></li>

                                        <li><a href="#charges" data-toggle="tab">Charges</a></li>
                                    </ul>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane" id="shipping_details">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <!-- <i class="material-icons">face</i> -->
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Estimate From</label>
                                                        <select class="form-control" id="estimate_from" name="estimate_from">
                                                            <option disabled="" selected=""></option>
                                                            <?php while ($row = mysqli_fetch_assoc($entities)) { ?>
                                                                <option value="<?php echo $row['Id']; ?>">
                                                                    <?php echo getEntityNameByCountryId($connection, $row['country_id']); ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Ship From</label>
                                                        <select class="form-control" id="ship_from" name="ship_from">
                                                            <option disabled="" selected=""></option>
                                                            <?php while ($row2 = mysqli_fetch_assoc($countries)) { ?>
                                                                <option value="<?php echo $row2['Id']; ?>">
                                                                    <?php echo $row2['name']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Ship To</label>
                                                        <select class="form-control" id="ship_to" name="ship_to">
                                                            <option disabled="" selected=""></option>
                                                            <?php while ($row = mysqli_fetch_assoc($rates_countries)) { ?>
                                                                <option value="<?php echo $row['Id']; ?>">
                                                                    <?php echo getCountryNameById($connection, $row['country_id']); ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="charges">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <!-- <i class="material-icons">face</i> -->
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"> Cargo Value</label>
                                                        <input name="cargo_value" id="cargo_value" type="text" class="form-control cargo_value" rel="tooltip" title="Input value" oninput="<?php echo $onlyNumeric; ?>" maxlength="20">
                                                    </div>
                                                </div>

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                    </span>
                                                    <div class="form-group label-floating dusty_tax_label_class">
                                                        <label class="control-label">Estimated Duty & Taxes</label>
                                                        <input name="duty_tax" id="duty_tax" type="text" class="form-control" rel="tooltip" title="Auto Calculated based on Cargo value and charges based on government regulations defined in sheet named 'Countries & Rates'">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <!-- <i class="material-icons">face</i> -->
                                                    </span>
                                                    <div class="form-group label-floating ior_label_class">
                                                        <label class="control-label"> Importer of Records </label>
                                                        <input name="ior" id="ior" type="text" class="form-control ior" disabled readonly rel="tooltip" title="Auto Calculated Fixed fee, applied as USD 600 or 5% of cargo value, whichever is higher">
                                                    </div>
                                                </div>

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Freight</label>
                                                        <input name="freight" type="text" class="form-control freight" id="freight" rel="tooltip" title="Determined by cargo and destination country">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                    </span>
                                                    <div class="form-group label-floating customs_brokerage_label">
                                                        <label class="control-label">Customs Brokerage</label>
                                                        <input name="customs_brokerage" type="text" class="form-control customs_brokerage" disabled readonly  id="customs_brokerage" rel="tooltip" title="Fixed Fee">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Import Permit/Approval</label>
                                                        <input name="import_permit_approval" type="text" class="form-control import_permit_approval" id="import_permit_approval" rel="tooltip" title="Dependent on certification/approval required">
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col-sm-12">
                                                <div class="panel-group" style="margin: 15px 5px 0px !important;" id="accordion">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                            <h4 class="panel-title" rel="tooltip" title="Auto Calculated 
                                                        a. Charge based on the higher of the flat fee or per kg rate. 
                                                        b. Chargeable weight is either gross weight or volumetric weight whichever is higher.
                                                        C. USD 400 or USD 0.75/kg">
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Handling Chagres</a>
                                                                <span class="handling_charges_span pull-right">
                                                                    
                                                                </span>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseOne" class="panel-collapse collapse in">
                                                            <div class="panel-body">
                                                                <div class="row">

                                                                    <div class="col-md-12">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                            </span>
                                                                            <div class="form-group label-floating">
                                                                                <label class="control-label">Package Gross Weight (Kg)</label>
                                                                                <input name="package_gross_weight" id="package_gross_weight" type="text" class="form-control package_gross_weight" rel="tooltip" title="Input in kg">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                            </span>
                                                                            <div class="form-group label-floating package_dimension_label_class">
                                                                                <label class="control-label">Package Dimensions (length*width*Height)</label>
                                                                                <input type="text" name="package_dimension" class="form-control package_dimension" id="package_dimension" placeholder="" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                            </span>
                                                                            <div class="form-group label-floating">
                                                                                <label class="control-label">Length in (cm)</label>
                                                                                <input type="text" name="length" class="form-control length" id="length">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                            </span>
                                                                            <div class="form-group label-floating">
                                                                                <label class="control-label">Width in (cm)</label>
                                                                                <input type="text" name="width" class="form-control width" id="width">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                            </span>
                                                                            <div class="form-group label-floating">
                                                                                <label class="control-label">Height in (cm)</label>
                                                                                <input type="text" name="height" class="form-control height" id="height">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                            </span>
                                                                            <div class="form-group label-floating volumetric_weight_label_class">
                                                                                <label class="control-label">Volumetric Weight</label>
                                                                                <input type="text" name="volumetric_weight" id="volumetric_weight" class="form-control volumetric_weight" placeholder="" disabled />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- <div class="input-group">
                                                    <span class="input-group-addon">
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Handling Charges</label>
                                                        <input name="" type="text" class="form-control" rel="tooltip" title="Auto Calculated 
                                                        a. Charge based on the higher of the flat fee or per kg rate. 
                                                        b. Chargeable weight is either gross weight or volumetric weight whichever is higher.
                                                        C. USD 400 or USD 0.75/kg">
                                                    </div>
                                                </div> -->
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                    </span>
                                                    <div class="form-group label-floating admin_bank_charges_label">
                                                        <label class="control-label">Admin & Bank Charges</label>
                                                        <input name="admin_bank_charges" type="text" disabled class="form-control admin_bank_charges" id="admin_bank_charges" rel="tooltip" title="Fixed Fee">
                                                    </div>
                                                </div>

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Compliance & Certification</label>
                                                        <input name="compliance_certification" type="text" class="form-control compliance_certification" id="compliance_certification" rel="tooltip" title="Input Dependent on part number and country of origin/destination">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Storage</label>
                                                        <input name="storage" type="text" class="form-control storage" id="storage" rel="tooltip" title="Input Charges based on actual storage time">
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Last Mile Delivery </label>
                                                        <input name="last_mile_delivery" type="text" class="form-control last_mile_delivery" id="last_mile_delivery" rel="tooltip" title="Input Charges based on actual storage time">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-10 col-sm-offset-1">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <!-- <i class="material-icons">email</i> -->
                                                    </span>
                                                    <div class="form-group label-floating grand_total_label">
                                                        <label class="control-label">Total</label>
                                                        <input name="grand_total"  type="text" disabled class="form-control grand_total" id="grand_total">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wizard-footer">
                                    <div class="pull-right">
                                        <input type='button' class='btn btn-next btn-fill btn-danger btn-wd' name='next' value='Next' />
                                        <input type='button' class='btn btn-finish btn-fill btn-danger btn-wd' name='get_estimate' value='Get Estimates' />
                                    </div>

                                    <div class="pull-left">
                                        <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <input type="hidden"  name="handling_charges" class="handling_charges" id="handling_charges">
                                <input type="hidden" class="ior_value" id="ior_value">
                                <input type="hidden" class="duty_tax_value" id="duty_tax_value">
                                <input type="hidden" class="handling_value" id="handling_value">
                                <input type="hidden" class="customs_brokerage_value" id="customs_brokerage_value">
                                <input type="hidden" class="admin_bank_charges_value" id="admin_bank_charges_value">
                            </form>
                        </div>
                    </div> <!-- wizard container -->
                </div>
            </div><!-- end row -->
        </div> <!--  big container -->

        <!-- <div class="footer">
            <div class="container text-center">
                Made with <i class="fa fa-heart heart"></i> by <a href="https://www.venturetronics.com/">Venturetronics</a>.
            </div>
        </div> -->
    </div>

</body>
<!--   Core JS Files   -->
<script src="assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/jquery.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript" src="js/main.js?clear_cache=<?php echo time(); ?>"></script>

<!--  Plugin for the Wizard -->
<script src="assets/js/material-bootstrap-wizard.js"></script>

<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
<script src="assets/js/jquery.validate.min.js"></script>

</html>