<?php

namespace TallAndSassy\PageGuide\Http\Controllers\Front;

class MenuController {
    public static function boot() {
        $isLoggedIn = (\Illuminate\Support\Facades\Auth::user()) ? true : false;
                if ($isLoggedIn) {
                     \TallAndSassy\PageGuide\PageGuideMenuWranglerFront::wrangleMe(
            "me",
            [
                'name' => __('tassy::PageGuide.MeLinkText'),
                "url" => "/me",
                "classes" => "",
                 "routeIs" => "me*"
            ]
        );

                    \TallAndSassy\PageGuide\PageGuideMenuWranglerFront::wrangleMe(
                        "log-out",
                        [
                            'name' => "Log Out",
                            "url" => route('logout'),
                            "classes" => "",
                             "routeIs" => "logout*"
                        ]
                    );
                } else {
                    \TallAndSassy\PageGuide\PageGuideMenuWranglerFront::wrangleMe(
                        "log-in",
                        [
                            'name' => "Log In",
                            "url" => route('login'),
                            "classes" => "",
                             "routeIs" => "login*"
                        ]
                    );
                }
    }
}
