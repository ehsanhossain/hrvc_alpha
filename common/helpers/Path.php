<?php

namespace common\helpers;

use Yii;

class Path
{
	public static function isLocal()
	{
		$host = $_SERVER['HTTP_HOST'] ?? '';
		return (strpos($host, 'localhost') !== false || strpos($host, '127.0.0.1') !== false);
	}

	public static function getHost()
	{
		if (self::isLocal()) {
			$folderImage = Yii::$app->getBasePath() . '/' . 'web/';
		} else {
			$folderImage = '';
		}
		return $folderImage;
	}

	public static function urlUpload()
	{
		if (self::isLocal()) {
			$url = Yii::$app->getBasePath() . '/' . 'web/';
		} else {
			$url = '';
		}
		return $url;
	}
	public static function frontendUrl()
	{
		if (self::isLocal()) {
			$url = 'http://localhost:8081/';
		} else {
			$url = 'https://app.tcghrvc.com/';
		}
		return $url;
	}
	public static function Api()
	{
		if (self::isLocal()) {
			$url = 'http://localhost:8080/';
		} else {
			$url = 'https://api.tcghrvc.com/';
		}
		return $url;
	}
	public static function fsModule()
	{
		if (self::isLocal()) {
			$url = 'http://localhost/financial/financial/';
		} else {
			$url = 'https://fs.tcghrvc.com/financial/index';
		}
		return $url;
	}
}

