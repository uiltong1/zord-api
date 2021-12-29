<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesenvolvedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desenvolvedores', function (Blueprint $table) {
            $table->bigIncrements('co_desenvolvedor');
            $table->string('nm_desenvolvedor', 80)->unique();
            $table->string('ds_sexo', 20);
            $table->date('dt_nascimento');
            $table->integer('nu_idade');
            $table->string('ds_hobby', 256);
            $table->bigInteger('co_nivel')->unsigned();
            $table->foreign('co_nivel')->references('co_nivel')->on('niveis')->onDelete('cascade');
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
        Schema::dropIfExists('desenvolvedores');
    }
}
