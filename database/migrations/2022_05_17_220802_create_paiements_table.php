<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->string('montant');
            $table->foreignId('user_id')->reference('id')->on('users')->nullable();
            $table->foreignId('commande_id')->reference('id')->on('commandes')->nullable();
            $table->foreignId('service_id')->reference('id')->on('services')->nullable();
            $table->string('from')->nullable();
            $table->string('currency')->nullable();
            $table->string('description')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('channels')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('operator_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_surname')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone_number')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_city')->nullable();
            $table->string('customer_country')->nullable();
            $table->string('customer_state')->nullable();
            $table->string('customer_zip_code')->nullable();
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
        Schema::dropIfExists('paiements');
    }
}
