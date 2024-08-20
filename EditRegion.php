<?php
include_once("includes/session.php");
include_once('database/database.php');

if (isset($_SESSION['user_email']) == true) {
    $counter = 0;
    $id = $_GET['id'];
    $query = "SELECT * FROM regions WHERE md5(Id) = '$id'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        $region_name = $row['name'];
        $id = $row['Id'];
    } else {
        header('Location: page_not_found');
    }
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Freight Calculator - User</title>
        <?php include_once('includes/header.php'); ?>
        <style>
            .username,
            .email {
                background: #ECF0F1 !important;
            }

            .username:focus,
            .email:focus {
                border: 1px solid transparent;
                outline: none !important;
                box-shadow: none !important;
            }
        </style>
    </head>

    <body>
        <?php include_once('includes/navbar.php'); ?>
        <div class="success-alert">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
            </svg>
            Region updated successfully!
        </div>
        <div class="error-alert">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            Something went wrong!
        </div>

        <div class="layout" id="layout">
            <div class="inner-layout">

                <div class="d-flex justify-content-between page-heading">
                    <div> Edit Region </div>
                </div>
                <div class="line-break"></div>

                <div class="mt-4 context">
                    <form id="edit-region-form" class="edit-region-form">
                        <div class="row">
                            <div class="col-md-6 mt-1">
                                <span class="font-weight-light">
                                    <strong> Region Name:<i class="text-danger">*</i></strong>
                                    <input type="text" name="region_name" id="region_name" class="form-control form-control-sm region_name" value="<?php echo $region_name; ?>" oninput="<?php echo $onlyCharacter; ?>">
                                </span>
                            </div>
                        </div>
                        <input type="hidden" name="id" class="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="action" class="action" value="EditRegion">
                        <div class="text-center submit mt-4">
                            <button type="submit" class="btn btn-info submit-btn">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </body>

    </html>
    <script type="text/javascript" src="js/regions.js?clear_cache=<?php echo time(); ?>"></script>
<?php
} else {
    header('location: login');
}
?>