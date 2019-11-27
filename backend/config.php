<?php

function getJsonResponse($success, $message){
    $response = array(
        'success' => $success,
        'message' => $message
    );

    return json_encode($response);
}

function getPostData($dataName){
    if(!isset($_POST[$dataName])){
        echo getJsonResponse(false, "Campo '$dataName' nao informado");
        exit;
    }
    else return $_POST[$dataName];
}

if(!isset($_SESSION)){ 
    session_start(); 
}