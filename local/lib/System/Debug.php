<?php

namespace Local\System;


class Debug
{

	static $logPath = '../_log/import.log';

	public static function log($data)
	{
		$file = self::open(self::$logPath);
		self::write($file, $data);
		self::close($file);
	}

	private static function open($path)
	{
		$f = fopen($path, 'a+');
		return $f;
	}

	private static function write($file, $data)
	{
		$date = date('d.m.Y H:i:s', time());
		$str = $date . ' ' . $data . "\r\n";
		fwrite($file, $str);
	}

	private static function close($file)
	{
		fclose($file);
	}
}