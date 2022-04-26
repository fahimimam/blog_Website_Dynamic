<header>
    <a href="<?php echo BASE_URL . '/index.php' ?>" class="logo">
        <h1 class="logo-text"><span>Alpha</span>Bee</h1>
    </a href>

    <i class="fas fa-bars menu-toggle"></i>

    <ul class="nav">
        <li><a href="<?php echo BASE_URL . '/index.php' ?>">Home</a></li>
        <li><a href="<?php echo BASE_URL . '/about.php' ?>">About</a></li>
        <li><a href="<?php echo BASE_URL . '/admin/posts/create_posts.php' ?>">Add Post</a></li>
        <?php if (isset($_SESSION['id'])) : ?>
            
            <li>
                <a href="#">
                    <i class="fa fa-user"></i>
                    <?php echo $_SESSION['username']; ?>
                    <i class="far fa-caret-square-down" style="font-size: .8em;"></i>
                </a>
                <ul>
                    <?php if ($_SESSION['admin']) : ?>
                        <li><a href="<?php echo BASE_URL . '/admin/dashboard.php' ?>">Dashboard</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo BASE_URL . '/logout.php' ?>" class="logout">Logout</a></li>
                </ul>
            <?php else : ?>
            <li><a href="<?php echo BASE_URL . '/register.php' ?>">Sign Up</a></li>
            <li><a href="<?php echo BASE_URL . '/login.php' ?>">Login</a></li>
        <?php endif; ?>

    </ul>
</header>