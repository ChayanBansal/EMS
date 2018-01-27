<?php
// USES  $email,$name,$send_pass
        // Import PHPMailer classes into the global namespace
        // These must be at the top of your script, not inside a function
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        //Load composer's autoloader
        require 'vendor/autoload.php';
        require_once('class_lib.php');
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            //$mail->SMTPDebug = 1;                                 // Enable verbose debug output	//DELETE THIS
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  					  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'ems.suas.2017@gmail.com';                 // SMTP username
            $mail->Password = 'ems@2017';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            //Recipients
            $mail->setFrom('ems.suas.2017@gmail.com', 'Examination Portal - SUAS Indore');         //CHANGE MAIL ID
            foreach($emails as $email){
                $mail->addAddress($email);     // Add a recipient
            }
            //$mail->addAddress('ellen@example.com');               // Name is optional
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = Mail_text($body);
            $mail->send();
            $alert=new alert();
            $alert->exec("Message sent successfully to all!", "success");
            mysqli_commit($conn);
        } catch (Exception $e) {
            $alert=new alert();
            $alert->exec("Error while sending the mail! Please try again..".$e, "warning");
        }

    function Mail_text($body){
		$mail="";
        $mail.='<html>
        <head>
        <style>
        body
        {
            text-align:center;
        }
        .text{
            color: #000000;
            line-height: 150%;
            margin: 10px;
        font-family: Georgia, Times, "Times New Roman", serif;
        font-size: 16px;
        text-align: left;
        }
        .title{
            font-size: 24px;
            color: #2A458E;
            font-family: "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Geneva, Verdana, sans-serif;
            font-weight: 400;
            line-height: 33px;
        }
        .mcontainer{
            padding: 10px;
            display: flex;
          justify-content: center;
        }
        .mailcontainer{
            font-size: 24px !important;
            width: 610px !important;
            min-height: 70px !important;
            padding: 5px !important;
            text-align: center;
            background: white;
            font-family: "Open Sans", sans-serif;
            align-items: center;
            margin-bottom:30px;
           
        }
        .portal{
            font-size: 18px;
        line-height: 27px;
        color: #555555;;
        border-bottom: 1px solid black;
        margin: 15px;
        }
        #hr{
            color: #1978C8;
            border: 2px solid #1978C8;
            width: 100%;
        }
       
        </style>
        </head>
        <body>
        <div class="mcontainer">
        <div class="mailcontainer">
        <div class="title">Symbiosis University Of Applied Sciences</div>
        <hr id="hr">
        <div class="portal">Message From Super Admin </div>
        <div class="text">
            '.$body.'
            </div>
        </div>
        </body>
        </html>';
		return $mail;
	}

?>