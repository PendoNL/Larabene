@extends('admin/master')

@section('content')
    <div class="container">
        <section class="ledenlijst">
            <div class="row">
                <div class="col-lg-12">

                    @include('partials/errors')
                    @include('flash::message')

                    <h2>Pagina's</h2>

                    <hr />

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Menuknop</th>
                                <th>Titel</th>
                                <th>Opties</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($content as $page)
                                <tr>
                                    <td>
                                        <a href="{{ route('content.show', ['content' => $page->slug]) }}">{{ $page->menu_text }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('content.show', ['content' => $page->slug]) }}">{{ $page->title }}</a>
                                    </td>
                                    <td>
                                        @can('update-content')
                                        <a href="{{ route('admin.content.edit', ['content' => $page->slug]) }}" class="btn btn-small btn-primary">Bewerken</a>
                                        @endcan
                                        @can('delete-content')
                                        <a href="{{ route('admin.content.destroy', ['content' => $page->slug]) }}" class="btn btn-small btn-danger" onClick="javascript:return confirm('Weet je het zeker?');">Verwijderen</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {!! $content->render() !!}

                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection