<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_transactions', function (Blueprint $table) {
            $table->bigIncrements('id',1000000);
            $table->unsignedBigInteger('user_id');
            $table->text('transaction_remarks')->nullable();
            

            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE request_transactions AUTO_INCREMENT = 100000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_transactions');
    }
}
