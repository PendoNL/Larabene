<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Str;
use App\ArticleCategory;
use App\Http\Requests;
use App\Article;
use App\Group;
use Validator;
use KrakenIO;
use Request;
use Route;
use Flash;
use Input;
use Image;
use Event;
use File;
use Mail;
use Gate;
use Auth;

class ArticleController extends \App\Http\Controllers\Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.articles.index', [
            'articles' => Article::recent()->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $article = new Article;
        $article->date = \Carbon\Carbon::now();
        
        return view('admin.articles.create')->with([
            'article'       => $article,
            'buttonLabel'   => 'Opslaan',
            'category_list' => ArticleCategory::alphabetical()->pluck('name', 'id')
        ]);
    }

    /**
     * @param ArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ArticleRequest $request)
    {
        $input = $request->all();
        $input['user_id']   = Auth::user()->id;
        $input['active']    = 1;
        $input['image']     = $this->uploadImage();

        Article::create($input);

        Flash::success('Het artikel is opgeslagen.');

        return redirect(route('admin.articles'));
    }

    /**

     * Show the form for editing the specified resource.
     *
     * @param  Article   $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('admin.articles.update')->with([
            'article'       => $article,
            'buttonLabel'   => 'Wijzigingen opslaan',
            'category_list' => ArticleCategory::alphabetical()->pluck('name', 'id')
        ]);
    }

    /**
     * @param ArticleRequest $request
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $input = $request->except(['_token', '_method', 'groups']);
        $input['image'] = $this->uploadImage($article->image);

        $article->update($input);

        Flash::success('Het bericht is bijgewerkt.');

        return redirect(route('admin.articles'));
    }

    /**
     * @param Article $article
     * @return mixed
     */
    public function highlight(Article $article)
    {
        $article->highlighted = 1;
        $article->save();

        Flash::success('Het artikel is uitgelicht');

        return redirect(route('admin.articles'));
    }

    /**
     * @param Article $article
     * @return mixed
     */
    public function dehighlight(Article $article)
    {
        $article->highlighted = 0;
        $article->save();

        Flash::success('Het artikel is niet langer uitgelicht');

        return redirect(route('admin.articles'));
    }

    /**
     * @param Article $article
     * @return mixed
     */
    public function deactivate(Article $article)
    {
        $article->active = 0;
        $article->save();

        Flash::success('Het artikel is gedeactiveerd');

        return redirect(route('admin.articles'));
    }

    /**
     * @param Article $article
     * @return mixed
     */
    public function activate(Article $article)
    {
        $article->active = 1;
        $article->save();

        Flash::success('Het artikel is geactiveerd');

        return redirect(route('admin.articles'));
    }

    /**
     * @param Article $article
     * @return mixed
     */
    public function defront(Article $article)
    {
        if ($article->type == "B") {
            $article->front = 0;
            $article->save();

            Flash::success('Het artikel is gedeactiveerd.');
        } else {
            Flash::error('Enkel blog artikelen kunnen op de frontpage geplaatst worden.');
        }

        return redirect(route('admin.articles.blogs'));
    }

    /**
     * @param Article $article
     * @return mixed
     */
    public function front(Article $article)
    {
        if ($article->type == "B") {
            $article->front = 1;
            $article->save();

            Flash::success('Het artikel is geactiveerd.');
        } else {
            Flash::error('Enkel blog artikelen kunnen op de frontpage geplaatst worden.');
        }

        return redirect(route('admin.articles.blogs'));
    }

    /**
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function removeImage(Article $article)
    {
        if (file_exists(public_path('uploads/articles/' . $article->image)) && $article->image != "") {
            File::delete(public_path('uploads/articles/' . $article->image));
            $article->image = '';
            $article->save();

            Flash::success('De banner is succesvol verwijderd.');
        }

        return redirect(route('admin.articles.edit', ['article' => $article->slug]));
    }

    /**
     * @param string $old
     * @return string
     */
    public function uploadImage($old = '')
    {
        if (Request::hasFile('image')) {
            $image = Request::file('image');
            $filename  = time() . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/articles/' . $filename);
            $thumb = public_path('uploads/articles/thumb.' . $filename);

            try {
                Image::make($image->getRealPath())->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path);

                Image::make($image->getRealPath())->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($thumb);

                if ($old != "") {
                    if (file_exists(public_path('uploads/articles/'.$old))) {
                        File::delete(public_path('uploads/articles/' . $old));
                    }

                    if (file_exists(public_path('uploads/articles/thumb.'.$old))) {
                        File::delete(public_path('uploads/articles/thumb.' . $old));
                    }
                }

                $response = KrakenIO::upload([
                    'file' => $path,
                    'wait' => true,
                    'lossy' => true,
                ]);

                if ($response['success'] == true) {
                    $contents = file_get_contents($response['kraked_url']);

                    File::delete($path);
                    File::put($path, $contents);
                }

                return $filename;
            } catch (Exception $e) {
                return $old;
            }
        }

        return $old;
    }

    /**
     * @param Article $article
     * @return mixed
     */
    public function destroy(Article $article)
    {
        if (Gate::denies('delete-article')) {
            return redirect(route('admin.articles'));
        }

        $article->delete();

        Flash::success('Het artikel is succesvol verwijderd.');

        return redirect(route('admin.articles'));
    }
}
