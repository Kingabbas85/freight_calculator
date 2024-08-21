<?php
include_once("includes/session.php");
include_once('database/database.php');

if (isset($_SESSION['user_email']) == true) {
    // Fetch rates data
    $query = "SELECT rates.*, regions.name, countries.name FROM rates 
              JOIN regions ON rates.region_id = regions.id
              JOIN countries ON rates.country_id = countries.id";
    $result = mysqli_query($connection, $query);
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Rates</title>
        <?php include_once('includes/header.php'); ?>
    </head>

    <body>
        <?php include_once('includes/navbar.php'); ?>
        <?php include_once('includes/alerts.php'); ?>
        <div class="layout" id="layout">
            <div class="inner-layout">
                <div class="d-flex justify-content-between page-heading">
                    <div>Rates</div>
                    <div class="add_new">
                        <a href="NewRate"> <i class="fas fa-plus"></i>&nbsp; Add New Rate </a>
                    </div>
                </div>
                <div class="line-break"></div>

                <div class="mt-4 context">
                    <table id="RatesTable" class="table-sm w-100 table_style mt-2" style="min-width:1000px;">
                        <thead>
                            <tr>
                                <th>Rate ID</th>
                                <th>Region</th>
                                <th>Country</th>
                                <th>TGS SLA Zone</th>
                                <th>TBS Priority</th>
                                <th>Duty Tax</th>
                                <th>Customs Brokerage</th>
                                <th>Handling</th>
                                <th>IOR</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) {
                                    $region_id = $row['region_id'];
                                	$region_name = getRegionNameById($connection, $region_id);
                                 ?>
                                <tr>
                                    <td><?php echo $row['Id']; ?></td>
                                    <td><?php echo $region_name; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['tgs_sla_zone']; ?></td>
                                    <td><?php echo $row['tbs_priority']; ?></td>
                                    <td><?php echo $row['duty_tax']; ?></td>
                                    <td><?php echo $row['customs_brokerage']; ?></td>
                                    <td><?php echo $row['handling']; ?></td>
                                    <td><?php echo $row['ior']; ?></td>
                                    <td>
                                        <a href="EditRate?id=<?php echo md5($row['Id']); ?>"  class="text-primary"><i class="fas fa-edit"></i></a>&nbsp
                                        <a href="javascript:void(0);" class="delete-rate-btn" data-id="<?php echo $row['Id']; ?>"><i class="fas fa-trash text-danger"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="js/rates.js?clear_cache=<?php echo time(); ?>"></script>

    </html>
<?php
} else {
    header('location: login');
}
?>
