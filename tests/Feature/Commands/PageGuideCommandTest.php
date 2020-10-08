<?php


namespace TallAndSassy\PageGuide\Tests\Feature\Commands;

class PageGuideCommandTest extends \TallAndSassy\PageGuide\Tests\TestCase
{
    /** @test */
    public function test_command_works()
    {
        $this->artisan('tassy:somecommand')->assertExitCode(0);
        $this->artisan('tassy:somecommand')->expectsOutput('TallAndSassy/PageGuide/hw/tbd');
    }
}
