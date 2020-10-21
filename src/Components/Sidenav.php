<?php

namespace TallAndSassy\PageGuide\Components;

use Livewire\Component;

/*
        [ ] Be sure to registrer this compoent in TallAndSassy/PageGuideServiceProvider.php
            Something like this in the function boot()...
                \Livewire\Livewire::component('tassy::livewire.sidenav',  \TallAndSassy\PageGuide\Components\Sidenav::class);

*/
class Sidenav extends Component
{
    public string $sample_var = "defaultValue"; // {{$sample_var}} is now avail in your blade.

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

    public function render()
    {
        # access via: <livewire:tassy::livewire.sidenav/>
        return view('tassy::livewire.sidenav');
    }
}
