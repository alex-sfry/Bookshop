<?php
namespace App\Cart;

class Cart
{
    public function addProduct($id)
    {   
        $id = intval($id);

        $productsInCart = array();

        if (isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];
        }

        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id]++;
        } else  $productsInCart[$id] = 1;

        $_SESSION['products'] = $productsInCart;

        return $this->countItems();
    }

    public static function countItems()
    {
        if (isset($_SESSION['products'])) {
            $count = 0;

            foreach ($_SESSION['products'] as $id => $qty) {
                $count = $count + $qty;
            }

            return $count;
        } else return 0;
    }
}