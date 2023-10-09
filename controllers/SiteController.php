<?php

namespace App\Core;

use App\Model\Category;
use App\Model\Product;
use App\Cart\Cart;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $category_obj = new Category();
        $product_obj = new Product();

        $data = [
            'vars' => [
                'category' => $category_obj->getCategoryList(),
                'latestProducts' => $product_obj->getLatestProducts(4)
            ],
            'objects' => [
            'cart' => new Cart()
            ]
        ];

        $view = ROOT . '/views/site/index.php';
        $title = 'Bookshop';

        $this->render($view, $data, $title);

        return true;
    }

    public function actionPageNotFound()
    {
        require_once(ROOT . '/views/404/404.php');

        return true;
    }
}
