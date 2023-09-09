<?php

namespace App\Database\Seeds;

use App\Models\CountryModel;
use CodeIgniter\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $csvFile = fopen("data/countries.csv", "r");
        // It will automatically read file from /public/data folder.

        $firstline = true;
        while(($data = fgetcsv($csvFile, 2000, ",")) !== FALSE)
        {
            if(!$firstline)
            {
                $object = new CountryModel;
                $object->insert([
                    "sortname" => $data['1'],
                    "name" => $data['2'],
                    "phonecode" => $data['3'],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);

    }
}
