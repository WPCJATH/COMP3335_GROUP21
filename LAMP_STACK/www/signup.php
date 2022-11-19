<?php
include_once './lib/toolfuctions.php';
header_check();


if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    require_once './static/signup.html';
    exit;
}

$data = read_post_data();

/*
 * Username check
 */
if (!isset($data['user'])){
    send_json(0, "Missing UserName!");
    exit;
}
$user = $data['user'];
if ( strlen($user)==0 || strlen($user) > 18 ){
    send_json(0, "User Name $user cannot be empty or longer than 18 characters.");
    exit;
}

include_once "./lib/config.php";
$config_ = get_config();

error_reporting(0);
mysqli_report(MYSQLI_REPORT_OFF);
$conn = mysqli_connect($config_['mysql_info']['host'], $config_['mysql_info']['computer_user'],
    $config_['mysql_info']['computer_pass'], $config_['mysql_info']['database']);

$sql = "select `User` from mysql.user where `User`='".mysqli_real_escape_string($conn, $user)."';";
$result = mysqli_query($conn, $sql);
if (!$result){
    send_json(0, "Server interval error,  please try later! ");
    exit;
}
if (mysqli_num_rows($result) > 0){
    send_json(0, "Username $user has already existed.");
    mysqli_close($conn);
    exit;
}

/*
 * Name check
 */
if (!isset($data['name']) || strlen($data['name'])===0){
    send_json(0, "Missing Name!");
    mysqli_close($conn);
    exit;
}
$name = $data['name'];
if ( strlen($name)==0 || strlen($name) > 18 ){
    send_json(0, "Name $name cannot be empty or longer than 18 characters.");
    exit;
}


/*
 * Email check
 */
$regex= '/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/'; // regular expression for validating email
if (!isset($data['email']) || !preg_match($regex,$data['email'])){
    send_json(0, "Invalid Email!");
    mysqli_close($conn);
    exit;
}
$email = $data['email'];


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

$idx=0;
$sql_ls[$idx++] = "INSERT INTO `CUSTOMER` (`CUS_ID`, `NAME`, `GENDER`, `AGE`, `ID_NO`, `EMAIL`, `PHONE_NO`)
VALUES (
        '".mysqli_real_escape_string($conn, $user)."', 
        '".mysqli_real_escape_string($conn, $name)."', 
         ".mysqli_real_escape_string($conn, 'NULL').", 
         ".mysqli_real_escape_string($conn, 'NULL').", 
         ".mysqli_real_escape_string($conn, 'NULL').",
        '".mysqli_real_escape_string($conn, $email)."', 
         ".mysqli_real_escape_string($conn, 'NULL')."
        );";
$sql_ls[$idx++] = "CREATE USER '".mysqli_real_escape_string($conn, $user)."'@'%' IDENTIFIED BY '".mysqli_real_escape_string($conn, $pass)."';";
$sql_ls[$idx++] = "GRANT ALL ON * To '".mysqli_real_escape_string($conn, $user)."'@'%';";
$sql_ls[$idx++] = "FLUSH PRIVILEGES;";

for ($i=0; $i<$idx; $i++){
    if (!mysqli_query($conn, $sql_ls[$i])) {
        send_json(0, "Register failed, please try later. ");
        mysqli_close($conn);
        exit;
    }
}

send_json(1);
mysqli_close($conn);