<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('request_transaction_id');
            $table->string('item_id');
            $table->double('request_qty',[11,2]);
            $table->double('request_original',[11,2])->nullable();
            $table->enum('status',['Pending','Approve','Decline'])->default('Pending');

            $table->foreign('item_id')->references('item_id')->on('items');
            $table->foreign('request_transaction_id')->references('id')->on('request_transactions');
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
        Schema::dropIfExists('requests');
    }
}
