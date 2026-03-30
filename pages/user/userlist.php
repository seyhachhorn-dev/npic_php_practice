<div class="container bg-light p-4 rounded">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>User List</h1>
        <a href="<?php echo $baseUrl ?>./?page=user/createuser" class="btn btn-success">Create User</a>
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
                        <img
                            src="<?php echo $row->photo ?? '../../assets/images/emptyuser.png'; ?>"
                            width="60">
                    </td>

                    <td><?php echo $row->name ?></td>
                    <td>
                        <a href="./?page=user/update&id=<?php echo $row->user_id ?>" class="btn btn-success">Update <i class="bi bi-pencil"></i></a>
                        <a href="./?page=user/delete&id=<?php echo $row->user_id ?>" class="btn btn-danger btn-delete">Delete <i class="bi bi-trash"></i></a>
                    </td>
                </tr>
            <?php
                $conn++;
            }
            ?>
        </tbody>



    </table>
</div>

<script>
    $(document).ready(
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "rgb(147, 147, 147)",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                 window.location.href = $(this).attr('href')

                    // title: "Deleted!",
                    // text: "Your file has been deleted.",
                    // icon: "success"
                };
            });
        })
    )
</script>