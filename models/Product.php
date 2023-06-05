<?php

class Product
{
    const SHOW_BY_DEFAULT = 8;

    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);

        $db = DBConnect::getConnection();

        $productList = array();

        $result = $db->query('SELECT books.id AS id, author_id, `name`, price, `image`, isNew, authors.id AS a_id, author
                              FROM books, authors
                              WHERE status = "1"
                              AND author_id = authors.id
                              ORDER BY books.id DESC
                              LIMIT ' . $count);

        $i = 0;

        while ($row = $result->fetch()) {
            $productList[$i]['id'] = $row['id'];
            $productList[$i]['author'] = $row['author'];
            $productList[$i]['name'] = $row['name'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['image'] = $row['image'];
            $productList[$i]['isNew'] = $row['isNew'];
            $i++;
        }

        return $productList;
    }

    public static function getProductsListByCategory($categoryId = false)
    {
        if ($categoryId) {
            $db = DBConnect::getConnection();

            $products = array();

            $result = $result = $db->query("SELECT books.id AS id, author_id, `name`, price, `image`, isNew, authors.id AS a_id, author
                                            FROM books, authors
                                            WHERE status = '1'
                                            AND author_id = authors.id
                                            AND category_id = '$categoryId'
                                            ORDER BY books.id DESC
                                            LIMIT " . self::SHOW_BY_DEFAULT);

            $i = 0;

            while ($row = $result->fetch()) {
                $productList[$i]['id'] = $row['id'];
                $productList[$i]['author'] = $row['author'];
                $productList[$i]['name'] = $row['name'];
                $productList[$i]['price'] = $row['price'];
                $productList[$i]['image'] = $row['image'];
                $productList[$i]['isNew'] = $row['isNew'];
                $i++;
            }

            return $productList;
        }
    }
}
