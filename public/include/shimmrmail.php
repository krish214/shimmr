<?php

    require "../PHPMailer-master/class.phpmailer.php"; //include phpmailer class
    if(isset($_REQUEST['email'])) {
       

        // Read the form values
        $success = false;
        $successTxt = "";
        $senderName = isset( $_POST['name'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['name'] ) : "";
        $senderEmail = isset( $_POST['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email'] ) : "";
        $subject = isset( $_POST['subject'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['subject'] ) : "";
        $message = isset( $_POST['message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message'] ) : "";

        $template=
        '<html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Shimmr Studio Email Design</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <style>
          
            body{
                font-family: "Titillium Web", sans-serif;
            }
            
            .my-data-table {
                  margin: auto;
                  display: table;
                border-collapse: collapse;
              }
              .my-data-right{
                font-size:14px;
                text-align:left;
                border: 1px solid #1abc9c;
                padding: 10px 55px;
                padding-right:80px;
              }
              .my-data-left{
                font-size:14px;
                border: 1px solid #1abc9c;
                text-align:left;
                padding: 10px 55px;
              }
              a{
                color:#ffffff;
             }
             a:hover{
                 color:#2767b5;
                }
              
            @media (max-width: 768px) {
                .full-width{
                    width:100%;
                }
            }
            </style>
        </head>
        <body style="margin: 0; padding: 0;">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td>
                    <table class="full-width" align="center" cellpadding="0" cellspacing="0" width="600">
                        <tr>
                            <td>
                                <table class="full-width" align="center" cellpadding="0" cellspacing="0" width="600" style="border:1px solid #efefef;">
                                    <tr>
                                        <td align="center">
                                        <a href="http://localhost/shimmr-studios-php/index.php">
                                            <img src="https://pbs.twimg.com/profile_images/745473585964158976/Tt7t_D05_400x400.jpg" alt="Shimmr-Studio" width="200" height="200" style="display: block; padding: 2em;" />
                                            </a>
                                       </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td align="center" style="padding: 20px 0 30px 0; font-size: 14px; font-weight:600;">
                                                    <span style="color:#2767b5;font-size: 16px;">'.$_POST['name'].'</span>
                                                       <span  style="color:#000000 !important;font-size: 14px;font-weight:600;"> Submitted New Enquiry Form...!</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 10px 0 10px 0; font-size: 16px; color: #fa6a00; text-align: center;">
                                                   Contact Details:-
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>
                                                    </td>
                                                </tr>
                                            </table>

                                            
                                            <table class="my-data-table">
  
                                                <tr>
                                                    <td class="my-data-right">Name:</td>
                                                    <td class="my-data-left">'.$senderName.'</td>
                                                </tr>
                                                <tr>
                                                    <td class="my-data-right">Email:</td>
                                                    <td class="my-data-left">'.$senderEmail.'</td>
                                                </tr>
                                                <tr>
                                                     <td class="my-data-right">Subject:</td>
                                                     <td class="my-data-left">'.$subject.'</td>
                                                </tr>
                                                <tr>
                                                     <td class="my-data-right">Message:</td>
                                                     <td class="my-data-left">'.$message.'</td>
                                                </tr>
                                               
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#1abc9c" style="padding: 30px 30px 30px 30px;">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td align="center" width="75%">
                                                    2019 © <a style="text-decoration: none;" href="http://shimmrstudios.com"> Shimmr Studios.  </a> All rights reserved.
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>   
            </tr>     
        </table>
        </body>
        </html>';
        try{

        // Instantiate Class  
        $mail = new PHPMailer();  
                
        // Set up SMTP
        $mail->SMTPDebug = 3;                       // Enable verbose debug output
        
        $mail->IsSMTP();                // Sets up a SMTP connection  
        $mail->CharSet = "utf-8";// set charset to utf8     
        $mail->SMTPSecure = "ssl";      // Connect using a TLS connection                  // Set mailer to use SMTP
        $mail->Host = 'mail.ezveb.com';                          // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;         // Connection with the SMTP does require authorization    
        $mail->Port = 465;  //Gmail SMTP port
        //$mail->Encoding = '7bit';

        // Authentication  
        $mail->Username   = "contact@shimmrstudios.com"; // Your full Gmail address
        $mail->Password   = "Welcome@12"; // Your Gmail password
            
        // Compose
        $mail->SetFrom('contact@shimmrstudios.com','contact@shimmrstudios.com');
        $mail->AddReplyTo('contact@shimmrstudios.com');
        $mail->Subject = "New Contact Form Enquiry";      // Subject (which isn't required)  
        $mail->MsgHTML($template);

        // Send To  
        $mail->AddAddress("contact@shimmrstudios.com"); // Where to send it - Recipient
        $result = $mail->Send();		// Send!  
     
        // unset($mail);
		// 	if(!$mail->send()) {
		// 			$response["Mailer Error"] = $mail->ErrorInfo;
		// 		}
		// 	}catch(Exception $e){
		// 		echo 'Caught exception: ',	$e->getMessage(), "\n";
        // 	}

        
        echo 'Message has been sent';
    }catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
    }else{
    echo 'error';
    }

?>