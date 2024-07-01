<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if (isset($_POST["send"])) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Corrected the comma to a dot
        $mail->SMTPAuth = true;
        $mail->Username = 'phptravelone@gmail.com';
        $mail->Password = 'qcmffvazinwoufen'; // Use app-specific password if 2FA is enabled
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        //Recipients
        $mail->setFrom('phptravelone@gmail.com', 'Travel One');
        $mail->addAddress($_POST['email']); // Corrected syntax

        // Content
        $mail->isHTML(true);
        $mail->Subject = $_POST['subject'];
        $mail->Body    = $_POST['message'];

        $mail->send();
        echo "
        <script>
        alert('Message sent successfully');
        window.location.href = '../Views/contact.php';
        </script>
        ";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}