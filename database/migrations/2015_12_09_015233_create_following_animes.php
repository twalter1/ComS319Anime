<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowingAnimes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('following_animes', function (Blueprint $table) {
            $table->integer( 'anime_id' )->unsigned()->index();
            $table->foreign( 'anime_id' )->references( 'id' )->on( 'animes' )->onDelete( 'cascade' );
            $table->integer( 'user_id' )->unsigned()->index();
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onDelete( 'cascade' );
            $table->primary( [ 'anime_id', 'user_id' ] );
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop( 'following_animes' );
    }
}
