<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    /**
     * Create permissions
     */

    // create '*' permission
    DB::table('permissions')->insert([
      'name' => '*',
      'locked' => true,
    ]);

    // create 'create category' permission
    DB::table('permissions')->insert([
      'name' => 'create category',
      'locked' => true,
    ]);

    // create 'update category' permission
    DB::table('permissions')->insert([
      'name' => 'update category',
      'locked' => true,
    ]);

    // create 'delete category' permission
    DB::table('permissions')->insert([
      'name' => 'delete category',
      'locked' => true,
    ]);

    // create 'create product' permission
    DB::table('permissions')->insert([
      'name' => 'create product',
      'locked' => true,
    ]);

    // create 'update product' permission
    DB::table('permissions')->insert([
      'name' => 'update product',
      'locked' => true,
    ]);

    // create 'delete product' permission
    DB::table('permissions')->insert([
      'name' => 'delete product',
      'locked' => true,
    ]);

    // create 'update country' permission
    DB::table('permissions')->insert([
      'name' => 'update country',
      'locked' => true,
    ]);

    // create 'update city' permission
    DB::table('permissions')->insert([
      'name' => 'update city',
      'locked' => true,
    ]);
  }
}
