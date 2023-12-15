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
    Schema::create('cities', function (Blueprint $table) {
      $table->id();
      // name
      $table->string('name');
      // has one country
      $table->foreignId('country_id')->constrained();
      // postal code (including letters, zip code etc.)
      $table->string('postal_code');
      // activated
      $table->boolean('activated')->default(true);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('cities');
  }
};
