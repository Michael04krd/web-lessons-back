<?php
ob_start();
session_start();
include('./settings.php');

ini_set('display_errors', DISPLAY_ERRORS);
ini_set('include_path', INCLUDE_PATH);

include('./scripts/db.php');
include('./modules/front.php');
include('./scripts/init.php');

header('Content-Type: text/html; charset=utf-8');
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
}

$is_ajax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

$request = array(
  'url' => isset($_GET['q']) ? $_GET['q'] : '',
  'method' => $_SERVER['REQUEST_METHOD'],
  'get' => $_GET,
  'post' => $_POST,
  'files' => $_FILES,
  'is_ajax' => $is_ajax,
  'Content-Type' => $is_ajax ? 'application/json' : 'text/html',
);

if ($is_ajax && empty($_POST) && $input = file_get_contents('php://input')) {
    parse_str($input, $request['post']);
    $_POST = $request['post'];
}


$response = init($request, $urlconf);

if (!empty($response['headers'])) {
    foreach ($response['headers'] as $key => $value) {
        header(is_string($key) ? "$key: $value" : $value);
    }
}

if (!empty($response['entity'])) {
    if ($is_ajax && is_array($response['entity'])) {
        header('Content-Type: application/json');
        echo json_encode($response['entity']);
    } else {
        echo $response['entity'];
    }
}
ob_end_flush();