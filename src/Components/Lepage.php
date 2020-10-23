<?php

namespace TallAndSassy\PageGuide\Components;

use Livewire\Component;

class Lepage extends Component
{
    public string $pageRoute;
    public string $tab = 'tbd';
    public int $count = 98;
    public string $title = 'Default Title';
    public string $tagline = 'For kids!';
    protected $listeners = ['pageRoute' => 'updateToPage', 'tab' => 'tab',];
    public array $asrParams = [];
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

    public function mount(string $pageRoute, array $asrParams)
    {
        #$this->FailOnDeadView($pageRoute);
        $this->pageRoute = $pageRoute;
        $this->asrParams = $asrParams;
    }
    public function render()
    {
        // LePage means we clicked on something and we want a big chunck to swap out.  Lets get that swap.
        $route = app('router')->getRoutes()->match(app('request')->create($this->pageRoute, 'GET'));
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
        $innerHtml = $innerView->render();
        $blade_prefix = \TallAndSassy\PageGuide\PageGuideServiceProvider::$blade_prefix;
        return view($blade_prefix.'::livewire.lepage', ['innerHtml' => $innerHtml]);
    }

    public static function wireSwaplinkInA(string $url)
    {
        // Note: close(); is there to force closing of any open modal
        // 8/20' Known Issue: Calls close() twice.  Everything is always getting closed twice.

        return <<<EOD
        wire:click="\$emit('pageRoute','$url')"
        x-on:click.prevent="maybeCloseAdminMenu(); urlChange('$url');"
        href="{$url}"
        EOD;
    }
}
