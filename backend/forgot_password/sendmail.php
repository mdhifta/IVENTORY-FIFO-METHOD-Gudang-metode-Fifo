<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include '../../database/config.php';

$email = $_POST["email"];

$query_user = $mysqli->query("SELECT * FROM tb_employees WHERE email='$email'");
$user_true = $query_user->num_rows;

$query_admin = $mysqli->query("SELECT * FROM tb_admin WHERE email='$email'");
$admin_true = $query_admin->num_rows;

if ($user_true != 0 || $admin_true != 0) {

  if ($user_true != 0) {
    $obj = $query_user->fetch_object();
  } else {
    $obj = $query_admin->fetch_object();
  }
  // Load Composer's autoloader
  require 'vendor/autoload.php';

  // Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
    //Server settings
    $mail->SMTPDebug = 2;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = "your_mail";                     // SMTP username
    $mail->Password   = "your_password";                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('your_mail', 'Admin');
    $mail->addAddress($obj->email);     // Add a recipient
    // $mail->addAddress($obj->email;,);               // Name is optional
    $mail->addReplyTo('your_mail', 'Information');

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Verify Mail';
    if ($admin_true == 1) {
      $mail->Body    = 'Click/copy the following link to change the password: <a href="localhost/FIFO/password/admin-password.php?id=' . $obj->id . '">Click Here</a>';
    } else {
      $mail->Body    = 'Click/copy the following link to change the password : <a href="localhost/FIFO/password/employees-password.php?id=' . $obj->id . '">Click Here</a>';
    }
    $mail->AltBody = '';

    $mail->send();
    echo 'Message has been sent';
    header("location:../../alertemail.php");
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}
