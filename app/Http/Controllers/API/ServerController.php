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

                    $server_uuid = !empty($body['payload']['uuid']) ? $body['payload']['uuid'] : '';

                    DB::table('server_infos')
                        ->where('token', $serverInfo->token)
                        ->update([
                            'info' => json_encode($body['payload']),
                            'ip' => !empty($body['payload']['ip']) ? $body['payload']['ip'] : '',
                            'server_uuid' => $server_uuid
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
        if (empty($input['uuid'])) {
            return response()->json(['error'=> parent::$invalidArgument, 'description' => 'Empty UUID'], $parent::$errorStatus);
        }

        $server_info = DB::table('server_infos')->where('server_uuid', $input['uuid'])->first();
        if (empty($server_info) || empty($server_info->token)) {
            return response()->json(['error'=> parent::$invalidArgument, 'description' => 'Invalid server uuid'], $parent::$errorStatus);
        }

        $secret_key = self::userVpnInfo($server_info->server_uuid, $request->get('token'));
        // $vpn_session = DB::table('vpn_sessions')->where('token', $request->get('token'))->first();

        $user = $request->get('user_info');
        $connectInfo = self::serverConnect($user->email, $server_info->token);
        if(empty($connectInfo['user_info']['payload'])) {
            return response()->json(['error'=> parent::$unknownError, 'description' => 'Failed to generate certs'], $parent::$errorStatus);
        }

        $reply = [
            'error'=> parent::$success, 
            'payload' => array('secret_key' => $secret_key, 'certs' => $connectInfo['user_info']['payload'])
        ];

        return response()->json($reply, parent::$successStatus);
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
            $user = DB::table('vpn_sessions')->where('secret_key', $input['secret_key'])->where('server_uuid', $input['uuid'])->first();
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
    protected static function serverConnect($user_email = '', $server_token='') {
        $answerInfo = [];
        if (empty($user_email) || empty($server_token)) {
            return $answerInfo;
        }

        $client = new Client([
            'headers' => ['Content-Type' => 'application/json', 'Authorization' => $server_token],
            'http_errors' => false
        ]);

        $answerInfo['disconnect'] = $client->request(
            'POST',
            self::$apiServer . self::$disconnectPath,
            ['body' => json_encode(['user_key' => $user_email])]
        );
        $answerInfo['disconnect'] = json_decode($answerInfo['disconnect']->getBody(), true);


        $answerInfo['user_info'] = $client->request(
            'POST',
            self::$apiServer . self::$userInfoPath,
            ['body' => json_encode(['user_key' => $user_email])]
        );
        $answerInfo['user_info'] = json_decode($answerInfo['user_info']->getBody(), true);

        return $answerInfo;
    }

    /**
     * upd vpn user info
     *
     * @return \Illuminate\Http\Response
     */
    protected static function userVpnInfo($server_uuid='', $user_token = ''){
        $secret = str_random(16);
        $info = [
            'token' => $user_token,
            'secret_key' => $secret,
            'server_uuid' => $server_uuid,
            'expiry_at' => time() + (5 * 60)
        ];

        $user_vpn_session = DB::table('vpn_sessions')->where('token', $user_token)->first();

        // TODO: Use replace into if database is MySQL
        if(empty($user_vpn_session)){
            DB::table('vpn_sessions')->insert($info);
        } else {
            DB::table('vpn_sessions')->where('token', $user_token)->update($info);
        }

        return $secret;
    }
}
