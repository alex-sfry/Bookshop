<?php

namespace App\Cart;

/**
 * [Class Cart]
 */
class Cart
{
    /**
     * @param int $id
     *
     * @return int
     */
    public function addProduct(int $id): int
    {
        $id = intval($id);

        $productsInCart = array();

        if (isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];
        }

        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id]++;
        } else {
            $productsInCart[$id] = 1;
        }

        $_SESSION['products'] = $productsInCart;

        return $this->countItems();
    }

    /**
     * @return int
     */
    public static function countItems(): int
    {
        if (isset($_SESSION['products'])) {
            $count = 0;

            foreach ($_SESSION['products'] as $id => $qty) {
                $count = $count + $qty;
            }

            return $count;
        } else {
            return 0;
        }
    }
}
