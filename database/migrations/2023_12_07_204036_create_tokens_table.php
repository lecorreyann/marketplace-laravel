<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('tokens', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->onDelete('cascade');
      $table->enum('type', ['remember_token', 'access_token', 'refresh_token', 'email_verification_token', 'password_reset_token']);
      $table->string('token', 64)->unique();
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('expires_at')->nullable();
      $table->timestamp('revoked_at')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tokens');
  }
};
