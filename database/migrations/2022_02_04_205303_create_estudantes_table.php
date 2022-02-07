<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudantes', function (Blueprint $table) {
            $table->id();
            $table->string('primeiro_nome', 50); // somente primeiro nome
            $table->string('nome', 255);  // nome completo da pessoa
            $table->string('email', 50); // jose@123.com
            $table->date('data_nascimento'); // 1990-04-21
            $table->string('formacao',50); // mestrado/doutorado/primario
            $table->string('telefone',30); // código de 4 digitos => 1BGA
            $table->integer('inscrito'); // 0 ou 1
            $table->integer('interesse'); // 0 (pouco) a 100 (muito) interesse 
            $table->string('estado', 2); // MG
            $table->string('cidade', 50); // Belo Horizonte
            $table->string('curso', 50); // ciencia da computacao
            
            $table->text('outras_informacoes'); 

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
        Schema::dropIfExists('estudantes');
    }
}
