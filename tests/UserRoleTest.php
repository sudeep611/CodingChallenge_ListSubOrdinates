<?php

// Autoload files using the Composer autoloader.
require_once __DIR__ . '/../vendor/autoload.php';

use UserRoles\UserRoleClass;
use PHPUnit\Framework\TestCase;

final class UserRoleTest extends TestCase
{
    public function testGetSubOrdinates()
    {
        $this->assertEquals(
            'Hello World',
            UserRoleClass::sayHelloWorld()
        );
    }

    public function testSetSubordinateParentTableArray()
    {

    }

    public function testGetRoleId()
    {

    }

    public function testRecursivelySearchSubOrdinateUserIds()
    {

    }

}