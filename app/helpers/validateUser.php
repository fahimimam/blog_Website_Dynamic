<?php
$email = '';
function validateUser($user)
{
    $errors = array();
    if (empty($user['username'])) {
        array_push($errors, 'Username is required');
    }
    else
    {
        $name = $user["username"];
    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        array_push($errors, 'Username contains only letters and White-space');
    }
    }

    

    if (empty($user["email"])) {
        array_push($errors, 'Email is required');
    } else {
        $email = $user['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, 'Invalid Email Format');
        }
    }

    if (empty($user['password'])) {
        array_push($errors, 'Password is required');
    }


    if ($user['passwordconf'] != $user['password']) {
        array_push($errors, 'Password Doesnt Match');
    }


    $existingUser = selectOne('users', ['email' => $user['email']]);

    if ($existingUser) {
        if (isset($user['update-user']) && $existingUser['email'] != $user['email']) {
            array_push($errors, 'Email Already Exists');
        }

        if (isset($user['create-admin'])) {
            array_push($errors, 'Email Already Exists');
        }
        if (isset($user['register-button'])) {
            array_push($errors, 'Email Already Exists');
        }
    }

    return $errors;
}

function validateLogin($user)
{
    $errors = array();
    //$errors = array();
    if (empty($user['username'])) {
        array_push($errors, 'Username is required');
    }

    if (empty($user['password'])) {
        array_push($errors, 'Password is required');
    }

    return $errors;
}
