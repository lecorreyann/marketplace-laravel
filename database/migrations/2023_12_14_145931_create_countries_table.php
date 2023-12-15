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
    Schema::create('countries', function (Blueprint $table) {
      $table->id();
      // name
      $table->string('name')->unique();
      // code (ISO 3166-1 alpha-2: https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2)
      $table->string('iso_3166-1_alpha-2')->unique();
      // activated
      $table->boolean('activated')->default(false);
      $table->timestamps();
      $table->softDeletes();
    });

    // Insert rows during migration
    Artisan::call('db:seed', [
      '--class' => 'CountrySeeder',
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('countries');
  }
};
