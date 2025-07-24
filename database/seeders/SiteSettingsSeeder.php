<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            'name' => config('app.name', 'Igakerta Bookstore'),
            'currency' => '£',
            'default_language' => 'en',
            'address' => 'Petukangan Utara Pesanggrahan Jakarta Selatan DKI Jakarta 12260',
            'country' => 'Indonesia',
            'email' => 'info@igakerta.com',
        ];

        foreach ($settings as $setting => $value) {
            SiteSetting::create([
                "name" => $setting,
                "value" => $value,
            ]);
        }
    }
}