<?php

// Autoload files using the Composer autoloader.
require_once __DIR__ . '/vendor/autoload.php';

use UserRoles\UserRoleClass;

$entry = new UserRoleClass();
$entry->getSubOrdinates(3);