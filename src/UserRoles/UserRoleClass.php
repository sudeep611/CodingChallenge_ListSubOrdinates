<?php

namespace UserRoles;

class UserRoleClass
{
    private $roleData;
    private $userData;
    private $subOrdinateParentTable = array();
    private $resultSubOrdinateArray = array();

    function __construct()
    {
        // Get the contents of the JSON file
        $data_sample = file_get_contents(__DIR__ . "/../files/data.json");
        // Convert to array and initialize to class variable
        $array_data_sample = json_decode($data_sample, true);
        $this->roleData = $array_data_sample["roles"];
        $this->userData = $array_data_sample["users"];
    }

    function getSubOrdinates($userId)
    {
        // First of all let us make table of role hierarchy
        $this->setSubordinateParentTableArray();
        // Find the role of the User
        $roleId = $this->getRoleId($userId);
        $this->recursivelySearchSubOrdinateUserIds($roleId);

        $resultArray = array();
        foreach ($this->userData as $user) {
            if(in_array($user["Role"], $this->resultSubOrdinateArray)) {
                array_push($resultArray, $user);
            }
        }
        echo json_encode($resultArray);
    }

    function setSubordinateParentTableArray() {
        foreach ($this->roleData as $role) {
            $this->subOrdinateParentTable[$role["Id"]] = $role["Parent"];
        }
    }

    function getRoleId($userId) {
        foreach ($this->userData as $user) {
            if ($user["Id"] == $userId) {
                return $user["Role"];
            }
        }
        return -1;
    }

    function recursivelySearchSubOrdinateUserIds($parentId) {
        $tempArray = array_keys($this->subOrdinateParentTable, $parentId);
        if(sizeof($tempArray) > 0) {
            foreach ($tempArray as $temp) {
                array_push($this->resultSubOrdinateArray, $temp);
                $this->recursivelySearchSubOrdinateUserIds($temp);
            }
        }
    }
}