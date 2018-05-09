<?php
function httpSend($requestType, $url, $data){
    $headers= array('Accept: application/json','Content-Type: application/json');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, $headers);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requestType);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
    $response = curl_exec($ch);
    return $response;
}
?>