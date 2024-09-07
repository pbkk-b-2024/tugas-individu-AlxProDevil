<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pertemuan1Controller;

Route::get('/', function () {
    return view('layouts.master');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/basic', function () {
    return view('pertemuan1.route.basic');
});

Route::get('/named', function () {
    return view('pertemuan1.route.named');
})->name('named');

Route::view('/view', 'pertemuan1.route.view');

Route::fallback(function () {
    return redirect('/home');
});

Route::prefix('/pertemuan1')->group(function(){
    Route::get('/ganjil-genap', [Pertemuan1Controller::class, 'ganjilGenap'])->name('ganjil-genap');
    Route::get('/fibonacci',[Pertemuan1Controller::class,'fibonacci'])->name('fibonacci');
    Route::get('/prima', [Pertemuan1Controller::class, 'prima'])->name('prima');
    Route::get('/routing', fn() => view('pertemuan1.routing'))->name('routing');

    Route::get('/routing/{param1}', [Pertemuan1Controller::class, 'param1'])->name('param1');
    Route::get('/routing/{param1}/{param2}', [Pertemuan1Controller::class, 'param2'])->name('param2');
});