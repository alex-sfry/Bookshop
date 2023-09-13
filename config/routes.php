<?php 

return array (
    'product/([0-9]+)' => 'product/view/$1', // actionView in ProductConroller

    'books/page-([0-9]+)' => 'books/index/$1', // actionIndex in BooksConroller
    'books' => 'books/index', // actionIndex in BooksConroller


    'category/([0-9]+)/page-([0-9]+)' => 'books/category/$1/$2', // actionCategory in BooksConroller
    'category/([0-9]+)' => 'books/category/$1', // actionCategory in BooksConroller

    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1', // actionAddAjax в CartController
    //'cart/add/([0-9]+)' => 'cart/add/$1', // actionAdd в CartController for PHP add to cart
    'cart' => 'cart/index', // actionIndex в CartController

    'user/register' => 'user/register', 
    'user/login' => 'user/login',
    'user/logout' => 'user/logout', 

    'account/edit' => 'account/edit',
    'account' => 'account/index',
    
    '(.+)' => 'site/PageNotFound', // 404
    '' => 'site/index', // actionIndex in SiteConroll

);