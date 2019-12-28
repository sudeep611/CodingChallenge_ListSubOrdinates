<?php

// Autoload files using the Composer autoloader.
require_once __DIR__ . '/vendor/autoload.php';

use UserRoles\UserRoleClass;

$entry = new UserRoleClass(__DIR__ . "/src/files/data.json");
echo($entry->getSubOrdinates(3));