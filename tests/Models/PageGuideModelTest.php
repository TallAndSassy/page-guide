<?php

namespace TallAndSassy\PageGuide\Tests\Feature\Models;

use TallAndSassy\PageGuide\Models\PageGuideModel;
use TallAndSassy\PageGuide\Tests\TestCase;

class PageGuideModelTest extends TestCase
{
    /** @test */
    public function it_can_create_a_model()
    {
        $model = PageGuideModel::create(['name' => 'John']);
        $this->assertDatabaseCount('page-guide', 1);
        $this->assertEquals('JOHN', $model->getUpperCasedName());
    }
}
