<?php
namespace App\Http\APIUtils;

class APICode {
	// System error codes 0 - 9
	public static $ok = 0;
	public static $invToken = 1;
	public static $invArgument = 2;
	public static $unknown = 3;

	// Controller codes 10+
	public static $planExpired = 10;
	public static $HWIDexisted = 11;

	public static function toString($code) {
		$description = [
			self::$invToken => 'Invalid token',
			self::$invArgument => 'Invalid argument',
			self::$unknown => 'Unknown error',

			self::$planExpired => 'User plan expired',
			self::$HWIDexisted => 'HWID already used for trial'
		];

		if (isset($description[$code])) {
			return $description[$code];
		}

		return null;
	}
}
