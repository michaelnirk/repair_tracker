<?php
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    define('PATH_SEP', ';');
//    set_include_path(get_include_path() . PATH_SEP . 'C:/wamp/www/repair_tracker/');
    set_include_path(get_include_path() . PATH_SEP . 'C:/develope/repair_tracker_v2/');
//    define('SMARTY_HOME', 'C:/wamp/www/repair_tracker/');
    define('SMARTY_HOME', 'C:/develope/repair_tracker_v2/');
    define('CLIENT_ID', "807899027268-16aee4oog4ij86nei402rrdupfq0fr6t.apps.googleusercontent.com");
    define('CLIENT_SECRET', 'pxPv4cG7vzrILbwKcmOoFSwr');
    define('REFRESH_TOKEN', '1/s2xNW5fGWb-DGO82Bejd1EerJ40EuyUhMwMEHfJIgRI');
} else {
    define('PATH_SEP', ':');
    set_include_path(get_include_path() . PATH_SEP . '/var/www/html/repair_tracker_v2/');
    define('SMARTY_HOME','/var/www/html/repair_tracker_v2/');
}

define('GMAIL_USER_NAME', 'michael.nirk@gmail.com');
define('GMAIL_PWD', 'Mas&1996');