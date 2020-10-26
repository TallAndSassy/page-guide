<?php

namespace TallAndSassy\PageGuide\Http\Controllers\Admin;

class BobController extends AdminBaseController
{
    public const viewRef = "tassy::admin/bob";
    public function getBodyView(string $subLevels) : \Illuminate\View\View
    {
        return view(static::viewRef, ['LastName' => "Deis"]);
    }
}
