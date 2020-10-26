<?php

namespace TallAndSassy\PageGuide\Http\Controllers\Admin;

class DashboardController extends AdminBaseController
{
    public const viewRef = "tassy::admin/dashboard/index";
    public function getBodyView(string $subLevels) : \Illuminate\View\View
    {
        return view(static::viewRef, ['LastName' => "Deis"]);
    }
}