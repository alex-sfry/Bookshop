<?php
namespace App\Core;
use App\Cart\Cart;

class CartController
{   
    private $cart_obj;
    
    public function __construct()
    {   
        $this->cart_obj = new Cart();
    }

    public function actionAdd($id)
    {   
        $this->cart_obj->addProduct($id);

        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer");
    }

    public function actionAddAjax($id)
    {           
        echo json_encode( $this->cart_obj->addProduct($id));

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