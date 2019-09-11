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
            $table->foreign('client-id')->references('id')->on('clients');
            $table->foreign('product-id')->references('id')->on('products');
            $table->foreign('contributor-id')->references('id')->on('contributors');
            $table->softDeletesTz();
            $table->timestampsTz();
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
