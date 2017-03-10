<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Beheerder van de website',
                'created_at' => '2017-03-10 21:02:24',
                'updated_at' => '2017-03-10 21:02:24',
            ),
        ));
        
        
    }
}
