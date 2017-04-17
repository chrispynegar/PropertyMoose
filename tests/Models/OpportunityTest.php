<?php

namespace Tests\Models;

use App\Models\Opportunity;

class OpportunityTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    function can_we_get_opportunities()
    {
        $opportunities = Opportunity::get();

        $this->assertInternalType('array', $opportunities);
        $this->assertNotEmpty($opportunities);
    }
}
