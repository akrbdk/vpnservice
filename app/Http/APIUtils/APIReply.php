<?php
namespace App\Http\APIUtils;
use Illuminate\Http\Response;

class APICode {
	// System error codes 0 - 9
	public static $ok = 0;
	public static $invToken = 1;
	public static $invArgument = 2;
	public static $unknown = 3;

	// Controller codes 10+
	public static $planExpired = 10;

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

class APIReply {
	public static function ok() {
		return self::rawReply(APICode::$ok, null, null);
	}

	public static function with($payload) {
		return self::rawReply(APICode::$ok, null, $payload);
	}

	public static function err($code, $description = null) {
		return self::rawReply($code, $description, null);
	}

	private static function rawReply($error, $description = null, $payload = null) {
		// TODO: Remove description from reply in release build
		if (!is_null($error) && !is_numeric($error)) {
			return 'Passed error code not numeric: ' . $error;
		}

		if (!is_null($description) && !is_string($description)) {
			return 'Passed description not string: ' . $description;
		}

		if (!is_null($payload) && !is_array($payload)) {
			return 'Passed payload not array: ' . $payload;
		}

		$reply = [
			'error' => $error,
			'description' => $description,
			'payload' => $payload
		];

		return response()->json($reply, 200);
	}
}