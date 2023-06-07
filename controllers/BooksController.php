<?php

class BooksController
{
    public function actionIndex($page = 1)
    {
        $category = array();

        $category = Category::getCategoryList();

        $latestProducts = array();
        $latestProducts = Product::getLatestProducts(8, $page);
        $pages_count = Product::getLatestProductsPagesCount();
        //$products_count = Product::getLatestProductsCount();

        require_once(ROOT . '/views/books/index.php');

        return true;
    }

    public function actionCategory($categoryId, $page = 1)
    {
        $category = array();

        $category = Category::getCategoryList();

        $categoryProducts = array();
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);
        $pages_count = Product::getProductsByCategoryPagesCount($categoryId);

        require_once(ROOT . '/views/books/category.php');

        return true;
    }
}
