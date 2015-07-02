<?php

namespace Aurora\Helper;

class String
{

	const ALNUM = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

	const ALPHA = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

	const HEXDEC = '0123456789abcdef';

	const NUMERIC = '0123456789';

	const SYMBOLS = '!"#$%&\'()*+,-./:;<=>?@[\\]^_`{|}~';

	public static function slug($string, $keepCase = false, $replaceWith = "-")
	{
		if ($keepCase === false) $string = mb_strtolower($string);

		$string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);

    	$string = preg_replace("/[^a-z_\-A-Z0-9. ]/", "", $string);
		$string = preg_replace("/[\s-]+/", " ", $string);
		$string = preg_replace("/[\s_]/", $replaceWith, $string);

		return $string;
	}

	public static function ascii($string)
	{
		return preg_replace('/[^\x0-\x7F]/', '', $string);
	}

	public static function mask($string, $visible = 3, $mask = '*')
	{
		if ($visible === 0) {
			return str_repeat($mask, mb_strlen($string));
		}

		$visible = mb_substr($string, -$visible);

		return str_pad($visible,
			(mb_strlen($string) + ( strlen($visible) - mb_strlen($visible) )), $mask, STR_PAD_LEFT);
	}

	public static function random($pool = String::ALNUM, $length = 32)
	{
		$string = '';
		$poolSize = mb_strlen($pool) - 1;

		for ($i = 0; $i < $length; $i++) {
			$string .= mb_substr($pool, mt_rand(0, $poolSize), 1);
		}

		return $string;
	}
}
