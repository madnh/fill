<?php
define('DS', DIRECTORY_SEPARATOR);
define('PHP_DIR', __DIR__);
define('COMMON_DIR', dirname(PHP_DIR));
define('BASE_DIR', dirname(COMMON_DIR));

require 'CLI.php';
require 'functions.php';
require 'Filler.php';