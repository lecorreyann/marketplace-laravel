<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TokenSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // get super admin user
    $super_admin = DB::table('users')->where('email', env('SUPER_ADMIN_EMAIL'))->first();
    // create email_verification_token for super admin and set revoked_at to now()
    if ($super_admin) {
      DB::table('tokens')->insert([
        'type' => 'email_verification_token',
        'token' => hash('sha256', random_bytes(32)),
        'expires_at' => now()->addSeconds(config('token.email_verification_token.expires_in')),
        'revoked_at' => now(),
        'created_at' => now(),
        'user_id' => $super_admin->id
      ]);
    }
  }
}
