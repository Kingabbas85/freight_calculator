<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon.ico">

    <title>Freight Cost Calculator</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body>
    <div class="image-container set-full-height" style="background-image: url('assets/img/wizard-profile.jpg')">
        <!--   Creative Tim Branding   -->
        <a href="dashboard.php">
            <div class="logo-container">
                <div class="logo">
                    <img src="images/fc_logo.png">
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
                        <div class="card wizard-card" data-color="green" id="wizardProfile">
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
			                            <li><a href="#customer_info" data-toggle="tab">Customer Info</a></li>
			                           
			                            <li><a href="#charges" data-toggle="tab">Charges</a></li>
			                        </ul>
								</div>

                                <div class="tab-content">
                                <div class="tab-pane" id="customer_info">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <!-- <i class="material-icons">face</i> -->
                                                </span>
                                                <div class="form-group label-floating">
		                                        	<label class="control-label">Estimate From</label>
		                                        	<select class="form-control">
		                                            	<option disabled="" selected=""></option>
		                                            	<option>Yes</option>
		                                            	<option>No </option>
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
		                                        	<select class="form-control">
		                                            	<option disabled="" selected=""></option>
		                                            	<option>Yes</option>
		                                            	<option>No </option>
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
		                                        	<select class="form-control">
		                                            	<option disabled="" selected=""></option>
		                                            	<option>Yes</option>
		                                            	<option>No </option>
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
                                                    <label class="control-label"> Importer of Record (IOR) <small>(required)</small></label>
                                                    <input name="firstname" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Estimated Duty & Taxes<small>(required)</small></label>
                                                    <input name="lastname" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Freight<small>(required)</small></label>
                                                    <input name="firstname" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Customs Brokerage<small>(required)</small></label>
                                                    <input name="lastname" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Import Permit/Approval<small>(required)</small></label>
                                                    <input name="firstname" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Handling Charges<small>(required)</small></label>
                                                    <input name="lastname" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">CLast Mile Delivery <small>(required)</small></label>
                                                    <input name="lastname" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Admin & Bank Charges<small>(required)</small></label>
                                                    <input name="firstname" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Compliance & Certification<small>(required)</small></label>
                                                    <input name="lastname" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Storage<small>(required)</small></label>
                                                    <input name="firstname" type="text" class="form-control">
                                                </div>
                                            </div>

                                           
                                        </div>
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <!-- <i class="material-icons">email</i> -->
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Total</label>
                                                    <input name="email" type="email" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="wizard-footer">
		                            <div class="pull-right">
		                                <input type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' value='Next' />
		                                <input type='button' class='btn btn-finish btn-fill btn-success btn-wd' name='get_estimate' value='Get Estimates' />
		                            </div>

		                            <div class="pull-left">
		                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
		                            </div>
		                            <div class="clearfix"></div>
		                        </div>
                            </form>
                        </div>
                    </div> <!-- wizard container -->
                </div>
            </div><!-- end row -->
        </div> <!--  big container -->

        <div class="footer">
            <div class="container text-center">
                Made with <i class="fa fa-heart heart"></i> by <a href="https://www.venturetronics.com/">Venturetronics</a>.
            </div>
        </div>
    </div>

</body>
<!--   Core JS Files   -->
<script src="assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/jquery.bootstrap.js" type="text/javascript"></script>

<!--  Plugin for the Wizard -->
<script src="assets/js/material-bootstrap-wizard.js"></script>

<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
<script src="assets/js/jquery.validate.min.js"></script>

</html>