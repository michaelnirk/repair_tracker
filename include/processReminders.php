<?php

set_include_path(get_include_path() . PATH_SEP . '/var/www/html/repair_tracker/');

require_once 'modules/ReminderControllerClass.php';

$reminderController = new ReminderControllerClass();
