<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// the route for this will be this http://laragigs.test/hello and it prints Hello World on screen
Route::get('/hello', function () {
    return response("<h1>Hello World</h1>")
        ->header('Content-Type', 'text/plain')
        ->header('foo', 'bar');
});

// {id} whilecard id
// ->where("id", '[0~9]+'); constraints
// dd die and dump helper method for debugging this will stop everything and show me that whatever pass in
// ddd Dump, Die, Debug -> this will show more details information
Route::get('/posts/{id}', function ($id) {
    // dd($id);
    // ddd($id);
    return response("Post " . $id);
})->where("id", '[0-9]+');


Route::get('/search', function (Request $request) {
    return $request->name . ' ' . $request->city;
});
