<?php include("../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/posts.php");
adminOnly(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Admin Section - Dashboard</title>

    <!-- FontAwsome Styling -->
    <link rel="stylesheet" href="../assets/css/all.css">

    <!-- CUSTOM STYLING -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="style.css">

    <!-- Jquery -->
    <script src="../js/jquery-3.5.1.min.js"></script>

    <!-- Ckeditor -->
    <script src="ckeditor/ckeditor.js"></script>

    <!-- Custom Script -->
    <script src="../assets/js/scripts.js"></script>

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

            <div class="content">

                <h2 class="page-title">Dashboard</h2>

                <?php include(ROOT_PATH . '/app/includes/messages.php'); ?>
                <div class="welcome">
                    <h2>Welcome <?php echo $_SESSION['username'] ?></h3>
                </div>


                <div class="smiley">
                    <div class="eyes">

                    </div>
                    <div class="lips">

                    </div>

                </div>





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