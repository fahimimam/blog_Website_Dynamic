<?php
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validateUser.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
//validation of register fields
$table = 'users';


$admin_users = selectAll($table);

$id = '';
$username = '';
$email = '';
$password = '';
$passwordconf = '';
$admin = '';
$errors = array();
$count = '';

function loginUser($user)
{
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['message'] = "You are now logged in";
    $_SESSION['type'] = "success";

    if ($_SESSION['admin']) {
        header('location: ' . BASE_URL . 'admin/dashboard.php');
    } else {
        header('location: ' . BASE_URL . '/index.php');
    }

    exit();
}


if (isset($_POST['register-button']) || isset($_POST['create-admin'])) {

    $errors = validateUser($_POST);

    if (count($errors) == 0) {
        
        unset($_POST['register-button'], $_POST['passwordconf'], $_POST['create-admin']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if (isset($_POST['admin'])) {
            $_POST['admin'] = 1;
            $user_id = create($table, $_POST);
            $_SESSION['message'] = 'Admin user created Successfully';
            $_SESSION['type'] = 'success';
            header('location: ' . BASE_URL . '/admin/users/index_users.php');
            exit();
        } else {
            $_POST['admin'] = 0;
            $user_id = create($table, $_POST);
            $user = selectOne($table, ['id' => $user_id]);
            $email = $_POST['email'];
            $password = $_POST['password'];
            $passwordconf = $_POST['passwordconf'];
            //log a user in 
            loginUser($user);
        }
    } else {
        //Save the unsaved data on form if error is occured
        //then these vars are echo-ed
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordconf = $_POST['passwordconf'];
        $admin = isset($_POST['admin']) ? 1 : 0;
    }
}

if (isset($_POST['update-user'])) {
    adminOnly();

    $errors = validateUser($_POST);
    $id = $_POST['id'];
    if (count($errors) == 0) {

        unset($_POST['update-user'], $_POST['passwordconf'], $_POST['id']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $_POST['admin'] = isset($_POST['admin']) ? 1 : 0;
        /* dd($_POST); */
        $count = update($table, $id, $_POST);
        if($_POST['admin'])
        {
            $_SESSION['message'] = 'Admin User Updated Successfully';
        }
        else
        {
            $_SESSION['message'] = 'User Updated Successfully';
        }
        $_SESSION['type'] = 'success';
        $_SESSION['username'] = $_POST['username'];
        header('location: ' . BASE_URL . '/admin/users/index_users.php');
        exit();
    } else {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $admin = isset($_POST['admin']) ? 1 : 0;
    }
}

if (isset($_POST['login-btn'])) {
    $errors = validateLogin($_POST);

    if (count($errors) == 0) {
        $user = selectOne($table, ['username' => $_POST['username']]);

        if ($user && password_verify($_POST['password'], $user['password'])) {
            loginUser($user);
        } else {
            array_push($errors, 'Wrong Credentials');
        }
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
}

if (isset($_GET['id'])) {
    $user = selectOne($table, ['id' => $_GET['id']]);
    $username = $user['username'];
    $email = $user['email'];
    $admin = $user['admin'];
}

if (isset($_GET['delete_id'])) {
    adminOnly();
    $count = delete($table, $_GET['delete_id']);
    $_SESSION['message'] = 'Admin User Deleted';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/users/index_users.php');
    exit();
}

///Admin Codes
