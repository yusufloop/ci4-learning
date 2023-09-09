<?php

namespace App\Database\Seeds;

use App\Models\CountryModel;
use CodeIgniter\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $json = file_get_contents("data/countries.json");
        $countries = json_decode($json);

        foreach($countries->countries as $key => $value)
        {
            $object = new CountryModel;
            $object->insert([
                "sortname" => $value->sortname,
                "name" => $value->name,
                "phoneCode" => $value->phoneCode,
            ]);
        }
    }
}
