<?php 
require_once './init/init.php';
include './includes/header.php';
include './includes/navbar.php';

$avaliable_pages = ['register', 'login','home','dashboard'];

if(isset($_GET['page'])){
    $page = $_GET['page'];

    if(in_array($page, $avaliable_pages)){
        include './pages/'. $page . '.php';
    }else{
         include './pages/error404.php';
    }
}else{
    include './pages/home.php';
}

include './includes/footer.php';
?>