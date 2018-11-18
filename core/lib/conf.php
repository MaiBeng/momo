<?php
namespace core\lib;

/**
 * 配置类
 */
class conf
{
	static public $confRsyn = array();
	static public function get($name,$file)
	{
		/**
		 * 1.判断配置文件是否存在
		 * 2.判断配置是否存在
		 * 3.缓存配置
		 */
		if (isset(self::$confRsyn[$file][$name])) {	// 判断缓存中是否存在该配置
			return self::$confRsyn[$file][$name];
		} else {
			$fileConf = MOMO.'/core/config/'.$file.'.php';
			if (is_file($fileConf)) {
				$conf = include $fileConf;
				if (isset($conf[$name])) {
					self::$confRsyn[$file] = $conf;
					return $conf[$name];
				} else {
					throw new Exception("没有这个配置项".$name);	
				}
			} else {
				throw new Exception("找不到配置文件".$file);
			}
		}
	}

	public function all($file)
	{
		if (isset(self::$confRsyn[$file])) {	// 判断缓存中是否存在该配置
			return self::$confRsyn[$file];
		} else {
			$fileConf = MOMO.'/core/config/'.$file.'.php';
			if (is_file($fileConf)) {
				$conf = include $fileConf;
				self::$confRsyn[$file] = $conf;
				return $conf;
			} else {
				throw new Exception("找不到配置文件".$file);
			}
		}
	}
}