<?php

namespace DBConnect;

/**
 * Class DBConnect
 * connect to DB
 */

class DBConnect
{
    // static methods

    // get env variables
    private static function getEnvVars()
    {
        $env_file_path = dirname(__DIR__) . "/.env";

        //Check .envenvironment file exists
        if (!is_file($env_file_path)) {
            throw new \ErrorException("Environment File is Missing.");
        }
        //Check .envenvironment file is readable
        if (!is_readable($env_file_path)) {
            throw new \ErrorException("Permission Denied for reading the " . ($env_file_path) . ".");
        }
        //Check .envenvironment file is writable
        if (!is_writable($env_file_path)) {
            throw new \ErrorException("Permission Denied for writing on the " . ($env_file_path) . ".");
        }

        $var_arrs = array();
        // Open the .en file using the reading mode
        $fopen = fopen($env_file_path, 'r');
        if ($fopen) {
            //Loop the lines of the file
            while (($line = fgets($fopen)) !== false) {
                // Split the line variable and succeeding comment on line if exists
                $line_no_comment = explode("#", $line, 2)[0];
                // Split the variable name and value
                $env_ex = preg_split('/(\s?)\=(\s?)/', $line_no_comment);
                $env_name = trim($env_ex[0]);
                $env_value = isset($env_ex[1]) ? trim($env_ex[1]) : "";
                $var_arrs[$env_name] = $env_value;
            }
            // Close the file
            fclose($fopen);
        }

        return $var_arrs;
    }

    
    // get DSN string
    private static function getDSN()
    {
        return "mysql:dbname=" . self::getEnvVars()['DB_NAME'] . ";host=" . self::getEnvVars()['DB_HOST'];
    }

    //get DB connection object
    public static function getConnection()
    {
        return new \PDO(
            self::getDSN(),
            self::getEnvVars()['DB_LOGIN'],
            self::getEnvVars()['DB_PASSWORD'],
            [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            ]
        );
    }

    public static function d($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
}
