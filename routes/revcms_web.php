<?php 

Route::get('/', ['uses' => '\App\Http\Controllers\Test\TestController1@home']);
Route::get('about-us', ['uses' => '\App\Http\Controllers\Test\TestController1@aboutUs']);
Route::get('contact-us', ['uses' => '\App\Http\Controllers\Test\TestController1@contactUs']);
Route::get('aimer', ['uses' => '\App\Http\Controllers\Test\TestController1@aimer']);
Route::get('re-far', ['uses' => '\App\Http\Controllers\Test\TestController1@reFar']);