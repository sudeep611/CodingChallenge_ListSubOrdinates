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
        // Set the roles array
        $this->roleData = $array_data_sample["roles"];
        // Set the User Array
        $this->userData = $array_data_sample["users"];
    }

    /*
     * This is the main function to call for getting the list of subordinates
     */
    public function getSubOrdinates($userId)
    {
        // First of all let us make table of role hierarchy
        $this->setSubordinateParentTableArray();
        // Find the role of the User
        $roleId = $this->getRoleId($userId);
        $this->recursivelySearchSubOrdinateUserIds($roleId);

        // Create variable to store the user information
        $resultArray = array();
        // Loop through user array and push the sub ordinate user to resultArray
        foreach ($this->userData as $user) {
            // If the user have role that matches in result array
            if(in_array($user["Role"], $this->resultSubOrdinateArray)) {
                array_push($resultArray, $user);
            }
        }
        // return the result in the json format
        return json_encode($resultArray);
    }

    /*
     *  This function creates the role and the direct parent relationship table
     */
    public function setSubordinateParentTableArray() {
        foreach ($this->roleData as $role) {
            $this->subOrdinateParentTable[$role["Id"]] = $role["Parent"];
        }
    }

    /*
     * When the user id of the user is provided this function returns the role of that user
     */
    public function getRoleId($userId) {
        foreach ($this->userData as $user) {
            if ($user["Id"] == $userId) {
                return $user["Role"];
            }
        }
        return -1;
    }

    /*
     * This function finds the direct sub ordinates and their subordinates and return their user ids
     */
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