<?php
include_once "config.php";
$config_ = get_config();

// reference: https://www.php.net/manual/zh/session.security.ini.php
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

session_start();

function header_check(){
    if (!strstr($_SERVER['REQUEST_URI'], '/index.php')){
        header("Location: index.php?home");
        exit;
    }
}

function session_update(): bool{
    if (isset($_SESSION['info'])) {
        $info = aes_cipher_decrypt($_SESSION['info'], true);
        if (isset($info) && $info['expire'] > time()) {
            global $config_;
            $info['expire'] = time() + $config_['life_time'];
            $_SESSION['info'] = aes_cipher_encrypt($info, true);
            return true;
        }
        log_out();
    }
    return false;
}


function log_out(){
    // Will detailed delete the session and corresponding cookies settings
    $_SESSION = array();
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),'',time()-3600, '/');
    }
    session_destroy();
}


function aes_cipher_encrypt($plaintext, $is_json=false): string
{
    global $config_;
    if ($is_json)
        return base64_encode(openssl_encrypt(json_encode($plaintext), "AES-128-ECB", $config_['session_key'], OPENSSL_RAW_DATA));
    else
        return base64_encode(openssl_encrypt($plaintext, "AES-128-ECB", $config_['session_key'], OPENSSL_RAW_DATA));
}

function aes_cipher_decrypt($ciphertext, $is_json=false){
    global $config_;
    if ($is_json)
        return json_decode(openssl_decrypt(base64_decode($ciphertext), "AES-128-ECB", $config_['session_key'], OPENSSL_RAW_DATA), true);
    else
        return openssl_decrypt(base64_decode($ciphertext), "AES-128-ECB", $config_['session_key'], OPENSSL_RAW_DATA);
}

function read_post_data(){
    global $config_;
    if ($config_['read_raw_post'])
        return json_decode(file_get_contents("php://input"), true);
    else
        return $_POST;
}