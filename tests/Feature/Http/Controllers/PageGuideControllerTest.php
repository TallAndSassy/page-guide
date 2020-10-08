<?php


namespace TallAndSassy\PageGuide\Tests\Feature\Http\Controllers;

class PageGuideControllerTest extends \TallAndSassy\PageGuide\Tests\TestCase
{
    /** @test */
    public function global_urls_returns_ok()
    {
        // Test hard-coded routes...
        $this
            ->get('/grok/TallAndSassy/PageGuide/sample_string')
            ->assertOk()
            ->assertSee('Hello PageGuide string via global url.');
        $this
            ->get('/grok/TallAndSassy/PageGuide/sample_blade')
            ->assertOk()
            ->assertSee('Hello PageGuide from blade in TallAndSassy/PageGuide/groks/sample_blade');
        $this
            ->get('/grok/TallAndSassy/PageGuide/controller')
            ->assertOk()
            ->assertSee('Hello PageGuide from: TallAndSassy\PageGuide\Http\Controllers\PageGuideController::sample');
    }


    /** @test */
    public function prefixed_urls_returns_ok()
    {
        // Test user-defined routes...
        // Reproduce in routes/web.php like so
        //  Route::tassy('staff');
        //  http://test-tallandsassy.test/staff/TallAndSassy/PageGuide/string
        //  http://test-tallandsassy.test/staff/TallAndSassy/PageGuide/blade
        //  http://test-tallandsassy.test/staff/TallAndSassy/PageGuide/controller
        $userDefinedBladePrefix = $this->userDefinedBladePrefix; // user will do this in routes/web.php Route::tassy('url');

        // string
        $this
            ->get("/$userDefinedBladePrefix/TallAndSassy/PageGuide/sample_string")
            ->assertOk()
            #->assertSee('hw(TallAndSassy\PageGuide\Http\Controllers\PageGuideController)');
        ->assertSee('Hello PageGuide string via blade prefix');

        // blade
        $this
            ->get("/$userDefinedBladePrefix/TallAndSassy/PageGuide/sample_blade")
            ->assertOk()
            ->assertSee('Hello PageGuide from blade in TallAndSassy/PageGuide/groks/sample_blade');

        // controller
        $this
            ->get("/$userDefinedBladePrefix/TallAndSassy/PageGuide/controller")
            ->assertOk()
            ->assertSee('Hello PageGuide from: TallAndSassy\PageGuide\Http\Controllers\PageGuideController::sample');
    }
}
