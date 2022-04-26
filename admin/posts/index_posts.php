<?php include("../../path.php"); ?>
<?php 
include(ROOT_PATH . "/app/controllers/posts.php");
usersOnly();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Admin Section - Manage Posts</title>

    <!-- FontAwsome Styling -->
    <link rel="stylesheet" href="../../assets/css/all.css">

    <!-- CUSTOM STYLING -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">

    <!-- Jquery -->
    <script src="../../js/jquery-3.5.1.min.js"></script>

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

                <h2 class="page-title">Manage Posts</h2>
                <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>
                <table>
                    <thead>
                        <th>Serial No</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th colspan="3">Action</th>
                    </thead>

                    <tbody>

                        <?php if ($_SESSION['admin']) : ?>

                            <?php foreach ($posts as $key => $post) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?> </td>
                                    <td><?php echo $post['title'] ?></td>
                                    <td><?php echo $post['username'] ?></td>
                                    <td><a href="edit_posts.php?id=<?php echo $post['id']; ?>" class="edit">Edit</a></td>
                                    <td><a href="edit_posts.php?delete_id=<?php echo $post['id']; ?>" class="delete">Delete</a></td>
                                    <?php if ($post['publish']) : ?>
                                        <td><a href="edit_posts.php?publish=0&p_id=<?php echo $post['id'] ?>" class="unpublish">Unpublish</a></td>
                                    <?php else : ?>
                                        <td><a href="edit_posts.php?publish=1&p_id=<?php echo $post['id'] ?>" class="publish">Publish</a></td>
                                    <?php endif;  ?>

                                </tr>
                            <?php endforeach; ?>

                        <?php else : ?>
                            <?php foreach ($posts_user as $key => $post) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?> </td>
                                    <td><?php echo $post['title'] ?></td>
                                    <td><?php echo $post['username'] ?></td>
                                    <td><a href="edit_posts.php?id=<?php echo $post['id']; ?>" class="edit">Edit</a></td>
                                    <td><a href="edit_posts.php?delete_id=<?php echo $post['id']; ?>" class="delete">Delete</a></td>

                                </tr>
                            <?php endforeach; ?>

                        <?php endif; ?>


                    </tbody>




                </table>

            </div>

        </div>
        <!-- Admin content ends -->

    </div>
    <!-- // Page Wrapper -->




</body>

</html>