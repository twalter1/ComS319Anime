<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->delete();

        $user = new User;
        $user->name = 'Tristan Walters';
        $user->email = 'tristan@iastate.edu';
        $user->password = bcrypt('test123');
        $user->description = 'I like to take long walks on the veranda.';
        $user->save();

        $user = new User;
        $user->name = 'Josh Baedke';
        $user->email = 'jrbaedke@iastate.edu';
        $user->password = bcrypt('test123');
        $user->description = 'I like bubble baths.';
        $user->save();

    }
}
