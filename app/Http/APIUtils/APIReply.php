<?php
namespace App\Http\APIUtils;

use App\Http\APIUtils\APICode;
use Illuminate\Http\Response;

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
		if (is_null($error) || !is_numeric($error)) {
			return 'Passed error code not numeric: ' . $error;
		}
		
		$reply = [ 'error' => $error ];

		if (!is_null($description)) {
			if (!is_string($description)) return 'Passed description not string: ' . $description;

			$reply['description'] = $description;
		}

		if (!is_null($payload)) {
			if (!is_array($payload)) return 'Passed payload not array: ' . $payload;

			$reply['payload'] = $payload;
		}
		
		return response()->json($reply, 200);
	}
}