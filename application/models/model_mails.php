<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_mails extends CI_Model {

    public function send($sujet, $mes, $adressMail)
    {
        $config = parse_ini_file("config.ini");
        $mail   = $config['mail'];
        $key = $config['key'];

        require ('application/vendor/autoload.php');


        $subject = $sujet;
        $body = $mes;

        $message = new Swift_Message($subject);
        $message->setFrom($mail);
        $message->setTo(array($adressMail));
        $message->setBody($body, 'text/html');


        $transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 2525);
        $transport->setUsername($mail);
        $transport->setPassword($key);

        $swift = Swift_Mailer::newInstance($transport);


        $swift->send($message, $errors);

    }

}
