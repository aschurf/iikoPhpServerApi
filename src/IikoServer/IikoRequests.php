<?php


namespace IikoServer\Api;


use IikoServer\Api\Exceptions\IikoApiException;

trait IikoRequests
{
    protected function request(string $requestUrl,string $key, string $method, $body = [], string $params = null){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->serverUrl.''.$requestUrl.'?key='.$key.''.$params,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => 'UTF-8',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        //count($body) > 0 ? curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($body)) : null;

        $response = curl_exec($curl);
        curl_close($curl);

        if (!$response){
            throw IikoApiException::incorrectRequest('');
        }

        return $response;
    }
}
