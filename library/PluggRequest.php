<?php

namespace PluggTo\Lib;

/**
* Class of Request to Apps Plugg.To
* @author Reginaldo Junior 
* @copyright Copyright (c) ThirdLevel [http://www.thirdlevel.com.br]
**/

class PluggRequest
{
    const CLIENT_ID     = '5de98c314871a4f1970eb387e937db5c';
    const CLIENT_SECRET = '8f4074857cee508fa69f938a8f53ebad';
    const API_USER      = '';
    const PASSWORD      = '';
    const TYPE          = 'APP';

    public function getAccessToken($code) 
    {
        $url = 'https://api.plugg.to/oauth/token';

        if (TYPE == 'APP') 
        {
            $data = "grant_type=authorization_code&client_id=" . CLIENT_ID . "&client_secret=" . CLIENT_SECRET . "&code=" . $code;
            
            $response = $this->sendRequest("post", $url, $params);

            return $response['access_token'];
        }

        if (TYPE == 'PLUGIN')
        {
            $params = [
                "grant_type"    => "password", 
                "client_id"     => CLIENT_ID, 
                "client_secret" => CLIENT_SECRET,
                "username"      => API_USER,
                "password"      => PASSWORD
            ];

            $response = $this->sendRequest("post", $url, $params);
            
            return $response['access_token'];
        }
    }


    public function sendRequest($method, $url, $params) {
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
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

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

        }

        $result = curl_exec($ch);

        return json_decode($result);
    }

}