<?php

// Autoload files using the Composer autoloader.
require_once __DIR__ . '/../vendor/autoload.php';

use UserRoles\UserRole;
use PHPUnit\Framework\TestCase;

final class UserRoleTest extends TestCase
{

    private $sampleDataFile = __DIR__ . "/../src/files/data.json";

    public function testGetSubOrdinates()
    {
        $actualClass = new UserRole($this->sampleDataFile);
        $this->assertJsonStringEqualsJsonString(
            json_encode($actualClass->getSubOrdinates(3)),
            json_encode("[{\"Id\":2,\"Name\":\"Emily Employee\",\"Role\":4},{\"Id\":5,\"Name\":\"Steve Trainer\",\"Role\":5}]")
        );
    }

    public function testGetRoleId()
    {
        $actualClass = new UserRole($this->sampleDataFile);
        $this->assertEquals(
            1,
            $actualClass->getRoleId(1)
        );
    }

    public function testRecursivelySearchSubOrdinateRoleIds()
    {
        $actualClass = new UserRole($this->sampleDataFile);
        $actualClass->recursivelySearchSubOrdinateRoleIds(3);
        $this->assertEquals(
            [4, 5],
            $actualClass->rolesSubordinates
        );
    }

}