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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('author_name');
            $table->string('email');
            $table->text('comment');
            $table->text('advantages')->nullable()->default(null);
            $table->text('disadvantages')->nullable()->default(null);
            $table->integer('rating');
            $table->boolean('recommend');
            $table->boolean('moderation_status')->default(false);
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');
            $table->index('product_id', 'product_idx');
            $table->index('user_id', 'user_idx');
            $table->integer('likes')->nullable()->default(null);
            $table->integer('dislikes')->nullable()->default(null);
            $table->foreign('product_id', 'product_id_fk')->on('products')->references('id');
            $table->foreign('user_id', 'user_id_fk')->on('users')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
