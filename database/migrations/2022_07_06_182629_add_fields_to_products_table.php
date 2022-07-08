<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('marque')->nullable();
            $table->string('composition')->nullable();
            $table->string('emballage')->nullable();
            $table->string('pays_production')->nullable();
            $table->string('conservation')->nullable();
            $table->integer('valeur_nutritionnelle')->default(0);
            $table->string('sodium')->nullable();
            $table->string('potassium')->nullable();
            $table->string('magnesium')->nullable();
            $table->string('fluorure')->nullable();
            $table->string('silicium_siO2')->nullable();
            $table->string('cendres')->nullable();
            $table->string('bicarbonate')->nullable();
            $table->string('sels_minéraux_totaux_sels_minéraux')->nullable();
            $table->string('nitrate')->nullable();
            $table->string('strontium')->nullable();
            $table->string('sulfate')->nullable();
            $table->string('designation_legale')->nullable();
            $table->string('distributeur')->nullable();
            $table->string('numero_article')->nullable();
            $table->string('duree_conservation')->nullable();
            $table->string('discount')->nullable();
            $table->string('poids')->nullable();
            $table->string('poids_unite_mesure')->nullable();
            $table->string('litre')->nullable();
            $table->string('litre_unite_mesure')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
