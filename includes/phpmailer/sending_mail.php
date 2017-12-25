<?php
// USES  $email,$name,$send_pass
        // Import PHPMailer classes into the global namespace
        // These must be at the top of your script, not inside a function
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        //Load composer's autoloader
        require 'vendor/autoload.php';
        require_once('../class_lib.php');
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
            $mail->addAddress($email, $name);     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Operator Registration Confirmation';
            $mail->Body    = Mail_text($email,$send_pass,$name);
            $mail->AltBody = strip_tags(Mail_text($email,$send_pass,$name));
            $mail->send();
            $alert=new alert();
            $alert->exec("New operator created and a mail containing the login details has been sent!", "success");
        } catch (Exception $e) {
            $alert=new alert();
            $alert->exec("Unable to send e-mail to operator!", "warning");
        }

    function Mail_text($email,$password,$name){
		$mail="";
		//require("frontend_lib.php");
        $mail.=`
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
        <!--[if gte mso 9]><xml>
         <o:OfficeDocumentSettings>
          <o:AllowPNG/>
          <o:PixelsPerInch>96</o:PixelsPerInch>
         </o:OfficeDocumentSettings>
        </xml><![endif]-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width">
        <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
        <title></title>
        <!--[if !mso]><!-- -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
        <!--<![endif]-->
        
        <style type="text/css" id="media-query">
          body {
      margin: 0;
      padding: 0; }
    
    table, tr, td {
      vertical-align: top;
      border-collapse: collapse; }
    
    .ie-browser table, .mso-container table {
      table-layout: fixed; }
    
    * {
      line-height: inherit; }
    
    a[x-apple-data-detectors=true] {
      color: inherit !important;
      text-decoration: none !important; }
    
    [owa] .img-container div, [owa] .img-container button {
      display: block !important; }
    
    [owa] .fullwidth button {
      width: 100% !important; }
    
    [owa] .block-grid .col {
      display: table-cell;
      float: none !important;
      vertical-align: top; }
    
    .ie-browser .num12, .ie-browser .block-grid, [owa] .num12, [owa] .block-grid {
      width: 610px !important; }
    
    .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
      line-height: 100%; }
    
    .ie-browser .mixed-two-up .num4, [owa] .mixed-two-up .num4 {
      width: 200px !important; }
    
    .ie-browser .mixed-two-up .num8, [owa] .mixed-two-up .num8 {
      width: 400px !important; }
    
    .ie-browser .block-grid.two-up .col, [owa] .block-grid.two-up .col {
      width: 305px !important; }
    
    .ie-browser .block-grid.three-up .col, [owa] .block-grid.three-up .col {
      width: 203px !important; }
    
    .ie-browser .block-grid.four-up .col, [owa] .block-grid.four-up .col {
      width: 152px !important; }
    
    .ie-browser .block-grid.five-up .col, [owa] .block-grid.five-up .col {
      width: 122px !important; }
    
    .ie-browser .block-grid.six-up .col, [owa] .block-grid.six-up .col {
      width: 101px !important; }
    
    .ie-browser .block-grid.seven-up .col, [owa] .block-grid.seven-up .col {
      width: 87px !important; }
    
    .ie-browser .block-grid.eight-up .col, [owa] .block-grid.eight-up .col {
      width: 76px !important; }
    
    .ie-browser .block-grid.nine-up .col, [owa] .block-grid.nine-up .col {
      width: 67px !important; }
    
    .ie-browser .block-grid.ten-up .col, [owa] .block-grid.ten-up .col {
      width: 61px !important; }
    
    .ie-browser .block-grid.eleven-up .col, [owa] .block-grid.eleven-up .col {
      width: 55px !important; }
    
    .ie-browser .block-grid.twelve-up .col, [owa] .block-grid.twelve-up .col {
      width: 50px !important; }
    
    @media only screen and (min-width: 630px) {
      .block-grid {
        width: 610px !important; }
      .block-grid .col {
        vertical-align: top; }
        .block-grid .col.num12 {
          width: 610px !important; }
      .block-grid.mixed-two-up .col.num4 {
        width: 200px !important; }
      .block-grid.mixed-two-up .col.num8 {
        width: 400px !important; }
      .block-grid.two-up .col {
        width: 305px !important; }
      .block-grid.three-up .col {
        width: 203px !important; }
      .block-grid.four-up .col {
        width: 152px !important; }
      .block-grid.five-up .col {
        width: 122px !important; }
      .block-grid.six-up .col {
        width: 101px !important; }
      .block-grid.seven-up .col {
        width: 87px !important; }
      .block-grid.eight-up .col {
        width: 76px !important; }
      .block-grid.nine-up .col {
        width: 67px !important; }
      .block-grid.ten-up .col {
        width: 61px !important; }
      .block-grid.eleven-up .col {
        width: 55px !important; }
      .block-grid.twelve-up .col {
        width: 50px !important; } }
    
    @media (max-width: 630px) {
      .block-grid, .col {
        min-width: 320px !important;
        max-width: 100% !important;
        display: block !important; }
      .block-grid {
        width: calc(100% - 40px) !important; }
      .col {
        width: 100% !important; }
        .col > div {
          margin: 0 auto; }
      img.fullwidth, img.fullwidthOnMobile {
        max-width: 100% !important; }
      .no-stack .col {
        min-width: 0 !important;
        display: table-cell !important; }
      .no-stack.two-up .col {
        width: 50% !important; }
      .no-stack.mixed-two-up .col.num4 {
        width: 33% !important; }
      .no-stack.mixed-two-up .col.num8 {
        width: 66% !important; }
      .no-stack.three-up .col.num4 {
        width: 33% !important; }
      .no-stack.four-up .col.num3 {
        width: 25% !important; } }
    
        </style>
    </head>
    <body class="clean-body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #FFFFFF">
      <style type="text/css" id="media-query-bodytag">
        @media (max-width: 520px) {
          .block-grid {
            min-width: 320px!important;
            max-width: 100%!important;
            width: 100%!important;
            display: block!important;
          }
    
          .col {
            min-width: 320px!important;
            max-width: 100%!important;
            width: 100%!important;
            display: block!important;
          }
    
            .col > div {
              margin: 0 auto;
            }
    
          img.fullwidth {
            max-width: 100%!important;
          }
                img.fullwidthOnMobile {
            max-width: 100%!important;
          }
          .no-stack .col {
                    min-width: 0!important;
                    display: table-cell!important;
                }
                .no-stack.two-up .col {
                    width: 50%!important;
                }
                .no-stack.mixed-two-up .col.num4 {
                    width: 33%!important;
                }
                .no-stack.mixed-two-up .col.num8 {
                    width: 66%!important;
                }
                .no-stack.three-up .col.num4 {
                    width: 33%!important
                }
                .no-stack.four-up .col.num3 {
                    width: 25%!important
                }
        }
      </style>
      <!--[if IE]><div class="ie-browser"><![endif]-->
      <!--[if mso]><div class="mso-container"><![endif]-->
      <table class="nl-container" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #FFFFFF;width: 100%" cellpadding="0" cellspacing="0">
        <tbody>
        <tr style="vertical-align: top">
            <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #FFFFFF;"><![endif]-->
    
        <div style="background-color:#FFFFFF;">
          <div style="Margin: 0 auto;min-width: 320px;max-width: 610px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;" class="block-grid ">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:#FFFFFF;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 610px;"><tr class="layout-full-width" style="background-color:transparent;"><![endif]-->
    
                  <!--[if (mso)|(IE)]><td align="center" width="610" style=" width:610px; padding-right: 5px; padding-left: 5px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                <div class="col num12" style="min-width: 320px;max-width: 610px;display: table-cell;vertical-align: top;">
                  <div style="background-color: transparent; width: 100% !important;">
                  <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 5px; padding-left: 5px;"><!--<![endif]-->
    
                      
                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 15px; padding-left: 15px; padding-top: 15px; padding-bottom: 15px;"><![endif]-->
    <div style="color:#2A458E;line-height:150%;font-family: 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Geneva, Verdana, sans-serif; padding-right: 15px; padding-left: 15px; padding-top: 15px; padding-bottom: 15px;">	
        <div style="font-size:12px;line-height:18px;font-family:'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Geneva, Verdana, sans-serif;color:#2A458E;text-align:left;"><p style="margin: 0;font-size: 14px;line-height: 21px;text-align: center"><span style="font-size: 22px; line-height: 33px;">﻿Symbioisis University of Applied Sciences</span></p></div>	
    </div>
    <!--[if mso]></td></tr></table><![endif]-->
    
                      
                      
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="divider" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
        <tbody>
            <tr style="vertical-align: top">
                <td class="divider_inner" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bottom: 5px;min-width: 100%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                    <table class="divider_content" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 3px solid #0068A5;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                        <tbody>
                            <tr style="vertical-align: top">
                                <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                    <span></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
                      
                      
                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 5px; padding-left: 5px; padding-top: 5px; padding-bottom: 5px;"><![endif]-->
    <div style="color:#555555;line-height:150%;font-family:'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; padding-right: 5px; padding-left: 5px; padding-top: 5px; padding-bottom: 5px;">	
        <div style="font-size:12px;line-height:18px;font-family:'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;color:#555555;text-align:left;"><p style="margin: 0;font-size: 14px;line-height: 21px;text-align: center"><span style="text-decoration: underline; font-size: 14px; line-height: 21px;"><span style="font-size: 18px; line-height: 27px;">Examination Portal Registration</span></span></p></div>	
    </div>
    <!--[if mso]></td></tr></table><![endif]-->
    
                      
                      
                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;"><![endif]-->
    <div style="color:#000000;line-height:150%;font-family:Georgia, Times, 'Times New Roman', serif; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">	
        <div style="font-size:12px;line-height:18px;font-family:Georgia, Times, 'Times New Roman', serif;color:#000000;text-align:left;"><p style="margin: 0;font-size: 14px;line-height: 21px"><span style="font-size: 16px; line-height: 24px;">Congratulations `.$name.`,</span></p><p style="margin: 0;font-size: 14px;line-height: 21px"><span style="font-size: 16px; line-height: 24px;">&#160;You have been registered with the SUAS, Indore Examination Portal as an operator. Please use the following details to log into the portal:</span></p></div>	
    </div>
    <!--[if mso]></td></tr></table><![endif]-->
    
                      
                      
                        <div style="font-size: 16px;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif; text-align: center;"><style>
      .details{
            margin: 10px;
            padding: 10px;
            border: 2px dashed black;
            font-weight:bolder;
            font-family: 'Open Sans', sans-serif;
            text-decoration:none;
            font-size: 16px;
        }
    </style>
    <div class="details">
                Username: `.
                $email.`<br> 
                Password: `.$password.` 
                </div>  </div>
    
                      
                      
                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;"><![endif]-->
    <div style="color:#555555;line-height:120%;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">	
        <div style="line-height:14px;font-size:12px;color:#555555;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;text-align:left;"><p style="margin: 0;font-size: 14px;line-height: 17px"><span style="font-size: 14px; line-height: 16px;"><span style="font-size: 16px; line-height: 19px;"><strong>NOTE:&#160;</strong></span></span></p><ol><li style="font-size: 12px; line-height: 16px; text-align: left;"><span style="font-size: 16px; line-height: 19px; background-color: rgb(255, 255, 255);">Please change your password as soon as you log into the portal for maximum security.</span></li><li style="line-height: 16px; text-align: left;"><span style="font-size: 16px; line-height: 19px; background-color: rgb(255, 255, 255);">Keep these details private, do not share these details with anyone.</span></li><li style="line-height: 16px; text-align: left;"><span style="font-size: 16px; line-height: 19px; background-color: rgb(255, 255, 255);">This is an auto-generated e-mail, please do not reply to it.</span></li></ol></div>	
    </div>
    <!--[if mso]></td></tr></table><![endif]-->
    
                      
                  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                  </div>
                </div>
              <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>   <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
            </td>
      </tr>
      </tbody>
      </table>
      <!--[if (mso)|(IE)]></div><![endif]-->
    
    
    </body></html>`;
		return $mail;
	}

?>