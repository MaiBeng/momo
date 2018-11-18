<?php
namespace core\lib;
use core\lib\conf;

/**
 * 模型类
 */
class model extends \PDO
{
	function __construct()
	{
		$database = conf::all('database');
		
		try {
			parent::__construct($database['DSN'], $database['USERNAME'], $database['PASSWD']);
		} catch (\PDOException $e) {
			p($e->getMessage());
		}
	}
}