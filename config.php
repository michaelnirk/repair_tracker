<?php
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    define('PATH_SEP', ';');
    set_include_path(get_include_path() . PATH_SEP . 'C:/develop/repair_tracker/');
    define('SMARTY_HOME', 'C:/develop/repair_tracker/');
} else {
    define('PATH_SEP', ':');
    set_include_path(get_include_path() . PATH_SEP . '/var/www/html/repair_tracker/');
    define('SMARTY_HOME','/var/www/html/repair_tracker/');
}