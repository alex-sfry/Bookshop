<?php

namespace App\Model;

use DBConnect\DBConnect;

/**
 * [class Product]
 */
class Product
{
    private const SHOW_BY_DEFAULT = 8;

    /**
     * @param int $count
     * @param int $page
     * @param object | null $pagination
     *
     * @return array
     */
    public function getLatestProducts(
        int $count = self::SHOW_BY_DEFAULT,
        int $page = 1,
        object $pagination = null
    ):
    array
    {
        $db = new DBConnect();
        $conn = $db->getConnection();

        $page = intval($page);
        $offset  = ($page - 1) * $count;

        $count = intval($count);

        $productList = array();

        $limit = $pagination ? (($pagination->get_page() - 1) * $count) . ', ' . $count : $offset . ', ' . $count;

//        $sql = 'SELECT books.id AS id, author_id, `name`, price, `image`, isNew, authors.id AS a_id, author
//                FROM books, authors
//                WHERE status = "1"
//                AND author_id = authors.id
//                ORDER BY books.id DESC
//                LIMIT ' . $count . ' OFFSET ' . $offset;

        $sql = '
                SELECT books.id AS id, author_id, `name`, price, `image`, isNew, authors.id AS a_id, author
                FROM books, authors
                WHERE status = "1"
                AND author_id = authors.id
                ORDER BY books.id DESC
                LIMIT ' . $limit . '
        ';

        return $this->getProductsList($conn, $sql, $productList);
    }

    /**
//     * @param int $count_per_page
     *
     * @return int
     */
    public function getLatestProductsPagesCount(/*int $count_per_page = self::SHOW_BY_DEFAULT*/): int
    {
        $db = new DBConnect();
        $conn = $db->getConnection();

        $sql = "SELECT COUNT(*) AS rows_qty
                FROM books";

        $result = $conn->prepare($sql);
        $result->execute();

        $count = $result->fetchColumn();
//        $pages_count = $count / $count_per_page;

//        return  $pages_count;
        return $count;
    }

    /**
     * @param int | bool $categoryId
     * @param int $page
     *
     * @return array | null
     */
    public function getProductsListByCategory(int | bool $categoryId = false, int $page = 1): array | null
    {
        if ($categoryId) {
            $db = new DBConnect();
            $conn = $db->getConnection();

            $page = intval($page);
            $offset  = ($page - 1) * self::SHOW_BY_DEFAULT;

            $products = array();

            $sql = "SELECT books.id AS id, author_id, `name`, price, `image`, isNew, authors.id AS a_id, author
                    FROM books, authors
                    WHERE status = '1'
                    AND author_id = authors.id
                    AND category_id = '$categoryId'
                    ORDER BY books.id DESC
                    LIMIT " . self::SHOW_BY_DEFAULT
                    . " OFFSET " . $offset;

            return $this->getProductsList($conn, $sql, $products);
        } else {
            return null;
        }
    }

    /**
     * @param int | bool $categoryId
     *
     * @return int | null
     */
    public function getProductsByCategoryPagesCount(int | bool $categoryId = false): int | null
    {
        if ($categoryId) {
            $db = new DBConnect();
            $conn = $db->getConnection();

            $sql = "SELECT COUNT(*) AS rows_qty
                    FROM books
                    WHERE category_id = '$categoryId'";

            $result = $conn->prepare($sql);
            $result->execute();

            $count = $result->fetchColumn();
//            $pages_count = $count / self::SHOW_BY_DEFAULT;

            return  $count;
        } else {
            return null;
        }
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function getProductById(int $id): mixed
    {
        $id = intval($id);

        if ($id) {
            $db = new DBConnect();
            $conn = $db->getConnection();

            $sql = "SELECT *
                    FROM books, authors
                    WHERE books.id = '$id'
                    AND books.author_id = authors.id";

            $result = $conn->prepare($sql);
            $result->execute();

            return $result->fetch();
        } else {
            return null;
        }
    }

    /**
     * @param \PDO $conn
     * @param string $sql
     * @param array $productList
     *
     * @return array
     */
    public function getProductsList(\PDO $conn, string $sql, array $productList): array
    {
        $result = $conn->prepare($sql);
        $result->execute();

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
