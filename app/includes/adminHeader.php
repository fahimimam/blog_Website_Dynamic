<header>
    <a href="<?php echo BASE_URL . '/index.php'; ?>" class="logo">
        <h1 class="logo-text"><span>Alpha</span>Bee</h1>
    </a>

    <i class="fas fa-bars menu-toggle"></i>

    <ul class="nav">
        <?php if (isset($_SESSION['username'])) : ?>
            <li>
                <a href="#">
                    <i class="fa fa-user"></i>
                    <?php echo $_SESSION['username']; ?>
                    <i class="far fa-caret-square-down" style="font-size: .8em;"></i>
                </a>
                <ul>
                    <li><a href="<?php echo BASE_URL . '/index.php' ?>">Home Page</a></li>
                    <li><a href="<?php echo BASE_URL . "/logout.php"; ?>" class="logout">Logout</a></li>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
</header>