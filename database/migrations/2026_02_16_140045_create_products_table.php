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
            $table->foreignId('category_id')->constrained('categories', 'id')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('short_description');
            $table->longText('description');
            $table->float('original_price');
            $table->float('discounted_price')->nullable();
            $table->foreignId('tag_id')
                ->nullable()
                ->constrained('product_tags', 'id')
                ->onDelete('cascade');
            $table->string('sku');
            $table->bigInteger('quantity');
            $table->boolean('on_sale')->default(0);
            $table->boolean('is_active')->default(1);
            $table->boolean('is_featured')->default(0);
            $table->bigInteger('views_count')->default(0);
            $table->timestamps();
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
