<?php

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
}