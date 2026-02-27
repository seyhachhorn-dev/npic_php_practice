<?php

$oldPassword = $newPassword = $confirmPassword = "";
$errNewPassword = $errOldPassword = "";

if (isset($_POST['changPassword'], $_POST["oldPassword"], $_POST["newPassword"], $_POST["confirmNewPassword"])) {
    $oldPassword = trim($_POST["oldPassword"]);
    $newPassword = trim($_POST["newPassword"]);
    $confirmPassword = trim($_POST["confirmNewPassword"]);

    if (empty($oldPassword)) {
        $errOldPassword = "Old Password is Require!";
    }
    if (empty($newPassword)) {
        $errNewPassword = "New Password is Require!!";
    }
    if ($confirmPassword != $newPassword) {
        $errNewPassword = "Password not Much!";
    }

    if (!IsUserPasswordCorrect($oldPassword)) {
        $oldPasswdErr = 'password or username is incorrect';
    }

    if (empty($errNewPassword) && empty($errOldPassword)) {
        if (setNewPassword($newPassword)) {
            header('Location: ./?page=logout');
        } else {
            echo '<div class="alert alert-danger" role="alert">
                try aggain.
                </div>';
        }
    }
}

if (isset($_POST['uploadPhoto']) && isset($_FILES['photo'])) {
    $photo = $_FILES['photo'];
    if (empty($photo)) {
        echo '<div class="alert alert-danger" role="alert">
                Please select a photo.
                </div>';
    } else {
        try {

            if (changeProfileImage($photo)) {
                echo '<div class="alert alert-success" role="alert">
                Photo uploaded successfully.
                </div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">
                Failed to upload photo.
                </div>';
            }
        } catch (Exception $e) {
            echo '<div class="alert alert-danger" role="alert"> 
                ' . $e->getMessage() . '
                </div>';
        }
    }
}

if (isset($_POST['deletePhoto'])) {
    deleteImageProfile();
    header("Location: ./?page=profile");
}


?>
<div class="row">
    <div class="col-6">
        <form method="post" action="./?page=profile" enctype="multipart/form-data">
            <div class="d-flex justify-content-center">
                <input name="photo" type="file" id="profileUpload" hidden>
                <label role="button" for="profileUpload">
                    <img src="
                     <?php

                        if (!empty(trim(isUserLogged()->photo))) {
                            echo isUserLogged()->photo;
                        } else {
                            echo './assets/images/emptyuser.png';
                        }

                        ?>"
                        class="rounded img-thumbnail"
                        style="width:200px; height:200px; object-fit: cover;">
            </div>
            <div class="d-flex justify-content-center gap-2 mt-2">
                <button type="submit" name="deletePhoto" class="btn btn-danger">Delete</button>
                <button type="submit" name="uploadPhoto" class="btn btn-success">Upload</button>
            </div>
        </form>
    </div>
    <div class="col-6">

        <section class="container mt-5">
            <div class="row justify-content-center">

                <div class="col-md-8 col-lg-6 ">
                    <h2 class="my-2">Change Password</h2>

                    <form action="./?page=profile" method="POST">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Old Password</label>
                            <input type="text" name="oldPassword" class="form-control <?php echo !empty($errOldPassword) ? 'is-invalid' : '' ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <span class="invalid-feedback"><?php echo $errOldPassword ?></span>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">New Password</label>
                            <input type="password" value="" name="newPassword" class="form-control <?php echo !empty($errNewPassword) ? 'is-invalid' : '' ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
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