<?php

/**
 * Aurora - Framework
 *
 * Aurora is fast, simple, extensible Framework
 *
 *
 * @category   Framework
 * @package    Aurora
 * @author     VeeeneX <veeenex@gmail.com>
 * @copyright  2015 Caroon
 * @license    MIT
 * @version    0.1.3
 * @link       http://caroon.com/Aurora
 *
 */

namespace Aurora\Helper;

/**
 * Encryption
 *
 * @category   Common
 * @package    Aurora
 * @author     VeeeneX <veeenex@gmail.com>
 * @copyright  2015 Caroon
 * @license    MIT
 * @version    0.1.3
 *
 */

class Encryption
{
	private $key;

	public function __construct($key)
	{
		$this->key = hash('sha256', $key, true);
	}

	public static function encrypt($value)
	{
		return strtr(
			base64_encode(
				mcrypt_encrypt(
					MCRYPT_RIJNDAEL_256,
					hash('sha256', $this->key, true),
					$value,
					MCRYPT_MODE_ECB
				)
			),
			'+/=', '-_,'
		);
	}

	public static function decrypt($value)
	{
		return trim(
			mcrypt_decrypt(
				MCRYPT_RIJNDAEL_256,
				hash('sha256', $this->key, true),
				base64_decode(
					strtr($value, '-_,', '+/=')
				),
				MCRYPT_MODE_ECB
			)
		);
	}
}
