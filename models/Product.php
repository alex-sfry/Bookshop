<?php
namespace App\Model;
use DBConnect\DBConnect;

class Product
{
    const SHOW_BY_DEFAULT = 8;

    public function getLatestProducts($count = self::SHOW_BY_DEFAULT, $page = 1)
    {   
        $page = intval($page);
        $offset  = ($page - 1) * $count;
        
        $count = intval($count);

        $db = DBConnect::getConnection();

        $productList = array();

        $result = $db->query('SELECT books.id AS id, author_id, `name`, price, `image`, isNew, authors.id AS a_id, author
                              FROM books, authors
                              WHERE status = "1"
                              AND author_id = authors.id
                              ORDER BY books.id DESC
                              LIMIT ' . $count . ' OFFSET ' . $offset);
                                
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

    public function getLatestProductsPagesCount($count_per_page = self::SHOW_BY_DEFAULT)
    {
            $db = DBConnect::getConnection();

            //$products = array();

            $result = $db->query("SELECT COUNT(*) AS rows_qty
                                FROM books");

            $count = $result->fetchColumn();
            $pages_count = $count / $count_per_page;

            return  $pages_count;
    }

    public function getProductsListByCategory($categoryId = false, $page = 1)
    {
        if ($categoryId) {
            $page = intval($page);
            $offset  = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db = DBConnect::getConnection();

            $products = array();

            $result = $result = $db->query("SELECT books.id AS id, author_id, `name`, price, `image`, isNew, authors.id AS a_id, author
                                            FROM books, authors
                                            WHERE status = '1'
                                            AND author_id = authors.id
                                            AND category_id = '$categoryId'
                                            ORDER BY books.id DESC
                                            LIMIT " . self::SHOW_BY_DEFAULT
                                            . " OFFSET " . $offset);

            $i = 0;

            while ($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['author'] = $row['author'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['image'] = $row['image'];
                $products[$i]['isNew'] = $row['isNew'];
                $i++;
            }

            return $products;
        }
    }

    public function getProductsByCategoryPagesCount($categoryId = false)
    {
        if ($categoryId) {
            $db = DBConnect::getConnection();

            //$products = array();

            $result = $db->query("SELECT COUNT(*) AS rows_qty
                                            FROM books
                                            WHERE category_id = '$categoryId'");

            $count = $result->fetchColumn();
            $pages_count = $count / self::SHOW_BY_DEFAULT;

            return  $pages_count;
        }
    }

    public function getProductById($id)
    {
        $id = intval($id);

        if ($id) {
            $db = DBConnect::getConnection();

            $result = $db->query("SELECT *
                                  FROM books, authors
                                  WHERE books.id = '$id'
                                  AND books.author_id = authors.id");

            return $result->fetch();
        }
    }

}
