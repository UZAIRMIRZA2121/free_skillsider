<?php
namespace App\Services;

use SendGrid;
use SendGrid\Mail\Mail;

class SendGridMailer
{
    protected $sendGrid;

    public function __construct()
    {
        $this->sendGrid = new SendGrid(env('SENDGRID_API_KEY'));
    }

    public function sendMail($to, $subject, $content)
    {
        $email = new Mail();
        $email->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $email->setSubject($subject);
        $email->addTo($to);
        $email->addContent("text/plain", $content);
        $email->addContent("text/html", "<p>$content</p>");

        try {
            $response = $this->sendGrid->send($email);
            return $response->statusCode();
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
