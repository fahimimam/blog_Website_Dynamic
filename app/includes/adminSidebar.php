<div class="left-sidebar">
    <ul>

        <?php if ($_SESSION['admin']) : ?>
            <li><a href="<?php echo BASE_URL . 'admin/posts/index_posts.php'; ?>">Manage Posts</a></li>
            <li><a href="<?php echo BASE_URL . 'admin/users/index_users.php'; ?>">Manage Users</a></li>
            <li><a href="<?php echo BASE_URL . 'admin/topics/index_topics.php'; ?>">Manage Topics</a></li>

        <?php else : ?>
            <li><a href="<?php echo BASE_URL . 'admin/posts/index_posts.php'; ?>">Manage Your Posts</a></li>
        <?php endif; ?>

    </ul>

</div>