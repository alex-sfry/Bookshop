<?php

class CartController
{
    public function actionAdd($id)
    {
        Cart::addProduct($id);

        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer");
    }

    public function actionAddAjax($id)
    {   
        echo json_encode(Cart::addProduct($id));

        return true;
    }

    public function actionIndex()
    {   
        echo '<pre>'; print_r( $_SESSION['products']);
        // $categories = array();
        // $categories = Category::getCategoryList();

        // $productsInCart =false;

        // if ($productsInCart) {
        //     //$productIds


        // }

        return true;
    } 
}