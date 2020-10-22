<?php

namespace TallAndSassy\PageGuide\Http\Controllers\Admin;

class AdminController extends \Illuminate\Routing\Controller
{
    
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    //    protected function FailOnDeadView($view){
    //        if(!view()->exists($view)){
    //            abort(404,$view);
    //        }
    //    }


    // Load based upon if the file is actually there. Extra /name/JJ stuff at the end get passed as associative
    private function _showGenerically(string $topDir, string $insideBladeName,   string $subLevels)
    {
        $view_prefix_with_colons = 'tassy::';
        assert($topDir == 'admin');// reserved to remind me that this could be a good generic function
        $args = explode('/', $subLevels);
        while (is_null(end($args))) { // https://stackoverflow.com/a/8663364/93933 remove trailing empties
            array_pop($args);
        }
        $arrParts = ['admin', ...$args]; // put admin back at the front
        $arrPartsOrig = $arrParts;
        $numParts = count($arrParts);
        $_shortenedViewPath = null;
        // there might be trailing params, (vs. dir path.  so walk down until you find your match, the rest must be params)
        $asrParams = [];
        foreach ($arrParts as $slot => $part) {
            $arrPath = array_slice($arrPartsOrig, 0, $numParts - $slot);
            $_shortenedViewPath = $view_prefix_with_colons.implode('/', $arrPath);
            if (! view()->exists($_shortenedViewPath)) {  # admin/dashboard.blade.php is ok, as is admin/dashboard/index.blade.php
                $_shortenedViewPath = $_shortenedViewPath.'/index';
            }
            if (view()->exists($_shortenedViewPath)) {
                $arrParams = array_slice($arrPartsOrig, $numParts - $slot); // so, not directory stuff, like id=1

                for ($i = 0; $i < count($arrParams); $i = $i + 2) {
                    assert(isset($arrParams[$i + 1]), __FILE__.__LINE__." arrParams must be key/value sets. So far, we have '$_shortenedViewPath'->: ".implode(',', $asrParams));
                    $asrParams[$arrParams[$i]] = $arrParams[$i + 1];
                }
                #$shortenedViewPath = implode('/', $arrPath);

                break;
            }
        }


        if (empty($_shortenedViewPath)) {
            abort(404, implode('-', $arrParts));
        } else {
             #dd([__FILE__,__LINE__,'$arrParts'=>$arrParts,'$arrPath'=>$arrPath, '$_shortenedViewPath'=>$_shortenedViewPath,  'asrParams'=>$asrParams]);
            #return view("$topDir.$insideBladeName", ['pageRoute' => $shortenedViewPath,'asrParams' => $asrParams]);
            return view($_shortenedViewPath, ['pageRoute' => $_shortenedViewPath,'asrParams' => $asrParams])->render();
        }
    }


    public function showAdminFronts(string $subLevels)
    {
        #dd([__FILE__,__LINE__,$subLevels]);
        if ($subLevels[0] == 'SpecialCaseMatchGoesHere') {
            //return $this->OurSpecialMethod($sub1, $sub2, etc.);
        } else {
            #return $this->_showGenerically('admin', '__outer', $subLevels);// Default - Just loook for the file
            return $this->_showGenerically('admin', 'page-admin', $subLevels);// Default - Just loook for the file
        }
    }

    //    public function showAdminBody(string $subLevels)
    //    {
    //        if ($subLevels[0] == 'OtherSpecialCaseMatchGoesHere') {
    //            //return $this->OurSpecialMethod($sub1, $sub2, etc.);
    //        } else {
    //            #dd($subLevels);
    //            return $this->_showGenerically('admin', '_body', $subLevels);// Default - Just loook for the file
    //        }
    //    }

    //    public static function wireSwaplinkInA(string $url)
    //    {
    //        // Note: close(); is there to force closing of any open modal
    //        // 8/20' Known Issue: Calls close() twice.  Everything is always getting closed twice.
    //        //10/22/20 look elsewhere for this function - probably a duplicate, but should probably be here.
    //        return <<<EOD
    //        wire:click="\$emit('pageRoute','$url')"
    //        x-on:click.prevent="urlChange('$url');close();"
    //        href="{$url}"
    //        EOD;
    //    }
}
