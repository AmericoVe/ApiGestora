<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
             


            $table->id();
            $table->string('coddoc');
            $table->string('descrip');
            $table->string('ctacompra');
            $table->string('ctaventa');
            $table->string('aux0001');
            $table->string('aux0002');
            $table->string('aux0003');
            $table->string('aux0004');
            $table->string('aux0005');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
        
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
