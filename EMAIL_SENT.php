<?php
	require_once("includes/helpers.php");

	// For local items
    $fileName = "./assets/Local_Items_Report/Pending Items Report - (Local).xlsm";
    if (file_exists($fileName)) {

        $to = array(
            "VT-Purchase@venturetronics.com",
        );

        $subject = "Pending Items Report - (Local)";

        // HTML Content
        $htmlContent = "<html>
                <body style='font-size:14px; color:#1C2833;'>
                    <span>Dear Sir,</span>
                    <br>
                    <span>Please find the attached file of</span>
                    <span style='background:yellow;'> <i><b> ''Pending Items Report - (Local)'' </b></i> </span>
                </body>

                <br><br>
                <img src='cid:local_chart'>
            </html>";

        $attachment = array(
            $fileName,
        );

        $cc = array(
            "mirfan@Powersoft19.com",
            "yaqoob.khan@venturetronics.com",
            'tariq.mukhtar@venturetronics.com',
            'zahid.aziz@venturetronics.com',
            'zubair.ahmed@venturetronics.com',
            "junaid.khalil@venturetronics.com",
        );

        // Email Sending Through Function
        $mail = imsSendEmail( $to, $subject, $htmlContent, $attachment, $cc );
         
        // Sending Status 
        echo $mail?"EMAIL_SENT":"EMAIL_SENDING_FAIL";
    }

    
    // For international items
    $fileName = "./assets/Imported_Items_Report/Pending Items Report - (Internatinal).xlsm";
    if (file_exists($fileName)) {

        $to = array(
            "ahsan.rafique@venturetronics.com",
            "naeem.shehzad@venturetronics.com",
            "ahmad.ishtiaq@venturetronics.com",
            'usman.aslam@venturetronics.com',
            'mudassr.hayat@venturetronics.com',
        );

        $subject = "Pending Items Report - (Internatinal)";

        // HTML Content
        $htmlContent = "<html>
                <body style='font-size:14px; color:#1C2833;'>
                    <span>Dear Sir,</span>
                    <br>
                    <span>Please find the attached file of</span>
                    <span style='background:yellow;'> <i><b> ''Pending Items Report - (Internatinal)'' </b></i> </span>
                </body>

                <br><br>
                <img src='cid:import_chart'>
            </html>";

        $attachment = array(
            $fileName,
        );

        $cc = array(
            "mirfan@Powersoft19.com",
            "yaqoob.khan@venturetronics.com",
            'tariq.mukhtar@venturetronics.com',
            'zahid.aziz@venturetronics.com',
            'zubair.ahmed@venturetronics.com',
            "junaid.khalil@venturetronics.com",
        );

        // Email Sending Through Function
        $mail = imsSendEmail( $to, $subject, $htmlContent, $attachment, $cc );
         
        // Sending Status 
        echo $mail?"EMAIL_SENT":"EMAIL_SENDING_FAIL";
    }


    // For MTT PRFs
    $fileName = "./assets/Due_Payments/Due Payments - MTT US.xlsx";
    if (file_exists($fileName)) {

        $to = array(
            'usman.aslam@venturetronics.com',
            "yaqoob.khan@venturetronics.com",
        );

        $subject = "Due Payments | MTT US";

        // HTML Content
        $htmlContent = "<html>
                <body style='font-size:14px; color:#1C2833;'>
                    <span>Dear Sir,</span>
                    <br>
                    <span>Please find the attached file of</span>
                    <span style='background:yellow;'> <i><b> ''Pending PRFs Report - (MTT)'' </b></i> </span>
                    <span> . </span>
                </body>
            </html>";

        $attachment = array(
            $fileName,
        );

        $cc = array(
            "junaid.khalil@venturetronics.com",
        );

        // Email Sending Through Function
        $mail = imsSendEmail( $to, $subject, $htmlContent, $attachment, $cc );
         
        // Sending Status 
        echo $mail?"EMAIL_SENT":"EMAIL_SENDING_FAIL";
    }

    // Automatic Database Backup at Daily Basis
    include ('Auto_DB_Backup.php');

    echo "<script>window.close();</script>";
?>