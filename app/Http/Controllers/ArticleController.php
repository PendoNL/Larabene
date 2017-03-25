<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleCategory;
use Request;
use Route;
use Session;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Article::active()->recent();
        if (Session::get('blog_string') != '') {
            $blogs = $blogs->where('title', 'LIKE', '%'.Session::get('blog_string').'%')
                ->orWhere('content', 'LIKE', '%'.Session::get('blog_string').'%');
        }
        $blogs = $blogs->paginate(15);

        view()->share('meta', [
            'title'         => 'Larabene - Belgisch-Nederlandse Laravel Community',
            'keywords'      => 'laravel, belgie, nederland, community, tips, nieuws, meetups, banen, projecten',
            'description'   => 'Laravel nieuws, meet-ups, vacaturesn en projecten voor Belgische en Nederlandse Artisans',
        ]);

        return view('blogs.index')->with([
            'active_cat' => '',
            'blogs'      => $blogs,
        ]);
    }

    /**
     * Display a listing of the resource for a given category.
     *
     * @param ArticleCategory $category
     *
     * @return \Illuminate\Http\Response
     */
    public function category(ArticleCategory $category)
    {
        view()->share('meta', [
            'title'         => $category->name.' blog - Larabene.',
            'keywords'      => $category->name.', blog, development, nieuws, projecten, vacatures, artisans',
            'description'   => 'Alle blog artikelen uit de categorie '.$category->name,
        ]);

        return view('blogs.index')->with([
            'active_cat' => $category->slug,
            'blogs'      => $category->articles()->active()->recent()->paginate(15),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param ArticleCategory $category
     * @param Article         $blog
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ArticleCategory $category, Article $blog)
    {
        $blogs = Article::active()->recent()->where('id', '!=', $blog->id)->limit(5)->get();

        view()->share('meta', [
            'title'         => $blog->title,
            'keywords'      => $blog->tags,
            'description'   => 'Artikel ['.$blog->title.'] uit de categorie '.$category->name,
        ]);

        return view('blogs.show')->with([
            'active_cat' => $blog->category->slug,
            'blog'       => $blog,
            'category'   => $category,
            'side_blogs' => $blogs,
        ]);
    }

    /**
     * Search within a blogs, a string may be empty.
     *
     * @return mixed
     */
    public function search()
    {
        $string = Request::get('string');
        Session::put('blog_string', $string);

        return redirect(route('blogs.index'));
    }
}
