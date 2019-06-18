<?php

namespace App\SendGrid;

use Twig\Environment;

class SendGrid
{
    /** @var Environment  */
    private $templating;

    public function __construct(Environment $twigEngine)
    {
        $this->templating = $twigEngine;
    }

    /**
     * @param array $data
     * @return bool
     * @throws \SendGrid\Mail\TypeException
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function sendEmail(array $data): bool
    {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom(getenv('EMAIL_FROM'));
        $email->setSubject($data['subject']);
        $email->addTo($data['delivery_address']);
        $email->addContent(
            "text/html",
            $this->templating->render('email/activate_account.html.twig', [
                'activation_link' => $data['activation_link']
            ])
        );

        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));

        try {
            $response = $sendgrid->send($email);
            if ($response->statusCode() === 202) {
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }

        return false;
    }
}
