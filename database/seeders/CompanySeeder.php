<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class CompanySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Define company size options as per your form
        $companySizes = ['1-10', '11-50', '51-200', '201-500', '501-1000', '1001+'];

        foreach (range(1, 100) as $index) {
            DB::table('companies')->insert([
                'c_name'            => $faker->company,
                'c_email'           => $faker->unique()->companyEmail,
                'c_password'        => Hash::make('password123'), // Default password
                'c_industry'        => $faker->word,
                'c_size'            => $faker->randomElement($companySizes),
                'c_established_year'=> $faker->year,
                'c_type'            => $faker->randomElement(['Private', 'Public', 'Government']),
                'c_city'            => $faker->city,
                'c_country'         => $faker->country,
                'c_postal_code'     => $faker->postcode,
                'c_website'         => $faker->url,
                'c_address'         => $faker->address,
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}
