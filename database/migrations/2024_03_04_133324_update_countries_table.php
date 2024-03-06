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
    //
    Schema::table('countries', function (Blueprint $table) {
      $table->renameColumn('activated', 'create_company_select_country_enable');
      $table->boolean('create_company_input_phone_enable')->default(true);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    //
    Schema::table('countries', function (Blueprint $table) {
      $table->renameColumn('create_company_activated', 'activated');
      $table->dropColumn('create_company_input_phone_enable');
    });
  }
};
