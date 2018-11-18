<?php
namespace core\lib;
use core\lib\conf;

/**
 * 日志类
 */
class log
{
	/**
	 * 1.确定日志存储方式
	 * 2.写日志
	 * 日志类
	 * 日志类
	 */
	static $class;

	public static function init()
	{
		//确定存储方式
		$drive = conf::get('DRIVE','log');
		$class = '\core\lib\drive\log\\'.$drive;
		self::$class = new $class;
	}

	public static function log($name)
	{
		self::$class->log($name);
	}
}