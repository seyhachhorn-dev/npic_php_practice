<div class="container bg-light p-4 rounded">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>User List</h1>
        <a href="<?php echo $baseUrl ?>?page=user/createuser" class="btn btn-success">Create User</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>photo</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

            <?php
            $users = getAllUsersNotAdmin();
            $conn = 1;
            while ($row = $users->fetch_object()) {

            ?>
                <tr>
                    <td><?php echo $conn ?></td>
                    <td>
                        <img src="
                 <?php echo $row->photo ?? '../../assets/images/emptyuser.png' ?>
                        ">
                    </td>
                    <td><?php echo $row->name ?></td>
                    <td>
                        <button class="btn btn-success">Update</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            <?php
                $conn++;
            }
            ?>
        </tbody>



    </table>
</div>