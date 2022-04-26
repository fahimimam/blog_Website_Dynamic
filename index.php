<?php include("path.php");
include(ROOT_PATH . "/app/controllers/topics.php");
$posts = array();
$postsTitle = "Recent Posts";

if (isset($_GET['t_id'])) {
    $posts = getPostsByTopicId($_GET['t_id']);
    $postsTitle = "You Searched For '" . $_GET['name'] . "'";
} else if (isset($_POST['search-term'])) {
    $postsTitle = "You Searched For '" . $_POST['search-term'] . "'";
    $posts = searchPosts($_POST['search-term']);
} else {
    $posts = getPublishedPosts();
}

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
    <title>Blog</title>

    <!-- Jquery -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>

    <!-- Slick Carousel -->
    <script src="assets/js/slick.min.js"></script>

    <!-- Custom Script -->
    <script src="assets/js/scripts.js"></script>

</head>

<body>
    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>
    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Post Slider -->
        <div class="post-slider">
            <h1 class="slider-title">Trending Posts</h1>

            <i class="fas fa-chevron-left prev"></i>
            <i class="fas fa-chevron-right next"></i>

            <!-- POST WRAPPER sTARTS -->
            <div class="post-wrapper">

                <?php foreach ($posts as $post) : ?>
                    <div class="post">

                        <img src="<?php echo BASE_URL . '/assets/images/' . $post['image'] ?>" class="slider-image">
                        <div class="post-info">
                            <h4>
                                <a href="single.php?id=<?php echo $post['id']; ?>" target="_blank"><?php echo $post['title'] ?></a>
                            </h4>
                            <i class="far fa-user"><?php echo $post['username']; ?></i>
                            &nbsp;
                            <i class="far fa-calendar"> <?php echo date('F j, Y', strtotime($post['created_at'])) ?></i>
                        </div>

                    </div>

                <?php endforeach; ?>

            </div>
            <!-- POST WRAPPER ENDS -->



        </div>
        <!-- //Post slider -->

        <!-- Content -->
        <div class="content clearfix">

            <!-- Main Content -->
            <div class="main-content">
                <h1 class="recent-post-title"><?php echo  $postsTitle ?></h1>

                <!-- POSTS START -->
                <?php $i = 0;
                foreach ($posts as $post) :
                    if ($i == 4)
                        break;
                ?>
                    <div class="post clearfix">
                        <img src="<?php echo BASE_URL . '/assets/images/' . $post['image'] ?>" class="post-image">
                        <div class="post-preview">
                            <h2><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title'] ?></a></h1>
                                <i class="far fa-user"> <?php echo $post['username']; ?></i>
                                &nbsp;
                                <i class="far fa-calendar-times"> <?php echo date('F j, Y', strtotime($post['created_at'])) ?></i>
                                <p class="preview-text">
                                    <?php echo  html_entity_decode(substr($post['body'], 0, 50) . '...'); ?>
                                </p>
                                <a href="single.php?id=<?php echo $post['id']; ?>" class="btn read-more">Read More...</a>
                        </div>
                    </div>
                    <?php $i = $i+1; ?>
                <?php endforeach; ?>


                <button onclick="location.href='all_posts.php'" class="btn btn-big" style="width: 90%; height:50px;">All Posts</button>


                <!-- POSTS ENDS -->
            </div>
            <!-- // Main Content -->

            <!-- SideBar Starts -->
            <div class="sidebar">

                <div class="section search">
                    <h2 class="section-title">Search</h2>
                    <form action="index.php" method="post">
                        <input type="text" name="search-term" class="text-input" placeholder="Search...">
                    </form>
                </div>

                <div class="section topics">
                    <h2 class="section-title">Topics</h2>
                    <ul>
                        <?php foreach ($topics as $key => $topic) : ?>
                            <a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?></a>
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
    <!-- Footer ends -->


</body>

</html>