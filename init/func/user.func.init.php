<?php 
function createUser($name, $username, $password, $photo){
    global $db;

    $image_path = null;

    if(!empty($photo['name'])){
        $image_path = uploadImage($photo);
    }
    $query = $db->prepare('INSERT INTO tbl_users(name,username,password,photo) VALUES(?,?,?,?)');
    $query -> bind_param('ssss',$name,$username,$password,$image_path);
    $query -> execute();
    if($db->affected_rows){
        return true;
    }
    return false;
}


function getAllUsersNotAdmin(){
    global $db;
    $query = $db->prepare('SELECT * FROM tbl_users WHERE level <> "admin"');
    $query -> execute();
    $result = $query->get_result();
    return $result;
}



function readUser($userID){
    global $db;
      $query = $db->prepare("SELECT * FROM tbl_users where user_id = ?");
    $query->bind_param("i", $userID);
    $query->execute();
     $result = $query->get_result();
     if($result -> num_rows){
        return $result->fetch_object();
     }
     return null;

}


// delete user
function deleteUser($userID)
{
    global $db;

    $targetUser = readUser($userID);

    if($targetUser->photo){
        unlink($targetUser->photo);
    }

    $query = $db->prepare("DELETE FROM tbl_users where user_id = ?");
    $query->bind_param("i", $userID);
    $query->execute();
    if ($db->affected_rows) {
        return true;
    } else {
        return false;
    }
}



// update users
function updateUser($id, $name, $username, $passwd, $photo){
    global $db;
    $targetUser = readUser($id);


       // Fix password
    if (empty($passwd)) {
        $passwd = $targetUser->password;
    }

    $img_path = null;

    if(!empty($photo['name'])){
        $img_path = uploadImage($photo);
    }
    if($img_path){
             $query = $db->prepare('UPDATE tbl_users SET name=?, username=?, password=?, photo=? WHERE user_id=?');
            $query->bind_param('ssssi', $name, $username, $passwd, $img_path, $id);
    }else {
        $query = $db->prepare('UPDATE tbl_users SET name=?, username=?, password=? WHERE user_id=?');
        $query->bind_param('sssi', $name, $username, $passwd, $id);
    }

     $query->execute();
    if ($db->affected_rows) {
        return true;
    }
    return false;

}



?>