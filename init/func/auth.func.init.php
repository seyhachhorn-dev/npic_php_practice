<?php 

// register user function
function registerUser ($name, $username, $password){
    global $db;

    $query = $db->prepare("INSERT INTO tbl_users(name, username, password) VALUES (?, ?, ?)");
    $query -> bind_param("sss",$name, $username, $password);
    $query -> execute();

    if($query -> affected_rows >0){
        return true;
    } else {
        return false;
    }
}
// validate useranme

function isUsernameExists($username){
    global $db;

    $query = $db->prepare("SELECT id FROM tbl_users WHERE username = ?");
    $query -> bind_param("s",$username);
    $query -> execute();
    $rs = $query -> get_result();

    if($rs -> num_rows >0){
        return true;
    } else {
        return false;
    }
}

?>