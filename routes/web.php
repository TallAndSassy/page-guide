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


// Override the laraveljetstream/routes/livewire routes, cuz I don't know the smarter way
// This is all to add menus when going to profile stuff, so nix all of this wehn you get smarter

//use Illuminate\Support\Facades\Route;
//use Laravel\Jetstream\Http\Controllers\CurrentTeamController;
//use Laravel\Jetstream\Http\Controllers\Livewire\ApiTokenController;
//use Laravel\Jetstream\Http\Controllers\Livewire\TeamController;
//use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;
//use Laravel\Jetstream\Jetstream;

$isBack = (request()->routeIs('user*') || request()->routeIs('me*') || request()->routeIs('admin*') || request()->routeIs('teams*'));
 $isLoggedIn = (\Illuminate\Support\Facades\Auth::user()) ? true : false;
        if ($isLoggedIn) {
#if ($isBack) {
    \TallAndSassy\PageGuide\PageGuideMenuWranglerBack::wrangleMe(
            "admin",
            [
                'name' => __('tassy::PageGuide.AdminLinkText'),
                "url" => "/admin",
                "classes" => "",
                "routeIs" => "admin*",
            ]
        );

        \TallAndSassy\PageGuide\PageGuideMenuWranglerBack::wrangleMe(
            "me",
            [
                'name' => __('tassy::PageGuide.MeLinkText'),
                "url" => "/me",
                "classes" => "",
                "routeIs" => "me*",

            ]
        );

}
//Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
//    Route::group(['middleware' => ['auth', 'verified']], function () {
//        // Add our menus
//
//        // User & Profile...
//        Route::get('/user/profile', [UserProfileController::class, 'show'])
//                    ->name('profile.show');
//
//        // API...
//        if (Jetstream::hasApiFeatures()) {
//            Route::get('/user/api-tokens', [ApiTokenController::class, 'index'])->name('api-tokens.index');
//        }
//
//        // Teams...
//        if (Jetstream::hasTeamFeatures()) {
//            Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
//            Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
//            Route::put('/current-team', [CurrentTeamController::class, 'update'])->name('current-team.update');
//        }
//    });
//});
