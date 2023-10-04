<?php
namespace App\Core;
use App\Model\Category;
use App\Model\Product;

class ProductController
{   
    public function actionView($productId)
    {   
        $category_obj = new Category();
        $product_obj = new Product();
    
        $category = array();
        $category = $category_obj->getCategoryList();
        $product = $product_obj->getProductById($productId);

        require_once(ROOT . '/views/product/view.php');
        
        return true;
    }
}