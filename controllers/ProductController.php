<?php
namespace App\Core;
use App\Model\Category;
use App\Model\Product;

class ProductController
{
    public function actionView($productId)
    {
        $category = array();

        $category = Category::getCategoryList();

        $product = Product::getProductById($productId);

        require_once(ROOT . '/views/product/view.php');
        
        return true;
    }
}