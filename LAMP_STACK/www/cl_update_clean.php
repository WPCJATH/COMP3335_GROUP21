<?php
require_once './lib/toolfuctions.php';
header_check();

$data = read_post_data();
/*
 * ROOM ID check
 */
if (!isset($data['room_no'])  || strlen($data['room_no'])===0){
    send_json(0, "Missing ROOM NUMBER!");
    exit;
}
$room_no = $data['room_no'];

/*
 * Connect to database
 */
include_once "./lib/config.php";
$config_ = get_config();

$info = get_user_info();
error_reporting(0);
mysqli_report(MYSQLI_REPORT_OFF);
$conn = mysqli_connect($config_['mysql_info']['host'], $info['user'], $info['pass'], $config_['mysql_info']['database']);

if (substr($room_no,0, 1)!=$info['floor']){
    send_json(0, "You do not have right to change this status. ");
    mysqli_close($conn);
    exit;
}

$sql = "UPDATE `ROOM` SET `IS_CLEAN`=true WHERE `ROOM_NO`='".mysqli_real_escape_string($conn, $room_no)."'; ";
$result = mysqli_query($conn, $sql);
if (!$result){
    send_json(0, "Invalid Reservation ID or ROOM Number. ");
    mysqli_close($conn);
    exit;
}

mysqli_close($conn);
send_json(1);
exit;