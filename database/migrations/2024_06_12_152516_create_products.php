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
            $table->string('code');
            $table->string('product_name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 0)->default(0);
            $table->integer('stock')->default(0);
            $table->text('picture');
            $table->unsignedBigInteger('insert_by')->nullable();
            $table->foreign('insert_by', 'product_insert_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
            $table->unsignedBigInteger('suplier_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
