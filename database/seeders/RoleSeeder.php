<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    /**
     * Create roles
     */

    // create super admin role
    DB::table('roles')->insert([
      'name' => 'super admin',
      'locked' => true,
    ]);

    // create admin role
    DB::table('roles')->insert([
      'name' => 'admin',
      'locked' => true,
    ]);

    // create user role
    DB::table('roles')->insert([
      'name' => 'user',
      'locked' => true,
    ]);

    // create vendor role
    DB::table('roles')->insert([
      'name' => 'vendor',
      'locked' => true,
    ]);
  }
}
