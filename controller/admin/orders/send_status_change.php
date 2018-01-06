<?php
//Include Error Handler
require_once '../../../utility/error_handler.php';

//Include Admin/Mod check
require_once '../../../utility/admin_mod_session.php';

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require '../../../vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'magbuycenter@gmail.com';                 // SMTP username
    $mail->Password = 'starwars123';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );                                   // TCP port to connect to

    //Recipients
    $mail->setFrom('magbuy@outlook.com', 'MagBuy');
    $mail->addAddress($userEmail, 'User');     // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'MagBay Order Status!';
    $mail->Body    = "Your order with ID : <b> $orderId <b/> <b>" . $status . '<b/>';

    $mail->send();

} catch (PDOException $e) {
    $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
    error_log($message, 3, '../../errors.log');
    header("Location: ../../view/error/error_500.php");
    die();
}