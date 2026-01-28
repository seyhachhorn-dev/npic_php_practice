<?php 

// register user function
function registerUser ($name, $username, $password){

    global $db;
    isUsernameExists($username);
    
    $query = $db->prepare("INSERT INTO tbl_users(name, username, password) VALUES (?, ?, ?)");
    $query -> bind_param("sss",$name, $username, $password);
    $query -> execute();

    if($query -> affected_rows >0){
        return true;
    } else {
        return false;
    }
}

// login

function loginUser ($username, $password){
    global $db;
    $query = $db->prepare("SELECT * FROM tbl_users where username = ? AND password = ?");
    $query -> bind_param("ss",$username, $password);
    $query -> execute();
    $rs = $query -> get_result();

    if($rs -> num_rows){
        return $rs -> fetch_object();
    } else {
        return false;
    }
}

function deleteUser ($userID){
    global $db;
    
    $query = $db->prepare("DELETE FROM tbl_users where user_id = ?");
    $query -> bind_param("i",$userID);
    $query -> execute();
    if($query -> affected_rows >0){
        return true;
    } else {
        return false;
    }
}

function updateUer ($userID, $name, $username,$password){
    global $db;

    $query = $db->prepare("UPDATE tbl_users SET name = ?, username = ?, password = ? WHERE user_id = ?");
    $query -> bind_param("sssi",$name, $username, $password, $userID);
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

    $query = $db->prepare("SELECT user_id FROM tbl_users WHERE username = ?");
    $query -> bind_param("s",$username);
    $query -> execute();
    $rs = $query -> get_result();

    if($rs -> num_rows){
        return true;
    } else {
        return false;
    }
}

?>