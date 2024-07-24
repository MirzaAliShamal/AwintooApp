<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'site_title' => 'Website',
            'email_from' => 'website@example.com',
            'copyright_text' => 'Copyright © 2024. All Rights Reserved.'
        ];
        DB::table('general_settings')->insert($data);
    }
}
