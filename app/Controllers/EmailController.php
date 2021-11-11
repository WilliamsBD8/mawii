<?php


namespace App\Controllers;

use Config\Services;

class EmailController extends BaseController
{
    protected $email;

    public function __construct()
    {
        $this->email = Services::email();
    }

    public function send($from, $name, $to, $subject, $message)
    {
        $email = \Config\Services::email();

        $email->setFrom(isset(configInfo()['email']) ? configInfo()['email'] : 'iplanet@iplanetcolombia.com', isset(configInfo()['name_app']) ? configInfo()['name_app'] : 'IPlanet Colombia S.A.S');
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);
        if ($email->send()){
            return true;
        }else{
            return [false, 'error' => $this->email->printDebugger(['headers'])];
        }

    }
}