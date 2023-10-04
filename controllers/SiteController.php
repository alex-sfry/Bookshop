<?php
namespace App\Core;
use App\Model\Category;
use App\Model\Product;


class SiteController
{   
    private $category_obj;
    private $product_obj;
    
    public function __construct()
    {   
        $this->category_obj = new Category();
        $this->product_obj = new Product();
    }

    public function actionIndex()
    {   
        

        $category = array();       
        $category =  $this->category_obj->getCategoryList();

        $latestProducts = array();
        $latestProducts = $this->product_obj->getLatestProducts(4);


        require_once(ROOT . '/views/site/index.php');
        
        return true;
    }

    public function actionPageNotFound()
    {   
        require_once(ROOT . '/views/404/404.php');
        
        return true;
    }
}