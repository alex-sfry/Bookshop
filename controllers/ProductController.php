<?php
namespace App\Core;
use App\Model\Category;
use App\Model\Product;

class ProductController
{   
    private $category_obj;
    private $product_obj;
    
    public function __construct()
    {   
        $this->category_obj = new Category();
        $this->product_obj = new Product();
    }

    public function actionView($productId)
    {   

        $category = array();
        $category = $this->category_obj->getCategoryList();
        $product = $this->product_obj->getProductById($productId);

        require_once(ROOT . '/views/product/view.php');
        
        return true;
    }
}