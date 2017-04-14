<?php

namespace Local\System;


class Debug
{
	public static function log($data)
	{
		$file = self::open();
		self::write($file, $data);
		self::close($file);
	}

	private static function open()
	{
		$folder = date('Y-m', time());
		$fileName = date('Y-m-d', time()) . '.log';
		$path = '../_log/import/' . $folder;
		if(!is_dir($path)){
			mkdir($path,0777,true);
		}
		$f = fopen($path.'/'.$fileName, 'a+');

		return $f;
	}

	private static function write($file, $data)
	{
		$date = date('H:i:s', time());
		$str = $date . ' ' . $data . "\r\n";
		fwrite($file, $str);
	}

	private static function close($file)
	{
		fclose($file);
	}
}