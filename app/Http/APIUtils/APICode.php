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
			$invToken => 'Invalid token',
			$invArgument => 'Invalid argument',
			$unknown => 'Unknown error',

			$planExpired => 'User plan expired'
		];

		if (isset($description[$code])) {
			return $description[$code];
		}

		return null;
	}
}
