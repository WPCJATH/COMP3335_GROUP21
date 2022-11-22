<?php
require_once './lib/toolfuctions.php';
header_check();

$data = read_post_data();
/*
 * Reservation ID check
 */
if (!isset($data['res_id'])  || strlen($data['res_id'])===0){
    send_json(0, "Missing Reservation ID!");
    exit;
}
$res_id = $data['res_id'];

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

$sql = "UPDATE `RESERVATION` SET
            `ROOM_NUMBER` = NULL
            WHERE `RES_ID` = '".mysqli_real_escape_string($conn, $res_id)."'
            AND `ROOM_NUMBER` = '".mysqli_real_escape_string($conn, $room_no)."';
            ";
$result = mysqli_query($conn, $sql);
if (!$result){
    send_json(0, "Invalid Reservation ID or ROOM Number. ");
    mysqli_close($conn);
    exit;
}

$sql = "UPDATE `ROOM` SET `OCCUPIED`=false, `IS_CLEAN`=false WHERE `ROOM_NO`='".mysqli_real_escape_string($conn, $room_no)."'; ";
$result = mysqli_query($conn, $sql);
if (!$result){
    send_json(0, "Invalid Reservation ID or ROOM Number. ");
    mysqli_close($conn);
    exit;
}

mysqli_close($conn);
send_json(1);
exit;