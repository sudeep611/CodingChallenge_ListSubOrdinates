<?php
require_once __DIR__ . '/vendor/autoload.php';

use UserRoles\UserRole;

$entry = new UserRole(__DIR__ . "/src/files/data.json");
echo($entry->getSubOrdinates(1));