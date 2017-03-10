<?php

use Illuminate\Database\Seeder;

class ArticleCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('article_categories')->delete();
        
        \DB::table('article_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'assumenda',
                'slug' => 'sequi-placeat-aspernatur-repellendus-consectetur',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'ut',
                'slug' => 'minus-vel-quo-est-nulla-est-atque-nobis',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'reiciendis',
                'slug' => 'commodi-quia-beatae-sapiente-sint-hic-non-quae',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'placeat',
                'slug' => 'harum-quod-nisi-dolore-rerum-asperiores-minima',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'qui',
                'slug' => 'reprehenderit-est-ut-facilis-dignissimos-incidunt-esse',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'maiores',
                'slug' => 'et-est-itaque-nulla-pariatur-harum-dolorem-qui',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'nam',
                'slug' => 'nulla-inventore-eos-veniam-maiores-omnis-rerum-totam',
            ),
        ));
        
        
    }
}
