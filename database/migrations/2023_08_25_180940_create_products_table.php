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
            $table->string('product_code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->float('quantity')->default(0)->nullable();
            $table->decimal('purchase_price');
            $table->decimal('sale_price');
            $table->text('image_url')->nullable();
            $table->enum('status', ["Published","Unpublished","Draft"])->default("Published");
            $table->foreignId(column:'category_id')->constrained('categories')->cascadeOnDelete();
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
