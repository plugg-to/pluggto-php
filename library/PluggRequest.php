<?php

namespace PluggTo\Lib;

/**
* Class of Request to Apps Plugg.To
* @author Reginaldo Junior 
* @copyright Copyright (c) ThirdLevel [http://www.thirdlevel.com.br]
**/

class PluggRequest
{

    public function getAccessToken($code) 
    {
        $url = 'https://api.plugg.to/oauth/token';

        $data = "grant_type=authorization_code&client_id=5de98c314871a4f1970eb387e937db5c&client_secret=8f4074857cee508fa69f938a8f53ebad&code=" . $code;

        $curl_handle = curl_init();

        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

        $response = curl_exec($curl_handle);

        $responseCode = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);

        $resultResponse = json_decode($response);

        curl_close($curl_handle);
        
        return $resultResponse->access_token;
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