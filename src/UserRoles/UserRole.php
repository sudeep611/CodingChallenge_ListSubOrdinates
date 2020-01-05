<?php

namespace UserRoles;

class UserRole
{
    private $roles = [];
    private $users = [];
    public $rolesSubordinates = [];

    public function __construct($jsonDataFile)
    {
        $data_sample = file_get_contents($jsonDataFile);
        $array_data_sample = json_decode($data_sample, true);
        $this->roles = $array_data_sample["roles"];
        $this->users = $array_data_sample["users"];
    }

    public function getSubOrdinates($userId)
    {
        $this->recursivelySearchSubOrdinateRoleIds($this->getRoleId($userId));
        $resultArray = [];
        foreach ($this->users as $user) {
            if(in_array($user["Role"], $this->rolesSubordinates)) {
                array_push($resultArray, $user);
            }
        }
        return json_encode($resultArray);
    }

    public function getRoleId($userId)
    {
        foreach ($this->users as $user) {
            if ($user["Id"] == $userId) {
                return $user["Role"];
            }
        }
        return -1;
    }

    public function recursivelySearchSubOrdinateRoleIds($roleId)
    {
        foreach ($this->roles as $r) {
            $currentRoleParentId = $r["Parent"];
            $currentRoleId = $r["Id"];
            if($currentRoleParentId == $roleId && !in_array($currentRoleId, $this->rolesSubordinates)) {
                array_push($this->rolesSubordinates, $currentRoleId);
                $this->recursivelySearchSubOrdinateRoleIds($currentRoleId);
            }
        }
    }
}