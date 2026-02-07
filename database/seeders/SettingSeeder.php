<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'name' => 'defaultProfilePicture',
                'value' => 'img\default\default_profile_picture.jpg'
            ],
            // [
            //     'name' => 'defaultThumbnail',
            //     'value' => 'img\default\default_thumbnail.jpg'
            // ]
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        };
    }
}
