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
        try {
            $this->mailer->isSMTP();
            $this->mailer->Host = 'smtp.gmail.com'; // Gmail SMTP server
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = 'freak.ghost11@gmail.com'; // Your email
            $this->mailer->Password = 'your-email-password'; // App-specific password
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port = 587;
            $this->mailer->setFrom('freak.ghost11@gmail.com', 'Your Store Name');
        } catch (Exception $e) {
            echo "Mailer setup failed: {$e->getMessage()}"; // Debugging output
        }
    }

    public function sendTransactionEmail($userEmail, $transactionDetails)
    {echo "  $userEmail, $transactionDetails  ";
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
