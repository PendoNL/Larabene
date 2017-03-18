<?php

namespace App\Http\Controllers\Admin;

use App\Content;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContentRequest;
use Flash;
use Gate;

class ContentController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $items = Content::orderBy('menu_text', 'ASC')->paginate(25);

        return view('admin.content.list', [
            'content'    => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('create-content')) {
            return redirect(route('admin.content'));
        }

        $content = new Content();

        return view('admin.content.create', compact('content'))->with([
            'buttonLabel'   => 'Opslaan',
        ]);
    }

    /**
     * @param ContentRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ContentRequest $request)
    {
        Content::create($request->all());

        Flash::success('De content pagina is opgeslagen');

        return redirect(route('admin.content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Content $content
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        if (Gate::denies('update-content')) {
            return redirect(route('admin.content'));
        }

        return view('admin.content.update', compact('content'))->with([
            'buttonLabel'   => 'Wijzigingen opslaan',
        ]);
    }

    /**
     * @param ContentRequest $request
     * @param Content        $content
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ContentRequest $request, Content $content)
    {
        $content->menu_text = $request->get('menu_text');
        $content->title = $request->get('title');
        $content->content = $request->get('content');
        $content->save();

        Flash::success('De content pagina is gewijzigd');

        return redirect(route('admin.content'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Content $content
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        if (Gate::denies('delete-content')) {
            return redirect(route('admin.content'));
        }

        $content->delete();

        Flash::success('De content pagina "'.$content->menu_text.'" is verwijderd');

        return redirect(route('admin.content'));
    }
}
