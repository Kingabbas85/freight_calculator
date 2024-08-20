<?php
     include_once('database/database.php');
     include_once('includes/session.php');
 
     if( isset($_POST["resetPassword"]) ) {
 
             $username = $_POST["username"];
             $password = md5($_POST["password"]);
             $confirm_password = $_POST["confirm_password"];
             if($_POST["password"] == $confirm_password)
             {
                $query = "Update users SET password = '$password' WHERE user_name = '$username' ";
                 $result = mysqli_query($connection, $query);
                 if ($result) {
                     echo 1;
                 } else {
                     echo "ERROR";
                 }
             }else {
                 echo "ERROR";
             }
 
     }
     
    //  if( isset($_POST["forgotPasswordByEmail"]) ) {
 
    //      $email = $_POST["reset_email"];
    //      $query  = "SELECT * FROM users WHERE email = '$email'";
    //      $result = mysqli_query($connection, $query);
 
    //      if (mysqli_num_rows($result) > 0 ) {
 
    //          $current_url = $_SERVER['REQUEST_URI'];
    //          $token = md5($email);
    //          $expiry_time = mktime(date("H", time()+3600), date("i"), date("s"), date("m"), date("d"), date("Y"));
    //          $expiry_date = date("Y-m-d H:i:s", $expiry_time);
    //          // echo "<pre>";
    //          // print_r($expiry_date);
    //          // echo "<br>";
    //          // echo   date('Y-m-d H:i:s');
    //          // die();
    //          $query = mysqli_query($connection, "UPDATE users SET  reset_link_token='" . $token . "', exp_date='" . $expiry_date . "' WHERE email='" . $email . "'");
    //          $link = "<a href='$Domain/ForgotPassword.php?email=$email&token=$token'>Click To Reset Password</a>";
 
 
 
    //          //Email send code
    //          $to = array($email);
    //          $subject = 'Reset Password';
 
    //          // HTML Content
    //          $htmlContent = "<html>
    //                      <body style='font-size:15px; color:#1C2833;'>
    //                          <div>
    //                              <span style='background:yellow;'> <b> ''".$link."'' </b> </span>
    //                              <br>
    //                              <span style='font-size:14px;'> Click On This Link to Reset Password </span>
    //                          </div>
    //                      </body>
    //                  </html>";
 
    //          $attachment = array();
    //          $cc = array();
 
    //          // Email Sending Through Function
    //          $mail = gtlSendEmail( $to, $subject, $htmlContent, $attachment, $cc );
             
    //          // Sending Status 
    //          echo $mail?"EMAIL_SENT":"EMAIL_SENDING_FAIL";
    //      }
    //      else {
    //          echo "USERS_DOES_NOT_EXIST";
    //      }
    //  }
 ?>