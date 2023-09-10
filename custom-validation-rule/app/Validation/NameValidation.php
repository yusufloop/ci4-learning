<?php

namespace App\Validation;

class NameValidation
{
    public function valid_name($value, string &$error = null): bool
    {
        $not_allowed_names = ["Anas", "Yusuf", "azri"];

        $value = strtolower($value); //input value into lowercase

        if (in_array($value, $not_allowed_names))
        {
            // If "value" exists in list, name will not be allowed for user.
            $error = "Name is already exist, try other name";
            return false;
        }
        return true;
    }
}
