<?php

namespace TallAndSassy\PageGuide\Components;

use Livewire\Component;

class Lepage extends Component
{
    public string $viewRef; // was pageRoute, but misnomer  Need viewRef & url
    public string $tab = 'tbd';
    public int $count = 98;
    public string $title = 'Default Title';
    public string $tagline = 'For kids!';
    protected $listeners = ['pageRoute' => 'updateToPage', 'tab' => 'tab',];
    public array $asrParams = [];
    private bool $justMounted;
    private string $ControllerName;
    private $controllerObj;
    // TODO: Store oringal url


    protected function FailOnDeadView($view)
    {
        if (! view()->exists($view)) {
            abort(404);
        }
    }


    public function goToTab(string $newTab)
    {
        $this->tab = $newTab;
    }

    public function updateToPage(string $pageRoute)
    {
        #$this->FailOnDeadView($pageRoute);
        $this->pageRoute = $pageRoute;
    }

    public function mount(string $viewRef, string $ControllerName, $controllerObj, array $asrParams)
    {
        #$this->FailOnDeadView($pageRoute);
        $this->viewRef = $viewRef;
        $this->asrParams = $asrParams;
        $this->ControllerName = $ControllerName;
        $this->controllerObj = $controllerObj;
        $this->justMounted = true;
    }
    public function render()
    {
        $request = app('request');
        $tailingUrl = $request->path(); //http://domain.com/foo/bar, the path method will return foo/bar
        $route = app('router')->getRoutes()->match($request);


//        dd(
//            app('router')->getRoutes()->match($request)
//        );
//        $route = app('router')->getRoutes()->match(app('request')->create($this->pageRoute987, 'GET'));

        // If refreshing, the params need to be put back into the url.  Probably should have just stored it. oh well.
        $reconstructedUrl = implode('/', $route->parameters);
        foreach ($this->asrParams as $key => $val) {
            $reconstructedUrl .= "/$key/$val";
        }
         $controllerAtMethod_asString = $route->action['controller'];
        $controllerAtMethod_asString = str_replace('getFrontView', 'getBodyView', $controllerAtMethod_asString);
        #$route = app('router')->getRoutes()->match($request->create($tailingUrl, 'GET'));
        #dd($route->action);
        #$controllerAtMethod_asString = $this->ControllerName."::getBodyView";
        #dd($route->action['uses']);
        //$controllerAtMethod_asString = str_replace('index', 'getBodyView', $controllerAtMethod_asString);

        $bodyView = \App::call($controllerAtMethod_asString, ['subLevels' => $reconstructedUrl]);
        #dd($controllerObj);

//        $controllerAtMethod_asString = $route->action['controller'];
//        $controllerAtMethod_asString = str_replace('index', 'getBodyView', $controllerAtMethod_asString);
//        $controllerObj = \App::call($controllerObj, ['subLevels' => $reconstructedUrl]);
//        $bodyView = $controllerObj->getBodyView();
        $bodyHtml = $bodyView->render();

        $blade_prefix = \TallAndSassy\PageGuide\PageGuideServiceProvider::$blade_prefix;

        return view($blade_prefix.'::livewire.lepage', ['bodyHtml' => $bodyHtml, 'title' => 'fromLePageRender']);

        $this->justMounted = false;

        // LePage means we clicked on something and we want a big chunck to swap out.  Lets get that swap.


        $route = app('router')->getRoutes()->match(app('request')->create($this->pageRoute, 'GET'));
        #dd($route);

        $controllerAtMethod_asString = $route->action['controller'];
        // Turn  'App\Http\Controllers\AdminController@showAdminFronts' into 'App\Http\Controllers\AdminController@showAdminBody'
        //  cuz we are livewire here - we already have the shell
        $controllerAtMethod_asString = str_replace('Fronts', 'Body', $controllerAtMethod_asString);

        // If refreshing, the params need to be put back into the url.  Probably should have just stored it. oh well.
        $reconstructedUrl = implode('/', $route->parameters);
        foreach ($this->asrParams as $key => $val) {
            $reconstructedUrl .= "/$key/$val";
        }

        $innerView = \App::call($controllerAtMethod_asString, ['subLevels' => $reconstructedUrl]);
        $innerHtml = $innerView->getView();
        $blade_prefix = \TallAndSassy\PageGuide\PageGuideServiceProvider::$blade_prefix;
        $this->justMounted = false;

        return view($blade_prefix.'::livewire.lepage', ['innerHtml' => $innerHtml]);
    }

    public static function wireSwaplinkInA(string $url)
    {
        // Note: close(); is there to force closing of any open modal
        // 8/20' Known Issue: Calls close() twice.  Everything is always getting closed twice.
        # wire:click="\$emit('pageRoute','$url')"
        # Livewire.emit('universalHandle_butActuallyForPollingCard','10')

        return <<<EOD
        x-on:click.prevent="maybeCloseAdminMenu(); urlChange('$url'); Livewire.emit('pageRoute','$url');"
        href="{$url}"
        EOD;
    }
}
