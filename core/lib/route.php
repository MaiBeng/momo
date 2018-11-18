<?php 
namespace core\lib;
use core\lib\conf;

//路由类
class route
{
	public $ctrl;		//控制器
	public $action;		//方法
	public function __construct()
	{
		// xxx.com/index/index 访问 index控制器的index方法
		/**
		 * 1.隐藏index.php （根目录下.htaccess文件）
		 * 2.获取url参数部分	$_SERVER['REQUEST_URI']
		 * 3.返回对应控制器和方法
		 */

		if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
			//	/index/index
			$path = $_SERVER['REQUEST_URI'];
			$patharr = explode('/', trim($path,'/'));
			if (isset($patharr[0])) {
				$this->ctrl = $patharr[0];
				unset($patharr[0]);
			}
			if (isset($patharr[1])) {
				$this->action = $patharr[1];
				unset($patharr[1]);
			}else{
				$this->action = conf::get('ACTION','route');
			}

			//URL多余部分转换为GET参数
			// index/index/id/1/str/2/test/3
			$count = count($patharr)+2;
			$i = 2;
			while ($i < $count) {
				if (isset($patharr[$i+1])) {
					$_GET[$patharr[$i]] = $patharr[$i+1];
				}
				$i += 2;
			}
			
		}else{
			$this->ctrl = conf::get('CTRL','route');
			$this->action = conf::get('ACTION','route');
		}
	}	
}