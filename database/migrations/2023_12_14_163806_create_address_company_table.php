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
    Schema::create('address_company', function (Blueprint $table) {
      $table->id();
      // has one address
      $table->foreignId('address_id')->constrained()->onDelete('cascade');
      // has one company
      $table->foreignId('company_id')->constrained()->onDelete('cascade');
      // type (b2c, b2b)
      $table->enum('type', ['b2c', 'b2b']);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('address_company');
  }
};
