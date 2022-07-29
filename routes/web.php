<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function(){
    dump("please use ".url("/user/1")." url");
    abort(404);
});

Route::get('/user/{id}', [\App\Http\Controllers\UserController::class,"getUser"]);
Route::post('/user/{id}/update-comments', [\App\Http\Controllers\UserController::class,"updateUserComments"]);
