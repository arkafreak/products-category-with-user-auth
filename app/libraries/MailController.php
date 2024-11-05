<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailController extends Controller
{
    private $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->setupMailer();
    }

    private function setupMailer()
    {
        $this->mailer->isSMTP(); // Set mailer to use SMTP
        $this->mailer->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $this->mailer->SMTPAuth = true; // Enable SMTP authentication
        $this->mailer->Username = 'freak.ghost11@gmail.com'; // Your Gmail address
        $this->mailer->Password = 'vqfg hoix cplr vmjg'; // Use the App Password generated above
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $this->mailer->Port = 587; // TCP port to connect to

        // Optional: Set the sender's email and name
        $this->mailer->setFrom('freak.ghost11@gmail.com', 'Freak Products Pvt Ltd');
    }


    public function sendTransactionEmail($userEmail, $username, $orderId, $totalAmount, $paymentMethod)
    {
        // Prepare the transaction details message
        $transactionDetails = "Dear $username,\n\n" .
            "Thank you for your order! We are pleased to inform you that your payment of Rs. $totalAmount has been processed successfully.\n\n" .
            "Here are the details of your order:\n" .
            "------------------------------------\n" .
            "Order ID: $orderId\n" .
            "Total Amount: Rs. $totalAmount\n" .
            "Status: Completed\n" .
            "Payment Method: $paymentMethod\n\n" .
            "You will receive an email confirmation shortly with more details regarding the shipping of your order.\n\n" .
            "If you have any questions or need further assistance, feel free to contact us at support@freakproducts.com.\n\n" .
            "Thank you for choosing Freak Products!\n\n" .
            "Best Regards,\n" .
            "The Freak Products Team";

        try {
            $this->mailer->addAddress($userEmail);
            $this->mailer->Subject = 'Order Confirmation';
            $this->mailer->Body = $transactionDetails;
            $this->mailer->send();
        } catch (Exception $e) {
            echo "Email could not be sent: {$this->mailer->ErrorInfo}";
        }
    }
}
