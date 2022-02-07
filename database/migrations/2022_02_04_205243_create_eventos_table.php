<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 50); // se é curso, palestra, etc.
            $table->string('nome', 255);  // titulo do evento => curso de javascript
            $table->string('carga_horaria', 20); // 2h, 3h23min
            $table->date('data'); // 2h, 3h23min
            $table->string('codigo_evento',4); // código de 4 digitos => 1BGA

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
        Schema::dropIfExists('eventos');
    }
}
