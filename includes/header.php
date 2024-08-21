
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv='cache-control' content='no-cache'>
	<meta http-equiv='expires' content='0'>
	<meta http-equiv='pragma' content='no-cache'>

   	<!-- include icon -->
	<link rel="shortcut icon" href="<?php echo $logo="images/fc_logo.png"; ?>"></link>

	<!-- Custom css files -->
	<link rel="stylesheet" type="text/css" href="css/main.css?clear_cache=<?php echo time();?>">
	<link rel="stylesheet" type="text/css" href="css/navbar.css?clear_cache=<?php echo time();?>">
	<link rel="stylesheet" type="text/css" href="css/login.css?clear_cache=<?php echo time();?>">
	<link rel="stylesheet" type="text/css" href="css/forms.css?clear_cache=<?php echo time();?>">
	<!-- Custom css files -->

   	<!-- css libraries -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/libraries/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="css/libraries/buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="css/libraries/tokenfield.css">
	<link rel="stylesheet" type="text/css" href="css/libraries/select.min.css"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="css/libraries/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/libraries/datepicker.min.css">
   <!-- css libraries -->
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css"> -->

	



	<!-- js libraries -->
	<script type="text/javascript" src="js/libraries/md5.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/libraries/sweetalert.min.js"></script>
	<script type="text/javascript" src="js/libraries/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="js/libraries/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="js/libraries/buttons.dataTables.min.js"></script>

	<script type="text/javascript" src="js/libraries/moment.min.js"></script>
	<script type="text/javascript" src="js/libraries/daterangepicker.js"></script>
	<script type="text/javascript" src="js/libraries/datepicker.min.js"></script>
	<script type="text/javascript" src="js/libraries/tokenfield.js"></script>
	<script type="text/javascript" src="js/libraries/select.min.js"></script>

	<script type="text/javascript" src="js/libraries/sweetalert.min.js"></script>
	<!-- js libraries -->
   

   	<!-- Custom js files -->
	<?php
		$url = "{$_SERVER['REQUEST_URI']}";
		if ($url != "/hrms/MarkAttendance") {
	?>
		<script src="js/main.js?clear_cache=<?php echo time();?>"></script>
	<?php 
		}
	?>
	<!-- Custom js files -->


	<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
	<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
	<!-- <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script> -->

	


	
	
	

	
    

	
    <!-- js libraries -->

	