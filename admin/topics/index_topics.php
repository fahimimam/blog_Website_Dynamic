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

    <title>Admin Section - Manage Topics</title>

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
                <a href="create_topics.php" class="btn btn-big">Add Topic</a>
                <a href="index_topics.php" class="btn btn-big">Manage Topics</a>

            </div>

            <div class="content">

                <h2 class="page-title">Manage Topics</h2>

                <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

                <table>
                    <thead>
                        <th>Serial No</th>
                        <th>Name</th>
                        <th colspan="2">Action</th>
                    </thead>

                    <tbody>
                        <?php foreach ($topics as $key => $topic) : ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $topic['name']; ?></td>
                                <td><a href="edit_topics.php?id=<?php echo $topic['id']; ?>" class="edit">Edit</a></td>
                                <td><a href="index_topics.php?del_id=<?php echo $topic['id']; ?> " class="delete">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>




                </table>

            </div>

        </div>
        <!-- Admin content ends -->

    </div>
    <!-- // Page Wrapper -->




</body>

</html>