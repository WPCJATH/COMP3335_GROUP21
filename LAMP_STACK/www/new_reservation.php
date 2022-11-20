<?php
require_once './lib/toolfuctions.php';
header_check();

$data = read_post_data();
if (!isset($data['room_type']) || strlen($data['room_type']===0)){
    send_json(0, "Invalid room type!");
    exit;
}
$room_type= $data['room_type'];

/*
 * Check-in Data Check
 */
if (!isset($data['check_in']) || strlen($data['check_in']===0)){
    send_json(0, "Missing Check-in Date!");
    exit;
}
$checkin= strtotime($data['check_in']);
if (!$checkin){
    send_json(0, "Invalid data format");
    exit;
}
if (intval($checkin/86400) < intval(time()/86400)){
    send_json(0, "Check-in date cannot before today!");
    exit;
}

/*
 * Check-in Data Check
 */
if (!isset($data['duration']) || strlen($data['duration']===0)){
    send_json(0, "Missing Occupancy Days");
    exit;
}
$duration = intval($data['duration']);
if (!$duration || $duration<=0 || $duration > 20){
    send_json(0, "Occupancy Days should be 1 to 20 days.");
    exit;
}

/*
 * Guest Members check
 */
if (!isset($data['members']) || strlen($data['members']===0 || sizeof($data['members']))===0){
    send_json(0, "Missing Guest Members.");
    exit;
}
$members = array_unique($data['members']);

/*
 * Connect to database
 */
include_once "./lib/config.php";
$config_ = get_config();

$info = get_user_info();
error_reporting(0);
mysqli_report(MYSQLI_REPORT_OFF);
$conn = mysqli_connect($config_['mysql_info']['host'], $info['user'], $info['pass'], $config_['mysql_info']['database']);
if (!$conn){
    send_json(0, "Server interval error, please try later! 1");
    exit;
}

/*
 * Room TYPE check
 */
$sql = "SELECT `CAPACITY`,`PRICE` FROM `ROOM_TYPE` WHERE `TYPE`='".mysqli_real_escape_string($conn, $room_type)."';";
$result = mysqli_query($conn, $sql);
if(!$result || !mysqli_num_rows($result) > 0){
    send_json(0, "Invalid Room type.".$room_type);
    mysqli_close($conn);
    exit;
}
$room_info = mysqli_fetch_assoc($result);
$capacity = intval($room_info['CAPACITY']);
$price = intval($room_info['PRICE']);
if ($capacity < sizeof($members)){
    send_json(0, "Number of Guest Members exceeds the room capacity!");
    mysqli_close($conn);
    exit;
}

foreach ($members as $member){
    $sql = "SELECT `PARTNER_ID` FROM `TRAVEL_PARTNER` 
                    WHERE `PARTNER_ID`='".mysqli_real_escape_string($conn, $member)."'
                    AND
                    `HOLDER`='".mysqli_real_escape_string($conn, $info['user'])."';";
    $result = mysqli_query($conn, $sql);
    if(!$result || !mysqli_num_rows($result) > 0){
        send_json(0, "Invalid Guest Members.");
        mysqli_close($conn);
        exit;
    }
}

/*
 * Remaining empty rooms check
 */
$conn_computer = mysqli_connect($config_['mysql_info']['host'], $config_['mysql_info']['computer_user'],
    $config_['mysql_info']['computer_pass'], $config_['mysql_info']['database']);
if (!$conn_computer){
    send_json(0, "Server interval error, please try later! 2");
    exit;
}

$sql = "SELECT `CHECKIN_DATE`, `DURATION` FROM `RESERVATION` WHERE `CANCELLED`=false;";
$result = mysqli_query($conn_computer, $sql);
if(!$result){
    send_json(0, "Server interval error, please try later! 3");
    mysqli_close($conn);
    mysqli_close($conn_computer);
    exit;
}

if (mysqli_num_rows($result) > 0){
    $counter  = 0;
    $occupied_slots = [];
    while ($row = mysqli_fetch_assoc($result))
        $occupied_slots[$counter++] = $row;

    $sql = "SELECT `ROOM_TYPE` FROM `ROOM` WHERE `ROOM_TYPE`='".mysqli_real_escape_string($conn_computer, $room_type)."';";
    $result = mysqli_query($conn_computer, $sql);
    if(!$result || !mysqli_num_rows($result) > 0){
        send_json(0, "Server interval error, please try later! 4");
        mysqli_close($conn);
        mysqli_close($conn_computer);
        exit;
    }
    $room_number = mysqli_num_rows($result);

    $counter = 0;
    foreach ($occupied_slots as $occupied_slot){
        $start = intval($occupied_slot['CHECKIN_DATE']);
        $dur = intval($occupied_slot['DURATION']);
        if (intval($start/86400) > intval($checkin/86400)){
            if (intval($checkin/86400)+$duration > intval($start/86400))
                $counter++;
        }
        else{
            if (intval($start/86400)+$dur > intval($checkin/86400))
                $counter++;
        }
    }

    if ($counter > $room_number){
        send_json(0, "Sorry! The time you booked is full, please choose another time slot. ");
        mysqli_close($conn);
        mysqli_close($conn_computer);
        exit;
    }
}

/*
 * Insert the new order
 *
 */
$reservation_id = date("Ymdhis", time()) . random_id(4);

$counter = 0;
$sql_ls[$counter++] = "INSERT INTO `RESERVATION` (`RES_ID` ,`CUS_ID`,`ROOM_NUMBER` ,`CHECKIN_DATE`,
                           `DURATION` ,`ROOM_TYPE` ,`CANCELLED` ,`AMT` ,`IS_ORDER`,`RESPONSE`) 
VALUES (
        '".mysqli_real_escape_string($conn, $reservation_id)."', 
        '".mysqli_real_escape_string($conn, $info['user'])."', 
        NULL, 
         str_to_date('".mysqli_real_escape_string($conn, date("Y-m-d", $checkin))."', '%Y-%m-%d'), 
         ".mysqli_real_escape_string($conn, $duration).", 
        '".mysqli_real_escape_string($conn, $room_type)."', 
        false, 
        ".mysqli_real_escape_string($conn, $price*$duration).", 
        false, 
        NULL                                                                                            
);";
foreach ($members as $member){
    $sql_ls[$counter++] = "INSERT INTO `TRAVEL_PARTNER_INORDER` (`RES_ID`, `PARTNER_ID`) VALUES 
        ('".mysqli_real_escape_string($conn, $reservation_id)."', '".mysqli_real_escape_string($conn, $member)."');";
}
foreach ($sql_ls as $sql){
    if (!mysqli_query($conn, $sql)){
        send_json(0, "Server interval error, please try later! ");
        mysqli_close($conn);
        mysqli_close($conn_computer);
        exit;
    }
}


mysqli_close($conn);
mysqli_close($conn_computer);
send_json(1);
