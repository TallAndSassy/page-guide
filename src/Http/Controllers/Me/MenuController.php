<?php

namespace TallAndSassy\PageGuide\Http\Controllers\Me;

class MenuController
{
    public static function boot()
    {
        $isLoggedIn = (\Illuminate\Support\Facades\Auth::user()) ? true : false;
        assert($isLoggedIn);

        \TallAndSassy\PageGuide\PageGuideMenuWranglerFront::wrangleMe(
            "admin",
            [
                'name' => __('tassy::PageGuide.AdminLinkText'),
                "url" => "/admin",
                "classes" => "",
                "routeIs" => "admin*"
            ]
        );

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
    }

}
