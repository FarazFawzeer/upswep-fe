<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Foreign keys — categories and brands must exist first
            $table->foreignId('category_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('brand_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            // Core product info
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->json('details')->nullable();       // bullet list: ["Regular fit", "Cotton blend", ...]
            $table->string('sku')->nullable()->unique();
            $table->decimal('price', 10, 2)->nullable(); // null = "Contact for price"

            // ---- Images stored directly on this table ----
            // main_image  : single primary image shown in the product grid card
            //               e.g. "products/shirt-main.jpg"
            //
            // sub_images  : JSON array of additional gallery images shown as
            //               thumbnails on the product detail page
            //               e.g. ["products/shirt-2.jpg", "products/shirt-3.jpg"]
            //               Cast to array in the model — no extra table needed.
            $table->string('main_image')->nullable();
            $table->json('sub_images')->nullable();

            // Homepage / listing flags
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_trending')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};