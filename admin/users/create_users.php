<?php include("../../path.php");?>
<?php include(ROOT_PATH . "/app/controllers/users.php"); 
adminOnly();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Admin Section - Create User</title>

    <!-- FontAwsome Styling -->
    <link rel="stylesheet" href="../../assets/css/all.css">

    <!-- CUSTOM STYLING -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">

    <!-- Jquery -->
    <script src="../../js/jquery-3.5.1.min.js"></script>

    <!-- Ckeditor -->
    <script src="../ckeditor/ckeditor.js"></script>

    <!-- Custom Script -->
    <script src="../../assets/js/scripts.js"></script>

</head>

<body>
    <!-- ADmin header here -->
    <?php include(ROOT_PATH . "/app/includes/adminHeader.php"); ?>
    <!-- ADmin header ends here -->


    <!-- Page Wrapper -->
    <div class="admin-wrapper">

        <!-- Left side bar -->
        <?php include(ROOT_PATH . "/app/includes/adminSidebar.php"); ?>
        <!-- Left side bar ends -->

        <!-- Admin Content -->
        <div class="admin-content">
            <div class="button-group">
                <a href="create_users.php" class="btn btn-big">Add User</a>
                <a href="index_users.php" class="btn btn-big">Manage users</a>

            </div>

            <div class="content">

                <h2 class="page-title">Create User</h2>

                <form action="create_users.php" method="post" enctype="multipart/form-data">
                    <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

                    <div>
                        <label>Username</label>
                        <input type="text" value="<?php echo $username ?>" name="username" class="text-input">
                    </div>

                    <div>
                        <label>Email</label>
                        <input type="text" value="<?php echo $email ?>" name="email" class="text-input">
                    </div>

                    <div>
                        <label>Password</label>
                        <input type="password" value="<?php echo $password ?>" name="password" class="text-input">
                    </div>

                    <div>
                        <label>Confirm Password</label>
                        <input type="password" value="<?php echo $passwordconf ?>" name="passwordconf" class="text-input">
                    </div>

                    <div>
                    <?php if (empty($admin)) : ?>
                            <label>
                                <input type="checkbox" name="admin">Admin
                            </label>
                        <?php else : ?>
                            <label>
                                <input type="checkbox" name="admin" checked>Admin
                            </label>
                        <?php endif; ?>
                    </div>

                    <div>
                        <button type="submit" name="create-admin" class="btn btn-big">Add User</button>
                    </div>

                </form>

            </div>

        </div>
        <!-- Admin content ends -->

    </div>
    <!-- // Page Wrapper -->




    <script>
        CKEDITOR.replace('body');
    </script>
</body>

</html>