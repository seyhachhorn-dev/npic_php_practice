<?php
require_once './init/init.php';
include './includes/header.php';
include './includes/navbar.php';

// unset($_SESSION['user_id']);
$user = isUserLogged();

$avaliable_pages = ['register', 'login', 'home', 'dashboard'];
$logged_in_pages = ['dashboard'];
$non_logged_pages = ['login', 'register'];

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
   include './pages/'. $page . '.php';
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