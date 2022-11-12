<?php

$envs = parse_ini_file('.env');

foreach ($envs as $key => $value) {
    define($key, $value);
}

define('URL_BASE', 'http://scubaphp.com/');

define('SLASH',DIRECTORY_SEPARATOR);
define('VIEW_FOLDER',__DIR__.SLASH.'view'.SLASH);
define('DATA_LOCATION',__DIR__.SLASH.'data'.SLASH.'users.json');