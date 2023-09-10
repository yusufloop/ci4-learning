<?php

namespace App\Validation;

class MobileValidation
{
    public function checkMobile($value, string &$error = null): bool
    {
        /*Checking: Number must start from 5-9{Rest Numbers}*/
        if(preg_match('/^[5-9]{1}[0-9]+/', $value))
        {
            if(!preg_match('/^[0-9]{10}+$/', $value))
            {
                $error = "mobile number is not valid";
                return false;
            }
            return true;
        }
        else
        {
            return false;
        }
        
    }
}
