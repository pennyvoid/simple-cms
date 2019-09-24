<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Category;
use App\Post;
use App\Setting;
use App\Tag;

Route::get('/', 'FrontEndController@index')->name('index');
Route::get('/posts/{slug}', 'FrontEndController@single')->name('single');
Route::get('/user/{id}', 'FrontEndController@user')->name('user.post');
Route::get('/category/{id}', 'FrontEndController@category')->name('category.single');
Route::get('/tag/{id}', 'FrontEndController@tag')->name('tag.single');
Route::get('/results', function () {
    $posts = Post::where('title', 'like', '%' . request()->query('search') . '%')->simplePaginate(3);

    return view('results')
        ->with('posts', $posts)
        ->with('query', request()->query('search'))
        ->with('setting', Setting::first())
        ->with('categories', Category::take(5)->get())
        ->with('tags', Tag::all());
})->name('results');

Auth::routes();


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    Route::get('/post/create', [
        'uses' => 'PostsController@create',
        'as' => 'post.create'
    ]);
    Route::post('/post/create', [
        'uses' => 'PostsController@store',
        'as' => 'post.store'
    ]);
    Route::get('/posts', [
        'uses' => 'PostsController@index',
        'as' => 'posts'
    ]);
    Route::get('/posts/{post}/edit', [
        'uses' => 'PostsController@edit',
        'as' => 'post.edit'
    ]);
    Route::delete('/posts/{post}/delete', [
        'uses' => 'PostsController@destroy',
        'as' => 'post.destroy'
    ]);
    Route::put('/post/{post}/update', [
        'uses' => 'PostsController@update',
        'as' => 'post.update'
    ]);

    Route::get('trashed-posts', 'PostsController@trashed')->name('trashed.posts');
    Route::put('restore-post/{post}', 'PostsController@restore')->name('restore.post');

    Route::get('/category/create', 'CategoriesController@create')->name('category.create');
    Route::get('/categories', 'CategoriesController@index')->name('categories');
    Route::post('/category/store', 'CategoriesController@store')->name('category.store');
    Route::get('/categories/{category}/edit', 'CategoriesController@edit')->name('category.edit');
    Route::put('/categories/{category}/update', 'CategoriesController@update')->name('category.update');
    Route::delete('/categories/{category}/delete', 'CategoriesController@destroy')->name('category.destroy');

    Route::resource('tags', 'TagsController');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/users', [
        'uses' => 'UsersController@index',
        'as' => 'users'
    ]);
    Route::get('/users/{user}', 'UsersController@show')->name('users.show');

    Route::get('/profile/edit', [
        'uses' => 'UsersController@editProfile',
        'as' => 'profile.edit'
    ]);
    Route::patch('/profile/{user}/update', [
        'uses' => 'UsersController@updateProfile',
        'as' => 'profile.update'
    ]);
    Route::get('/setting/edit', 'SettingsController@edit')->name('settings.edit');
    Route::post('/setting/update', 'SettingsController@update')->name('settings.update');
});


Route::middleware(['auth', 'mainAdmin'])->prefix('admin')->group(function () {
    Route::post('/users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
    Route::post('/users/{user}/make-writer', 'UsersController@makeWriter')->name('users.make-writer');
    Route::delete('/users/{user}/delete', 'UsersController@destroy')->name('users.destroy');
});
