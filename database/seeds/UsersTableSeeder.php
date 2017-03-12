<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Admin',
                'email' => 'info@larabene.dev',
                'avatar' => 'placeholder.png',
                'password' => bcrypt('welkom'),
                'remember_token' => NULL
            ),
        ));

        factory(App\User::class, 10)->create();
    }
}
