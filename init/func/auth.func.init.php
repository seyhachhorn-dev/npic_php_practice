<?php

// register user function
function registerUser($name, $username, $password)
{

    global $db;
    isUsernameExists($username);

    $query = $db->prepare("INSERT INTO tbl_users(name, username, password) VALUES (?, ?, ?)");
    $query->bind_param("sss", $name, $username, $password);
    $query->execute();

    if ($query->affected_rows > 0) {
        return true;
    } else {
        return false;
    }
}

// login

function loginUser($username, $password)
{
    global $db;
    $query = $db->prepare("SELECT * FROM tbl_users where username = ? AND password = ?");
    $query->bind_param("ss", $username, $password);
    $query->execute();
    $rs = $query->get_result();

    if ($rs->num_rows) {
        return $rs->fetch_object();
    } else {
        return false;
    }
}



// update user
function updateUer($userID, $name, $username, $password)
{
    global $db;

    $query = $db->prepare("UPDATE tbl_users SET name = ?, username = ?, password = ? WHERE user_id = ?");
    $query->bind_param("sssi", $name, $username, $password, $userID);
    $query->execute();
    if ($query->affected_rows > 0) {
        return true;
    } else {
        return false;
    }
}

// validate useranme
function isUsernameExists($username)
{
    global $db;

    $query = $db->prepare("SELECT user_id FROM tbl_users WHERE username = ?");
    $query->bind_param("s", $username);
    $query->execute();
    $rs = $query->get_result();

    if ($rs->num_rows) {
        return true;
    } else {
        return false;
    }
}

// isLogin check
function isUserLogged()
{
    global $db;

    if (!isset($_SESSION['user_id'])) {
        return null;
    }
    $user_id = $_SESSION['user_id'];
    $query = $db->prepare("SELECT * FROM tbl_users WHERE user_id = ?");
    $query->bind_param('i', $user_id);
    $query->execute();
    $rs = $query->get_result();
    if ($rs->num_rows) {
        return $rs->fetch_object();
    } else {
        return null;
    }
}

// update and select
function updatedUserAndDiplay($username, $password, $userID)
{
    global $db;
    $update = $db->prepare("UPDATE tbl_users SET username = ?, SET password = ? where user_id = ?");
    $update->bind_param("s", $username, $password, $userID);
    if ($update->execute()) {

        $select = $db->prepare("SELECT * from tbl_users where user_id = ?");
        $select->bind_param("i", $userID);
        $select->execute();
        $rs = $select->get_result();
        if ($rs->num_rows) {
            return $rs->fetch_object();
        } else {
            return null;
        }
    } else {
        return false;
    }
}


// validation password is user have pass and correct
function IsUserPasswordCorrect($password)
{
    global $db;
    $user = isUserLogged();
    $query = $db->prepare("SELECT * from tbl_users where user_id = ? AND password = ?");
    $query->bind_param("ss", $user->user_id, $password);
    $query->execute();
    $rs = $query->get_result();
    if ($rs->num_rows) {
        return true;
    } else {
        return false;
    }
}

// set new pass
function setNewPassword($password)
{
    global $db;
    $user = isUserLogged();
    $query = $db->prepare("UPDATE tbl_users Set password = ? where user_id = ?");
    $query->bind_param("ss", $password, $user->user_id);
    $query->execute();
    if ($db->affected_rows) {
        return true;
    } else {
        return false;
    }
}

function isAdmin()
{
    $user = isUserLogged();
    return $user && $user->level === 'admin';
}

function deleteImageProfile() {
    global $db;
    $user = isUserLogged();
if ($user && !empty(trim($user->photo)) && file_exists($user->photo)) {
        unlink($user->photo);
    }

    $query = $db->prepare('UPDATE tbl_users SET photo =NULL where user_id = ?');
    $query->bind_param("i", $user->user_id);
    return $query->execute(); 
}

function changeProfileImage($image)
{
    global $db;
    $user = isUserLogged();
    $image_path = uploadImage($image);
    if ($image_path && $user->photo) {
        unlink($user->photo);
    }
    $query = $db->prepare('UPDATE tbl_users SET photo =? where user_id = ?');
    $query->bind_param("si", $image_path, $user->user_id);
    $query->execute();
    if ($db->affected_rows) {

        return true;
    } else {
        return false;
    }
}


function uploadImage($image)
{
    $img_name = $image['name'];
    $img_size = $image['size'];
    $tmp_name = $image['tmp_name'];
    $err = $image['error'];

    $dir = "./assets/images/";

    $allow_extension = ['jpg', 'jpeg', 'png'];
    $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);
    $image_lower_ext = strtolower($img_extension);
    if (!in_array($image_lower_ext, $allow_extension)) {
        throw new Exception('Invalid image extension');
    }

    if ($err !== 0) {
        throw new Exception('Unknow error ocurred');
    }

    if ($img_size > 5000000) {
        throw new Exception('Image size is too large');
    }

    $new_img_name = uniqid("PI-") . "." . $img_extension;
    $img_path = $dir . $new_img_name;
    move_uploaded_file($tmp_name, $img_path);
    return $img_path;
}
