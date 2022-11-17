<?php
/**
 * This is the customized config for phpmyadmin
 * The config template is from https://docs.phpmyadmin.net/zh_CN/latest/config.html#mysql-settings
 * Some adjustments are based on https://github.com/WilliamDenniss/kubernetes-for-developers/blob/master/Bonus/phpMyAdmin/config/config.user.inc.php
 */

declare(strict_types=1);

// For debug
$cfg['environment'] = 'development'; //'production'

/**
 * This is needed for cookie based authentication to encrypt the cookie.
 * Needs to be a 32-bytes long string of random bytes. See FAQ 2.10.
 */
$cfg['blowfish_secret'] = 'socjrhstcmtkshfeitnxhaweocgsiurk';

/**
 * Some general security settings
 */
// A demo of double factor authentication
// For enterprise purpose could adopt google/microsoft/etc. 2fa
$cfg['DBG']['simple2fa'] = true;

// Google human-computer certification keys
// Get from https://www.google.com/recaptcha/admin/create
$cfg['CaptchaLoginPublicKey']= '6LeVlxIjAAAAAD6D4SqQOQny3DDU46B70Aqro0-R';
$cfg['CaptchaLoginPrivateKey'] = '6LeVlxIjAAAAAOs2kmCLU7gRZJPSsktRtb0X4l6G';

// Only to avoid connection failures during SSL
// $cfg['MysqlSslWarningSafeHosts'] = ['127.0.0.1', 'localhost'];

/**
 * Servers configuration
 */
$i = 0;

/**
 * First server
 */
$i++;
/* Authentication type */
// CooKie is the safest on phpmyadmin
$cfg['Servers'][$i]['auth_type'] = 'cookie';
/* Server parameters */
$cfg['Servers'][$i]['host'] = 'mysql';
$cfg['Servers'][$i]['port'] = 3306;
$cfg['Servers'][$i]['compress'] = false;
$cfg['Servers'][$i]['AllowNoPassword'] = false;

/*
 * The config below is unnecessary since we will ensure phpmyadmin only sign on within the ethernet
 */
// Ensure ssl connection
# $cfg['Servers'][$i]['ssl'] = true;
// For authentication of this phpmyadmin
# $cfg['Servers'][$i]['ssl_key'] = '/tmp/client-cert/client-key.pem';
# $cfg['Servers'][$i]['ssl_cert'] = '/tmp/client-cert/client-cert.pem';
// Ensure the server
# $cfg['Servers'][$i]['ssl_ca'] = '/tmp/cert/ca.pem';
# $cfg['Servers'][$i]['ssl_ca_path'] = '/tmp/client-cert/';
# $cfg['Servers'][$i]['ssl_ciphers'] = 'DHE-RSA-AES256-SHA';
// Since we use self-signed certificate, to avoid certification failure, disable this value.
# $cfg['Servers'][$i]['ssl_verify'] = false;

// Only allow root login from localhost
# $cfg['Servers'][$i]['AllowDeny']['order'] = 'allow,deny';
# $cfg['Servers'][$i]['AllowDeny']['rules'] = ['allow root from 192.168.128.3'];

/**
 * phpMyAdmin configuration storage settings.
 */

/* User used to manipulate with storage */
// $cfg['Servers'][$i]['controlhost'] = '';
// $cfg['Servers'][$i]['controlport'] = '';
// $cfg['Servers'][$i]['controluser'] = 'pma';
// $cfg['Servers'][$i]['controlpass'] = 'pmapass';

/* Storage database and tables */
// $cfg['Servers'][$i]['pmadb'] = 'phpmyadmin';
// $cfg['Servers'][$i]['bookmarktable'] = 'pma__bookmark';
// $cfg['Servers'][$i]['relation'] = 'pma__relation';
// $cfg['Servers'][$i]['table_info'] = 'pma__table_info';
// $cfg['Servers'][$i]['table_coords'] = 'pma__table_coords';
// $cfg['Servers'][$i]['pdf_pages'] = 'pma__pdf_pages';
// $cfg['Servers'][$i]['column_info'] = 'pma__column_info';
// $cfg['Servers'][$i]['history'] = 'pma__history';
// $cfg['Servers'][$i]['table_uiprefs'] = 'pma__table_uiprefs';
// $cfg['Servers'][$i]['tracking'] = 'pma__tracking';
// $cfg['Servers'][$i]['userconfig'] = 'pma__userconfig';
// $cfg['Servers'][$i]['recent'] = 'pma__recent';
// $cfg['Servers'][$i]['favorite'] = 'pma__favorite';
// $cfg['Servers'][$i]['users'] = 'pma__users';
// $cfg['Servers'][$i]['usergroups'] = 'pma__usergroups';
// $cfg['Servers'][$i]['navigationhiding'] = 'pma__navigationhiding';
// $cfg['Servers'][$i]['savedsearches'] = 'pma__savedsearches';
// $cfg['Servers'][$i]['central_columns'] = 'pma__central_columns';
// $cfg['Servers'][$i]['designer_settings'] = 'pma__designer_settings';
// $cfg['Servers'][$i]['export_templates'] = 'pma__export_templates';

/**
 * End of servers configuration
 */

$cfg['LoginCookieValidity'] = 900; // 30min login validity

/**
 * Directories for saving/loading files from server
 */
$cfg['UploadDir'] = '';
$cfg['SaveDir'] = '';

/**
 * Whether to display icons or text or both icons and text in table row
 * action segment. Value can be either of 'icons', 'text' or 'both'.
 * default = 'both'
 */
//$cfg['RowActionType'] = 'icons';

/**
 * Defines whether a user should be displayed a "show all (records)"
 * button in browse mode or not.
 * default = false
 */
//$cfg['ShowAll'] = true;

/**
 * Number of rows displayed when browsing a result set. If the result
 * set contains more rows, "Previous" and "Next".
 * Possible values: 25, 50, 100, 250, 500
 * default = 25
 */
//$cfg['MaxRows'] = 50;

/**
 * Disallow editing of binary fields
 * valid values are:
 *   false    allow editing
 *   'blob'   allow editing except for BLOB fields
 *   'noblob' disallow editing except for BLOB fields
 *   'all'    disallow editing
 * default = 'blob'
 */
//$cfg['ProtectBinary'] = false;

/**
 * Default language to use, if not browser-defined or user-defined
 * (you find all languages in the locale folder)
 * uncomment the desired line:
 * default = 'en'
 */
//$cfg['DefaultLang'] = 'en';
//$cfg['DefaultLang'] = 'de';

/**
 * How many columns should be used for table display of a database?
 * (a value larger than 1 results in some information being hidden)
 * default = 1
 */
//$cfg['PropertiesNumColumns'] = 2;

/**
 * Set to true if you want DB-based query history.If false, this utilizes
 * JS-routines to display query history (lost by window close)
 *
 * This requires configuration storage enabled, see above.
 * default = false
 */
//$cfg['QueryHistoryDB'] = true;

/**
 * When using DB-based query history, how many entries should be kept?
 * default = 25
 */
//$cfg['QueryHistoryMax'] = 100;

/**
 * Whether or not to query the user before sending the error report to
 * the phpMyAdmin team when a JavaScript error occurs
 *
 * Available options
 * ('ask' | 'always' | 'never')
 * default = 'ask'
 */
//$cfg['SendErrorReports'] = 'always';

/**
 * 'URLQueryEncryption' defines whether phpMyAdmin will encrypt sensitive data from the URL query string.
 * 'URLQueryEncryptionSecretKey' is a 32 bytes long secret key used to encrypt/decrypt the URL query string.
 */
$cfg['URLQueryEncryption'] = true;
$cfg['URLQueryEncryptionSecretKey'] = 'socjrhstcmtkshfeitnxhaweocgsiurk';
