<?php

use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\callback;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/halo',function(){
    return "halo world";
});
