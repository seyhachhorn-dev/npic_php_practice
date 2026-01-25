<?php
// declar var

$name = "";
$username = "";
$password = "";


// handle the value first 
if (isset($_POST['name'], $_POST['username'], $_POST['password'], $_POST['confirmPassword'])) {
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    // simple validation

    if (empty($name)) {
        $errName = "Name is required";
    }
    if (empty($username)) {
        $errUsername = "Username is required";
    }

    if (empty($password)) {
        $errPassword = "Password is required";
    }
    if ($password !== $confirmPassword) {
        $errPassword = "Password does not match";
    }

    if (isUsernameExists($username)) {
        $errUsername = "Username already exists";
    }

    if (empty($errName) && empty($errUsername) && empty($errPassword)) {
        if (registerUser($name, $username, $password)) {
            $username = $name = $password = $confirmPassword = "";
            echo '<div class="alert alert-success" role="alert">
  Create Account Successfully! .Go to <a href="./?page=login">Login</a>
</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
    Something went wrong. Please try again. or Go to Login <a href="./?page=login">Login</a>
</div>';
        }
    }
}



?>

<section class="container mt-5">
    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-6 ">
            <h2 class="my-2">Register Page</h2>

            <form action="./?page=register" method="POST">

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input type="text" value="<?php echo $name ?>" name="name" class="form-control <?php echo !empty($errName) ? 'is-invalid' : '' ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <span class="invalid-feedback"><?php echo $errName ?></span>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" value="<?php echo $username ?>" name="username" class="form-control <?php echo !empty($errUsername) ? 'is-invalid' : '' ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <span class="invalid-feedback"> <?php echo $errUsername ?></span>
                </div>


                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Password</label>
                    <input type="password" value="" name="password" class="form-control <?php echo !empty($errPassword) ? 'is-invalid' : '' ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <span class="invalid-feedback"><?php echo $errPassword ?></span>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Confirm Password</label>
                    <input type="password" value="" name="confirmPassword" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</section>