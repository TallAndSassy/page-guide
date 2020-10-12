<?php

Route::get(
    '/',
    function () {
       \TallAndSassy\PageGuide\Http\Controllers\Front\MenuController::boot();
        return view('tassy::front/index');
    }
);

Route::middleware(['auth:sanctum', 'verified'])->get(
    '/admin',
    function () {
        \TallAndSassy\PageGuide\Http\Controllers\Admin\MenuController::boot();
        return view('tassy::admin/index');
    }
)->name('admin');

Route::middleware(['auth:sanctum', 'verified'])->get(
    '/me',
    function () {
        \TallAndSassy\PageGuide\Http\Controllers\Me\MenuController::boot();
        return view('tassy::me/index');
    }
)->name('me');
