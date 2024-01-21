<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users_ids = DB::table('users')->insertGetId([
            'name' => Str::random(10),
            'email' => 'test_user@gmail.com',
            'password' => Hash::make('password'),
            'username' => 'username',
            'status' => 'active'
        ]);

        // this could be a factory, maybe I'll refactor it later
        for ($i = 0; $i < 10; $i++) {
            DB::table('main_reports')->insert([
                'student_id' => $users_ids,
                'chapters' => '[1,2,3]',
                'pages' => '[10,11,12]',
                'surah' => '1',
                'reported_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
