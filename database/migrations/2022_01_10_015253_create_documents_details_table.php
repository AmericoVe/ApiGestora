<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_details', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->string('codart');
            $table->string('desart');
            $table->string('cant');
            $table->string('precio');
            $table->string('igv');
            $table->string('subtotal');
            $table->string('total');
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
        Schema::dropIfExists('documents_details');
    }
}
