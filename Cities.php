<?php
include_once("includes/session.php");
include_once('database/database.php');

if (isset($_SESSION['user_email']) == true) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Freight Calculator - Cities</title>
        <?php include_once('includes/header.php'); ?>
    </head>

    <body>
        <?php include_once('includes/navbar.php'); ?>
        <?php include_once('includes/alerts.php'); ?>
        <div class="layout" id="layout">
            <div class="inner-layout">
                <div class="d-flex justify-content-between page-heading">
                    <div class="heading"> Cities </div>
                    <div class="add_new">
                        <a href="NewCity"> <i class="fas fa-plus"></i>&nbsp; Add City </a>
                    </div>
                </div>
                <div class="line-break"></div>

                <div class="context mt-4">
                    <table id="CityTable" class="table-sm w-100 table_style mt-2" style="min-width:1000px;">
                        <thead>
                            <tr class="text-left">
                                <th width="50px"> # </th>
                                <th> City Name </th>
                                <th> Country </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $query = "SELECT cities.*, countries.name as country_name FROM cities 
                                      LEFT JOIN countries ON cities.country_id = countries.Id";
                            $result = mysqli_query($connection, $query);
                            if (mysqli_num_rows($result)) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['Id'];
                                    $city_name = $row['name'];
                                    $country_name = $row['country_name'];

                                    echo '<tr>';
                                    echo '<td>' . $count++ . '</td>';
                                    echo '<td>' . $city_name . '</td>';

									echo '<td>' . $country_name . '</td>';
									echo '<td class="text-center">';
									echo '<a href="EditCity?id=' .md5($id)  . '" class="text-primary"><i class="fas fa-edit"></i></a>&nbsp';
									echo '<a  href="javascript:void(0);" data-id="' . $id . '" class="delete-city-btn"><i class="fas fa-trash text-danger"></i></a>';
									echo '</td>';
									echo '</tr>';
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>

	</html>
	<script type="text/javascript" src="js/cities.js?clear_cache=<?php echo time(); ?>"></script>
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