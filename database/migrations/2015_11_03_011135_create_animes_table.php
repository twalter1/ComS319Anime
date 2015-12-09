<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->increments('id');
            $table->string( 'name' );
            $table->string( 'profile_url' )->nullable();
            $table->json( 'genre' );
            $table->string( 'status' );
            $table->integer( 'numSeasons' )->unsigned();
            $table->integer( 'numEpisodes' )->unsigned();
            $table->text( 'description' )->nullable();
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
        Schema::drop('animes');
    }
}
