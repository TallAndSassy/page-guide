<?php

// Front
Route::get(
    '/',
    function () {
        \TallAndSassy\PageGuide\Http\Controllers\Front\MenuController::boot();

        return view('tassy::front/index');
    }
);

// =========================== Admin ===================================================================================
//Route::get('/admin/read/{sublevels?}', 'ReadController@showAdminFronts')->where('sublevels', '.*');           // mainly to show use of custom controller
//Route::get('/admin/help/{sublevels?}', 'HelpController@showAdminFronts')->where('sublevels', '.*');           // mainly to show use of custom controller
//Route::get('/admin/{sublevels?}', 'AdminController@showAdminFronts')->where('sublevels', '.*');           //https://stackoverflow.com/a/31681869/93933

Route::get('/admin', fn () => redirect('/admin/default'));

Route::middleware(['auth:sanctum', 'verified'])->get(
    '/admin/{sublevels?}',
    function (\TallAndSassy\PageGuide\Http\Controllers\Admin\AdminController $AdminController, string $sublevels) {
        \TallAndSassy\PageGuide\Http\Controllers\Admin\MenuController::boot(); //10/22 no-op
        #dd($AdminController);

        return $AdminController->showAdminFronts($sublevels);
    }
)->name('admin');

Route::middleware(['auth:sanctum', 'verified'])->get(
    '/admin',
    function () {
        \TallAndSassy\PageGuide\Http\Controllers\Admin\MenuController::boot();

        return view('tassy::admin/index');
    }
)->name('admin');

// =========================== Me ======================================================================================
Route::middleware(['auth:sanctum', 'verified'])->get(
    '/me',
    function () {
        \TallAndSassy\PageGuide\Http\Controllers\Me\MenuController::boot();

        return view('tassy::me/index');
    }
)->name('me');


// =========================== Boot Stuff  =============================================================================
/*  Build back-end menu entries
    This should almost definitely live somewhere else
*/
$isBackPage = \TallAndSassy\PageGuide\Http\Controllers\PageGuideController::isBackPage();
if ($isBackPage) {
    \TallAndSassy\PageGuide\PageGuideMenuWranglerBack::wrangleMe(
        "home",
        [
                'name' => __('tassy::PageGuide.FrontLinkText'),
                "url" => "/",
                "classes" => "",
                "routeIs" => "home*",
            ]
    );

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
