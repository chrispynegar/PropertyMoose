<?php

namespace Tests\Libraries;

use App\Libraries\Crawl;
use Symfony\Component\DomCrawler\Crawler;

class CrawlTest extends \PHPUnit\Framework\TestCase
{
    private $c;

    public function setUp()
    {
        // Crawl initial page.
        $this->c = Crawl::source(PROPERTIES_URL);
    }

    /** @test */
    function can_we_get_the_source_url()
    {
        $this->assertEquals(PROPERTIES_URL, $this->c->getUrl());
        $this->assertInternalType('string', $this->c->getUrl());
    }

    /** @test */
    function can_we_get_the_source()
    {
        $this->assertInternalType('string', $this->c->getSource());
    }

    /** @test */
    function can_we_get_the_crawler_object()
    {
        $this->assertInstanceOf(Crawler::class, $this->c->crawler());
    }
}
