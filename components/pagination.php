<?php

class Pagination
{   
    private  $pages_count;
    private  $page;
    private  $limit;
    private $url;


    public function __construct( $pages_count, $page, $limit )
    {
        $this->pages_count = $pages_count;
        $this->page = $page;
        $this->limit = $limit;
        $this->url = $url;
    }


    public function get()
    {
        $last = 0;
        $range = intdiv($this->page,  $this->limit);

        // min page in page list
        $range >= 1 && $this->page > $range * $this->limit ? $i = $this->limit * $range + 1 : $i = $this->limit * $range - 3;
        $range == 0 && $i = 1;

        if ($this->page < 2 && $this->pages_count > 2) {
            if ($this->pages_count > 3) {
                $last = $this->limit;
            } else $last = $this->pages_count;
        } else $this->pages_count - $this->page > 3 ? $last = $this->page + 3 : $last = $this->pages_count;

        //max page in page list
        $range > 0 && $this->page > $range * $this->limit ? $last = ($range + 1) * $this->limit : $last = $range * $this->limit;
        $range == 0 &&  $last = $this->limit;
        $last > $this->pages_count && $last = $this->pages_count + 1;
        
        $prev_link = '';
        $main = '';
        $next_link = '';

        if ($this->pages_count > 1 && $this->page > 1) {
            $prev_link =  $this->url . $this->page - 1 . "'> < </a>
                </li>";
        }

        if ($this->pages_count > 1 && $this->page < $this->pages_count) {
            $next_link = $this->url . $this->page + 1 . "'> > </a>
                </li>";
        }
        
        while ($i <= $last) {
            $main = "<li class='pagination__item'>
            <a href='/category/" . $categoryId . "/page-" . $i . "'>" . $i . "</a>
                </li>";
            $i++;
        };


        
        // `if ($this->pages_count > 1 && $this->page > 1) {
        //     echo "<li class='pagination__item'>
        //         <a href='/books/page-" . $this->page - 1 . "'> < </a>
        //         </li>";
        // }

        // while ($i <= $last) {
        //     echo "<li class='pagination__item'>
        //         <a href='/books/page-" . $i . "'>" . $i . "</a>
        //         </li>";
        //     $i++;
        // };

        // if ($this->pages_count > 1 && $this->page < $this->pages_count) {
        //     echo "<li class='pagination__item'>
        //         <a href='/books/page-" . $this->page + 1 . "'> > </a>
        //         </li>";
        // }`;

        $html = '';
        $html .= $prev_link . $main . $next_link;
        return $html;
    }
}



    // $last = 0;
    // $range = intdiv($page,  4);

    // // min page in page list
    // $range >= 1 && $page > $range * 4 ? $i = 4 * $range + 1 : $i = 4 * $range - 3;
    // $range == 0 && $i = 1;

    // if ($page < 2 && $pages_count > 2) {
    //     if ($pages_count > 3) {
    //         $last = 4;
    //     } else $last = $pages_count;
    // } else $pages_count - $page > 3 ? $last = $page + 3 : $last = $pages_count;

    // //max page in page list
    // $range > 0 && $page > $range * 4 ? $last = ($range + 1) * 4 : $last = $range * 4;
    // $range == 0 &&  $last = 4;
    // $last > $pages_count && $last = $pages_count + 1;

    // if ($pages_count > 1 && $page > 1) {
    //     echo "<li class='pagination__item'>
    //             <a href='/books/page-" . $page-1 . "'> < </a>
    //             </li>";
    // } 

    // while ($i <= $last) {
    //     echo "<li class='pagination__item'>
    //             <a href='/books/page-" . $i . "'>" . $i . "</a>
    //             </li>";
    //     $i++;
    // };

    // if ($pages_count > 1 && $page < $pages_count) {
    //     echo "<li class='pagination__item'>
    //             <a href='/books/page-" . $page+1 . "'> > </a>
    //             </li>";
    // }
