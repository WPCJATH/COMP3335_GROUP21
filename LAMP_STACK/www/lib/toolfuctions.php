<?php
/**
    This is a .php file supply tool functions for other php pages.
 */
include_once "config.php";
$config_ = get_config();

/**
 Reference: https://www.php.net/manual/zh/session.security.ini.php
 Secure the session control and sql query.
*/

ini_set('session.cookie_lifetime', '0');
ini_set('session.use_cookies', 'On');
ini_set('session.use_only_cookies', 'On');
ini_set('session.use_strict_mode', 'On');
ini_set('session.cookie_httponly','On');
ini_set('session.cookie_secure','On');
ini_set('session.cookie_samesite', 'Strict');
ini_set('session.gc_maxlifetime',$config_['life_time']);
ini_set('session.use_trans_sid','Off');
ini_set('session.sid_length','64');
ini_set('session.sid_bits_per_character','6');
ini_set('session.hash_function','sha256');
ini_set('magic_quotes_gpc', 'On');

/**
 Every needed file will include this file, start session here to avoid repetitive session start
 */
session_start();

/**
 * Only allow https://{hostname}/index.php?{request_keyword} like url,
 * If not, redirect to home page.
 * @return void
 */
function header_check(){
    if (!strstr($_SERVER['REQUEST_URI'], '/index.php') and !strstr($_SERVER['REQUEST_URI'], '/temp.php')){
        header("Location: index.php?home");
        exit;
    }
}

/**
 * Check whether the user has signed in and whether the signin expired.
 * AES encryption is used to protect the user's expire time and password on the server.
 * Called by pages that require checking the signin status of user.
 * @return string|bool  role -> user signed in & not expired; false -> otherwise
 *      Role is to determine the user's identity, i.e., one of customer, front-desk, manager, and cleaner
 */
function session_update(){
    if (isset($_SESSION['info'])) {
        $info = aes_cipher_decrypt($_SESSION['info'], true);
        if (isset($info) && $info['expire'] > time()) {
            global $config_;
            $info['expire'] = time() + $config_['life_time'];
            $_SESSION['info'] = aes_cipher_encrypt($info, true);
            return $info['role'];
        }
        log_out();
    }
    return false;
}


/**
 * Clear the all session information about the user i.e., the server will regard as logged out.
 * Will be called when the user's session expired or user manually sign out from the website.
 * @return void
 */
function log_out(){
    // Will detailed delete the session and corresponding cookies settings
    $_SESSION = array();
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),'',time()-3600, '/');
    }
    session_destroy();
}


/**
 * Return the decrypted user id and password to required page.
 * @return array|false|mixed|string
 */
function get_user_info(){
    if (isset($_SESSION['info'])) {
        $info = aes_cipher_decrypt($_SESSION['info'], true);
        if (isset($info) && $info['expire'] > time()) {
            global $config_;
            $info['expire'] = time() + $config_['life_time'];
            $_SESSION['info'] = aes_cipher_encrypt($info, true);
            return $info;
        }
        log_out();
    }
    return false;
}


/**
 * Encrypt a string/json information via AES cyber and return the cybertext
 * @param $plaintext
 *          The string/json type plaintext to be encrypted.
 * @param bool $is_json
 *          Specify the type of plaintext: true -> json; false -> string
 * @return string
 *          The encrypted cybertext
 */
function aes_cipher_encrypt($plaintext, bool $is_json=false): string
{
    global $config_;
    if ($is_json)
        return base64_encode(openssl_encrypt(json_encode($plaintext), "AES-128-ECB", $config_['session_key'], OPENSSL_RAW_DATA));
    else
        return base64_encode(openssl_encrypt($plaintext, "AES-128-ECB", $config_['session_key'], OPENSSL_RAW_DATA));
}


/**
 * Decrypt a cybertext encrypted by aes_cipher_encrypt() to a string/json type plaintext
 * @param $cybertext
 *          The cybertext to be decrypted.
 * @param bool $is_json
 *          Specify the type of plaintext: true -> json; false -> string.
 * @return false|mixed|string
 *          The decrypted plaintext.
 */
function aes_cipher_decrypt($cybertext, bool $is_json=false){
    global $config_;
    if ($is_json)
        return json_decode(openssl_decrypt(base64_decode($cybertext), "AES-128-ECB", $config_['session_key'], OPENSSL_RAW_DATA), true);
    else
        return openssl_decrypt(base64_decode($cybertext), "AES-128-ECB", $config_['session_key'], OPENSSL_RAW_DATA);
}


/**
 * Since some post request cannot be fetched in $_POST, we cannot figure out why.
 * The file lib/config 'read_raw_post' specifies which type of post data to read:
 *  true -> read post from file "php://input"; false -> directly return $_POST.
 * @return array|mixed
 *      The post data fetched.
 */
function read_post_data(){
    global $config_;
    if ($config_['read_raw_post'])
        return json_decode(file_get_contents("php://input"), true);
    else
        return $_POST;
}

/**
 * The server specified return style for POST requests:
 * A json contains key 'status' and 'msg' (optional)
 * And send back to the client.
 * @param $status
 *       0: request failed; 1: request successfully  executed.
 * @param string $msg
 *      Optional. May transform the reminder of failure.
 * @return void
 */
function  send_json($status, string $msg=''){
    $res['status'] = $status;
    if ($msg!=='')
        $res['msg'] = $msg;
    echo json_encode($res);
}


/**
 * Generate a random string based on the length
 * @param int $length
 *          The length of the random string
 * @return string
 *          The random string
 */
function random_id(int $length = 18): string{
    $str = '0123456789';
    $len = strlen($str)-1;
    $rand_str = '';
    for ($i=0;$i<$length;$i++) {
        $num=mt_rand(0,$len);
        $rand_str .= $str[$num];
    }
    return $rand_str;
}
