<?php
include_once './lib/toolfuctions.php';
header_check();


if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    require_once './static/signup.html';
    exit;
}

$res['status'] = 1;
$res['msg'] = 'TTTTest';

echo json_encode($res);
exit;

$data = read_post_data();
if (!isset($data['user'])){
    $res['status'] = 0;
    $res['msg'] = "Missing UserName!";
    echo json_encode($res);
    exit;
}
if (!isset($data['name'])){
    $res['status'] = 0;
    $res['msg'] = "Missing Name!";
    echo json_encode($res);
    exit;
}
if (!isset($data['email'])){
    $res['status'] = 0;
    $res['msg'] = "Missing Email!";
    echo json_encode($res);
    exit;
}
if (!isset($data['pass'])){
    $res['status'] = 0;
    $res['msg'] = "Missing Password!";
    echo json_encode($res);
    exit;
}

$user = $data['user'];
$pass = $data['pass'];
$name = $data['name'];
$email = $data['email'];

include_once "./lib/config.php";
$config_ = get_config();

error_reporting(0);
mysqli_report(MYSQLI_REPORT_OFF);
$conn = mysqli_connect($config_['mysql_info']['host'], $config_['mysql_info']['computer_user'],
    $config_['mysql_info']['computer_pass'], $config_['mysql_info']['database']);

$sql = "select `User` from mysql.user where `User`='".mysqli_real_escape_string($conn, $user)."';";


$res['status'] = 1;
$res['msg'] = 'TTTTest';

echo json_encode($res);