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
    Schema::create('permissions', function (Blueprint $table) {
      $table->id();
      // permission name must be unique
      $table->string('name')->unique();
      // locked permissions cannot be deleted/updated
      $table->boolean('locked')->default(false);
      $table->timestamps();
      $table->softDeletes();
    });

    // Insert rows during migration
    Artisan::call('db:seed', [
      '--class' => 'PermissionSeeder',
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('permissions');
  }
};
