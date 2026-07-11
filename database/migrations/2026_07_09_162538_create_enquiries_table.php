<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();

            // Nullable FK — product enquiries link to a product,
            // contact form submissions have no product (null)
            $table->foreignId('product_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            // Customer details
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->text('message')->nullable();

            // Subject — used by the contact form dropdown
            // (General Enquiry / Order Question / Product Question / etc.)
            // null for product-page enquiries
            $table->string('subject')->nullable();

            // Dealer workflow status — admin panel uses this to track follow-ups
            // new       = just submitted, dealer hasn't seen it yet
            // contacted = dealer has been in touch with the customer
            // closed    = resolved / no longer active
            $table->enum('status', ['new', 'contacted', 'closed'])->default('new');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};