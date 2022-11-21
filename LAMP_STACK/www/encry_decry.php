<?php
function determine_param($ciphering) {
    $key_length = 16;
    switch ($ciphering) {
        case "AES-128-CBC":
            echo "AES-128-CBC";
            $key_length = 16;
            break;
        case "AES-128-CTR":
            echo "AES-128-CTR";
            $key_length = 16;
            break;
        case "AES-196-CBC":
            echo "AES-196-CBC";
            $key_length = 24;
            break;
        case "AES-256-CBC":
            echo "AES-256-CBC";
            $key_length = 32;
            break;
        default:
            $key_length = 64;
    }
    $iv_length = openssl_cipher_iv_length($ciphering);
    $iv = openssl_random_pseudo_bytes($iv_length);
    $key = openssl_random_pseudo_bytes($key_length);
    $options = 0;
    return [$key, $iv, $options];
}

// echo var_dump(openssl_get_cipher_methods());
$ciphering = "AES-256-CBC";
[$key, $iv, $options] = determine_param($ciphering);
$content = "plain text";
echo "key: " . $key . "iv: " . $iv . "options: " . $options;

echo "original content: " . $content . "\n";
$encryption_text = openssl_encrypt($content, $ciphering, $key, $options, $iv);
echo "encryption: " . $encryption_text . "\n";

$decryption_text = openssl_decrypt($encryption_text, $ciphering, $key, $options, $iv);
echo "decryption: " . $decryption_text . "\n";
?>