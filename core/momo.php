<?php 
namespace core;

class momo
{
	public static $classmap = array();
	public static function run()
	{
		p('ok');
		$route = new \core\lib\route();
	}

	public static function load($class)
	{
		//自动加载类库
		// new \core\route();
		// $class = "\core\route";
		// MOMO . '/core/route.php';
		str_replace('\\', '/', $class);

		if (isset($classmap[$class])) {
			return true;
		}else{
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