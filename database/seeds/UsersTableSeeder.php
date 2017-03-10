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
                'name' => 'User',
                'email' => 'info@larabene.dev',
                'avatar' => '',
                'password' => '$2y$10$irVQNvAYvOzW5T/7BNVK/O4mI3YnApSSepZW9hWmZGcUvggunx.AG',
                'remember_token' => NULL,
                'created_at' => '2017-03-10 22:03:19',
                'updated_at' => '2017-03-10 22:03:19',
            ),
        ));
        
        
    }
}
