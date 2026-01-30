<?php 


$username = $password = "";
$errUsername = $errPassword = "";

if(isset($_POST['username'], $_POST['password'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(empty($username)){
        $errUsername = "Username is required";
    }
    if(empty($password)){
        $errPassword = "Password is required";
    }



    if(empty($errUsername) && empty ($errPassword)){
    $user = loginUser($username, $password);
    if($user !== false){
        header("Location: ./?page=dashboard");
        exit();
    }else{
        echo '<div class="alert alert-danger" role="alert">
    Something went wrong. Please try again. or Go to Register <a href="./?page=register">Register</a>
</div>';
    }
}
}






?>

<section class="container mt-5">
    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-6 ">
            <h2 class="my-2">Login Page</h2>

            <form action="./?page=login" method="POST">

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" value="" name="username" class="form-control <?php echo !empty($errUsername) ? 'is-invalid' : ''?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <span class="invalid-feedback"> <?php echo $errUsername ?></span>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Password</label>
                    <input type="password" value="" name="password" class="form-control <?php echo !empty($errPassword) ? 'is-invalid' : '' ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <span class="invalid-feedback"><?php echo $errPassword ?></span>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</section>

<!-- $username = $password = "";
$errUsername = $errPassword = "";

if (isset($_POST['username'], $_POST['password'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username)) {
        $errUsername = "Username is required";
    }

    if (empty($password)) {
        $errPassword = "Password is required";
    }

    // ONLY attempt login after validation
    if (empty($errUsername) && empty($errPassword)) {

        $user = loginUser($username, $password);

        if ($user !== false) {
            header("Location: ./?page=dashboard");
            exit();
        } else {
            echo '<div class="alert alert-danger" role="alert">
                Something went wrong. Please try again.
                or Go to Register <a href="./?page=register">Register</a>
            </div>';
        }
    }
} -->
