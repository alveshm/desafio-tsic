<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_docu')->unsigned();
            $table->foreign('item_docu')
                  ->references('id')
                  ->on('documentos')->onDelete('cascade');  
            $table->integer('item_prod')->unsigned();
            $table->foreign('item_prod')
                  ->references('id')
                  ->on('produtos')->onDelete('cascade');
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
        Schema::table('documentos', function(Blueprint $table)
        {
            $table->dropForeign('item_docu'); 
        });
        Schema::table('produtos', function(Blueprint $table)
        {
            $table->dropForeign('item_prod'); 
        });
    }
}
