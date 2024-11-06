<?php
// Include Stripe's PHP library
require_once('vendor/autoload.php');

// Initialize Stripe with your secret key
\Stripe\Stripe::setApiKey('sk_test_51QI0l6EJzWqJA7RbuAFhVBJVZxuUbpcDx1sOV1hghi9ZDqowgF9XAQOLZjSn4nxWxJTnrCfipAuqq9bOyIxulK5E00AJMCkR4f');

// Get data from the POST request
$inputData = json_decode(file_get_contents('php://input'), true);
$paymentToken = $inputData['paymentToken'];
$orderId = $inputData['orderId'];
$totalAmount = $inputData['totalAmount'];

// Create a payment intent
try {
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $totalAmount,  // Amount is in cents
        'currency' => 'inr',
        'payment_method' => $paymentToken,
        'confirmation_method' => 'manual',
        'confirm' => true,
    ]);

    // Respond with success
    echo json_encode([
        'status' => 'success',
    ]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    // If there's an error, respond with the error message
    echo json_encode([
        'status' => 'failure',
        'error' => $e->getMessage(),
    ]);
}
?>
