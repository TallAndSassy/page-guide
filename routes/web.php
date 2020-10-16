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
//
//// Add menus when on back end.  There must be a better way.
//#$isBackBound = in_array(explode('/', request()->getPathInfo())[1], ['user','teams','me','admin','user']);
//        if (\TallAndSassy\PageGuide\Http\Controllers\PageGuideController::isBackPage()) {
//            \TallAndSassy\PageGuide\PageGuideMenuWranglerBack::wrangleMe(
//                "admin",
//                [
//                'name' => __('tassy::PageGuide.AdminLinkText'),
//                "url" => "/admin",
//                "classes" => "",
//                "routeIs" => "admin*",
//            ]
//            );
//
//            \TallAndSassy\PageGuide\PageGuideMenuWranglerBack::wrangleMe(
//                "me",
//                [
//                'name' => __('tassy::PageGuide.MeLinkText'),
//                "url" => "/me",
//                "classes" => "",
//                "routeIs" => "me*",
//
//            ]
//            );
//        }
