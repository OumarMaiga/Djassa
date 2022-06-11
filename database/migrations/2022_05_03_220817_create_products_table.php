<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->foreignId('user_id')->reference('id')->on('users');
            $table->text('overview')->nullable();
            $table->string('price')->nullable();
            $table->string('quantity')->nullable();
            $table->boolean('published')->default(1);
            $table->foreignId('category_id')->reference('id')->on('categories')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
