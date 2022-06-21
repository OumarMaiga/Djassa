<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('user_id')->reference('id')->on('users');
            $table->foreignId('rayon_id')->reference('id')->on('rayons')->nullable();
            $table->foreignId('category_id')->reference('id')->on('categories')->nullable();
            $table->foreignId('sub_category_id')->reference('id')->on('sub_categories')->nullable();
            $table->string('etat');
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
        Schema::dropIfExists('sub_sub_categorie');
    }
}
