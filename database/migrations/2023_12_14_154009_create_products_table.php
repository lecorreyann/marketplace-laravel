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
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      // sku
      $table->string('sku')->unique();
      // gtin (Global Trade Item Number: https://www.gs1.org/standards/id-keys/gtin)
      $table->string('gtin')->nullable();
      // name
      $table->string('name');
      // slug
      $table->string('slug')->unique();
      // description
      $table->text('description')->nullable();
      // weight
      $table->decimal('weight', 10, 2)->nullable();
      // dimensions
      $table->decimal('height', 10, 2)->nullable();
      $table->decimal('width', 10, 2)->nullable();
      $table->decimal('depth', 10, 2)->nullable();
      // price
      $table->decimal('price', 10, 2);
      // stock management
      $table->boolean('stock_management')->default(true);
      // stock
      $table->integer('stock')->nullable();
      // activated
      $table->boolean('activated')->default(true);
      // has one category
      $table->foreignId('category_id')->constrained();
      // has one company
      $table->foreignId('company_id')->constrained();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('products');
  }
};
