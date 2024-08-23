<?php
   include_once('database/database.php');
   include_once('includes/session.php');

   // if (isset($_POST['venturetronicsLogin'])) {

   //    $adServer = "10.10.5.1";
   //    $ldap = ldap_connect($adServer);
   //    $useremail = $_POST['email'];
   //    $password = $_POST['password'];

   //    $ldaprdn = $useremail;
   //    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
   //    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

   //    $bind = @ldap_bind($ldap, $ldaprdn, $password);
   //    if ($bind) {

   //       $filter = "(userprincipalname=$useremail)";
   //       $result = ldap_search($ldap, "dc=venturetronics,dc=com", $filter);
   //       $info = ldap_get_entries($ldap, $result);
   //       for ($i = 0; $i < $info["count"]; $i++) {
   //          if ($info['count'] > 1) {
   //             break;
   //          }

   //          $_SESSION['user_name'] = $info[$i]["samaccountname"][0];
   //          $_SESSION['full_name'] = $info[$i]["cn"][0];
   //          $_SESSION['user_email'] = $info[$i]["userprincipalname"][0];

   //          $user_name = $info[$i]["samaccountname"][0];
   //          $full_name = $info[$i]["cn"][0];
   //       }

   //       $_SESSION['user_name'] = $user_name;
   //       $_SESSION['full_name'] = $full_name;
   //       $_SESSION['user_email'] = $useremail;
   //       $_SESSION['user_role'] = "user";
   //       $_SESSION['active'] = 1;
          
   //       $user_role = 'user';
   //       $query = "Select * FROM permissions WHERE user_email = '$useremail'";
   //       $result = mysqli_query($connection, $query);
   //       if (mysqli_num_rows($result) > 0) {
   //          while ($row = mysqli_fetch_assoc($result)) {
   //             $user_role = $row['user_role'];
   //             $_SESSION['user_role'] = $user_role;
   //          }
   //       }
          
   //       $useremail = strtolower($useremail);
   //       $password = md5($password);
   //       $query2 = "Select * FROM users WHERE email = '$useremail'";
   //       $result2 = mysqli_query($connection, $query2);
   //       if (mysqli_num_rows($result2)) {
   //          while ($row2 = mysqli_fetch_assoc($result2)) {

   //             $email = $row2['email'];
   //             $query3 = "Update users SET password = '$password', user_role = '$user_role' WHERE email = '$email'";
   //             $result3 = mysqli_query($connection, $query3);
   //          }
   //       } else {
   //          $query3 = "Insert INTO users (display_name, user_name, email, password, user_role, active) VALUES ('$full_name', '$user_name', '$useremail', '$password', '$user_role', 1)";
   //          $result3 = mysqli_query($connection, $query3);
   //       }
   //       if ($result3) {
   //          echo 1;
   //       }
   //       @ldap_close($ldap);
   //    } else {

   //       $useremail = strtolower($useremail);
   //       $password = md5($password);
   //       $query2 = "Select * FROM users WHERE email = '$useremail' && password = '$password' && active = '1'";
   //       $result2 = mysqli_query($connection, $query2);
   //       if (mysqli_num_rows($result2) > 0) {
   //          while ($row2 = mysqli_fetch_assoc($result2)) {

   //             $user_name = $row2['user_name'];
   //             $full_name = $row2['display_name'];
   //             $email = $row2['email'];
   //             $user_role = $row2['user_role'];
   //             $active = $row2['active'];

   //             $_SESSION['user_name'] = $user_name;
   //             $_SESSION['full_name'] = $full_name;
   //             $_SESSION['user_email'] = $email;
   //             $_SESSION['user_role'] = $user_role;
   //             $_SESSION['active'] = $active;
   //          }
   //          echo 1;
   //       } else {
   //          echo "Invalid credientials";
   //       }
   //    }
   // } else if (isset($_POST['powersoft19Login'])) {

   //    $adServer = "powersoft19.com";
   //    $ldap = ldap_connect($adServer);
   //    $useremail = $_POST['email'];
   //    $password = $_POST['password'];

   //    $ldaprdn = $useremail;
   //    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
   //    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

   //    $bind = @ldap_bind($ldap, $ldaprdn, $password);
   //    if ($bind) {

   //       $filter = "(userprincipalname=$useremail)";
   //       $result = ldap_search($ldap, "dc=powersoft19,dc=com", $filter);
   //       $info = ldap_get_entries($ldap, $result);
   //       for ($i = 0; $i < $info["count"]; $i++) {
   //          if ($info['count'] > 1) {
   //             break;
   //          }

   //          $_SESSION['user_name'] = $info[$i]["samaccountname"][0];
   //          $_SESSION['full_name'] = $info[$i]["cn"][0];
   //          $_SESSION['user_email'] = $info[$i]["userprincipalname"][0];

   //          $user_name = $info[$i]["samaccountname"][0];
   //          $full_name = $info[$i]["cn"][0];
   //       }

   //       $_SESSION['user_name'] = $user_name;
   //       $_SESSION['full_name'] = $full_name;
   //       $_SESSION['user_email'] = $useremail;
   //       $_SESSION['user_role'] = "user";
   //       $_SESSION['active'] = 1;
          
   //       $user_role = 'user';
   //       $query = "Select * FROM permissions WHERE user_email = '$useremail'";
   //       $result = mysqli_query($connection, $query);
   //       if (mysqli_num_rows($result) > 0) {
   //          while ($row = mysqli_fetch_assoc($result)) {
   //             $user_role = $row['user_role'];
   //             $_SESSION['user_role'] = $user_role;
   //          }
   //       }
          
   //       $useremail = strtolower($useremail);
   //       $password = md5($password);
   //       $query2 = "Select * FROM users WHERE email = '$useremail'";
   //       $result2 = mysqli_query($connection, $query2);
   //       if (mysqli_num_rows($result2)) {
   //          while ($row2 = mysqli_fetch_assoc($result2)) {

   //             $email = $row2['email'];
   //             $query3 = "Update users SET password = '$password', user_role = '$user_role' WHERE email = '$email'";
   //             $result3 = mysqli_query($connection, $query3);
   //          }
   //       } else {
   //          $query3 = "Insert INTO users (display_name, user_name, email, password, user_role, active) VALUES ('$full_name', '$user_name', '$useremail', '$password', '$user_role', 1)";
   //          $result3 = mysqli_query($connection, $query3);
   //       }
   //       if ($result3) {
   //          echo 1;
   //       }
   //       @ldap_close($ldap);
   //    } else {

   //       $useremail = strtolower($useremail);
   //       $password = md5($password);
   //       $query2 = "Select * FROM users WHERE email = '$useremail' && password = '$password' && active = '1'";
   //       $result2 = mysqli_query($connection, $query2);
   //       if (mysqli_num_rows($result2) > 0) {
   //          while ($row2 = mysqli_fetch_assoc($result2)) {

   //             $user_name = $row2['user_name'];
   //             $full_name = $row2['display_name'];
   //             $email = $row2['email'];
   //             $user_role = $row2['user_role'];
   //             $active = $row2['active'];

   //             $_SESSION['user_name'] = $user_name;
   //             $_SESSION['full_name'] = $full_name;
   //             $_SESSION['user_email'] = $email;
   //             $_SESSION['user_role'] = $user_role;
   //             $_SESSION['active'] = $active;
   //          }
   //          echo 1;
   //       } else {
   //          echo "Invalid credientials";
   //       }
   //    }
   // } else if (isset($_POST['raythorneLogin'])) {

   //    $adServer = "raythorne.com";
   //    $ldap = ldap_connect($adServer);
   //    $useremail = $_POST['email'];
   //    $password = $_POST['password'];

   //    $ldaprdn = $useremail;
   //    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
   //    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

   //    $bind = @ldap_bind($ldap, $ldaprdn, $password);
   //    if ($bind) {

   //       $filter = "(userprincipalname=$useremail)";
   //       $result = ldap_search($ldap, "dc=raythorne,dc=com", $filter);
   //       $info = ldap_get_entries($ldap, $result);
   //       for ($i = 0; $i < $info["count"]; $i++) {
   //          if ($info['count'] > 1) {
   //             break;
   //          }

   //          $_SESSION['user_name'] = $info[$i]["samaccountname"][0];
   //          $_SESSION['full_name'] = $info[$i]["cn"][0];
   //          $_SESSION['user_email'] = $info[$i]["userprincipalname"][0];

   //          $user_name = $info[$i]["samaccountname"][0];
   //          $full_name = $info[$i]["cn"][0];
   //       }

   //       $_SESSION['user_name'] = $user_name;
   //       $_SESSION['full_name'] = $full_name;
   //       $_SESSION['user_email'] = $useremail;
   //       $_SESSION['user_role'] = "user";
   //       $_SESSION['active'] = 1;
          
   //       $user_role = 'user';
   //       $query = "Select * FROM permissions WHERE user_email = '$useremail'";
   //       $result = mysqli_query($connection, $query);
   //       if (mysqli_num_rows($result) > 0) {
   //          while ($row = mysqli_fetch_assoc($result)) {
   //             $user_role = $row['user_role'];
   //             $_SESSION['user_role'] = $user_role;
   //          }
   //       }
          
   //       $useremail = strtolower($useremail);
   //       $password = md5($password);
   //       $query2 = "Select * FROM users WHERE email = '$useremail'";
   //       $result2 = mysqli_query($connection, $query2);
   //       if (mysqli_num_rows($result2)) {
   //          while ($row2 = mysqli_fetch_assoc($result2)) {

   //             $email = $row2['email'];
   //             $query3 = "Update users SET password = '$password', user_role = '$user_role' WHERE email = '$email'";
   //             $result3 = mysqli_query($connection, $query3);
   //          }
   //       } else {
   //          $query3 = "Insert INTO users (display_name, user_name, email, password, user_role, active) VALUES ('$full_name', '$user_name', '$useremail', '$password', '$user_role', 1)";
   //          $result3 = mysqli_query($connection, $query3);
   //       }
   //       if ($result3) {
   //          echo 1;
   //       }
   //       @ldap_close($ldap);
   //    } else {

   //       $useremail = strtolower($useremail);
   //       $password = md5($password);
   //       $query2 = "Select * FROM users WHERE email = '$useremail' && password = '$password' && active = '1'";
   //       $result2 = mysqli_query($connection, $query2);
   //       if (mysqli_num_rows($result2) > 0) {
   //          while ($row2 = mysqli_fetch_assoc($result2)) {

   //             $user_name = $row2['user_name'];
   //             $full_name = $row2['display_name'];
   //             $email = $row2['email'];
   //             $user_role = $row2['user_role'];
   //             $active = $row2['active'];

   //             $_SESSION['user_name'] = $user_name;
   //             $_SESSION['full_name'] = $full_name;
   //             $_SESSION['user_email'] = $email;
   //             $_SESSION['user_role'] = $user_role;
   //             $_SESSION['active'] = $active;
   //          }
   //          echo 1;
   //       } else {
   //          echo "Invalid credientials";
   //       }
   //    }
   // } else {

   //    $email = $_POST["email"];
   //    $password = md5($_POST["password"]);
   //    $query = "Select * FROM users WHERE email = '$email' && password = '$password' && active = '1'";
   //    $result = mysqli_query($connection, $query);
   //    if (mysqli_num_rows($result)) {
   //       while ($row = mysqli_fetch_assoc($result)) {
                
   //       $full_name = $row['display_name'];
   //       $user_name = $row['user_name'];
   //       $email = $row['email'];
   //       $user_role = $row['user_role'];
   //       $active = $row['active'];
          
   //       $_SESSION['full_name'] = $full_name;
   //       $_SESSION['user_name'] = $user_name;
   //       $_SESSION['user_email'] = $email;
   //       $_SESSION['user_role'] = $user_role;
   //       $_SESSION['active'] = $active;
   //       }
   //       echo 1;
   //    } else {
   //       echo "USERS_DOES_NOT_EXIST";
   //    }
   // }

    if (isset($_POST['getLoginInfo'])) {

        $email = $_POST["email"];
        $password = md5($_POST["password"]);
        $query = "Select * FROM users WHERE email = '$email' && password = '$password'";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                    
                $full_name = $row['display_name'];
                $user_name = $row['user_name'];
                $email = $row['email'];
                $user_role = $row['user_role'];
                $status = $row['status'];
                    
                $_SESSION['full_name'] = $full_name;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_role'] = $user_role;
                $_SESSION['active'] = $status;
                $_SESSION["loggedIn"] = true;
            }
            echo 1;
        } else {
            echo "USERS_DOES_NOT_EXIST";
        }
    }
?>