<?php
include_once './lib/toolfuctions.php';
header_check();


if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    require_once './static/login.html';
    exit;
}

$data = read_post_data();
if (!isset($data['user']) || !isset($data['pass'])){
    send_json(0);
    exit;
}

$user = $data['user'];
$pass = $data['pass'];

include_once "./lib/config.php";
$config_ = get_config();

error_reporting(0);
mysqli_report(MYSQLI_REPORT_OFF);
$conn = mysqli_connect($config_['mysql_info']['host'], $user, $pass, $config_['mysql_info']['database']);

if (!$conn){
    send_json(0);
    exit;
}

mysqli_close($conn);

$info = [
    'user' => $user,
    'pass' => $pass,
    'expire' => time() +$config_['life_time']
];

$_SESSION['info'] = aes_cipher_encrypt($info, true);
$_SESSION['user'] = $user;

send_json(1);

# header("Location: index.php?home");


