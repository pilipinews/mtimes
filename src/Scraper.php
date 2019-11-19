<?php

namespace Pilipinews\Website\Mtimes;

use Pilipinews\Common\Article;
use Pilipinews\Common\Interfaces\ScraperInterface;
use Pilipinews\Common\Scraper as AbstractScraper;

/**
 * Manila Times Scraper
 *
 * @package Pilipinews
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class Scraper extends AbstractScraper implements ScraperInterface
{
    /**
     * @var string[]
     */
    protected $removables = array('.tdb-sub-title', '.tdb-flex-min', '.breadcrumb', '.tdb-social-share', '.wp-caption', '.td-a-ad');

    /**
     * Returns the contents of an article.
     *
     * @param  string $link
     * @return \Pilipinews\Common\Article
     */
    public function scrape($link)
    {
        $this->prepare((string) $link);

        $title = $this->title('.tdb-title-text');

        $this->remove($this->removables);

        $body = $this->body('.td-post-content');

        $html = $this->html($body);

        return new Article($title, $html, $link);
    }
}
