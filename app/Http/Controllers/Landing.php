<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Landing extends Controller
{

    protected $appID;
    protected $appSecret;
    protected $version;

    function __construct()
    {
        $this->appID = "1953168228253948";
        $this->appSecret = "18b12407ccebd01d54a580452bc33917";
        $this->version = "v1.0";
    }

    public function index()
    {
        return view("landing");
    }

    public function loginSuccess(Request $request)
    {
        $token_exchange_url = 'https://graph.accountkit.com/'.$this->version.'/access_token?'.
            'grant_type=authorization_code'.
            '&code='.$request->code.
            "&access_token=AA|$this->appID|$this->appSecret";
        $data = $this->doCurl($token_exchange_url);
        $user_id = $data['id'];
        $user_access_token = $data['access_token'];
        $refresh_interval = $data['token_refresh_interval_sec'];

        $me_endpoint_url = 'https://graph.accountkit.com/'.$this->version.'/me?'.
            'access_token='.$user_access_token;
        $data = $this->doCurl($me_endpoint_url);
        $phone = isset($request['phone']) ? $request['phone']['number'] : '';
        $email = isset($request['email']) ? $request['email']['address'] : '';

        return response()->json($data);
    }

    private function doCurl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = json_decode(curl_exec($ch), true);
        curl_close($ch);
        return $data;
    }
}
