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
                'name' => 'defaultProfilePictureDir',
                'value' => 'img/default/'
            ],
            [
                'name' => 'defaultProfilePictureImg',
                'value' => 'default_profile_picture.jpg'
            ],
            [
                'name' => 'defaultThumbnailDir',
                'value' => 'img/default/thumbnail/'
            ],
            [
                'name' => 'defaultThumbnailExt',
                'value' => '.jpg'
            ],
            [
                'name' => 'profilePictureFolder',
                'value' => 'profile_pictures'
            ],
            [
                'name' => 'thumbnailFolder',
                'value' => 'post_thumbnail'
            ],
            [
                'name' => 'userSeederCount',
                'value' => '300'
            ],
            [
                'name' => 'postSeederCount',
                'value' => '3000'
            ],
            [
                'name' => 'commentSeederCount',
                'value' => '7000'
            ],
            [
                'name' => 'messageSeederCount',
                'value' => '10000'
            ],
            [
                'name' => 'notificationSeederCount',
                'value' => '8000'
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        };
    }
}
