<?php

namespace App\Core;

use App\Model\Category;
use App\Model\Product;
use App\Cart\Cart;

/**
 * [Class ProductController]
 */
class ProductController extends Controller
{
    /**
     * @param int $productId
     *
     * @return bool
     */
    public function actionView(int $productId): bool
    {
        $category_obj = new Category();
        $product_obj = new Product();

        $data = [
            'vars' => [
                'category' => $category_obj->getCategoryList(),
                'product' => $product_obj->getProductById($productId)
            ],
            'objects' => [
                'cart' => new Cart(),
            ]
        ];

        $view = ROOT . '/views/product/view.php';
        $title = 'Bookshop';

        $this->render($view, $data, $title);

        return true;
    }
}
