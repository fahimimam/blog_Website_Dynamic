<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/posts.php"); 
usersOnly();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Admin Section - Create Posts</title>

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
                <a href="create_posts.php" class="btn btn-big">Add Posts</a>
                <a href="index_posts.php" class="btn btn-big">Manage Posts</a>

            </div>

            <div class="content">

                <h2 class="page-title">Create Posts</h2>



                <form action="create_posts.php" method="post" enctype="multipart/form-data">
                    <?php include(ROOT_PATH . '/app/helpers/formErrors.php'); ?>
                    <div>
                        <label>Title</label>
                        <input type="text" value="<?php echo $title ?>" name="title" class="text-input">
                    </div>

                    <div>
                        <label>Body</label>
                        <textarea name="body" id="body"><?php echo $body ?></textarea>
                    </div>

                    <div>
                        <label>Image</label>
                        <input type="file" name="image" value="<?php echo $image_name ?>" class="text-input">
                    </div>

                    <div>
                        <label>Topic</label>
                        <select name="topic_id" class="text-input">
                            <option value=""></option>

                            <?php foreach ($topics as $key => $topic) : ?>

                                <?php if (!empty($topic_id) && $topic_id == $topic['id']) : ?>
                                    <option selected value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
                                <?php else : ?>
                                    <option value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
                                <?php endif; ?>

                            <?php endforeach; ?>


                        </select>
                    </div>

                    <?php if($_SESSION['admin']): ?>
                        <div>
                        <?php if (empty($publish)) : ?>
                            <label>
                                <input type="checkbox" name="publish">Publish
                            </label>
                        <?php else : ?>
                            <label>
                                <input type="checkbox" name="publish" checked>Publish
                            </label>
                        <?php endif; ?>
                    </div>
                        <?php endif;?>

                    

                    <div>
                        <button type="submit" name="add-post" class="btn btn-big">Add post</button>
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