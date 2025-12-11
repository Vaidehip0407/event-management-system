<?php
session_start();
include "config.php";
include "functions.php";
require_once('vendor/stripe/stripe-php/init.php'); // Include Stripe PHP library
require 'vendor/autoload.php';  // Include the BaconQrCode autoloader

use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

// Get payment request ID
$payment_request_id = sanitize($_GET['payment_id']);

// Fetch payment request from database
$sql_select = "SELECT amount, event_name, user_id, event_id FROM payment_requests WHERE payment_request_id = ?";
$stmt = mysqli_prepare($conn, $sql_select);
mysqli_stmt_bind_param($stmt, "s", $payment_request_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$payment_request = mysqli_fetch_assoc($result);

if (!$payment_request) {
    echo "Invalid payment request.";
    exit;
}

$amount = $payment_request['amount']; // Amount
$event_name = $payment_request['event_name'];
$user_id = $payment_request['user_id']; // Get User ID
$event_id = $payment_request['event_id']; // Get Event ID

// Construct payment link
$payment_link = "https://yourwebsite.com/complete_payment.php?payment_request_id=" . urlencode($payment_request_id);  // Link for QR code

// Generate QR code using BaconQrCode
$renderer = new ImageRenderer(
    new RendererStyle(400),
    new Png()
);
$writer = new Writer($renderer);
$qrCode = $writer->writeFile($payment_link);  // Returns raw PNG data

// Save the QR code image to a file (you might want a separate directory)
$qrCodeFilename = 'qrcodes/' . $payment_request_id . '.png';
file_put_contents($qrCodeFilename, $qrCode);

// Update the database with the QR code filename
$sql_update = "UPDATE payment_requests SET qr_code_url = ? WHERE payment_request_id = ?";
$stmt = mysqli_prepare($conn, $sql_update);
mysqli_stmt_bind_param($stmt, "ss", $qrCodeFilename, $payment_request_id);
mysqli_stmt_execute($stmt);

// Stripe API key
\Stripe\Stripe::setApiKey('YOUR_STRIPE_SECRET_KEY'); // Replace with your secret key

try {
    $intent = \Stripe\PaymentIntent::create([
        'amount' => $amount * 100, // Stripe expects amount in cents
        'currency' => 'usd',
        'metadata' => [
            'payment_request_id' => $payment_request_id, // Associate payment intent with your system
            'event_name' => $event_name,
          ],
    ]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Processing Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
      .qr-code-container{
        margin: 20px auto;
        display:flex;
        justify-content: center;
      }
    </style>
</head>

<body>
   <div class="qr-code-container">
     <img src="<?php echo htmlspecialchars($qrCodeFilename); ?>" alt="QR Code" />
    </div>
    <script>
        const stripe = Stripe('YOUR_STRIPE_PUBLISHABLE_KEY'); // Replace with your publishable key

        stripe.confirmCardPayment("<?php echo $intent->client_secret ?>", {
            payment_method: {
                card: stripe.elements().create('card')
            }
        }).then(function (result) {
            if (result.error) {
                // Inform the customer that there was an error.
                alert(result.error.message);
            } else {
                // The payment has been processed!
                if (result.paymentIntent.status === 'succeeded') {
                    // Call the function to update the payments table.
                    updatePaymentsTable(<?php echo json_encode(array(
                        'payment_request_id' => $payment_request_id,
                        'user_id' => $user_id,
                        'event_id' => $event_id,
                        'amount' => $amount,
                        'event_name' => $event_name
                    )); ?>);

                     // Update the payment requests table
                    window.location.href = "payment_success.php?payment_request_id=<?php echo urlencode($payment_request_id) ?>";
                }
            }
        });

       async function updatePaymentsTable(paymentData) {
        const response = await fetch('update_payment_data.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(paymentData)
        });

        if (!response.ok) {
           // Handle error if necessary
           console.error('Failed to update payment data.');
        }
    }
    </script>
</body>

</html>