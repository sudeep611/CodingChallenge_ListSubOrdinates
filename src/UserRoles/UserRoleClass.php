<?php

namespace UserRoles;

class UserRoleClass
{
    private $roleData;
    private $userData;
    public $subOrdinateParentTable = array();
    public $resultSubOrdinateArray = array();

    public function __construct($jsonDataFile)
    {
        // Get the contents of the JSON file
        $data_sample = file_get_contents($jsonDataFile);
        // Convert to array and initialize to class variable
        $array_data_sample = json_decode($data_sample, true);
        $this->roleData = $array_data_sample["roles"];
        $this->userData = $array_data_sample["users"];
    }

    public function getSubOrdinates($userId)
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
        return json_encode($resultArray);
    }

    public function setSubordinateParentTableArray() {
        foreach ($this->roleData as $role) {
            $this->subOrdinateParentTable[$role["Id"]] = $role["Parent"];
        }
    }

    public function getRoleId($userId) {
        foreach ($this->userData as $user) {
            if ($user["Id"] == $userId) {
                return $user["Role"];
            }
        }
        return -1;
    }

    public function recursivelySearchSubOrdinateUserIds($parentId) {
        $tempArray = array_keys($this->subOrdinateParentTable, $parentId);
        if(sizeof($tempArray) > 0) {
            foreach ($tempArray as $temp) {
                array_push($this->resultSubOrdinateArray, $temp);
                $this->recursivelySearchSubOrdinateUserIds($temp);
            }
        }
    }
}