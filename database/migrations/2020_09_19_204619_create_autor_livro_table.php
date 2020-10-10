<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutorLivroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autor_livro', function (Blueprint $table) {
            $table->unsignedBigInteger('autor_id');
            $table->unsignedBigInteger('livro_id');

            $table->foreign('autor_id')->references('id')->on('autors');
            $table->foreign('livro_id')->references('id')->on('livros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('autor_livro');
    }
}
