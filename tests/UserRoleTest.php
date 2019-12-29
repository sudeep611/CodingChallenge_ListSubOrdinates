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
        $actualClass->setSubordinateParentTableArray();
        $this->assertEquals(
            [1 => 0, 2 => 1, 3 => 2, 4 => 3, 5 => 3],
            $actualClass->subOrdinateParentTable
        );
    }

    public function testGetRoleId()
    {
        $actualClass = new UserRoleClass($this->sampleDataFile);
        $this->assertEquals(
            1,
            $actualClass->getRoleId(1)
        );
    }

    public function testRecursivelySearchSubOrdinateUserIds()
    {
        $actualClass = new UserRoleClass($this->sampleDataFile);
        $actualClass->setSubordinateParentTableArray();
        $actualClass->recursivelySearchSubOrdinateUserIds(3);
        $this->assertEquals(
            [4, 5],
            $actualClass->resultSubOrdinateArray
        );
    }

}