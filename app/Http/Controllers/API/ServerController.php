<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use GuzzleHttp\Client;

use App\Http\APIUtils\APIReply;
use App\Http\APIUtils\APICode;

class ServerController extends ApiController
{
    public static $createPath = '/api/v1/server/create';
    public static $infoPath = '/api/v1/server/info';
    public static $disconnectPath = '/api/v1/user/disconnect';
    public static $userInfoPath = '/api/v1/user/get';

    /**
     * create api
     *
     * * headers body
     * Content-Type - application/json
     * token - User token
     *
     * * request body
     * endpoint - VPNController endpoint
     * secret_key - configuration defined user key
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $input = $request->all();
        if ( !isset($input['endpoint']) || !isset($input['secret_key'])) {
            return APIReply::err(APICode::$invArgument, 'Empty secret or endpoint');
        }

        $client = new Client([
            'headers' => ['Content-Type' => 'application/json'],
            'http_errors' => false
        ]);

        $response = $client->request(
            'POST',
            'http://' . $input['endpoint'] . self::$createPath,
            ['body' => json_encode(['secret_key' => $input['secret_key']])]
        );

        $reply = json_decode($response->getBody(), true);
        if ( !isset($reply['payload']) ) {
            return APIReply::err(APICode::$unknown, 'Invalid VPN server reply');
        }

        $payload = $reply['payload'];
        if ( !isset($payload['token']) || !isset($payload['uuid']) ) {
            return APIReply::err(APICode::$unknown, 'Invalid VPN server reply');
        }

        DB::table('server_infos')->insert([
            'token' => $payload['token'], 
            'server_uuid' => $payload['uuid'],
            'ip' => $input['endpoint']
        ]);

        return APIReply::with(['uuid' => $payload['uuid']]);
    }

    /**
     * info api
     *
     * * headers body
     * Content-Type - application/json
     * token - User token
     * * body
     * uuid - server uuid
     * @return \Illuminate\Http\Response
     */
    public function info(Request $request) {
        $input = $request->all();
        if ( !isset($input['uuid']) ) {
            return APIReply::err(APICode::$invArgument, 'Empty uuid');
        }

        $serverInfo = DB::table('server_infos')->where('server_uuid', $input['uuid'])->first();
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json', 'Authorization' => $serverInfo->token],
            'http_errors' => false
        ]);

        $response = $client->request(
            'GET',
            'http://' . $serverInfo->ip . self::$infoPath,
            ['body' => json_encode(['token' => $serverInfo->token])]
        );

        $reply = json_decode($response->getBody(), true);
        if ( !isset($reply['payload']) ) {
            return APIReply::err(APICode::$unknown, 'Invalid VPN server reply');
        }

        $payload = $reply['payload'];
        if ( !isset($payload['uuid']) || !isset($payload['country_iso']) ) {
            return APIReply::err(APICode::$unknown, 'Invalid VPN server reply');
        }

        DB::table('server_infos')->where('server_uuid', $input['uuid'])->update([
            'info' => json_encode($payload),
            'server_uuid' => $payload['uuid'],
            'country_iso' => $payload['country_iso']
        ]);

        return APIReply::ok();
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
            return APIReply::err(APICode::$invArgument, 'Empty UUID');
        }

        $server_info = DB::table('server_infos')->where('server_uuid', $input['uuid'])->first();
        if (empty($server_info) || empty($server_info->token)) {
            return APIReply::err(APICode::$invArgument, 'Invalid server uuid');
        }

        $secret_key = self::userVpnInfo($server_info->server_uuid, $request->get('token'));

        $user = $request->get('user_info');
        $connectInfo = self::serverConnect($user->email, $server_info->token, $server_info->ip);
        if(empty($connectInfo['user_info']['payload'])) {
            return APIReply::err(APICode::$invArgument, 'Failed to generate certs');
        }

        return APIReply::with([
            'secret_key' => $secret_key, 
            'certs' => $connectInfo['user_info']['payload']]
        );
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

        return APIReply::with(['servers'=> $serverArr]);
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
    public function verifyConn(Request $request) {
        $input = $request->all();
        if (!isset($input['secret_key']) || !isset($input['uuid'])) {
            return APIReply::err(APICode::$invArgument, 'Empty UUID or secret');
        }

        $user = DB::table('vpn_sessions')
                ->where('secret_key', $input['secret_key'])
                ->where('server_uuid', $input['uuid'])
                ->where('token', $request->get('token'))
                ->first();

        if (empty($user) || $user->expiry_at < time()) {
            return APIReply::err(APICode::$invArgument);
        }

        DB::table('vpn_sessions')
                ->where('secret_key', $input['secret_key'])
                ->where('server_uuid', $input['uuid'])
                ->where('token', $request->get('token'))
                ->update(['expiry_at' => 0]);

        return APIReply::ok();
    }

    /**
     * serverList api
     *
     * @return \Illuminate\Http\Response
     */
    protected static function serverConnect($user_email = '', $server_token='', $endpoint='') {
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
            'http://' . $endpoint . self::$disconnectPath,
            ['body' => json_encode(['user_key' => $user_email])]
        );
        $answerInfo['disconnect'] = json_decode($answerInfo['disconnect']->getBody(), true);


        $answerInfo['user_info'] = $client->request(
            'POST',
            'http://' . $endpoint . self::$userInfoPath,
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
