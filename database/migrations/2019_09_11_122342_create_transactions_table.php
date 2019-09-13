<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payment_amount', 20);
            $table->timestamp('created_at');
            $table->bigInteger('client_id')->length(10)->unsigned();
            $table->bigInteger('contributor_id')->length(10)->unsigned();
            $table->softDeletesTz();

            $table->foreign('client_id')->references('id')->on('clients');
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
        Schema::dropIfExists('transactions');
    }
}
