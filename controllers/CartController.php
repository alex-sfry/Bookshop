<?php
namespace App\Core;
use App\Cart\Cart;

class CartController
{   
    public function actionAdd($id)
    {   
        $cart_obj = new Cart();

        $cart_obj->addProduct($id);

        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer");
    }

    public function actionAddAjax($id)
    {   
        $cart_obj = new Cart();

        echo json_encode( $cart_obj->addProduct($id));

        return true;
    }

    public function actionIndex()
    {   
        if (!isset($_SESSION['products'])) {
            echo 'Cart is empty.';
            return true;
        }
        echo '<pre>'; print_r( $_SESSION['products']);

        // $category_obj = new Category();
        
        // $categories = array();
        // $categories = $category_obj->getCategoryList();

        // $productsInCart =false;

        // if ($productsInCart) {
        //     //$productIds


        // }

        return true;
    } 
}