<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eletrodomesticos', function (Blueprint $table) {
            
            $table->id();
            $table->timestamps();
            $table->string('nome');
            $table->text('descricao');
            $table->string('tensao');
            $table->unsignedBigInteger('fk_marca');

            $table->foreign('fk_marca')->references('id')->on('marcas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eletrodomesticos');
    }
};
