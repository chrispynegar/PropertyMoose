<?php

namespace App\Models;

use App\Libraries\Crawl;

class Opportunity extends Model
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $image_url;

    /**
     * @var float
     */
    public $terms_in_months;

    /**
     * @var float
     */
    public $projected_rent;

    /**
     * @var float
     */
    public $projected_return;

    /**
     * @var float
     */
    public $deal_size;

    /**
     * @var float
     */
    public $investors;

    /**
     * @var float
     */
    public $funded_percent;

    /**
     * @var float
     */
    public $invested;
    /**
     * Crawls for all the available opportunities.
     *
     * @return array
     */
    public static function get()
    {
        $crawler = Crawl::source(PROPERTIES_URL);
        $opportunities = $crawler->filter('.card--property--funding')->each(function ($node, $i) {
            $opportunity = new Opportunity;

            // Get the property title.
            $opportunity->title = strip_whitespace($node->filter('.card__title')->text());

            // Get the property image.
            $image = $node->filter('.card__image')->extract('src');
            $image = 'https://propertymoose.co.uk' . ltrim($image[1], '.');
            $opportunity->image_url = $image;

            // Get the figures.
            $node->filter('.card__figure')->each(function ($node, $i) use ($opportunity) {
                // Get the figure.
                $figure = strip_whitespace($node->text());

                // Determinte the correct key.
                $keys = ['terms_in_months', 'projected_rent', 'projected_return'];
                $key = $keys[$i];

                $opportunity->$key = (float) strip_whitespace($node->text());
            });

            // Get deal information.
            $node->filter('.card__progress__figure__figure')->each(function ($node, $i) use ($opportunity) {
                // Get the figure.
                $figure = strip_whitespace($node->text());

                // Determinte the correct key.
                $keys = ['deal_size', 'investors', 'funded_percent', 'invested'];
                $key = $keys[$i];

                $opportunity->$key = (float) strip_whitespace($node->text());
            });

            return $opportunity;
        });

        return $opportunities;
    }
}
