<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      // first name
      $table->string('first_name');
      // last name
      $table->string('last_name');
      // email
      $table->string('email')->unique();
      // email_verified_at
      $table->timestamp('email_verified_at')->nullable();
      // password
      $table->string('password');
      $table->timestamps();
      $table->softDeletes();
    });

    // Insert rows during migration
    Artisan::call('db:seed', [
      '--class' => 'UserSeeder',
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('users');
  }
};
