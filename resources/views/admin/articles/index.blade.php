@extends('admin/master')

@section('content')
    <div class="container">
        <section class="ledenlijst">
            <div class="row">
                <div class="col-lg-12">

                    @include('partials/errors')
                    @include('flash::message')

                    <h2>Blog</h2>

                    <hr />

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Active</th>
                                <th>Uitgelicht</th>
                                <th>Categorie</th>
                                <th>Titel</th>
                                <th>Door</th>
                                <th>Datum</th>
                                <th>Opties</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td>
                                        @if($article->active == 1)
                                            <a class="btn btn-success small" href="{{ route('admin.articles.deactivate', ['article' => $article->slug]) }}">Y</a>
                                        @else
                                            <a class="btn btn-danger small" href="{{ route('admin.articles.activate', ['article' => $article->slug]) }}">N</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($article->highlighted == 1)
                                            <a class="btn btn-success small" href="{{ route('admin.articles.dehighlight', ['article' => $article->slug]) }}">Y</a>
                                        @else
                                            <a class="btn btn-danger small" href="{{ route('admin.articles.highlight', ['article' => $article->slug]) }}">N</a>
                                        @endif
                                    </td>
                                    <td>{{ $article->category->name }}</td>
                                    <td>
                                        <a href="{{ route('blogs.show', ['articlecategory' => $article->category->slug, 'article' => $article->slug]) }}">{{ $article->title }}</a>
                                    </td>
                                    <td>{{ !is_null($article->user) ? $article->user->name : '' }}</td>
                                    <td>{{ $article->updated_at->format('d-m-Y') }}</td>
                                    <td>
                                        @can('update-article')
                                        <a href="{{ route('admin.articles.edit', ['article' => $article->slug]) }}" class="btn btn-small btn-primary"><i class="fa fa-pencil"></i></a>
                                        @endcan
                                        @can('delete-article')
                                        <a href="{{ route('admin.articles.destroy', ['article' => $article->slug]) }}" class="btn btn-small btn-danger" onClick="javascript:return confirm('Weet je het zeker?');"><i class="fa fa-trash-o"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {!! $articles->render() !!}

                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection