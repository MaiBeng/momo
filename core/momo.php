<?php 
namespace core;

class momo
{
	public static $classmap = array();
	public $assign;
	public static function run()
	{
		\core\lib\log::init();
		$route = new \core\lib\route();
		$ctrlClass = $route->ctrl;
		$action = $route->action;
		$ctrlfile = APP.'/ctrl/'.$ctrlClass.'Ctrl.php';
		$clctrlClass = '\\'.MODULE.'\ctrl\\'.$ctrlClass.'Ctrl';
		if (is_file($ctrlfile)) {
			include $ctrlfile;
			$ctrl = new $clctrlClass();
			$ctrl->$action();
			\core\lib\log::log('ctrl:'.$ctrlClass.'  action:'.$action);
		}else{
			throw new \Exception("找不到控制器".$ctrlClass);
		}
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

	public function assign($name, $value)
	{
		$this->assign[$name] = $value;
	}

	public function display($file)
	{
		$file = APP.'/views/'.$file;
		if (is_file($file)) {
			extract($this->assign);	//将数组键名作为变量名，键值作为变量值输出
			include $file;
		}
	}
}