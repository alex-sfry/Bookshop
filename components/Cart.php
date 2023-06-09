<?php

class Cart
{
    public static function addProduct($id)
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
        //echo '<pre>'; print_r( $_SESSION['products']);

        return self::countItems();
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