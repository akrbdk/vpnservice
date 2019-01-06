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
    public static $disconnectPath = 'api/v1/user/disconnect';
    public static $userInfoPath = 'api/v1/user/get';

    /**
     * create api
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){

        $input = $request->all();

        if($user = parent::checkUserPlatform($input)){

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
                            DB::table('users')
                                ->where('id', $user->id)
                                ->update([
                                    'server_token' => $body['payload']['token'],
                                    'secret_key' => str_random(20)
                                ]);

                            return parent::answer(parent::$success, $body, 'Success', parent::$successCheck, parent::$successStatus);
                        }
                    }
                }
            }
        }

        return parent::answer(parent::$error, '', 'Invalid Request', parent::$errorCheck, parent::$errorStatus);
    }

    /**
     * info api
     *
     * @return \Illuminate\Http\Response
     */
    public function info(Request $request){

        $input = $request->all();

        if($user = parent::checkUserPlatform($input)){
            if(empty($user->server_token)){
                return parent::answer(parent::$error, '', 'You don\'t registered', parent::$errorCheck, parent::$errorStatus);
            }

            $client = new Client([
                'headers' => ['Content-Type' => 'application/json', 'Authorization' => $user->server_token],
                'http_errors' => false
            ]);

            $response = $client->request(
                'GET',
                self::$apiServer . self::$infoPath,
                ['body' => json_encode(['token' => $user->server_token])]
            );

            if ($response->getStatusCode() == 200) {
                if (!empty($body = json_decode($response->getBody(), true))) {
                    if(!$body['status'] && !empty($body['payload'])){
                        $upd = [
                            'info' => json_encode($body['payload']),
                            'server_uuid' => !empty($body['payload']['uuid']) ? $body['payload']['uuid'] : ''
                        ];

                        DB::table('users')
                            ->where('server_token', $user->server_token)
                            ->update($upd);

                        return parent::answer(parent::$success, $body, '', parent::$successCheck, parent::$successStatus);
                    }
                }

            }
        }

        return parent::answer(parent::$error, '','', parent::$errorCheck, parent::$errorStatus);
    }

    /**
     * connect api
     *
     * @return \Illuminate\Http\Response
     */
    public function connect(Request $request){

        $input = $request->all();

        if($user = parent::checkUserPlatform($input, 'y')){
            $connectInfo = self::serverConnects($user);

            if(!empty($connectInfo)){
                return response()->json(['error'=> 0, 'secret_key' => $user->secret_key, 'certs' => $connectInfo['user_info']['payload'], 'payload' => array('check' => 'Ok')], parent::$successStatus);
            }
        }

        return parent::answer(parent::$error, '','Unauthorized', parent::$errorCheck, parent::$errorStatus);

    }

    /**
     * serverList api
     *
     * @return \Illuminate\Http\Response
     */
    public function serverList(Request $request){

    }

    /**
     * verifyConn api
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyConn(Request $request)
    {
        $input = $request->all();

        if(!empty($input['secret_key'])){
            $user = DB::table('users')->where('secret_key', $input['secret_key'])->where('server_uuid', $input['uuid'])->first();
            if(!empty($user)){
                return parent::answer(parent::$success, '', '', parent::$successCheck, parent::$successStatus);
            }
        }

        return parent::answer(parent::$error, '','Unauthorized', parent::$errorCheck, parent::$errorStatus);
    }

    /**
     * serverList api
     *
     * @return \Illuminate\Http\Response
     */
    protected static function serverConnects($params = ''){

        $answerInfo = [];

        if(!empty($params)){
            $client = new Client([
                'headers' => ['Content-Type' => 'application/json', 'Authorization' => $params->server_token],
                'http_errors' => false
            ]);

            $answerInfo['disconnect'] = $client->request(
                'POST',
                self::$apiServer . self::$disconnectPath,
                ['body' => json_encode(['user_key' => $params->secret_key])]
            );
            $answerInfo['disconnect'] = json_decode($answerInfo['disconnect']->getBody(), true);

            $answerInfo['user_info'] = $client->request(
                'POST',
                self::$apiServer . self::$userInfoPath,
                ['body' => json_encode(['user_key' => $params->secret_key])]
            );
            $answerInfo['user_info'] = json_decode($answerInfo['user_info']->getBody(), true);
        }

        return $answerInfo;

    }
}
