<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowingUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('following_users', function (Blueprint $table) {
            $table->integer( 'user_id' )->unsigned()->index();
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onDelete( 'cascade' );
            $table->integer( 'following_id' )->unsigned()->index();
            $table->foreign( 'following_id' )->references( 'id' )->on( 'users' )->onDelete( 'cascade' );
            $table->primary( [ 'following_id', 'user_id' ] );
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop( 'following_users' );
    }
}
