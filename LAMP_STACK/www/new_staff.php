<?php
require_once './lib/toolfuctions.php';
header_check();

$data = read_post_data();
/*
 * Staff name check
 */
if (!isset($data['staff_name'])){
    send_json(0, "Missing FUll Name!");
    exit;
}
$staff_name = $data['staff_name'];
if ( strlen($staff_name)==0 || strlen($staff_name) > 20 ){
    send_json(0, "Full name cannot be empty or longer than 30 characters.");
    exit;
}

/*
 * Position check
 */
if (!isset($data['position']) || strlen($data['position'])===0){
    send_json(0, "Missing Position!");
    exit;
}
$position = $data['position'];
$position = strtoupper($position);
$position = ($position==="0")? "CL":$position;
$position = ($position==="1")? "FD":$position;
$position = ($position==="2")? "MA":$position;
if ($position!=="CL" && $position!=="FD" && $position!=="MA"){
    send_json(0, "Invalid Position");
    exit;
}

/*
 * Response Floor check
 */
$floor = -1;
if ($position==="CL"){
    if (!isset($data['floor']) || strlen($data['floor']===0)){
        send_json(0, "Missing Floor Number!");
        exit;
    }
    $floor = intval($data['floor']);
    if ($floor <= 0 || $floor > 8){
        send_json(0, "Invalid Floor Number");
        exit;
    }
}

/*
 * Connect to database
 */
include_once "./lib/config.php";
$config_ = get_config();

$info = get_user_info();
if ($info['user']===$staff_name){
    send_json(0, "You cannot update your own profile ");
    exit;
}


# error_reporting(0);
# mysqli_report(MYSQLI_REPORT_OFF);
$conn = mysqli_connect($config_['mysql_info']['host'], $info['user'], $info['pass'], $config_['mysql_info']['database']);
if (!$conn){
    send_json(0, "Server interval error, please try later! ");
    exit;
}

$sql = "SELECT * FROM `STAFF` WHERE STAFF_ID='".mysqli_real_escape_string($conn, $staff_name)."';";
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) >0){
    $sql = "UPDATE `STAFF` SET 
                `POSITION` = '".mysqli_real_escape_string($conn, $position)."',
                `RESPONSIBLE_FLOOR`= ".mysqli_real_escape_string($conn, $floor)." 
                WHERE `STAFF_ID` = '".mysqli_real_escape_string($conn, $staff_name)."';";
    $result = mysqli_query($conn, $sql);
    if (!$result){
        send_json(0, "Server interval error, please try later! ");
        mysqli_close($conn);
        exit;
    }
    send_json(1);
    mysqli_close($conn);
    exit;
}

/*
 * Password check
 */
if (!isset($data['pass'])){
    send_json(0, "Missing Password!");
    mysqli_close($conn);
    exit;
}
$pass = $data['pass'];
if ( strlen($pass) < 8 || strlen($pass) > 12 ){
    send_json(0, "Password cannot be less than 8 or longer than 12 characters.");
    mysqli_close($conn);
    exit;
}

$idx = 0;
$sql_ls[$idx++] = "CREATE USER '".mysqli_real_escape_string($conn, $staff_name)."'@'%' IDENTIFIED BY '".mysqli_real_escape_string($conn, $pass)."';";
$sql_ls[$idx++] = "GRANT SELECT, UPDATE, DELETE, INSERT ON * To '".mysqli_real_escape_string($conn, $staff_name)."'@'%';";
$sql_ls[$idx++] = "FLUSH PRIVILEGES;";
$sql_ls[$idx++] = "INSERT INTO `STAFF`  (`STAFF_ID`, `POSITION`, `RESPONSIBLE_FLOOR`) VALUES (
              '".mysqli_real_escape_string($conn, $staff_name)."',
              '".mysqli_real_escape_string($conn, $position)."',
              '".mysqli_real_escape_string($conn, $floor)."'
);";
for ($i=0; $i<$idx; $i++){
    if (!mysqli_query($conn, $sql_ls[$i])) {
        send_json(0, "Register failed, please try later. ".mysqli_error($conn));
        mysqli_close($conn);
        exit;
    }
}

send_json(1);
mysqli_close($conn);





