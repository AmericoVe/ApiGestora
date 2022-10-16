<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_details', function (Blueprint $table) {
            $table->id();
            $table->integer('idorder'); 
            $table->integer('idproducto'); 
            $table->string('codigo')->nullable(); 
            $table->string('descripcion')->nullable();             
            $table->string('cantidad')->nullable();            
            $table->double('precio')->nullable();
            $table->string('categoria')->nullable(); 
            $table->string('modelo')->nullable(); 
            $table->string('color')->nullable();
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
        Schema::dropIfExists('orders_details');
    }
}
