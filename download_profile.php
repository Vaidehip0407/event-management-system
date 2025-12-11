<?php
session_start();
include "config.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['loggedin'] !== true) {
    echo "<script>window.location.href='login.php'</script>";
    exit();
}

$u_id = $_SESSION['user_id'];

// Fetch user data from the database
$sql_user = "SELECT user_name, user_email, user_address FROM user_master WHERE user_id = ?";
$stmt_user = mysqli_prepare($conn, $sql_user);
mysqli_stmt_bind_param($stmt_user, "i", $u_id);
mysqli_stmt_execute($stmt_user);
$result_user = mysqli_stmt_get_result($stmt_user);
$user_data = mysqli_fetch_assoc($result_user);

if (!$user_data) {
    echo "User data not found.";
    exit();
}

$user_name = htmlspecialchars($user_data['user_name'], ENT_QUOTES, 'UTF-8');
$user_email = htmlspecialchars($user_data['user_email'], ENT_QUOTES, 'UTF-8');
$user_address = htmlspecialchars($user_data['user_address'], ENT_QUOTES, 'UTF-8');

// Fetch events participated in
$sql_events = "SELECT e.event_name, e.event_date
               FROM user_event_registration uer
               JOIN event_master e ON uer.event_id = e.event_id
               WHERE uer.user_id = ?";
$stmt_events = mysqli_prepare($conn, $sql_events);
mysqli_stmt_bind_param($stmt_events, "i", $u_id);
mysqli_stmt_execute($stmt_events);
$result_events = mysqli_stmt_get_result($stmt_events);

$events_data = array();
while ($row = mysqli_fetch_assoc($result_events)) {
    $events_data[] = array(
        'event_name' => htmlspecialchars($row['event_name'], ENT_QUOTES, 'UTF-8'),
        'event_date' => htmlspecialchars($row['event_date'], ENT_QUOTES, 'UTF-8')
    );
}

// Fetch payment receipts
$sql_payments = "SELECT p.payment_amount, p.payment_date, p.transaction_id, p.event_name
                FROM payments p
                WHERE p.user_id = ?";
$stmt_payments = mysqli_prepare($conn, $sql_payments);
mysqli_stmt_bind_param($stmt_payments, "i", $u_id);
mysqli_stmt_execute($stmt_payments);
$result_payments = mysqli_stmt_get_result($stmt_payments);

$payments_data = array();
while ($row = mysqli_fetch_assoc($result_payments)) {
    $payments_data[] = array(
        'payment_amount' => htmlspecialchars($row['payment_amount'], ENT_QUOTES, 'UTF-8'),
        'payment_date' => htmlspecialchars($row['payment_date'], ENT_QUOTES, 'UTF-8'),
        'transaction_id' => htmlspecialchars($row['transaction_id'], ENT_QUOTES, 'UTF-8'),
        'event_name' => htmlspecialchars($row['event_name'], ENT_QUOTES, 'UTF-8')
    );
}

// Buffer output to prevent header errors
ob_start();

// Include the TCPDF library
require_once('TCPDF-main/tcpdf.php'); // Adjust path if needed!

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('College Event Management System');
$pdf->SetAuthor('CEMS'); //You may be added your name here or name of company.
$pdf->SetTitle('User Profile Information');
$pdf->SetSubject('User Profile');
$pdf->SetKeywords('profile, user, information, pdf');

// Set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'User Profile', 'College Event Management System', array(0, 64, 255), array(0, 64, 128));
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// Set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// Set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
$pdf->SetFont('dejavusans', '', 12, '', true);

// Add a page
$pdf->AddPage();

// Set some text to print
$txt = "User Profile Information\n\n";
$txt .= "Name: " . $user_name . "\n";
$txt .= "Email: " . $user_email . "\n";
$txt .= "Address: " . $user_address . "\n\n";

$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0); // Output user information

// --- Events Section ---
$pdf->Ln(5); // Add a line break for spacing
$pdf->SetFont('', 'B', 14); // Set bold font for heading
$pdf->Cell(0, 10, 'Events Participated In:', 0, 1, 'L');
$pdf->SetFont('', '', 12); // Reset font

if (count($events_data) > 0) {
    foreach ($events_data as $event) {
        $pdf->Cell(0, 10, "  - " . $event['event_name'] . " (Date: " . $event['event_date'] . ")", 0, 1, 'L');
    }
} else {
    $pdf->Cell(0, 10, "  No events participated in.", 0, 1, 'L');
}

// --- Payment Receipts Section ---
$pdf->Ln(5); // Add a line break for spacing
$pdf->SetFont('', 'B', 14); // Set bold font for heading
$pdf->Cell(0, 10, 'Payment Receipts:', 0, 1, 'L');
$pdf->SetFont('', '', 12); // Reset font

if (count($payments_data) > 0) {
    // Table Header
    $pdf->SetFillColor(230, 230, 230); // Light gray fill color
    $pdf->SetTextColor(0);
    $pdf->SetFont('', 'B', 12);
    $pdf->Cell(60, 7, 'Event', 1, 0, 'C', 1); // width = 60, height = 7
    $pdf->Cell(30, 7, 'Amount', 1, 0, 'C', 1);
    $pdf->Cell(40, 7, 'Date', 1, 0, 'C', 1);
    $pdf->Cell(60, 7, 'Transaction ID', 1, 1, 'C', 1); //End of row

    //Table Data
    $pdf->SetFont('', '', 11);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0);
    foreach ($payments_data as $payment) {
        $pdf->Cell(60, 6, $payment['event_name'], 1, 0, 'L', 1);
        $pdf->Cell(30, 6, '₹' . $payment['payment_amount'], 1, 0, 'C', 1);
        $pdf->Cell(40, 6, $payment['payment_date'], 1, 0, 'C', 1);
        $pdf->Cell(60, 6, $payment['transaction_id'], 1, 1, 'L', 1); //End of row
    }
} else {
    $pdf->Cell(0, 10, "  No payment receipts found.", 0, 1, 'L');
}

// Add a page number
$numPages = $pdf->getNumPages();
for ($i = 1; $i <= $numPages; $i++) {
    $pdf->setPage($i);
    $pdf->Text(10, 287, 'Page ' . $i . '/' . $numPages);
}

// Close and output PDF document
$pdf->Output('user_profile.pdf', 'D'); // 'D' = Force Download

ob_end_flush(); //Send output and turn off buffering
exit();
?>