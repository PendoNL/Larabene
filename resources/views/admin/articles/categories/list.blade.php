@extends('admin/master')

@section('content')
    <div class="container">
        <section class="ledenlijst">
            <div class="row">
                <div class="col-lg-12">

                    @include('partials/errors')
                    @include('flash::message')

                    <h2>Artikel Categorie&euml;n</h2>

                    <a href="{{ route('admin.articles.categories.create') }}" class="btn btn-small btn-primary">Categorie toevoegen</a>

                    <hr />

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Naam</th>
                                <th>Slug</th>
                                <th>Aantal items</th>
                                <th>Opties</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ count($category->articles) }} artikelen</td>
                                    <td>
                                        @can('update-article')
                                        <a href="{{ route('admin.articles.categories.edit', ['articlecategory' => $category->slug]) }}" class="btn btn-small btn-primary">Bewerken</a>
                                        @endcan
                                        @can('delete-article')
                                        <a class="btn btn-small btn-danger" href="{{ route('admin.articles.categories.destroy', ['articlecategory' => $category->slug]) }}" onClick="javascript:return confirm('Weet je het zeker?');">Verwijderen</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection