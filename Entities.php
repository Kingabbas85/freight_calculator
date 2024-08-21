<?php
include_once("includes/session.php");
include_once('database/database.php');

if (isset($_SESSION['user_email']) == true) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Freight Calculator - Entities</title>
        <?php include_once('includes/header.php'); ?>
    </head>

    <body>
        <?php include_once('includes/navbar.php'); ?>
        <?php include_once('includes/alerts.php'); ?>
        <div class="layout" id="layout">
            <div class="inner-layout">
                <div class="d-flex justify-content-between page-heading">
                    <div class="heading">Entities</div>
                    <div class="add_new">
                        <a href="NewEntity"> <i class="fas fa-plus"></i>&nbsp; Add Entity </a>
                    </div>
                </div>
                <div class="line-break"></div>
                <div class="context mt-4">
                    <table id="EntityTable" class="table-sm w-100 table_style mt-2" style="min-width:1000px;">
                        <thead>
                            <tr class="text-left">
                                <th width="50px"> # </th>
                                <th> Country </th>
                                <th> City </th>
                                <th> Address </th>
                                <th> Website </th>
                                <th> Phone Number </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $query = "SELECT e.*, c.name as country_name, ci.name as city_name FROM entities e
                                  JOIN countries c ON e.country_id = c.Id
                                  JOIN cities ci ON e.city_id = ci.Id";
                            $result = mysqli_query($connection, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                // pre_r($row);die();
                            ?>
                                <tr>
                                    <td> <?php echo $count++; ?> </td>
                                    <td> <?php echo $row['country_name']; ?> </td>
                                    <td> <?php echo $row['city_name']; ?> </td>
                                    <td> <?php echo $row['address']; ?> </td>
                                    <td> <?php echo $row['website']; ?> </td>
                                    <td> <?php echo $row['phone_number']; ?> </td>
                                   <?php 
                                    echo '<td>
                                    <a href="EditEntity?id=' . md5($row['Id']) . '" class="text-primary"><i class="fas fa-edit"></i></a>&nbsp;
                                    <a href="javascript:void(0);" class="delete-entity-btn" data-id="' . $row['Id'] . '">
                                            <i class="fas fa-trash text-danger"></i>
                                        </a>
                                  </td>';
                                   ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>

    </html>
    <script type="text/javascript" src="js/entities.js?clear_cache=<?php echo time(); ?>"></script>
    <script type="text/javascript">
        // var startDate = moment().startOf('year');
        // var endDate = moment().endOf('month');
        // $("#daterange").daterangepicker({
        //  	startDate: startDate,
        //  	endDate: endDate,
        //  	locale: { 
        //    	format: 'MMM DD, YYYY',
        //  	},
        //  	maxDate: moment() // Restrict forward dates to today
        // });
    </script>
<?php

} else {
    header('location: login');
}
?>