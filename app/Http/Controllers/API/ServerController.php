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
     * * headers body
     * Content-Type - application/json
     * token - User token
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

                        $serverInfo = DB::table('server_infos')->where('token', $body['payload']['token'])->first();
                        if(empty($serverInfo)){
                            DB::table('server_infos')->insert(
                                array('token' => $body['payload']['token'])
                            );
                        }
                        DB::table('users')
                            ->where('id', $request->get('user_id'))
                            ->update([
                                'server_token' => $body['payload']['token'],
                                'secret_key' => str_random(20)
                            ]);
                        return parent::retAnswer(parent::$success, false, ['check' => parent::$successCheck], parent::$successStatus);
                    }
                }
            }
        }
    }

    /**
     * info api
     *
     * * headers body
     * Content-Type - application/json
     * token - User token
     *
     * @return \Illuminate\Http\Response
     */
    public function info(Request $request){

        $serverInfo = DB::table('server_infos')->get()->last();
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json', 'Authorization' => $serverInfo->token],
            'http_errors' => false
        ]);
        $response = $client->request(
            'GET',
            self::$apiServer . self::$infoPath,
            ['body' => json_encode(['token' => $serverInfo->token])]
        );

        if ($response->getStatusCode() == 200) {
            if (!empty($body = json_decode($response->getBody(), true))) {
                if(!$body['status'] && !empty($body['payload'])){

                    $upd = [
                        'info' => json_encode($body['payload']),
                        'server_uuid' => !empty($body['payload']['uuid']) ? $body['payload']['uuid'] : ''
                    ];

                    DB::table('users')
                        ->where('id', $request->get('user_id'))
                        ->update($upd);

                    DB::table('server_infos')
                        ->where('token', $serverInfo->token)
                        ->update([
                            'info' => json_encode($body['payload']),
                            'ip' => !empty($body['payload']['ip']) ? $body['payload']['ip'] : '',
                            'server_uuid' => !empty($body['payload']['uuid']) ? $body['payload']['uuid'] : ''
                        ]);

                    return parent::retAnswer(parent::$success, false, ['check' => parent::$successCheck], parent::$successStatus);
                }
            }
        }
    }

    /**
     * connect api
     *
     * * request body
     * uuid - VPN server uuid
     *
     * * headers body
     * Content-Type - application/json
     * token - User token
     *
     * @return \Illuminate\Http\Response
     */
    public function connect(Request $request){

        $input = $request->all();

        if(!empty($input['uuid'])){

            $user = $request->get('user_info');
            $server_info = DB::table('server_infos')->where('server_uuid', $input['uuid'])->first();

            if(empty($server_info)){
                return parent::retAnswer(parent::$invalidArgument, 'invalidArgument', ['check' => parent::$errorCheck], parent::$errorStatus);
            }

            if(!empty($server_info->token)){
                $connectInfo = self::serverConnects($user->secret_key, $server_info->token);
                if(!empty($connectInfo['user_info']['payload'])){
                    return response()->json(['error'=> 0, 'payload' => array('secret_key' => $user->secret_key, 'certs' => $connectInfo['user_info']['payload'])], parent::$successStatus);
                }
            }
        }

        return parent::retAnswer(parent::$error, 'Unauthorized', ['check' => parent::$errorCheck], parent::$errorStatus);
    }

    /**
     * serverList api
     *
     * * headers body
     * Content-Type - application/json
     * token - User token
     *
     * @return \Illuminate\Http\Response
     */
    public function serverList(Request $request){

        $serverArr = [];
        $serverList = DB::table('server_infos')->get();
        if(!empty($serverList)){
            foreach ($serverList as $server){
                $serverArr[] = json_decode($server->info, true);
            }
        }
        if(!empty($serverArr)){
            return parent::retAnswer(parent::$success, false, ['servers' => $serverArr], parent::$successStatus);
        }
        return parent::retAnswer(parent::$error, 'The server list is empty', ['check' => parent::$errorCheck], parent::$errorStatus);
    }

    /**
     * verifyConn api
     *
     * * request body
     * secret_key - User secret key
     * uuid - Server uuid
     *
     * * headers body
     * Content-Type - application/json
     * token - User token
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyConn(Request $request)
    {
        $input = $request->all();
        if(!empty($input['secret_key'])){
            $user = DB::table('users')->where('secret_key', $input['secret_key'])->where('server_uuid', $input['uuid'])->first();
            if(!empty($user)){
                return parent::retAnswer(parent::$success, false, ['check' => parent::$successCheck], parent::$successStatus);
            }
        }
        return parent::retAnswer(parent::$error, 'The user does not exist', ['check' => parent::$errorCheck], parent::$errorStatus);
    }

    /**
     * serverList api
     *
     * @return \Illuminate\Http\Response
     */
    protected static function serverConnects($secret_key = '', $server_token=''){

        $answerInfo = [];

        if(!empty($secret_key) && !empty($server_token)){
            $client = new Client([
                'headers' => ['Content-Type' => 'application/json', 'Authorization' => $server_token],
                'http_errors' => false
            ]);

            $answerInfo['disconnect'] = $client->request(
                'POST',
                self::$apiServer . self::$disconnectPath,
                ['body' => json_encode(['user_key' => $secret_key])]
            );
            $answerInfo['disconnect'] = json_decode($answerInfo['disconnect']->getBody(), true);

            $answerInfo['user_info'] = $client->request(
                'POST',
                self::$apiServer . self::$userInfoPath,
                ['body' => json_encode(['user_key' => $secret_key])]
            );
            $answerInfo['user_info'] = json_decode($answerInfo['user_info']->getBody(), true);
        }

        return $answerInfo;

    }
}
