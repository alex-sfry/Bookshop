<?php
namespace App\Core;
use App\Model\Category;
use App\Model\Product;
use App\cPag\Pagination;

class BooksController
{
    public function actionIndex($page = 1)
    {
        $category_obj = new Category();

        $category = array();
        $category = $category_obj->getCategoryList();

        $product_obj = new Product();

        $latestProducts = array();
        $latestProducts = $product_obj->getLatestProducts(8, $page);
        $pages_count = $product_obj->getLatestProductsPagesCount();
        //$products_count = $product_obj->getLatestProductsCount();

        $pagination = new Pagination ($pages_count, 1, 4, 'page-');

        require_once(ROOT . '/views/books/index.php');

        return true;
    }

    public function actionCategory($categoryId, $page = 1)
    {
        $category_obj = new Category();

        $category = array();
        $category = $category_obj->getCategoryList();

        $product_obj = new Product();

        $categoryProducts = array();
        $categoryProducts = $product_obj->getProductsListByCategory($categoryId, $page);
        $pages_count = $product_obj->getProductsByCategoryPagesCount($categoryId);

        $pagination = new Pagination ($pages_count, 1, 4, 'page-');

        require_once(ROOT . '/views/books/category.php');

        return true;
    }
}
