<?php

function getJsonResponse($success, $message){
    $response = array(
        'success' => $success,
        'message' => $message
    );

    return json_encode($response);
}

if(!isset($_SESSION)){ 
    session_start(); 
}