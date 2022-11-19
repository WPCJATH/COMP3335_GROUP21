<?php
require_once './lib/toolfuctions.php';
header_check();

$data = read_post_data();
if (!isset($data['cus_id']) || strlen($data['cus_id']===0)){
    send_json(0, "Server Interval Error. Please try again later.");
    exit();
}

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

$sql_ls = [];
$idx = 0;
$sql_ls[$idx++] = "DELETE FROM `TRAVEL_PARTNER` WHERE `HOLDER` = '".mysqli_real_escape_string($conn, $user_info['user'])."'
        AND `PARTNER_ID` = '".mysqli_real_escape_string($conn, $data['cus_id'])."';";
$sql_ls[$idx++] = "DELETE FROM `CUSTOMER` 
        WHERE `CUS_ID` = '".mysqli_real_escape_string($conn, $user_info['user'])."';";


for ($i=0; $i<$idx; $i++){
    if (!mysqli_query($conn, $sql_ls[$i])) {
        send_json(0, "Register failed, please try later. $i");
        mysqli_close($conn);
        exit;
    }
}
mysqli_close($conn);
send_json(1);

