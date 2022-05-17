<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('file_path');
            $table->string('type');
            $table->foreignId('user_id')->reference('id')->on('users')->nullable();
            $table->foreignId('product_id')->reference('id')->on('postules')->nullable();
            $table->foreignId('category_id')->reference('id')->on('opportunites')->nullable();
            $table->foreignId('rayon_id')->reference('id')->on('entreprises')->nullable();
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
        Schema::dropIfExists('files');
    }
}
