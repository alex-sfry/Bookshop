<?php 

return array (
    'product/([0-9]+)' => 'product/view/$1', // actionView in ProductConroller

    'books' => 'books/index', // actionIndex in BooksConroller

    'category/([0-9]+)' => 'books/category/$1', // actionCategory in BooksConroller

    '' => 'site/index', // actionIndex in SiteConroller
);