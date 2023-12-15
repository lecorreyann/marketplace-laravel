<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('address_user', function (Blueprint $table) {
      $table->id();
      // has one address
      $table->foreignId('address_id')->constrained()->onDelete('cascade');
      // has one user
      $table->foreignId('user_id')->constrained()->onDelete('cascade');
      // type (billing, shipping)
      $table->enum('type', ['billing', 'shipping']);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('address_user');
  }
};
