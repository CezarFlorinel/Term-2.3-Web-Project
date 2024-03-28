<?php
require __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// Initialize TCPDF
$pdf = new TCPDF();
$pdf->SetCreator('My Application');
$pdf->SetAuthor('John Doe');
$pdf->SetTitle('TCPDF Example');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->AddPage();

// Add HTML content to the PDF
$htmlContent = '
<h1>Welcome to TCPDF!</h1>
<p>This is a basic example of TCPDF library.</p>
<ul>
    <li>Easy to use</li>
    <li>Support for HTML formatting</li>
    <li>Supports images and different fonts</li>
    <p> Mariiiia </p>
</ul>';
$pdf->writeHTML($htmlContent, true, false, true, false, '');

// Save the PDF to a file
$pdfFilePath = __DIR__ . '/example_001.pdf';  // Adjust the path as needed
$pdf->Output($pdfFilePath, 'F');

// Initialize PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings for Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = '2024.festival.haarlem@gmail.com'; // Replace with your Gmail address
    $mail->Password = 'oala evej xqbo ipge'; // Replace with your Gmail password or App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('2024.festival.haarlem@gmail.com', 'Cezar'); // Replace 'Your Name' with your name
    $mail->addAddress('cezar.florinel@yahoo.com', 'Lol'); // Add a recipient

    // Attach the PDF file
    $mail->addAttachment($pdfFilePath, 'ExamplePDF.pdf');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Here is your PDF';
    $mail->Body = 'Hi there, please find attached the PDF.';
    $mail->AltBody = 'Hi there, please find attached the PDF.';


    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $mail->SMTPDebug = 3;

    // Send the email
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// Optional: Delete the PDF file if it's no longer needed
unlink($pdfFilePath);