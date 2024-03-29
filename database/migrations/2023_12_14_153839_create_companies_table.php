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
    Schema::create('companies', function (Blueprint $table) {
      $table->id();
      // name
      $table->string('name');
      // identifier
      $table->string('identifier');
      // type of identifier
      $table->enum('identifier_type', ['siren']);
      // has one address
      $table->foreignId('address_id')->constrained();
      $table->timestamps();
      // has one user
      $table->foreignId('user_id')->constrained();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('companies');
  }
};
