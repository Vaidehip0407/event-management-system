<?php
session_start();
include "config.php";

// Include PHPMailer Autoload (adjust path if needed based on your project structure)
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Check if the user is logged in as an admin (optional, but good practice)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "Access Denied."; // Or redirect
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_id = $_POST['payment_id'];
    $payment_completion_status = $_POST['payment_completion_status'];

    // Validate input (optional, but recommended)
    if (empty($payment_id) || !in_array($payment_completion_status, ['Pending', 'Complete'])) {
        echo "Invalid input."; // Or handle error appropriately
        exit();
    }

    // Update the payment status in the database
    $sql_update = "UPDATE payments SET payment_completion_status = ? WHERE payment_id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("si", $payment_completion_status, $payment_id);

    if ($stmt_update->execute()) {
        $email_status = 'not_sent'; // Default status
        // If status updated to 'Complete', send email
        if ($payment_completion_status == 'Complete') {
            $email_status = sendPaymentCompletionEmail($conn, $payment_id); // Call email function and get status
        }
        $redirect_url = "view_payments.php?update_status=success&email_status=" . $email_status; // Add email_status to URL
        echo "<script>alert('Payment status updated successfully.'); window.location.href='" . $redirect_url . "';</script>"; // Success message and redirect
    } else {
        $redirect_url = "view_payments.php?update_status=error&db_error=" . urlencode($stmt_update->error); // Pass DB error
        echo "<script>alert('Error updating payment status.'); window.location.href='" . $redirect_url . "';</script>"; // Error message and redirect
    }
    $stmt_update->close();
} else {
    echo "Invalid request."; // Access directly without POST
}
$conn->close();


function sendPaymentCompletionEmail($conn, $payment_id) {
    // Fetch payment details and user email
    $sql_email_data = "SELECT p.user_email, p.event_name
                         FROM payments p
                         WHERE p.payment_id = ?";
    $stmt_email_data = $conn->prepare($sql_email_data);
    $stmt_email_data->bind_param("i", $payment_id);
    $stmt_email_data->execute();
    $result_email_data = $stmt_email_data->get_result();
    $payment_data = $result_email_data->fetch_assoc();
    $stmt_email_data->close();

    if ($payment_data) {
        $to = $payment_data['user_email'];
        $event_name = $payment_data['event_name'];
        $subject = "Payment Confirmation for Event: " . $event_name;
        $message_body = "Dear User,\n\n";
        $message_body .= "Your payment for the event '" . $event_name . "' has been successfully completed and confirmed.\n\n";
        $message_body .= "Thank you for your registration!\n\n";
        $message_body .= "Sincerely,\nThe Event Team";

        $mail = new PHPMailer(true); // true enables exceptions

        try {
            //Server settings (adjust these for your SMTP server)
            // $mail->SMTPDebug = SMTP::DEBUGOFF;                      //Enable verbose debug output (SMTP::DEBUGSERVER for more details)
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through (replace with your SMTP server)
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'vaidehipanchal3@gmail.com';                     //SMTP username (replace with your SMTP username)
            $mail->Password   = 'ymjm pdud ruog jqsf';                               //SMTP password (replace with your SMTP password)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged for port 465
            $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS`

            //Recipients
            $mail->setFrom('vaidehipanchal3@gmail.com', 'Event Management System'); //Set sender email and name (replace with your "From" email and name)
            $mail->addAddress($to, $payment_data['user_email']);     //Add a recipient (email and name - name is optional)
            // $mail->addReplyTo('info@example.com', 'Information'); // Add reply-to address if needed
            // $mail->addCC('cc@example.com');                       // Add CC if needed
            // $mail->addBCC('bcc@example.com');                      // Add BCC if needed

            //Attachments (optional)
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(false);                                  //Set email format to HTML (set to false for plain text)
            $mail->Subject = $subject;
            $mail->Body    = $message_body;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; //Optional plain text body

            $mail->send();
            return 'sent'; // Email sent successfully
        } catch (Exception $e) {
            return 'failed'; // Email sending failed
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; // For debugging, you can uncomment this line to see the PHPMailer error
        }
    } else {
        return 'email_data_error'; // Error fetching email data
    }
}
?>