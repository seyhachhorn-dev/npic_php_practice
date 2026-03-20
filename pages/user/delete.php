<?php

$id = $_GET['id'];
$targetUser = readUser($id);
if($targetUser === null || $targetUser -> level=='admin'){
    header('Location: ./?page=user/userlist');
}

if(deleteUser($id)){
     echo '<div class="alert alert-success" role="alert">
                 Delete Account Successfully!
                 </div>';
}


?>


