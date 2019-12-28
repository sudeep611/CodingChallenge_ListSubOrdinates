<?php
    // Global Variables
    $FINAL_SUBORDINATE_ARRAY = array();

    getSubOrdinates(1);


    function getSubOrdinates($userId) {
        // Get the contents of the JSON file
        $data_sample = file_get_contents("data.json");
//        print_r($data_sample);
        // Convert to array
        $array_data_sample = json_decode($data_sample, true);

        $rolesData = $array_data_sample["roles"];
        $userData = $array_data_sample["users"];

        $roleId = getRoleId($userData, $userId);
        print_r($roleId);

        getResultArray($userData, $rolesData, $roleId );
    }
?>

<?php function getRoleId($userData, $userId) {
    foreach ($userData as $uData) {
        if ($uData["Id"] == $userId) {
            return $uData["Role"];
        }
    }
    return -1;
} ?>

<?php function getSubordinateParentTableArray($rolesDataArray) {
    $subordinateParentTable = array();

    foreach ($rolesDataArray as $role) {
        $subordinateParentTable[$role["Id"]] = $role["Parent"];
    }
    return $subordinateParentTable;
} ?>

<?php function recursivelySearchSubOrdinateUserIds($subOrdinateParentTable, $parentId) {
    global $FINAL_SUBORDINATE_ARRAY;
    $tempArray = array_keys($subOrdinateParentTable, $parentId);
    if(sizeof($tempArray) > 0) {
        foreach ($tempArray as $temp) {
            array_push($FINAL_SUBORDINATE_ARRAY, $temp);
            recursivelySearchSubOrdinateUserIds($subOrdinateParentTable, $temp);
        }
    }
}
?>

<?php function getResultArray($userDataArray, $rolesDataArray, $parentId) {
    global $FINAL_SUBORDINATE_ARRAY;
    $subOrdinateParentTable = getSubordinateParentTableArray($rolesDataArray);
    recursivelySearchSubOrdinateUserIds($subOrdinateParentTable, $parentId);

    $resultArray = array();
    foreach ($userDataArray as $user) {
        if(in_array($user["Role"], $FINAL_SUBORDINATE_ARRAY)) {
            array_push($resultArray, $user);
        }
    }
    echo json_encode($resultArray);
} ?>
