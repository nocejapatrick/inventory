<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_id')->unique();
            $table->string('item_name');
            $table->double('item_stock');
            $table->enum('item_unit',['m','Kg','g','cm','mm','in','ft','yd','l','ml','pcs']);
            $table->string('item_classification');
            $table->string('item_skill');
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
    Schema::dropIfExists('items');
    }
}
