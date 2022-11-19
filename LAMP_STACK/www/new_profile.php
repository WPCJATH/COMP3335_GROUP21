<?php
require_once './lib/toolfuctions.php';
header_check();


$data = read_post_data();
/*
 * Full name check
 */
if (!isset($data['full_name'])){
    send_json(0, "Missing FUll Name!");
    exit;
}
$full_name = $data['full_name'];
if ( strlen($full_name)==0 || strlen($full_name) > 30 ){
    send_json(0, "Full name cannot be empty or longer than 30 characters.");
    exit;
}

/*
 * Gender check
 */
if (!isset($data['gender'])){
    send_json(0, "Missing Gender!");
    exit;
}
$gender = $data['gender'];
if ($gender == 0 || $gender === 'male'){
    $gender = "female";
}
elseif ($gender == 1 || $gender === 'female'){
    $gender = 'male';
}
else{
    send_json(0, "Invalid gender!");
    exit;
}

/*
 * Age check
 */
if (!isset($data['age']) || strlen($data['age'])===0){
    send_json(0, "Missing Age!");
    exit;
}
$age = intval($data['age']);
if ( $age < 0 ){
    send_json(0, "User Name $age cannot be less than 0");
    exit;
}


/*
 * ID number check
 */
if (!isset($data['id'])){
    send_json(0, "Missing ID Number!");
    exit;
}
$id = $data['id'];
if (strlen($id)==0 || strlen($id) > 18 ){
    send_json(0, "ID Number cannot be empty or longer than 18 characters.");
    exit;
}

/*
 * Phone check
 */
$regex = "/^\d*$/";
if (!isset($data['phone']) || !preg_match($regex, $data['phone'])){
    send_json(0, "Invalid Phone Number!");
    exit;
}
$phone = $data['phone'];
if (strlen($phone)==0 || strlen($phone) > 15 ){
    send_json(0, "Phone Number cannot be empty or longer than 15 characters.");
    exit;
}

/*
 * Email check
 */
$regex= '/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/'; // regular expression for validating email
if (!isset($data['email']) || !preg_match($regex,$data['email'])){
    send_json(0, "Invalid Email!");
    exit;
}
$email = $data['email'];

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
    send_json(0, "Server interval error, please try later! ");
    exit;
}

// If CUS_ID is set, then means this is a request of updating an existing profile.
if (isset($data['cus_id'])){
    $sql = "UPDATE `CUSTOMER` SET
            `NAME` = '".mysqli_real_escape_string($conn, $full_name)."',
            `GENDER` = '".mysqli_real_escape_string($conn, $gender)."',
            `AGE` = '".mysqli_real_escape_string($conn, $age)."',
            `ID_NO` = '".mysqli_real_escape_string($conn, $id)."',
            `EMAIL` = '".mysqli_real_escape_string($conn, $email)."',
            `PHONE_NO` = '".mysqli_real_escape_string($conn, $phone)."'
            WHERE `CUS_ID` = '".mysqli_real_escape_string($conn, $data['cus_id'])."';
            ";
    $result = mysqli_query($conn, $sql);
    if (!$result){
        send_json(0, "Server interval error,  please try later! ");
        mysqli_close($conn);
        exit;
    }
    mysqli_close($conn);
    send_json(1);
    exit;
}

while (true){
    $entry_id = random_id();
    $sql = "select `CUS_ID` from `CUSTOMER` where `CUS_ID`='".mysqli_real_escape_string($conn, $entry_id)."';";
    $result = mysqli_query($conn, $sql);
    if (!$result){
        send_json(0, "Server interval error,  please try later! ");
        exit;
    }
    if (! mysqli_num_rows($result) > 0)
        break;
}

$sql = "INSERT INTO `CUSTOMER` (`CUS_ID`, `NAME`, `GENDER`, `AGE`, `ID_NO`, `EMAIL`, `PHONE_NO`)
VALUES (
        '".mysqli_real_escape_string($conn, $entry_id)."', 
        '".mysqli_real_escape_string($conn, $full_name)."', 
        '".mysqli_real_escape_string($conn, $gender)."', 
         ".mysqli_real_escape_string($conn, $age).", 
        '".mysqli_real_escape_string($conn, $id)."', 
        '".mysqli_real_escape_string($conn, $email)."', 
        '".mysqli_real_escape_string($conn, $phone)."'
        );";
$result = mysqli_query($conn, $sql);
if (!$result){
    send_json(0, "Server interval error,  please try later! ");
    mysqli_close($conn);
    exit;
}

$sql = "INSERT INTO `TRAVEL_PARTNER` (`PARTNER_ID`, `HOLDER`) VALUES 
        ('".mysqli_real_escape_string($conn, $entry_id)."', '".mysqli_real_escape_string($conn, $info['user'])."');";
$result = mysqli_query($conn, $sql);
if (!$result){
    send_json(0, "Server interval error,  please try later! ");
    mysqli_close($conn);
    exit;
}

mysqli_close($conn);
send_json(1);


