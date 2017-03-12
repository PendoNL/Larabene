<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\ArticleCategory;
use App\Http\Requests;
use Validator;
use Request;
use Route;
use Flash;
use Input;

class ArticleCategoryController extends \App\Http\Controllers\Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.articles.categories.list', [
            'categories' => ArticleCategory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new ArticleCategory;

        return view('admin.articles.categories.create')->with([
            'category'      => $category,
            'buttonLabel'   => 'Opslaan'
        ]);
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CategoryRequest $request)
    {
        $input = [];
        $input['name'] = $request->get('name');

        ArticleCategory::create($input);

        Flash::success('De categorie is toegevoegd.');

        return redirect(route('admin.articles.categories'));
    }

    /**

     * Show the form for editing the specified resource.
     *
     * @param  ArticleCategory   $category
     * @return \Illuminate\Http\Response
     */
    public function edit(ArticleCategory $category)
    {
        return view('admin.articles.categories.update')->with([
            'category'      => $category,
            'buttonLabel'   => 'Wijzigingen opslaan'
        ]);
    }

    /**
     * @param CategoryRequest $request
     * @param ArticleCategory $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CategoryRequest $request, ArticleCategory $category)
    {
        $input = [];
        $input['name'] = $request->get('name');

        $category->update($input);

        Flash::success('De categorie is bijgewerkt.');

        return redirect(route('admin.articles.categories'));
    }

    /**
     * @param ArticleCategory $category
     * @return mixed
     */
    public function destroy(ArticleCategory $category)
    {
        if (count($category->articles) > 0) {
            Flash::error('Deze categorie is niet leeg.');

            return redirect(route('admin.articles.categories'));
        }

        $category->delete();

        Flash::success('De categorie is succesvol verwijderd.');

        return redirect(route('admin.articles.categories'));
    }
}
