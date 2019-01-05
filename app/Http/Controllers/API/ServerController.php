<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use GuzzleHttp\Client;

class ServerController extends ApiController
{

    public static $apiServer = 'http://51.75.169.54:8000/';
    public static $serverAccessKey= 'test_secret';

    public static $createPath = 'api/v1/server/create';
    public static $infoPath = 'api/v1/server/info';

    /**
     * create api
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){

        $client = new Client([
            'headers' => ['Content-Type' => 'application/json'],
            'http_errors' => false
        ]);

        $response = $client->request(
            'POST',
            self::$apiServer . self::$createPath,
            ['body' => json_encode(['secret_key' => self::$serverAccessKey])]
        );

        if ($response->getStatusCode() == 200) {
            if ($response->hasHeader('Content-Length')) {
                $content_length = current($response->getHeader('Content-Length'));
                if (!empty($body = json_decode($response->getBody(), true)) && $content_length) {

                    if(!empty($body['payload']['token'])){
                        DB::table('server_info')->insert(
                            array('token' => trim(htmlentities($body['payload']['token'])))
                        );

                        return parent::answer(parent::$success, $body, 'Success', parent::$successCheck, parent::$successStatus);
                    }
                }
            }

        } else {
            return parent::answer(parent::$error, '', 'Invalid Request', parent::$errorCheck, parent::$errorStatus);
        }
    }

    /**
     * info api
     *
     * @return \Illuminate\Http\Response
     */
    public function info(Request $request){

        $input = $request->all();

        if(empty($input['token'])){
            return parent::answer(parent::$error, '', 'Missing field - Token', parent::$errorCheck, parent::$errorStatus);
        }

        $client = new Client([
            'headers' => ['Content-Type' => 'application/json', 'Authorization' => trim(htmlentities($input['token']))],
            'http_errors' => false
        ]);

        $response = $client->request(
            'GET',
            self::$apiServer . self::$infoPath,
            ['body' => json_encode(['token' => trim(htmlentities($input['token']))])]
        );

        if ($response->getStatusCode() == 200) {
            if (!empty($body = json_decode($response->getBody(), true))) {

                $upd = [
                    'info' => json_encode($body['payload']),
                    'server_uuid' => !empty($body['payload']['uuid']) ? $body['payload']['uuid'] : ''
                ];

                DB::table('server_info')
                    ->where('token', $input['token'])
                    ->update($upd);

                if(!$body['status']){
                    return parent::answer(parent::$success, '', $body, parent::$successCheck, parent::$successStatus);
                }
                return parent::answer(parent::$error, '', $body, parent::$errorCheck, parent::$errorStatus);
            }

        }

    }

    /**
     * connect api
     *
     * @return \Illuminate\Http\Response
     */
    public function connect(Request $request){

    }
}
