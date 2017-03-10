<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('articles')->delete();
        
        \DB::table('articles')->insert(array (
            0 => 
            array (
                'id' => 5,
                'highlighted' => 1,
                'active' => 1,
                'category_id' => 3,
                'user_id' => 1,
                'slug' => 'velit-necessitatibus-magnam-voluptatum-adipisci-debitis-enim',
                'date' => '2017-03-10',
                'url' => '',
                'title' => 'ut',
                'image' => 'http://lorempixel.com/400/200/',
                'content' => '',
                'client' => '',
                'tags' => 'aut',
                'front' => 0,
            ),
            1 => 
            array (
                'id' => 6,
                'highlighted' => 0,
                'active' => 1,
                'category_id' => 4,
                'user_id' => 1,
                'slug' => 'est-nemo-ut-dignissimos-molestiae-dolores-aut',
                'date' => '2017-03-10',
                'url' => '',
                'title' => 'ex',
                'image' => 'http://lorempixel.com/400/200/',
                'content' => '',
                'client' => '',
                'tags' => 'quis',
                'front' => 0,
            ),
            2 => 
            array (
                'id' => 7,
                'highlighted' => 1,
                'active' => 1,
                'category_id' => 5,
                'user_id' => 1,
                'slug' => 'officiis-aut-ducimus-beatae-dolor-tenetur-voluptatem',
                'date' => '2017-03-10',
                'url' => '',
                'title' => 'et',
                'image' => 'http://lorempixel.com/400/200/',
                'content' => '',
                'client' => '',
                'tags' => 'et',
                'front' => 0,
            ),
            3 => 
            array (
                'id' => 8,
                'highlighted' => 0,
                'active' => 0,
                'category_id' => 6,
                'user_id' => 1,
                'slug' => 'suscipit-et-voluptas-est',
                'date' => '2017-03-10',
                'url' => '',
                'title' => 'voluptatibus',
                'image' => 'http://lorempixel.com/400/200/',
                'content' => '',
                'client' => '',
                'tags' => 'et',
                'front' => 0,
            ),
            4 => 
            array (
                'id' => 9,
                'highlighted' => 0,
                'active' => 1,
                'category_id' => 7,
                'user_id' => 5,
                'slug' => 'dolores-omnis-rerum-voluptatum-suscipit-exercitationem-cum',
                'date' => '2017-03-10',
                'url' => '',
                'title' => 'et',
                'image' => 'http://lorempixel.com/400/200/',
                'content' => '',
                'client' => '',
                'tags' => 'itaque',
                'front' => 0,
            ),
        ));
        
        
    }
}
