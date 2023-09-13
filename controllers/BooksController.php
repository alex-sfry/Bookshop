<?php
namespace App\Core;
use App\Model\Category;
use App\Model\Product;
use App\cPag\Pagination;

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

        $pagination = new Pagination ($pages_count, 1, 4, 'page-');

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

        $pagination = new Pagination ($pages_count, 1, 4, 'page-');

        require_once(ROOT . '/views/books/category.php');

        return true;
    }
}
