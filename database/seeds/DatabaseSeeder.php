<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(RolePermissionSeeder::class);
        $this->call(AgendaCategorySeeder::class);

        Model::reguard();
        $this->call('RolesTableSeeder');
        $this->call('RoleUserTableSeeder');
        $this->call('ArticlesTableSeeder');
        $this->call('ArticleCategoriesTableSeeder');
        $this->call('UsersTableSeeder');
    }
}
