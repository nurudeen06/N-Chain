<?php 

include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
	
function text_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function sendMail($email, $name, $subject, $body){
	global $sitemail, $sitename;
	
	require_once "../PHPMailer/PHPMailer.php";
    require_once '../PHPMailer/Exception.php';

    $mail = new PHPMailer;
    $mail->setFrom($sitemail);
    $mail->FromName = $sitename;
    $mail->addAddress("$email", "$name");
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = '<!DOCTYPE html>
            <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
            <head>
                <meta charset="utf-8"> <!-- utf-8 works for most cases -->
                <meta name="viewport" content="width=device-width"> 
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="x-apple-disable-message-reformatting"> 
                <title>Mail Notification</title>
                <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">
                <link rel="stylesheet" type="text/css" href="mail.css">
            </head>
            <body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
                <center style="width: 100%; background-color: #f1f1f1;">
                <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
                  &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
                </div>
                <div style="max-width: 600px; margin: 0 auto;" class="email-container">
                    <!-- BEGIN BODY -->
                  <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                      <tr>
                      <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                          <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                              <tr>
                                  <td class="logo" style="text-align: center;">
                                    <h1><a href="#"><img src="pentax.jpg" style="height: 150px; width: 100%;"></a></h1>
                                </td>
                              </tr>
                          </table>
                      </td>
                      </tr><!-- end tr -->
                            <tr>
                      <td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                            
                            <tr>
                                <p style="margin: 14px;">'.$body.'</p>
                            </tr>
                            
                        </table>
                      </td>
                      </tr><!-- end tr -->
                          <!-- 1 Column Text + Button : END -->
                      </table>
                  <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                      
                  </table>
            
                </div>
              </center>
            </body>
            </html>';
    $send = $mail->send();
    return $send;
}


function customAlert($case, $content){
    switch ($case) {
      case 'success':
        $mesg =  '<script type="text/javascript">
          $(document).ready(function() {
              swal({
                  title: "Success",
                  text: " '.$content.' ",
                  icon: "success",
                  button: "Ok",
                  timer: 5000
              });    
          });
        </script>';
        break;

        case 'error':
          $mesg = '<script type="text/javascript">
              $(document).ready(function() {
                  swal({
                      title: "Error",
                      text: " '.$content.' ",
                      icon: "error",
                      button: "Ok",
                      timer: 5000
                  });    
              });
          </script>';
        break;
      default:
        break;
    }
	return $mesg;
}

function pageRedirect($sec, $route){
  $c = "<meta http-equiv='refresh' Content='".$sec."; url=".$route." ' />";
  return $c;
}


?>