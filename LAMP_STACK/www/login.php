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

$sql = "SELECT `POSITION` FROM `STAFF` WHERE `STAFF_ID`='".mysqli_real_escape_string($conn, $user)."';";
$result = mysqli_query($conn, $sql);

$role = "customer";
if ($result && mysqli_num_rows($result) > 0){
    $role = mysqli_fetch_assoc($result)['POSITION'];
}

mysqli_close($conn);

$info = [
    'user' => $user,
    'pass' => $pass,
    'role' => $role,
    'expire' => time() +$config_['life_time']
];

$_SESSION['info'] = aes_cipher_encrypt($info, true);
$_SESSION['user'] = $user;

send_json(1);



