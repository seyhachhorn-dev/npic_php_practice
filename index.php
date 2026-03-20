<?php
require_once './init/init.php';
$user = isUserLogged();
include './includes/header.php';
include './includes/navbar.php';

// unset($_SESSION['user_id']);


$logged_in_pages = ['dashboard', 'profile'];
$non_logged_pages = ['login', 'register'];

$admin_pages = ['user/userlist', 'user/createuser', 'user/update', 'user/delete'];

$avaliable_pages = [
    ...$non_logged_pages,
    'home',
    'logout',
    ...$logged_in_pages,
    ...$admin_pages
];

$page = '';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
if (in_array($page, $logged_in_pages) && empty($user)) {
    header('Location: ./?page=login');
}
if (in_array($page, $non_logged_pages) && !empty($user)) {
    header('Location: ./?page=dashboard');
}
if (in_array($page, $avaliable_pages)) {

    if (in_array($page, $admin_pages) && !isAdmin()) {
        header('Location: ./?page=dashboard');
        exit();
    }
    include './pages/' . $page . '.php';
} else {
    header('Location: ./?page=login');
}

include './includes/footer.php';




// if(isset($_GET['page'])){
//     $page = $_GET['page'];

//     if(in_array($page, $avaliable_pages)){
//         include './pages/'. $page . '.php';
//     }else{
//          include './pages/error404.php';
//     }
// }else{
//     include './pages/home.php';
// }