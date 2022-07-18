<?php

namespace IikoServer\Api\Requests;

trait IikoTransportRequest
{


    protected function transportRequest(string $host, string $endpoint, array $data, array $headers){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $host.$endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;


    }

}