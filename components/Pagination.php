<?php

namespace App\cPag;

/**
 * [Class Pagination]
 */
class Pagination
{
    private float $pages_count;
    private int $current_page;
    private int $limit;
    private string $pattern;
    private string $prev_link = '';
    private string $next_link = '';
    private string $main = '';
    private string $reg_exp;
    private int $i = 1;

    /**
     * @param int $pages_count
     * @param int $current_page
     * @param int $limit
     * @param string $pattern
     */
    public function __construct(float $pages_count, int $current_page, int $limit, string $pattern)
    {
        $this->pages_count = $pages_count;
        $this->current_page = $current_page;
        $this->limit = $limit;
        $this->pattern = $pattern;
        $this->reg_exp = '/' . $pattern . '([0-9]+)/';
    }

    /**
     * @return string
     */
    public function init(): string
    {
        $uri = explode("/", $_SERVER['REQUEST_URI']);
        $uri[count($uri) - 1] == '' && array_pop($uri);
        $page_main = preg_match($this->reg_exp, $uri[count($uri) - 1]) ?
            implode('/', array_slice($uri, 0, -1)) . '/' : '';
        $page_pattern = preg_match($this->reg_exp, $uri[count($uri) - 1]) ?
            substr($uri[count($uri) - 1], 0, -1) :
                implode('/', $uri) . '/' . $this->pattern;
// current page
        $this->currentPage($uri);
// back button
        $this->prevLink($page_main, $page_pattern);
// forward button
        $this->nextLink($page_main, $page_pattern);
        $range = intdiv($this->current_page, $this->limit);
// last page in page select list depending on position
        $last = $this->minPage($range);
        $last = $this->maxPage($range);
// pages html
        $this->mainHTML($page_main, $page_pattern, $last);
        $html = '';
        $html .= "<ul class='pagination' style='display: flex; gap: 10px;'>" .
                    $this->prev_link . $this->main . $this->next_link . "</ul>";
        return $html;
    }

    /**
     * @param array $uri
     *
     * @return void
     */
    private function currentPage(array $uri): void
    {
        preg_match($this->reg_exp, $uri[count($uri) - 1]) &&
            $this->current_page = substr($uri[count($uri) - 1], -1);
    }

    /**
     * @param string $page_main
     * @param string $page_pattern
     *
     * @return void
     */
    private function prevLink(string $page_main, string $page_pattern): void
    {
        if ($this->pages_count > 1 && $this->current_page > 1) {
            $this->prev_link = "<li class='pagination__item pagination__arrow'>
            <a href='" . $page_main . $page_pattern . $this->current_page - 1 . "'> < </a>
                </li>";
        }
    }

    /**
     * @param string $page_main
     * @param string $page_pattern
     *
     * @return void
     */
    private function nextLink(string $page_main, string $page_pattern): void
    {
        if ($this->pages_count > 1 && $this->current_page < $this->pages_count) {
            $this->next_link = "<li class='pagination__item pagination__arrow'>
            <a href='" . $page_main . $page_pattern . $this->current_page + 1 . "'> > </a>
                </li>";
        }
    }

    /**
     * @param int $range
     *
     * @return int
     */
    private function minPage(int $range): float
    {
        $range >= 1 && $this->current_page > $range * $this->limit ?
            $this->i = $this->limit * $range + 1 :
                $this->i = $this->limit * $range - ($this->limit - 1);
        $range == 0 && $this->i = 1;
        if ($this->current_page < 2 && $this->pages_count > 2) {
            if ($this->pages_count > $this->limit - 1) {
                $last = $this->limit;
            } else {
                $last = $this->pages_count;
            }
        } else {
            $this->pages_count - $this->current_page > $this->limit - 1 ?
                    $last = $this->current_page + $this->limit - 1 : $last = $this->pages_count;
        }

        return $last;
    }

    /**
     * @param int $range
     *
     * @return int
     */
    private function maxPage(int $range): float
    {
        $range > 0 && $this->current_page > $range * $this->limit ?
            $last = ($range + 1) * $this->limit : $last = $range * $this->limit;
        $range == 0 && $last = $this->limit;
        $last > $this->pages_count && $last = $this->pages_count + 1;
        return $last;
    }

    /**
     * @param int $page_main
     * @param string $page_pattern
     * @param int $last
     *
     * @return void
     */
    private function mainHTML(string $page_main, string $page_pattern, float $last): void
    {
        $active = '';
        while ($this->i <= $last) {
            if ($this->i == $this->current_page) {
                $active = '_active';
            } else {
                $active = '';
            }
            $this->main .= "<li class='pagination__item" . $active . "'>
            <a href='" . $page_main . $page_pattern . $this->i . "'>" . $this->i . "</a>
                </li>";
            $this->i++;
        };
    }
}
