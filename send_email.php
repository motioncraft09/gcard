<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $subject = isset($_POST['subject']) ? $_POST['subject'] : 'New Guarantee Request';
    $sellerName = isset($_POST['sellerName']) ? $_POST['sellerName'] : '';
    $sellerEmail = isset($_POST['sellerEmail']) ? $_POST['sellerEmail'] : '';
    $buyerName = isset($_POST['buyerName']) ? $_POST['buyerName'] : '';
    $buyerEmail = isset($_POST['buyerEmail']) ? $_POST['buyerEmail'] : '';
    $serviceDescription = isset($_POST['serviceDescription']) ? $_POST['serviceDescription'] : '';
    $budget = isset($_POST['budget']) ? $_POST['budget'] : '';
    $guaranteePeriod = isset($_POST['guaranteePeriod']) ? $_POST['guaranteePeriod'] : '';
    $terms = isset($_POST['terms']) ? $_POST['terms'] : '';
    $fee = isset($_POST['fee']) ? $_POST['fee'] : '';
    $total = isset($_POST['total']) ? $_POST['total'] : '';
    $txId = isset($_POST['txId']) ? $_POST['txId'] : '';
    $senderNumber = isset($_POST['senderNumber']) ? $_POST['senderNumber'] : '';
    $paymentMethod = isset($_POST['paymentMethod']) ? $_POST['paymentMethod'] : '';
    $certificateId = isset($_POST['certificateId']) ? $_POST['certificateId'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';

    // Prepare email content
    $to = 'motioncraft.portal@gmail.com';
    $headers = "From: no-reply@yourdomain.com\r\n";
    $headers .= "Reply-To: $sellerEmail\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $emailContent = "
    <html>
    <head>
        <title>$subject</title>
    </head>
    <body>
        <h2>Universal Guarantee Card - New Request</h2>
        <p><strong>Certificate ID:</strong> $certificateId</p>
        <p><strong>Request Type:</strong> $type</p>
        
        <h3>Seller Information</h3>
        <p><strong>Name:</strong> $sellerName</p>
        <p><strong>Email:</strong> $sellerEmail</p>
        
        <h3>Buyer Information</h3>
        <p><strong>Name:</strong> $buyerName</p>
        <p><strong>Email:</strong> $buyerEmail</p>
        
        <h3>Service Details</h3>
        <p><strong>Description:</strong> $serviceDescription</p>
        <p><strong>Budget:</strong> ৳ $budget</p>
        <p><strong>Guarantee Period:</strong> $guaranteePeriod days</p>
        <p><strong>Terms:</strong> $terms</p>
        
        <h3>Financial Details</h3>
        <p><strong>Service Fee:</strong> ৳ $fee</p>
        <p><strong>Total Amount:</strong> ৳ $total</p>
        
        <h3>Payment Information</h3>
        <p><strong>Transaction ID:</strong> $txId</p>
        <p><strong>Sender Number:</strong> $senderNumber</p>
        <p><strong>Payment Method:</strong> $paymentMethod</p>
        
        <hr>
        <p>This request was submitted on " . date('Y-m-d H:i:s') . "</p>
    </body>
    </html>
    ";

    // Send email
    if (mail($to, $subject, $emailContent, $headers)) {
        // Redirect back to success page
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?success=1');
    } else {
        // Redirect back with error
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?error=1');
    }
    exit;
} else {
    // Not a POST request, redirect to form
    header('Location: index.html');
    exit;
}
?>
