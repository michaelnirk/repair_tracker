<?php
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    define('PATH_SEP', ';');
    set_include_path(get_include_path() . PATH_SEP . 'C:/develop/repair_tracker/');
    define('SMARTY_HOME', 'C:/develop/repair_tracker/');
    define('CLIENT_ID', "807899027268-16aee4oog4ij86nei402rrdupfq0fr6t.apps.googleusercontent.com");
    define('CLIENT_SECRET', 'pxPv4cG7vzrILbwKcmOoFSwr');
    define('REFRESH_TOKEN', '1/s2xNW5fGWb-DGO82Bejd1EerJ40EuyUhMwMEHfJIgRI');
} else {
    define('PATH_SEP', ':');
    set_include_path(get_include_path() . PATH_SEP . '/var/www/html/repair_tracker/');
    define('SMARTY_HOME','/var/www/html/repair_tracker/');
}

define('GMAIL_USER_NAME', 'michael.nirk@gmail.com');
define('GMAIL_PWD', 'Mas&1996');