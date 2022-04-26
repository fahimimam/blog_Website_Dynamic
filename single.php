<?php include("path.php"); ?>
<?php include(ROOT_PATH . '/app/controllers/posts.php');

if (isset($_GET['id'])) {

    $post = selectOne('posts', ['id' => $_GET['id']]);
}

if (isset($_GET['t_id'])) {
    $posts = getPostsByTopicId($_GET['t_id']);
    $postsTitle = "You Searched For '" . $_GET['name'] . "'";
}

$posts = selectAll('posts', ['publish' => 1]);
$topics = selectAll('topics');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- FontAwsome Styling -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">

    <!-- CUSTOM STYLING -->
    <link rel="stylesheet" href="assets/css/style.css">

    <title><?php echo $post['title']; ?> | AlphaBee</title>

    <!-- Jquery -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>

    <!-- Custom Script -->
    <script src="assets/js/scripts.js"></script>

</head>

<body>
    <!-- Facebook Page PLUGIN SDK -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v8.0" nonce="ER0E4QBy">
    </script>

    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Content -->
        <div class="content clearfix">

            <div class="main-content-wrapper">

                <!-- Main Content -->
                <div class="main-content single">
                    <h1 class="post-title"><?php echo $post['title']; ?> | AlphaBee</h1>
                    <div class="post-content">
                        <?php echo html_entity_decode($post['body']); ?>
                    </div>

                    <form action="single.php" method="post">

                    </form>

                </div>
                <!-- // Main Content -->

            </div>

            <!-- SideBar Starts -->
            <div class="sidebar single">

                <div class="fb-page" data-href="https://www.facebook.com/mr.obayed" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                    <blockquote cite="https://www.facebook.com/mr.obayed" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/mr.obayed">Mr. Obayed</a></blockquote>
                </div>

                <div class="popular">
                    <h2 class="section-title">Popular Posts</h2>

                    <?php $i = 0;
                    foreach ($posts as $p) :
                        if ($i == 4)
                            break; ?>
                        <div class="post clearfix">
                            <img src="<?php echo BASE_URL . '/assets/images/' . $p['image']; ?>" alt="alone" class="pop-image">
                            <a href="single.php?id=<?php echo $p['id']; ?>" class="pop-title">
                                <h4><?php echo $p['title'] ?></h4>
                            </a>
                        </div>
                        <?php $i = $i + 1; ?>
                    <?php endforeach; ?>




                    <div class="section topics">
                        <h2 class="section-title">Topics</h2>
                        <ul>
                            <?php foreach ($topics as $topic) : ?>
                                <li>
                                    <a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    </div>

                </div>
                <!-- Sidebar Ends -->
            </div>

            <!-- //content -->

        </div>
        <!-- // Page Wrapper -->


        <!-- Footer -->
        <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>
        <!-- //Footer Ends -->


</body>

</html>