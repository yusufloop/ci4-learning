<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UserEntity extends Entity
{
    //i want to use different column names in database and in my application
    protected $datamap = [
        "fullname" => "name",
        "emailAddress" => "email",
        "phoneNumber" => "phone_no",
    ];
    protected $dates   = [
        'created_at', 
        'updated_at', 
        'deleted_at'];
    protected $casts   = [];

    // -----------------------------------------------------------------------
    #mutators
    // encrypting password and re-assign to password field
    function setPassword(string $password)
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_BCRYPT);
        return $this;
    }
// -----------------------------------------------------------------------
#Accessors
    // Before making any accessor in entity, keep in mind these things    
    // We need to use get keyword in front of method name. Then we need to include the method name as column name. In getEmail(), email is the column name of table.
    // After changing or doing anything with the value, next we need to return that value.
    public function getEmail()
    {
        // accessor which changes the case of email address, means in upper case
        return strtoupper($this->attributes['email']);
    }

    public function getName()
    {
        // accessor which replaces space with _ in name value
        return str_replace(" ", "_", $this->attributes['name']);
    }

    // -----------------------------------------------------------------------
    #virtual properties
    // full_data is the virtual property, we can use inside application
    // This method is printing the combine value for name and email
    public function full_data()
    {
        return $this->attributes['name'] . " ". $this->attributes['email'];
    }
}
