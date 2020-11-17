<?php

namespace TallAndSassy\PageGuide\Http\Controllers\Admin;

abstract class AdminBaseController extends \Illuminate\Routing\Controller
{
    public const viewRef = "tassy::admin/__body";
    //abstract public static string $title = 'Dashboard';
    /* It is worth noting that LePage works differently in that it just swaps out the body.  */


    // Load based upon if the file is actually there. Extra /name/JJ stuff at the end get passed as associative
    //    private function _showGenerically(string $topDir, string $insideBladeName,   string $subLevels, bool $isLivewire)
    //    {
    //        $view_prefix_with_colons = $blade_prefix = \TallAndSassy\PageGuide\PageGuideServiceProvider::$blade_prefix.'::';
    //        assert($topDir == 'admin');// reserved to remind me that this could be a good generic function
    //        $args = explode('/', $subLevels);
    //        while (is_null(end($args))) { // https://stackoverflow.com/a/8663364/93933 remove trailing empties
    //            array_pop($args);
    //        }
    //
    //        $page = array_shift($args); // like 'dashboard' in admin/dashboard
    //        $arrParts = ['admin',$page, ...$args]; // put admin back at the front
    //        $arrPartsOrig = $arrParts;
    //        $numParts = count($arrParts);
    //        $_shortenedViewPath = null;
    //        // there might be trailing params, (vs. dir path.  so walk down until you find your match, the rest must be params)
    //        $asrParams = [];
    //        foreach ($arrParts as $slot => $part) {
    //            $arrPath = array_slice($arrPartsOrig, 0, $numParts - $slot);
    //            $_shortenedViewPath_withPrefix = $view_prefix_with_colons.implode('/', $arrPath);
    //            if (! view()->exists($_shortenedViewPath_withPrefix)) {  # admin/dashboard.blade.php is ok, as is admin/dashboard/index.blade.php
    //                $_shortenedViewPath_withPrefix = $_shortenedViewPath_withPrefix.'/index';
    //            }
    //
    //            if (view()->exists($_shortenedViewPath_withPrefix)) {
    //                $asrParams = [__FILE__,__LINE__,'You need to work on this logic'];
    //                //              $asrParams = array_slice($arrPartsOrig, ($numParts - 1) - $slot); // so, not directory stuff, like id=1 and nix the top level, like 'dashboard' in admin/dashbaord/tab/3
    //
    //                //                for ($i = 0; $i < count($arrParams); $i = $i + 2) {
    //                //                    $arrParamsStr = implode('/',$arrParams);
    //                //                    assert(isset($arrParams[$i + 1]), __FILE__.__LINE__." arrParams must be key/value sets. So far, from '$topDir - $subLevels' we have '$arrParamsStr': ".implode(',', $asrParams))." ";
    //                //                    $asrParams[$arrParams[$i]] = $arrParams[$i + 1];
    //                //                }
    //                #$shortenedViewPath = implode('/', $arrPath);
    //                $viewParams = ['viewRef' => $_shortenedViewPath_withPrefix,'asrParams' => $asrParams, 'isLivewire' => $isLivewire];
    //
    //
    //                return view('tassy::admin/index', $viewParams);
    //                #dd([__FILE__,__LINE__,'$_shortenedViewPath'=>$_shortenedViewPath_withPrefix, $viewParams]);
    //
    //                return view($_shortenedViewPath_withPrefix, $viewParams);
    //            }
    //        }
    //        abort(404, implode('-', $arrParts));
    //    }

    public static function subLevels2asrParams($subLevels) : array
    {
        //fyi: explode('/','')) == [0=>'']
        $subLevels = trim($subLevels);
        $arrParams = explode('/', $subLevels);
        // handle degenerate
        if (empty($arrParams[0])) {
            array_shift($arrParams);
        }
        #$arrParams = (count($arrParams) == 1 && empty($arrParams[0])) ? [] : $arrParams;

        $asrParams = [];
        $numParams = count($arrParams);
        #dd($numParams);

        for ($i = 0; $i < $numParams; $i = $i + 2) {
            #dd($arrParams);

            #assert(isset($arrParams[$i + 1]), __FILE__.__LINE__."$subLevels arrParams must be key/value set at i($i) '".implode('-', $arrParams)."' count(numParams):".$numParams."vs ".$numParams);
            $asrParams[$arrParams[$i]] = $arrParams[$i + 1];
        }


        return $asrParams;
    }

    // showAdminFronts is called by the routes/web.php
    public function getFrontView(string $subLevels = '')
    {
        $asrParams = [];//static::subLevels2asrParams($subLevels);
        return view("tassy::admin.__index_shell", ['viewRef' => static::viewRef,'asrParams' => $asrParams, 'ControllerName' => get_called_class(), 'controllerObj' => $this]);
        //            if ($isBodyOnly) {
        //                return 'body from AdminController';
        //    dd([__FILE__,__LINE__]);
        //
        //                return view("tassy::admin.__body", ['viewRef' => static::viewRef ,'asrParams' => $asrParams, 'ControllerName' => get_called_class(), 'controllerObj' => $this]);
        //            } else {
        //
        //                return view("tassy::admin.__index_shell", ['viewRef' => static::viewRef,'asrParams' => $asrParams, 'ControllerName' => get_called_class(), 'controllerObj' => $this]);
        //            }
    }

    #abstract public function getBodyView(string $subLevels) :  \Illuminate\View\View;
    public function getBodyView(string $subLevels) : \Illuminate\View\View
    {
        return view(static::viewRef);
    }

    //    public static function wireSwaplinkInA(string $url) // See LePage
}
