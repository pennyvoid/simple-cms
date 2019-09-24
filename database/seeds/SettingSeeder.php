<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'site_name' => "Laravel's Blog",
            'contact_number' => '00-98938-241-1295',
            'contact_email' => 'info@laravel_blog.com',
            'address' => 'Iran-Tehran'
        ]);
    }
}
