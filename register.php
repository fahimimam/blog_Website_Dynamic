<?php include("path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/users.php"); 
guestsOnly();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"  content="ie=edge">

    <!-- FontAwsome Styling -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">

    <!-- CUSTOM STYLING -->
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Reister</title>

    <!-- Jquery -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>


    <!-- Custom Script -->
    <script src="assets/js/scripts.js"></script>

</head>

<body>

    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

    <div class="auth-content">
        <form action="register.php" method="post">
            <h2 class="form-title">
                Register
            </h2>

            <!-- ERror messages -->
            <?php include(ROOT_PATH . "/app/helpers/formErrors.php");?>

            <div>
                <label>Username</label>
                <input type="text" value="<?php echo $username; ?>" name="username" class="text-input">
            </div>

            <div>
                <label>Email</label>
                <input type="text" value="<?php echo $email; ?>" name="email" class="text-input">
            </div>

            <div>
                <label>Password</label>
                <input type="password" value="<?php echo $password; ?>" name="password" class="text-input">
            </div>

            <div>
                <label>Confirm Password</label>
                <input type="password" value="<?php echo $passwordconf; ?>" name="passwordconf" class="text-input">
            </div>

            <div>
                <button type="submit" name="register-button" class="btn btn-big">Register</button>
            </div>

            <p>Or <a href="<?php echo BASE_URL . '/login.php' ?>">Sign In</a></p>

        </form>
    </div>



</body>

</html>