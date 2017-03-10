<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Content;
use Request;

class ContentController extends Controller
{

    /**
     * @param $slug
     * @return mixed
     *
     * Return content page
     */
    public function show($slug)
    {
        $content = Content::where('slug', $slug)->first();
        if(!empty($content->title)) {

            // Variables
            $with = [
                'page_title' => ($content->menu_text . ' - Pendo.'),
                'content' => $content,
            ];

            view()->share('meta', $content->pageMeta());

            // Return the view
            return view('content.show')->with($with);
        } else {
            abort(404);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('content.home');
    }
}
