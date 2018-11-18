<?php
namespace core\lib\drive\log;
use core\lib\conf;

/**
 * 文件存储日志
 */
class file
{
	public $path;	//日志存储位置

	public function __construct()
	{
		$conf = conf::get('OPTION', 'log');
		$this->path = $conf['PATH'].date('YmdH').'\\';
	}

	public function log($message, $file = 'log')
	{
		/**
		 * 1.确定文件的存储位置是否存在
		 * 2.不存在：新建目录
		 * 3.写入日志
		 */
		if (!is_dir($this->path)) {
			mkdir($this->path, '0777', true);
		}

		$message = date('Y-m-d H:i:s').json_encode($message).PHP_EOL;
		$path = $this->path.$file.'.php';
		return file_put_contents($path, $message, FILE_APPEND);
	}
}