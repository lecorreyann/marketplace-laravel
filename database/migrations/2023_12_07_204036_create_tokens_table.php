<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('tokens', function (Blueprint $table) {
      $table->id();
      // has one user
      $table->foreignId('user_id')->constrained()->onDelete('cascade');
      // type (remember_token, access_token, refresh_token, email_verification_token, password_reset_token)
      $table->enum('type', ['remember_token', 'access_token', 'refresh_token', 'email_verification_token', 'password_reset_token']);
      // token value
      $table->string('token', 64)->unique();
      // creation date
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      // expiration date
      $table->timestamp('expires_at')->nullable();
      // revocation date
      $table->timestamp('revoked_at')->nullable();
    });

    // Insert rows during migration
    Artisan::call('db:seed', [
      '--class' => 'TokenSeeder',
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tokens');
  }
};
