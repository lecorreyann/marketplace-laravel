<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // create super admin user
    DB::table('users')->insert([
      'last_name' => env('SUPER_ADMIN_LAST_NAME'),
      'first_name' => env('SUPER_ADMIN_FIRST_NAME'),
      'email' => env('SUPER_ADMIN_EMAIL'),
      'password' => Hash::make(env('SUPER_ADMIN_PASSWORD')),
      'created_at' => now(),
    ]);
  }
}
