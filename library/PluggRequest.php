<?php

namespace PluggTo\Lib;

use Exception;

/**
* Class of Request to Apps Plugg.To
* @author Reginaldo Junior 
* @copyright Copyright (c) ThirdLevel [http://www.thirdlevel.com.br]
**/

class PluggRequest
{
    public $CLIENT_ID     = '';
    public $CLIENT_SECRET = '';
    public $API_USER      = '';
    public $PASSWORD      = '';
    public $TYPE          = 'APP';
    public $tries         = 0;

    public function getAccessToken($code=null, $returnRefreshToken=false) 
    {
        $url = 'https://api.plugg.to/oauth/token';

        if ($this->TYPE == 'APP') 
        {
            $params = [
                "grant_type"    => "authorization_code",
                "client_id"     => $this->CLIENT_ID,
                "client_secret" => $this->CLIENT_SECRET,
                "code"          => $code
            ];
            
            $response = $this->sendRequest("post", $url, $params, "auth");

            if (!isset($response->access_token))
                return false;
        }

        if ($this->TYPE == 'PLUGIN')
        {
            $params = [
                "grant_type"    => "password", 
                "client_id"     => $this->CLIENT_ID, 
                "client_secret" => $this->CLIENT_SECRET,
                "username"      => $this->API_USER,
                "password"      => $this->PASSWORD
            ];

            $response = $this->sendRequest("post", $url, $params, "auth");
            
            if (!isset($response->access_token))
                return false;          
        }
        
        if ($returnRefreshToken) {
            return $response;
        }
        
        return $response->access_token; 
    }

    public function getAccessTokenByRefreshToken($refreshToken, $returnAllTokens = false)
    {
        $url = 'https://api.plugg.to/oauth/token';

        $params = [
            "grant_type"    => "refresh_token", 
            "client_id"     => $this->CLIENT_ID, 
            "client_secret" => $this->CLIENT_SECRET,
            "refresh_token" => $refreshToken
        ];
        
        $response = $this->sendRequest("post", $url, $params, "auth");

        if (!isset($response->access_token))
            return false;

        if($returnAllTokens)
        {
            return $response;
        }

        return $response->access_token;       
    }

    public function sendRequest($method, $url, $params=[], $type="") {
        $ch = curl_init();

        if (strtolower ( $method ) == "get")  {
            $i =0;
            
            foreach ($params as $key => $value) {

                if ($i == 0) {
                    $value = "?".$key."=".$value;
                } else {
                    $value = "&".$key."=".$value;
                }
            
                $i++;
            
                $url = $url . $value;
            }

            curl_setopt_array($ch, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url
            ));

        } elseif (strtolower ( $method ) == "post") {

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, 1);

            $data_string = json_encode($params);

            if ($type == "auth") {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'))
                ));
            } else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
                );
            }
        } elseif (strtolower ( $method ) == "put") {

            $data_string = json_encode($params);

            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
            );

        } else if (strtolower ( $method ) == "delete") {
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json'
                )
            );
        }

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 1000);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);

        $result = curl_exec($ch);

        // get the curl status
        $status = curl_getinfo($ch);

        if (empty($status['http_code'])) {
            if ($this->tries < 10) {
                $this->tries++;
                return $this->sendRequest($method, $url, $params, $type);
            }
        }

        return json_decode($result);
    }
}
