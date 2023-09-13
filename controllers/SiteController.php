<?php
namespace App\Core;
use App\Model\Category;
use App\Model\Product;

class SiteController
{
    public function actionIndex()
    {   
        $category = array();
        
        $category = Category::getCategoryList();

        $latestProducts = array();
        $latestProducts = Product::getLatestProducts(4);

        require_once(ROOT . '/views/site/index.php');
        
        return true;
    }

    public function actionPageNotFound()
    {   
        require_once(ROOT . '/views/404/404.php');
        
        return true;
    }
}