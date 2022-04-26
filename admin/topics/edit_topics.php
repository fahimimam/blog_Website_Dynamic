<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/topics.php"); 
adminOnly();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Admin Section - Edit Topic</title>

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
                <a href="create_topics.php" class="btn btn-big">Add Topic</a>
                <a href="index_topics.php" class="btn btn-big">Manage Topics</a>

            </div>

            <div class="content">

                <h2 class="page-title">Edit Topic</h2>

                <form action="edit_topics.php" method="post">

                    <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>
                    
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div>
                        <label>Name</label>
                        <input type="text" name="name" value="<?php echo $name; ?>" class="text-input">
                    </div>

                    <div>
                        <label>Description</label>
                        <textarea name="description" id="body"><?php echo $description; ?></textarea>
                    </div>


                    <div>
                        <button type="submit" name="update-topic" class="btn btn-big">Update Topic</button>
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