<?php
include_once("includes/session.php");
include_once('database/database.php');

if (isset($_SESSION['user_email']) == true) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Add New Customer</title>
        <?php include_once('includes/header.php'); ?>
    </head>

    <body>
        <?php include_once('includes/navbar.php'); ?>
        <?php include_once('includes/alerts.php'); ?>
        <div class="layout" id="layout">
            <div class="inner-layout">
                <div class="d-flex justify-content-between page-heading">
                    <div>Add New Customer</div>
                </div>
                <div class="line-break"></div>

                <div class="mt-4 context">
                    <form id="customer-form" class="customer-form">
                        <div class="row">
                            <div class="col-md-6 mt-1">
                                <label for="contact_name"><strong>Contact Name:<i class="text-danger">*</i></strong></label>
                                <input type="text" name="contact_name" id="contact_name" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-6 mt-1">
                                <label for="company_name"><strong>Company Name:<i class="text-danger">*</i></strong></label>
                                <input type="text" name="company_name" id="company_name" class="form-control form-control-sm company_name">
                            </div>
                            <div class="col-md-6 mt-1">
                                <label for="phone_1"><strong>Phone 1:</strong></label>
                                <input type="text" name="phone_1" id="phone_1" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-6 mt-1">
                                <label for="phone_2"><strong>Phone 2:</strong></label>
                                <input type="text" name="phone_2" id="phone_2" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-6 mt-1">
                                <label for="email"><strong>Email:</strong></label>
                                <input type="email" name="email" id="email" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-6 mt-1">
                                <label for="city"><strong>City:</strong></label>
                                <input type="text" name="city" id="city" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-12 mt-1">
                                <label for="mailing_address"><strong>Mailing Address:</strong></label>
                                <input type="text" name="mailing_address" id="mailing_address" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-12 mt-1">
                                <label for="billing_address"><strong>Billing Address:</strong></label>
                                <input type="text" name="billing_address" id="billing_address" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-12 mt-1">
                                <label for="notes"><strong>Notes:</strong></label>
                                <textarea name="notes" id="notes" class="form-control form-control-sm" rows="4"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="action" class="action" value="NewCustomer">
                        <div class="text-center submit mt-4">
                            <button type="submit" class="btn btn-info submit-btn">Add Customer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="js/customers.js?clear_cache=<?php echo time(); ?>"></script>

    </html>
<?php
} else {
    header('location: login');
}
?>
