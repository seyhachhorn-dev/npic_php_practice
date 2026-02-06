<?php 

$oldPassword = "";
$newPassword = "";

if(isset($_POST['changPassword'],$_POST["oldPassword"],$_POST["Newpassword"],$_POST["confirmNewPassword"])){
    $oldPassword = trim($_POST["oldPassword"]);
    $newPassword = trim($_POST["newPassword"]);
    $confirmPassword = trim($_POST["confirmNewPassword"]);

    if(empty($oldPassword)){
        $errOldPassword = "Old Password is Require!";
    }
     if(empty($newPassword)){
        $errNewPassword = "New Password is Require!!";
    }
     if($confirmPassword != $newPassword){
        $errNewPassword = "Password not Much!";
    }

}





?>
<div class="row">
    <div class="col-6"><h1>Img</h1></div>
    <div class="col-6">


    <section class="container mt-5">
    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-6 ">
            <h2 class="my-2">Change Password</h2>

            <form action="./?page=profile" method="POST">

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Old Password</label>
                    <input type="text"  name="oldPassword" class="form-control <?php echo !empty($errOldPassword) ? 'is-invalid' : '' ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <span class="invalid-feedback"><?php echo $errOldPassword ?></span>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">New Password</label>
                    <input type="password" value="" name="Newpassword" class="form-control <?php echo !empty($errNewPassword) ? 'is-invalid' : '' ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <span class="invalid-feedback"><?php echo $errNewPassword ?></span>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Confirm New Password</label>
                    <input type="password" value="" name="confirmNewPassword" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>

                <button type="submit" name="changPassword" class="btn btn-primary">Change</button>
            </form>
        </div>
    </div>
</section>


    </div>
</div>