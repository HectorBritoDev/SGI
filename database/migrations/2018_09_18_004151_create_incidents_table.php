<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->string('description');
            $table->string('severity', 1);
            $table->boolean('active')->default(1);

            $table->unsignedInteger('category_id')->nullable(); //LLAVE FORANEA (UN INCIDENTE TIENE UNA CATEGORIA)
            $table->foreign('category_id')->references('id')->on('categories');

            $table->unsignedInteger('level_id')->nullable()->default(null); //LLAVE FORANEA (UN INCIDENTE TIENE UNA NIVEL)
            $table->foreign('level_id')->references('id')->on('levels');

            $table->unsignedInteger('project_id')->nullable()->default(null); //LLAVE FORANEA (UN INCIDENTE TIENE UNA NIVEL)
            $table->foreign('project_id')->references('id')->on('projects');

            $table->unsignedInteger('client_id')->nullable()->default(null); //LLAVE FORANEA (QUIEN REGISTRO LA INCIDENCIA)
            $table->foreign('client_id')->references('id')->on('users');

            $table->unsignedInteger('support_id')->nullable()->default(null); //LLAVE FORANEA (QUIEN ESTA ATENDIENDO LA INCIDENCIA)
            $table->foreign('support_id')->references('id')->on('users');

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
        Schema::dropIfExists('incidents');
    }
}
