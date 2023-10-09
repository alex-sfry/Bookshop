<?php

namespace DBConnect;

/**
 * Class DBConnect
 * connect to DB
 */

class DBConnect
{
    // get DSN string
    private function getDSN()
    {
        return "mysql:dbname=" . DB_NAME . ";host=" . DB_HOST;
    }

    //get DB connection object
    public function getConnection()
    {
        return new \PDO(
            $this->getDSN(),
            DB_LOGIN,
            DB_PASSWORD,
            [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            ]
        );
    }

    /**
     * @param mixed $arr
     * 
     */
    public static function d($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
}
