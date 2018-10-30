<?php 
namespace core;

class momo
{
	public static $classmap = array();
	public static function run()
	{
		$route = new \core\lib\route();
		p($route);
	}

	public static function load($class)
	{
		//自动加载类库
		// new \core\route();
		// $class = "\core\route";
		// MOMO . '/core/route.php';

		if (isset($classmap[$class])) {
			return true;
		}else{
			str_replace('\\', '/', $class);
			$file = MOMO . '/' . $class . '.php';
			if (is_file($file)) {
				require_once $file;
				self::$classmap[$class] = $class;
			}else{
				return false;
			}
		}
	}
}