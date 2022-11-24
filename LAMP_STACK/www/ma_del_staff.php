<?php
require_once './lib/toolfuctions.php';
header_check();

$data = read_post_data();
if (!isset($data['staff_name']) || strlen($data['staff_name'] === 0)) {
    send_json(0, "Server Interval Error. Please try again later.");
    exit();
}
$staff_name = $data['staff_name'];

/*
 * Connect to database
 */
include_once "./lib/config.php";
$config_ = get_config();
$user_info = get_user_info();


# error_reporting(0);
# mysqli_report(MYSQLI_REPORT_OFF);
$conn = mysqli_connect($config_['mysql_info']['host'], $user_info['user'], $user_info['pass'], $config_['mysql_info']['database']);
if (!$conn){
    send_json(0, "Server interval error, please try later! ");
    exit;
}

if ($user_info['user']===$staff_name){
    send_json(0, "You cannot delete yourself ");
    mysqli_close($conn);
    exit;
}

$sql = "DELETE FROM `STAFF` WHERE `STAFF_ID` = '".mysqli_real_escape_string($conn, $staff_name)."';";
if (!mysqli_query($conn, $sql)){
    send_json(0, "Server Interval Error. Please try again later. ".mysqli_error($conn));
    mysqli_close($conn);
    exit;
}

send_json(1);
mysqli_close($conn);
