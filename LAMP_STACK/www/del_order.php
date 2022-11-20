<?php
require_once './lib/toolfuctions.php';
header_check();

$data = read_post_data();
if (!isset($data['res_id']) || strlen($data['res_id'] === 0)) {
    send_json(0, "Server Interval Error. Please try again later.");
    exit();
}
$res_id = $data['res_id'];

/*
 * Connect to database
 */
include_once "./lib/config.php";
$config_ = get_config();
$user_info = get_user_info();


error_reporting(0);
mysqli_report(MYSQLI_REPORT_OFF);
$conn = mysqli_connect($config_['mysql_info']['host'], $user_info['user'], $user_info['pass'], $config_['mysql_info']['database']);
if (!$conn){
    send_json(0, "Server interval error, please try later! ");
    exit;
}

$sql = "SELECT `IS_ORDER`,`CANCELLED` FROM `RESERVATION`  WHERE 
            `CUS_ID`='".mysqli_real_escape_string($conn, $user_info['user'])."'
            AND `RES_ID`='".mysqli_real_escape_string($conn, $res_id)."';";
$result = mysqli_query($conn, $sql);
if (!$result || !mysqli_num_rows($result) > 0){
    send_json(0, "The order is not exist.");
    mysqli_close($conn);
    exit;
}
$info = mysqli_fetch_assoc($result);
if ($info['IS_ORDER']){
    send_json(0, "You cannot cancel a confirmed reservation.");
    mysqli_close($conn);
    exit;
}
if ($info['CANCELLED']){
    send_json(0, "The reservation is already been cancelled.");
    mysqli_close($conn);
    exit;
}

$sql = "UPDATE `RESERVATION` SET `CANCELLED`=true WHERE `RES_ID`='".mysqli_real_escape_string($conn, $res_id)."';";
$result = mysqli_query($conn, $sql);
if (!$result){
    send_json(0, "Server Interval Error, Please try again later.");
    mysqli_close($conn);
    exit;
}

send_json(1);
mysqli_close($conn);
exit;



