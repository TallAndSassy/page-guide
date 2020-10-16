<?php


namespace TallAndSassy\PageGuide\Http\Controllers;

class PageGuideController
{
    public static function isBackPage(): bool
    {
        #dd(explode('/', request()->getPathInfo())[1]);
        $isBack = in_array(explode('/', request()->getPathInfo())[1], ['user','teams','me','admin','user']);
        #dd($isBack);
        return $isBack;
    }
    public function sample()
    {
        return 'Hello PageGuide from: '.__METHOD__;
    }
}
