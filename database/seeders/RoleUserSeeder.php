<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RoleUserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    //
    $user = DB::table('users')->where('email', env('SUPER_ADMIN_EMAIL'))->first();
    $super_admin_role = DB::table('roles')->where('name', 'super admin')->first();
    if ($user) {
      DB::table('role_user')->insert([
        'user_id' => $user->id,
        'role_id' => $super_admin_role->id,
      ]);
    }
  }
}
