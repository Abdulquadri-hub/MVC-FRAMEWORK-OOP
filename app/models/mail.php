<?php 

defined('ROOTPATH') or exit("Access Denied");

/**
 * undocumented class
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail {
    
    public function send_email(mixed $recipient, mixed $subject, mixed $message) {

        require ROOT_PATH.'/vendor/autoload.php';

        $mail = new PHPMailer(true);

    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'abdulquadri.aq@gmail.com';                     //SMTP username
    $mail->Password   = 'tqpozbzmuamcvzwt';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    //Recipients
    $mail->setFrom('abdulquadri.aq@gmail.com', 'my_website');
    $mail->addAddress($recipient, 'Pretigious customer');     //Add a recipient


    //$mail->addAttachment('url', 'filename');    // Name is optional

    $mail->isHTML(true);                                  
    $mail->Subject = $subject;
    $mail->Body    = $message;
    //$mail->AltBody = $message;

    if(!$mail->send()){
        return false;
        // echo "Error sending mail";
    }else{
        return true;
        //echo '<center style = "margin: 5px;"> Message has been sent </center>';
    }

    }
}
