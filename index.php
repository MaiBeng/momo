<?php
/**
 * 入口文件
 * 1.定义常量
 * 2.加载函数库
 * 3.启动框架
 */

// 定义根目录
define('MOMO', realpath('./'));

// 定义框架核心文件目录
define('CORE', MOMO . '/core');

// 定义框架控制器文件目录
define('APP', MOMO . '/app');

// 定义模块
define('MODULE', 'app');

// 是否开启调试模式
define('DEBUG', true);

if (DEBUG) {
	ini_set('display_error', 'On');
}else{
	ini_set('display_error', 'Off');
}

//加载函数库
require_once CORE . '/common/function.php';
require_once CORE . '/momo.php';

//定义new的类不存在时要触发的方法
spl_autoload_register('\core\momo::load');

//启动框架
\core\momo::run();
