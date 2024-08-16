<?php
	session_start();
	include_once('database/database.php');

	if (isset($_POST['getLogin'])) {

		if (isset($_POST['email']) && isset($_POST['password'])) {

			$useremail = $_POST['email'];
			$password = $_POST['password'];

			$useremail = strtolower($useremail);
			$password = md5($password);
			$query2 = "Select * FROM users WHERE email = '$useremail' && password = '$password'";
			$result2 = mysqli_query($connection, $query2);
			if (mysqli_num_rows($result2) > 0) {
				while ($row2 = mysqli_fetch_assoc($result2)) {

					$user_name = $row2['user_name'];
					$user_displayName = $row2['display_name'];
					$email = $row2['email'];
					$user_role = $row2['user_role'];

					$_SESSION['user_name'] = $user_name;
					$_SESSION['user_fullname'] = $user_displayName;
					$_SESSION['user_email'] = $email;
					$_SESSION['user_role'] = $user_role;
				}
				echo 1;
			} else {
				echo "Invalid credientials";
			}
		}
	}


// if (isset($_POST['venturetronicsLogin'])) {

// 	if (!empty($_POST['email']) && !empty($_POST['password'])) {

// 		$adServer = "10.10.5.1";
// 		$ldap = ldap_connect($adServer);
// 		$useremail = $_POST['email'];
// 		$password = $_POST['password'];

// 		$ldaprdn = $useremail;

// 		ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
// 		ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

// 		$bind = @ldap_bind($ldap, $ldaprdn, $password);
// 		if ($bind) {

// 			$filter = "(userprincipalname=$useremail)";
// 			$result = ldap_search($ldap, "dc=venturetronics,dc=com", $filter);
// 			$info = ldap_get_entries($ldap, $result);
// 			for ($i = 0; $i < $info["count"]; $i++) {
// 				if ($info['count'] > 1) {
// 					break;
// 				}
// 				// echo "First Name: ".$info[$i]["givenname"][0]."<br>";
// 				// echo "Last Name: ".$info[$i]["sn"][0]."<br>";
// 				// echo "Full Name: ".$info[$i]["cn"][0]."<br>";
// 				// echo "User Name: ".$info[$i]["samaccountname"][0]."<br>";
// 				// echo "Email Address: ".$info[$i]["userprincipalname"][0]."<br>";
// 				// echo "Designation: ".$info[$i]["title"][0]."<br>";

// 				$_SESSION['first_name'] = $info[$i]["givenname"][0];
// 				$_SESSION['user_name'] = $info[$i]["samaccountname"][0];
// 				$_SESSION['user_fullname'] = $info[$i]["cn"][0];
// 				$_SESSION['user_email'] = $info[$i]["userprincipalname"][0];

// 				$user_name = $info[$i]["samaccountname"][0];
// 				$user_displayName = $info[$i]["cn"][0];
// 				$user_email = $info[$i]["userprincipalname"][0];
// 			}

// 			$_SESSION['user_role'] = "";
// 			$query = "Select * from permissions where user_email = '$user_email' ";
// 			$result = mysqli_query($connection, $query);
// 			if (mysqli_num_rows($result) > 0) {
// 				while ($row = mysqli_fetch_assoc($result)) {
// 					$user_role = $row['user_role'];
// 					$_SESSION['user_role'] = $row['user_role'];
// 				}
// 			} else {
// 				$user_role = 'guest';
// 				$_SESSION['user_role'] = "guest";
// 			}
// 			$password = md5($password);
// 			$useremail = strtolower($useremail);
// 			$user_email = strtolower($user_email);
// 			$query2 = "Select * from users where email = '$user_email' ";
// 			$result2 = mysqli_query($connection, $query2);
// 			if (mysqli_num_rows($result2) > 0) {
// 				while ($row2 = mysqli_fetch_assoc($result2)) {

// 					$email = $row2['email'];
// 					$query3 = "Update `users` SET password = '$password', user_role = '$user_role' WHERE email = '$email' ";
// 					$result3 = mysqli_query($connection, $query3);
// 				}
// 			} else {
// 				$query3 = "Insert INTO users (display_name, user_name, email, password, user_role, assign_to) VALUES ('$user_displayName', '$user_name', '$user_email', '$password', '$user_role', 0)";
// 				$result3 = mysqli_query($connection, $query3);
// 			}
// 			if ($result3) {
// 				echo 1;
// 			}

// 			@ldap_close($ldap);
// 		} else {

// 			$useremail = strtolower($useremail);
// 			$password = md5($password);
// 			$query2 = "Select * from users where email = '$useremail' && password = '$password' ";
// 			$result2 = mysqli_query($connection, $query2);
// 			if (mysqli_num_rows($result2) > 0) {
// 				while ($row2 = mysqli_fetch_assoc($result2)) {

// 					$user_name = $row2['user_name'];
// 					$user_displayName = $row2['display_name'];
// 					$email = $row2['email'];
// 					$user_role = $row2['user_role'];

// 					$_SESSION['user_name'] = $user_name;
// 					$_SESSION['user_fullname'] = $user_displayName;
// 					$_SESSION['user_email'] = $email;
// 					$_SESSION['user_role'] = $user_role;
// 				}
// 				echo 1;
// 			} else {
// 				echo "Invalid credientials";
// 			}
// 		}
// 	}
// }


// if (isset($_POST['powersoft19Login'])) {

// 	if (!empty($_POST['email']) && !empty($_POST['password'])) {

// 		$adServer = "powersoft19.com";
// 		$ldap = ldap_connect($adServer);
// 		$useremail = $_POST['email'];
// 		$password = $_POST['password'];
// 		// $useremail = "danish.raza@powersoft19.com";
// 		// $password = "123Pakistan$";

// 		$ldaprdn = $useremail;

// 		ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
// 		ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

// 		$bind = @ldap_bind($ldap, $ldaprdn, $password);

// 		if ($bind) {

// 			$filter = "(userprincipalname=$useremail)";
// 			$result = ldap_search($ldap, "dc=powersoft19,dc=com", $filter);
// 			$info = ldap_get_entries($ldap, $result);
// 			for ($i = 0; $i < $info["count"]; $i++) {
// 				if ($info['count'] > 1) {
// 					break;
// 				}
// 				// echo "First Name: ".$info[$i]["givenname"][0]."<br>";
// 				// echo "Last Name: ".$info[$i]["sn"][0]."<br>";
// 				// echo "Full Name: ".$info[$i]["cn"][0]."<br>";
// 				// echo "User Name: ".$info[$i]["samaccountname"][0]."<br>";
// 				// echo "Email Address: ".$info[$i]["userprincipalname"][0]."<br>";
// 				// echo "Designation: ".$info[$i]["title"][0]."<br>";

// 				$_SESSION['first_name'] = $info[$i]["givenname"][0];
// 				$_SESSION['user_name'] = $info[$i]["samaccountname"][0];
// 				$_SESSION['user_fullname'] = $info[$i]["cn"][0];
// 				$_SESSION['user_email'] = $info[$i]["userprincipalname"][0];

// 				$user_name = $info[$i]["samaccountname"][0];
// 				$user_displayName = $info[$i]["cn"][0];
// 				$user_email = $info[$i]["userprincipalname"][0];
// 			}

// 			$_SESSION['user_role'] = "";
// 			$query = "Select * from permissions where user_email = '$user_email' ";
// 			$result = mysqli_query($connection, $query);
// 			if (mysqli_num_rows($result) > 0) {
// 				while ($row = mysqli_fetch_assoc($result)) {
// 					$user_role = $row['user_role'];
// 					$_SESSION['user_role'] = $row['user_role'];
// 				}
// 			} else {
// 				$user_role = 'guest';
// 				$_SESSION['user_role'] = "guest";
// 			}
// 			$password = md5($password);
// 			$useremail = strtolower($useremail);
// 			$user_email = strtolower($user_email);
// 			$query2 = "Select * from users where email = '$user_email' ";
// 			$result2 = mysqli_query($connection, $query2);
// 			if (mysqli_num_rows($result2) > 0) {
// 				while ($row2 = mysqli_fetch_assoc($result2)) {

// 					$email = $row2['email'];
// 					$query3 = "Update `users` SET password = '$password', user_role = '$user_role' WHERE email = '$email' ";
// 					$result3 = mysqli_query($connection, $query3);
// 				}
// 			} else {
// 				$query3 = "Insert INTO users (display_name, user_name, email, password, user_role, assign_to) VALUES ('$user_displayName', '$user_name', '$user_email', '$password', '$user_role', 0)";
// 				$result3 = mysqli_query($connection, $query3);
// 			}
// 			if ($result3) {
// 				echo 1;
// 			}

// 			@ldap_close($ldap);
// 		} else {

// 			$useremail = strtolower($useremail);
// 			$password = md5($password);
// 			$query2 = "Select * from users where email = '$useremail' && password = '$password' ";
// 			$result2 = mysqli_query($connection, $query2);
// 			if (mysqli_num_rows($result2) > 0) {
// 				while ($row2 = mysqli_fetch_assoc($result2)) {

// 					$user_name = $row2['user_name'];
// 					$user_displayName = $row2['display_name'];
// 					$email = $row2['email'];
// 					$user_role = $row2['user_role'];

// 					$_SESSION['user_name'] = $user_name;
// 					$_SESSION['user_fullname'] = $user_displayName;
// 					$_SESSION['user_email'] = $email;
// 					$_SESSION['user_role'] = $user_role;
// 				}
// 				echo 1;
// 			} else {
// 				echo "Invalid credientials";
// 			}
// 		}
// 	}
// }


// if (isset($_POST['raythorneLogin'])) {

// 	if (!empty($_POST['email']) && !empty($_POST['password'])) {

// 		$adServer = "raythorne.com";
// 		$ldap = ldap_connect($adServer);
// 		$useremail = $_POST['email'];
// 		$password = $_POST['password'];
// 		$ldaprdn = $useremail;

// 		ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
// 		ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

// 		$bind = @ldap_bind($ldap, $ldaprdn, $password);
// 		if ($bind) {

// 			$filter = "(userprincipalname=$useremail)";
// 			$result = ldap_search($ldap, "dc=raythorne,dc=com", $filter);
// 			$info = ldap_get_entries($ldap, $result);
// 			for ($i = 0; $i < $info["count"]; $i++) {
// 				if ($info['count'] > 1) {
// 					break;
// 				}
// 				// echo "First Name: ".$info[$i]["givenname"][0]."<br>";
// 				// echo "Last Name: ".$info[$i]["sn"][0]."<br>";
// 				// echo "Full Name: ".$info[$i]["cn"][0]."<br>";
// 				// echo "User Name: ".$info[$i]["samaccountname"][0]."<br>";
// 				// echo "Email Address: ".$info[$i]["userprincipalname"][0]."<br>";
// 				// echo "Designation: ".$info[$i]["title"][0]."<br>";

// 				$_SESSION['first_name'] = $info[$i]["givenname"][0];
// 				$_SESSION['user_name'] = $info[$i]["samaccountname"][0];
// 				$_SESSION['user_fullname'] = $info[$i]["cn"][0];
// 				$_SESSION['user_email'] = $info[$i]["userprincipalname"][0];

// 				$user_name = $info[$i]["samaccountname"][0];
// 				$user_displayName = $info[$i]["cn"][0];
// 				$user_email = $info[$i]["userprincipalname"][0];
// 			}

// 			$_SESSION['user_role'] = "";
// 			$query = "Select * from permissions where user_email = '$user_email' ";
// 			$result = mysqli_query($connection, $query);
// 			if (mysqli_num_rows($result) > 0) {
// 				while ($row = mysqli_fetch_assoc($result)) {
// 					$user_role = $row['user_role'];
// 					$_SESSION['user_role'] = $row['user_role'];
// 				}
// 			} else {
// 				$user_role = 'guest';
// 				$_SESSION['user_role'] = "guest";
// 			}
// 			$password = md5($password);
// 			$useremail = strtolower($useremail);
// 			$user_email = strtolower($user_email);
// 			$query2 = "Select * from users where email = '$user_email' ";
// 			$result2 = mysqli_query($connection, $query2);
// 			if (mysqli_num_rows($result2) > 0) {
// 				while ($row2 = mysqli_fetch_assoc($result2)) {

// 					$email = $row2['email'];
// 					$query3 = "Update `users` SET password = '$password', user_role = '$user_role' WHERE email = '$email' ";
// 					$result3 = mysqli_query($connection, $query3);
// 				}
// 			} else {
// 				$query3 = "Insert INTO users (display_name, user_name, email, password, user_role, assign_to) VALUES ('$user_displayName', '$user_name', '$user_email', '$password', '$user_role', 0)";
// 				$result3 = mysqli_query($connection, $query3);
// 			}
// 			if ($result3) {
// 				echo 1;
// 			}

// 			@ldap_close($ldap);
// 		} else {

// 			$useremail = strtolower($useremail);
// 			$password = md5($password);
// 			$query2 = "Select * from users where email = '$useremail' && password = '$password' ";
// 			$result2 = mysqli_query($connection, $query2);
// 			if (mysqli_num_rows($result2) > 0) {
// 				while ($row2 = mysqli_fetch_assoc($result2)) {

// 					$user_name = $row2['user_name'];
// 					$user_displayName = $row2['display_name'];
// 					$email = $row2['email'];
// 					$user_role = $row2['user_role'];

// 					$_SESSION['user_name'] = $user_name;
// 					$_SESSION['user_fullname'] = $user_displayName;
// 					$_SESSION['user_email'] = $email;
// 					$_SESSION['user_role'] = $user_role;
// 				}
// 				echo 1;
// 			} else {
// 				echo "Invalid credientials";
// 			}
// 		}
// 	}
// }