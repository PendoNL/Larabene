<?php

Auth::routes();

/*
 * Administration Area Routes
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'role:admin|owner']], function () {

    /*
     * Admin Home
     */
    Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'AdminController@index']);

    /*
     * Log Viewer
     */
    Route::get('logs', ['as' => 'admin.logs', 'uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index']);

    /*
     * Content Admin
     */
    Route::group(['prefix' => 'content'], function () {
        Route::get('/', ['as' => 'admin.content', 'uses'   => 'ContentController@index']);
        Route::get('/create', ['as' => 'admin.content.create', 'uses' => 'ContentController@create']);
        Route::get('/{content}/edit', ['as' => 'admin.content.edit', 'uses' => 'ContentController@edit']);

        Route::post('/create', ['as' => 'admin.content.store', 'uses' => 'ContentController@store']);
        Route::put('/{content}/edit', ['as' => 'admin.content.update', 'uses' => 'ContentController@update']);
        Route::get('/{content}/delete', ['as' => 'admin.content.destroy', 'uses' => 'ContentController@destroy']);
    });

    /*
     * Article Routes
     */
    Route::group(['prefix' => 'articles'], function () {
        Route::get('/all', ['as' => 'admin.articles', 'uses' => 'ArticleController@index']);
        Route::get('/create', ['as' => 'admin.articles.create', 'uses' => 'ArticleController@create']);
        Route::get('/{article}/edit', ['as' => 'admin.articles.edit', 'uses' => 'ArticleController@edit']);
        Route::get('/{article}/activate', ['as' => 'admin.articles.activate', 'uses' => 'ArticleController@activate']);
        Route::get('/{article}/deactivate', ['as' => 'admin.articles.deactivate', 'uses' => 'ArticleController@deactivate']);
        Route::get('/{article}/highlight', ['as' => 'admin.articles.highlight', 'uses' => 'ArticleController@highlight']);
        Route::get('/{article}/dehighlight', ['as' => 'admin.articles.dehighlight', 'uses' => 'ArticleController@dehighlight']);
        Route::get('/{article}/edit/remove-banner', ['as' => 'admin.articles.edit.remove_banner', 'uses' => 'ArticleController@removeImage']);

        Route::post('/create', ['as' => 'admin.articles.store', 'uses' => 'ArticleController@store']);
        Route::put('/{article}/edit', ['as' => 'admin.articles.update', 'uses' => 'ArticleController@update']);
        Route::get('/{article}/delete', ['as' => 'admin.articles.destroy', 'uses' => 'ArticleController@destroy']);

        /*
         * Article Categories Admin
         */
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', ['as' => 'admin.articles.categories', 'uses'   => 'ArticleCategoryController@index']);
            Route::get('/create', ['as' => 'admin.articles.categories.create', 'uses' => 'ArticleCategoryController@create']);
            Route::get('/{articlecategory}/edit', ['as' => 'admin.articles.categories.edit', 'uses' => 'ArticleCategoryController@edit']);

            Route::post('/create', ['as' => 'admin.articles.categories.store', 'uses' => 'ArticleCategoryController@store']);
            Route::put('/{articlecategory}/edit', ['as' => 'admin.articles.categories.update', 'uses' => 'ArticleCategoryController@update']);
            Route::get('/{articlecategory}/delete', ['as' => 'admin.articles.categories.destroy', 'uses' => 'ArticleCategoryController@destroy']);
        });
    });
});

/*
 * Contact Routes
 */
Route::get('/contact', ['as' => 'contact', 'uses' => 'ContactController@show']);
Route::post('/contact', 'ContactController@post');

/*
 *  Leden Routes
 */
Route::group(['prefix' => 'leden'], function () {
    Route::get('registreren', ['as' => 'auth.register', 'uses' => 'Auth\RegisterController@getRegister']);
    Route::get('uitloggen', ['as' => 'auth.logout', 'uses' => 'Auth\LoginController@logout']);
    Route::get('inloggen', ['as' => 'auth.login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::get('activeren/{token}', ['as' => 'auth.activate', 'uses' => 'Auth\RegisterController@getActivateAccount']);

    Route::post('/registreren', 'Auth\RegisterController@postRegister');
    Route::post('/inloggen', 'Auth\LoginController@login');
});

/*
 * Reset Password Routes
 */
Route::group(['prefix' => 'wachtwoord'], function () {
    Route::get('herstellen/{token}', ['as' => 'auth.resetpw', 'uses' => 'Auth\PasswordController@getReset']);
    Route::get('vergeten', ['as' => 'auth.reset', 'uses' => 'Auth\PasswordController@getEmail']);

    Route::post('herstellen', ['as' => 'auth.reset.do', 'uses' => 'Auth\PasswordController@postReset']);
    Route::post('vergeten', 'Auth\PasswordController@postEmail');
});

/*
 * Blog Routes
 */
Route::group(['prefix' => 'blog'], function () {
    // View Blogs & Index
    Route::get('/', ['as' => 'blogs.index', 'uses' => 'ArticleController@index']);
    Route::get('/{articlecategory}', ['as' => 'blogs.index.category', 'uses' => 'ArticleController@category']);
    Route::get('/{articlecategory}/{article}', ['as' => 'blogs.show', 'uses' => 'ArticleController@show']);

    Route::post('/', ['as' => 'blogs.search', 'uses' => 'ArticleController@search']);
});

/*
 * Content Pages or 404 Fallback
 */
Route::get('{slug}', ['as' => 'content.show', 'uses' => 'ContentController@show']);

/*
 * Fixed Content Routes
 */
Route::get('/', ['as' => 'content.home', 'uses' => 'ContentController@index']);
