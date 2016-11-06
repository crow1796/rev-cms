<?php 

Route::get('/', ['uses' => '\App\Http\Controllers\Test\TestController1@home']);
Route::get('test', ['uses' => '\App\Http\Controllers\Test\TestController1@test']);
Route::get('test-1', ['uses' => '\App\Http\Controllers\Test\TestController1@test1']);
Route::get('test-2', ['uses' => '\App\Http\Controllers\Test\TestController1@test2']);