<?php

Route::get(
    '/',
    function () {




        $isLoggedIn = (\Illuminate\Support\Facades\Auth::user()) ? true : false;
                if ($isLoggedIn) {
                     \TallAndSassy\PageGuide\PageGuideMenuWranglerFront::wrangleMe(
            "me",
            [
                'name' => __('tassy::PageGuide.MeLinkText'),
                "url" => "/me",
                "classes" => ""
            ]
        );

                    \TallAndSassy\PageGuide\PageGuideMenuWranglerFront::wrangleMe(
                        "log-out",
                        [
                            'name' => "Log Out",
                            "url" => route('logout'),
                            "classes" => ""
                        ]
                    );
                } else {
                    \TallAndSassy\PageGuide\PageGuideMenuWranglerFront::wrangleMe(
                        "log-in",
                        [
                            'name' => "Log In",
                            "url" => route('login'),
                            "classes" => ""
                        ]
                    );
                }
        return view('tassy::front/index');
    }
);

Route::middleware(['auth:sanctum', 'verified'])->get(
    '/admin',
    function () {
        return view('tassy::admin/index');
    }
)->name('admin');

Route::middleware(['auth:sanctum', 'verified'])->get(
    '/me',
    function () {
        return view('tassy::me/index');
    }
)->name('me');
