<?php
namespace App\Core;
use App\Model\Category;
use App\Model\Product;
use App\cPag\Pagination;

class BooksController
{   
    private $category_obj;
    private $product_obj;
    
    public function __construct()
    {   
        $this->category_obj = new Category();
        $this->product_obj = new Product();
    }

    public function actionIndex($page = 1)
    {
        $category = array();
        $category =  $this->category_obj->getCategoryList();

        $latestProducts = array();
        $latestProducts = $this->product_obj->getLatestProducts(8, $page);
        $pages_count =$this->product_obj->getLatestProductsPagesCount();
        //$products_count = $this->product_obj->getLatestProductsCount();

        $pagination = new Pagination ($pages_count, 1, 4, 'page-');

        require_once(ROOT . '/views/books/index.php');

        return true;
    }

    public function actionCategory($categoryId, $page = 1)
    {
        $category = array();
        $category =  $this->category_obj->getCategoryList();

        $categoryProducts = array();
        $categoryProducts = $this->product_obj->getProductsListByCategory($categoryId, $page);
        $pages_count = $this->product_obj->getProductsByCategoryPagesCount($categoryId);

        $pagination = new Pagination ($pages_count, 1, 4, 'page-');

        require_once(ROOT . '/views/books/category.php');

        return true;
    }
}
