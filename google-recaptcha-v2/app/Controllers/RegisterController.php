<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class RegisterController extends BaseController
{
    public function index()
    {
        return view('register');
    }

    public function googleCaptchaStore()
    {
        // Automatic generated google captcha widget post variable
        $recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));

        //form-data

        $secret = env('RECAPTCHAV2_SECRET');

        $credential = array(
            'secret' => $secret,
            'response' => $recaptchaResponse
        );

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);

        $status = json_decode($response, true);

        $session = session();

        if($status['success'])
        {
            $session->setFlashdata('msg', 'form has been submitted successfully');
        }
        else
        {
            $session->setFlashdata('msg', 'Please verify check the form again');
        }
        return redirect()->to('form');
    }
}
