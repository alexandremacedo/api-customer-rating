<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcquisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acquisitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payment-type', 20);
            $table->bigInteger('client_id')->length(10)->unsigned();
            $table->bigInteger('product_id')->length(10)->unsigned();
            $table->bigInteger('contributor_id')->length(10)->unsigned();
            $table->softDeletesTz();
            $table->timestampsTz();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('contributor_id')->references('id')->on('contributors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acquisitions');
    }
}
