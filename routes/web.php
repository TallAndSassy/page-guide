<?php
Route::get('/', function () {
    return view('tassy::front/index');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/admin', function () {
    return view('tassy::admin/index');
})->name('admin');

Route::middleware(['auth:sanctum', 'verified'])->get('/me', function () {
    return view('tassy::me/index');
})->name('me');
