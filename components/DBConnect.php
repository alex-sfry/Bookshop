<?php
namespace DBConnect;
/**
 * Class DBConnect
 * класс подключения к БД
 * исп статические свойства и методы - обращение без создания объекта класса
 */
class DBConnect
{

	// константы класса
	const DB_NAME = 'book_shop';
	const DB_HOST = 'localhost:9000';
	const DB_LOGIN = '';
	const DB_PASSWORD = '';

	// статические методы
	// получаем строку DSN
	private static function getDSN(){
		return "mysql:dbname=".self::DB_NAME.";host=".self::DB_HOST;
	}

	// получаем объект соединения с БД
	public static function getConnection(){
		return new \PDO(self::getDSN(), self::DB_LOGIN, self::DB_PASSWORD,
									[
										\PDO::ATTR_DEFAULT_FETCH_MODE =>\PDO::FETCH_ASSOC,
										\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
									]);
	}

	public static function d($arr){
		echo '<pre>';
		print_r($arr);
		echo '</pre>';
	}

}
