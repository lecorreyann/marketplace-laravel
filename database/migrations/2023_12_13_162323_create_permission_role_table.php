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
    Schema::create('permission_role', function (Blueprint $table) {
      $table->id();
      // role_id
      $table->foreignId('role_id')->constrained()->onDelete('cascade');
      // permission_id
      $table->foreignId('permission_id')->constrained()->onDelete('cascade');
      $table->timestamps();
      $table->softDeletes();
    });

    // Insert rows during migration
    Artisan::call('db:seed', [
      '--class' => 'PermissionRoleSeeder',
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('permission_role');
  }
};
