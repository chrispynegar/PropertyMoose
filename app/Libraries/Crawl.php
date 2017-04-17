<?php

namespace App\Libraries;

use Symfony\Component\DomCrawler\Crawler;

class Crawl
{
    /**
     * @var string
     */
    private $url = '';

    /**
     * @var string
     */
    private $source = '';

    /**
     * @var Symfony\Component\DomCrawler\Crawler
     */
    private $crawler;

    /**
     * Constructor.
     *
     * @param  string  $url
     * @return void
     */
    public function __construct(string $url)
    {
        $this->setUrl($url);
        $this->crawl();
    }

    /**
     * Get the URL that we're crawling.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set the URL to crawl.
     *
     * @param  string  $url
     * @return Crawl
     */
    private function setUrl(string $url): Crawl
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Gets the source that we're crawling from the defined URL.
     *
     * @return string
     */
    public function getSource()
    {
        // Have we already got the source contents?
        if ($this->source !== '')
        {
            return $this->source;
        }

        // Retrieve the source.
        return $this->source = file_get_contents($this->url);
    }

    /**
     * Gets the crawler object.
     *
     * @return Symfony\Component\DomCrawler\Crawler
     */
    public function crawler(): Crawler
    {
        return $this->crawler;
    }

    /**
     * Crawls the source.
     *
     * @return Symfony\Component\DomCrawler\Crawler
     */
    private function crawl(): Crawler
    {
        return $this->crawler = new Crawler($this->getSource());
    }

    /**
     * Filters through the source.
     *
     * @param  string  $selector
     * @return
     */
    public function filter(string $selector)
    {
        return $this->crawler->filter($selector);
    }

    /**
     * Crawl content from the defined source.
     *
     * @param  string  $url
     * @return
     */
    public static function source(string $url)
    {
        $class = get_called_class();
        return new $class($url);
    }
}
