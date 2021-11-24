<?php


namespace Kaadon\ThinkMailer;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ThinkMailer
{
    private $mail;

    private $config = [
        "Host" => 'smtp.example.com',
        "SMTPAuth" => true,
        "Username" => 'user@example.com',
        "Password" => 'secret',
        "SMTPSecure" => PHPMailer::ENCRYPTION_SMTPS,
        "Port" => 465
    ];

    public function __construct($e = false)
    {
        $this->mail = new PHPMailer($e);

        return $this->mail;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config): void
    {
        $this->config = $config;
    }

    /**
     * @param PHPMailer $mail
     */
    public function setMail(PHPMailer $mail): void
    {
        $this->mail->Host = $this->config['Host'];                     //Set the SMTP server to send through
        $this->mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $this->mail->Username = 'user@example.com';                     //SMTP username
        $this->mail->Password = 'secret';                               //SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $this->mail->Port = 465;
        $this->mail = $mail;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function sendMail($SMTPDebug = 0)
    {
        //Create an instance; passing `true` enables exceptions
        try {
            if ($SMTPDebug) {
                $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            }
            $mail->isSMTP();                                            //Send using SMTP
                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
            $mail->addAddress('ellen@example.com');               //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');

            //Attachments
            $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}