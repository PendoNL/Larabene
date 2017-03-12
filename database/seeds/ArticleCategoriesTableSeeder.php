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

        factory(App\ArticleCategory::class, 8)->create();
    }
}
