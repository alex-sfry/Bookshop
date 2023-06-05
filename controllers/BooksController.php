<?php

include_once(ROOT . '/models/Category.php');
include_once(ROOT . '/models/Product.php');

class BooksController
{
    public function actionIndex()
    {   
        $category = array();
        
        $category = Category::getCategoryList();

        $latestProducts = array();
        $latestProducts = Product::getLatestProducts(8);

        require_once(ROOT . '/views/books/index.php');
        
        return true;
    }

    public function actionCategory($categoryId)
    {   
        $category = array();
        
        $category = Category::getCategoryList();

        $categoryProducts = array();
        $categoryProducts = Product::getProductsListByCategory($categoryId);

        require_once(ROOT . '/views/books/category.php');
        
        return true;
    }
}