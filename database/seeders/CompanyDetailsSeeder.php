<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CompanyDetailsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get all company IDs (assuming you already inserted 100 companies)
        $companyIds = DB::table('companies')->pluck('id');

        foreach ($companyIds as $companyId) {
            DB::table('company_details')->insert([
                'company_id'    => $companyId,
                'profile_img'   => 'uploads/company_profile/' . $faker->image('public/uploads/company_profile', 400, 400, null, false), // Generates a fake image
                'cover_img'     => 'uploads/company_cover/' . $faker->image('public/uploads/company_cover', 1200, 400, null, false), // Generates a fake cover image
                'market_type'   => $faker->randomElement(['B2B', 'B2C', 'Both']),
                'about'         => $faker->paragraph(3),
                'contact_email' => $faker->unique()->companyEmail,
                'phone'         => $faker->phoneNumber,
                'follower'      => $faker->numberBetween(100, 10000),
                'facebook'      => 'https://facebook.com/' . $faker->userName,
                'twitter'       => 'https://twitter.com/' . $faker->userName,
                'linkedin'      => 'https://linkedin.com/in/' . $faker->userName,
                'instagram'     => 'https://instagram.com/' . $faker->userName,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
