<?php

namespace UserRoles;

class UserRole
{
    private $roles = [];
    private $users = [];
    public $rolesSubordinates = [];

    public function __construct($jsonDataFile)
    {
        // Get the contents of the JSON file
        $data_sample = file_get_contents($jsonDataFile);
        // Convert to array and initialize to class variable
        $array_data_sample = json_decode($data_sample, true);
        // Set the roles array
        $this->roles = $array_data_sample["roles"];
        // Set the User Array
        $this->users = $array_data_sample["users"];
    }

    /*
     * This is the main function to call for getting the list of subordinates
     */
    public function getSubOrdinates($userId)
    {
        // Search for the users sub ordinates user ids
        $this->recursivelySearchSubOrdinateRoleIds($this->getRoleId($userId));

        // Create variable to store the user information
        $resultArray = [];

        // Loop through user array and push the sub ordinate user to resultArray
        foreach ($this->users as $user) {
            // If the user have role that matches in result array
            if(in_array($user["Role"], $this->rolesSubordinates)) {
                array_push($resultArray, $user);
            }
        }
        // return the result in the json format
        return json_encode($resultArray);
    }

    /*
     * When the user id of the user is provided this function returns the role of that user
     */
    public function getRoleId($userId) {
        foreach ($this->users as $user) {
            if ($user["Id"] == $userId) {
                return $user["Role"];
            }
        }
        return -1;
    }

    /*
     * This function finds the direct sub ordinates and their subordinates and return their user ids
     */
    public function recursivelySearchSubOrdinateRoleIds($roleId) {
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