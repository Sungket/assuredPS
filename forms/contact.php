<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  ini_set('display_errors', 'Off');
	error_reporting(E_ALL);

  $name = $_POST["name"];
  $email = $_POST["email"];
  $subject = $_POST["subject"];
  $message = $_POST["message"];

  //Load Composer's autoloader
  require "../vendor/autoload.php";

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  $mail = new PHPMailer(true);

  try {
    //server settings
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    // $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->Username = "sunj.rhymes";
    $mail->Password = "veaz rkjd sevu ubwk";
    $mail->SMTPOptions = array(
      'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
      )
    );

    //Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress("sunj.rhymes@googlemail.com");
    $mail->addReplyTo($email);

    //Content
    $mail->Subject = $subject;
    $mail->Body = $message;

    //Just need plain text message
    $mail->isHTML(false);

    $mail->send();

    //echo "message sent! Thank you.";
    //echo json_encode(['success' => true, 'message' => 'Message sent successfully.']);
    echo "OK";
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }