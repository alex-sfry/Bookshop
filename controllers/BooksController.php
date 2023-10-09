<?php

namespace App\Core;

use App\Model\Category;
use App\Model\Product;
use App\cPag\Pagination;
use App\Cart\Cart;

class BooksController extends Controller
{
    public function actionIndex($page = 1)
    {
        $category_obj = new Category();
        $product_obj = new Product();

        $pages_count = $product_obj->getLatestProductsPagesCount();

        $data = [
            'vars' => [
                'category' => $category_obj->getCategoryList(),
                'latestProducts' =>  $product_obj->getLatestProducts(8, $page),
                'pages_count' => $product_obj->getLatestProductsPagesCount()
            ],
            'objects' => [
                'cart' => new Cart(),
                'pagination' => new Pagination($pages_count, 1, 4, 'page-')
            ]
        ];

        $view = ROOT . '/views/books/index.php';
        $title = 'Bookshop';

        $this->render($view, $data, $title);

        return true;
    }

    public function actionCategory($categoryId, $page = 1)
    {
        $category_obj = new Category();
        $product_obj = new Product();

        $pages_count = $product_obj->getProductsByCategoryPagesCount($categoryId);

        $data = [
            'vars' => [
                'category' => $category_obj->getCategoryList(),
                'categoryProducts' => $product_obj->getProductsListByCategory($categoryId, $page),

            ],
            'objects' => [
                'cart' => new Cart(),
                'pagination' => new Pagination($pages_count, 1, 4, 'page-')
            ]
        ];

        $view = ROOT . '/views/books/category.php';
        $title = 'Bookshop';

        $this->render($view, $data, $title);

        return true;
    }
}
