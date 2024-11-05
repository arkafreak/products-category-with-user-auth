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
        // Prepare the transaction details message with external image links
        $transactionDetails = "<p>Dear $username,</p>" .
            "<p>Thank you for your order! We are pleased to inform you that your payment of Rs. $totalAmount has been processed successfully.</p>" .
            "<p>Here are the details of your order:</p>" .
            "<hr>" .
            "<p><strong>Order ID:</strong> $orderId<br>" .
            "<strong>Total Amount:</strong> Rs. $totalAmount<br>" .
            "<strong>Status:</strong> Completed<br>" .
            "<strong>Payment Method:</strong> $paymentMethod</p>" .
            "<p>You will receive an email confirmation shortly with more details regarding the shipping of your order.</p>" .
            "<p>If you have any questions or need further assistance, feel free to contact us at <a href='mailto:support@freakproducts.com'>support@freakproducts.com</a>.</p>" .
            "<p>Thank you for choosing Freak Products!</p>" .
            "<p>Best Regards,<br><strong>The Freak Products Team</p>" .

            // Add the PayPal Logo HTML after the payment method
            '<table border="0" cellpadding="10" cellspacing="0">' .
            '<tr><td></td></tr>' .
            '<tr><td>' .
            '<a href="https://www.paypal.com/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open(\'https://www.paypal.com/webapps/mpp/paypal-popup\',\'WIPaypal\',\'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700\'); return false;">' .
            '<img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" border="0" alt="PayPal Acceptance Mark">' .
            '</a>' .
            '</td></tr>' .
            '</table>';

        try {
            $this->mailer->addAddress($userEmail);
            $this->mailer->Subject = 'Order Confirmation';

            // Set the email format to HTML
            $this->mailer->isHTML(true);

            // Set the body of the email
            $this->mailer->Body = $transactionDetails;

            $this->mailer->send();
        } catch (Exception $e) {
            echo "Email could not be sent: {$this->mailer->ErrorInfo}";
        }
    }
}
