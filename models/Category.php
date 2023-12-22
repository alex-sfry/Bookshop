<?php

namespace App\Model;

use DBConnect\DBConnect;

/**
 * [class Category]
 */
class Category
{
    /**
     * @return array
     */
    public function getCategoryList(): array
    {
        $db = new DBConnect();
        $conn = $db->getConnection();

        $categoryList = array();

        $sql = 'SELECT id, `name`
                FROM categories
                ORDER BY sort_order ASC;';

        $result = $conn->prepare($sql);
        $result->execute();

        $i = 0;

        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }

        return $categoryList;
    }
}
