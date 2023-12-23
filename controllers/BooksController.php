<?php

namespace App\Core;

use App\Model\Category;
use App\Model\Product;
//use App\cPag\Pagination;
use App\Cart\Cart;

/**
 * [class BooksController]
 */
class BooksController extends Controller
{
    /**
     * @param int $page
     *
     * @return bool
     */
    public function actionIndex(int $page = 1): bool
    {
        $category_obj = new Category();
        $product_obj = new Product();
        $zPagination = new \Zebra_Pagination();
        $records_per_page = 7;

        $pages_count = $product_obj->getLatestProductsPagesCount();

        $zPagination->records($pages_count);
        $zPagination->records_per_page($records_per_page);
        $zPagination->method('url');
        $zPagination->variable_name('page-');
        $zPagination->selectable_pages(5);

        $data = [
            'vars' => [
                'category' => $category_obj->getCategoryList(),
                'latestProducts' =>  $product_obj->getLatestProducts($records_per_page, $page, $zPagination),
//                'pages_count' => $pages_count,
//                'records_per_page' => 8
            ],
            'objects' => [
                'cart' => new Cart(),
//                'pagination' => new Pagination($pages_count, 1, 4, 'page-')
                'pagination' => $zPagination->render(true)
            ]
        ];

        $view = ROOT . '/views/books/index.php';
        $title = 'Bookshop';

        $this->render($view, $data, $title);

        return true;
    }

    /**
     * @param int $categoryId
     * @param int $page
     *
     * @return bool
     */
    public function actionCategory(int $categoryId, int $page = 1): bool
    {
        $category_obj = new Category();
        $product_obj = new Product();
        $zPagination = new \Zebra_Pagination();
        $records_per_page = 7;

        $pages_count = $product_obj->getProductsByCategoryPagesCount($categoryId);

        $zPagination->records($pages_count);
        $zPagination->records_per_page($records_per_page);
        $zPagination->method('url');
        $zPagination->variable_name('page-');
        $zPagination->selectable_pages(5);

        $data = [
            'vars' => [
                'category' => $category_obj->getCategoryList(),
                'categoryProducts' => $product_obj->getProductsListByCategory($categoryId, $page),

            ],
            'objects' => [
                'cart' => new Cart(),
//                'pagination' => new Pagination($pages_count, 1, 4, 'page-')
                'pagination' => $zPagination->render(true)
            ]
        ];

        $view = ROOT . '/views/books/category.php';
        $title = 'Bookshop';

        $this->render($view, $data, $title);

        return true;
    }
}
