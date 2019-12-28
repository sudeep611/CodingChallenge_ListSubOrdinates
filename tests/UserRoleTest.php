<?php

// Autoload files using the Composer autoloader.
require_once __DIR__ . '/../vendor/autoload.php';

use UserRoles\UserRoleClass;
use PHPUnit\Framework\TestCase;

final class UserRoleTest extends TestCase
{

    private $sampleDataFile = __DIR__ . "/../src/files/data.json";

    public function testGetSubOrdinates()
    {
        $actualClass = new UserRoleClass($this->sampleDataFile);
        $this->assertJsonStringEqualsJsonString(
            json_encode($actualClass->getSubOrdinates(3)),
            json_encode("[{\"Id\":2,\"Name\":\"Emily Employee\",\"Role\":4},{\"Id\":5,\"Name\":\"Steve Trainer\",\"Role\":5}]")
        );
    }

    public function testSetSubordinateParentTableArray()
    {
        $actualClass = new UserRoleClass($this->sampleDataFile);
        $this->assertEquals();
    }

//    public function testGetRoleId()
//    {
//        $this->assertEquals(
//            'Hello World',
//            UserRoleClass::sayHelloWorld()
//        );
//    }
//
//    public function testRecursivelySearchSubOrdinateUserIds()
//    {
//
//    }

}