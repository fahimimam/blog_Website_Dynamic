<?php
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validatePost.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
$table = 'posts';

if(isset($_SESSION['id']))
{
    $posts_user = getPostByID($_SESSION['id']);
}


$topics = selectAll('topics');
$posts = getPostsWithUsername($table);
$errors = array();
$title = "";
$body = "";
$topic_id = "";
$publish = "";
$image_name = '';
$destination = '';
$id = '';

if (isset($_GET['id'])) {
    $post = selectOne($table, ['id' => $_GET['id']]);
    /* dd($post); */

    $title = $post['title'];
    $id = $post['id'];
    $body = $post['body'];
    $topic_id = $post['topic_id'];
    $publish = $post['publish'];
}

if (isset($_GET['delete_id'])) {
    usersonly();
    $count = delete($table, $_GET['delete_id']);
    $_SESSION['message'] = 'Post deleted Successfully';
    $_SESSION['type'] = 'success';
    header("location: " . BASE_URL . "/admin/posts/index_posts.php");
    exit();
}

if (isset($_GET['publish']) && isset($_GET['p_id'])) {
    adminOnly();
    $publish = $_GET['publish'];
    $p_id = $_GET['p_id'];

    $count = update($table, $p_id, ['publish' => $publish]);

    $_SESSION['message'] = 'Post Publish Statement Changed';
    $_SESSION['type'] = 'success';
    header("location: " . BASE_URL . "/admin/posts/index_posts.php");
    exit();
}

if (isset($_POST['add-post'])) {
    usersOnly();
    $errors = validatePost($_POST);

    /* dd($_FILES['image']['name']); */

    if (!empty($_FILES['image']['name'])) {

        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/assets/images/" . $image_name;
        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($result) {
            $_POST['image'] = $image_name;
        } else {
            array_push($errors, "Failed To Upload Image");
        }
    } else {
        array_push($errors, 'Post image Required');
    }

    if (count($errors) == 0) {
        unset($_POST['add-post']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['publish'] = isset($_POST['publish']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);
        $post_id = create($table, $_POST);
        /* dd($_POST); */

        $_SESSION['message'] = 'Post Created Successfully';
        $_SESSION['type'] = 'success';
        if ($_SESSION['admin']) {
            header("location: " . BASE_URL . "/admin/posts/index_posts.php");
            exit();
        }

        if ($_SESSION['admin'] == 0) {
            header("location: " . BASE_URL . "/index.php");
            exit();
        }
    } else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $topic_id = $_POST['topic_id'];
        $publish = isset($_POST['publish']) ? 1 : 0;
    }
}

if (isset($_POST['update-post'])) {
    usersOnly();
    $errors = validatePost($_POST);

    if (!empty($_FILES['image']['name'])) {

        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/assets/images/" . $image_name;
        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($result) {
            $_POST['image'] = $image_name;
        } else {
            array_push($errors, "Failed To Upload Image");
        }
    } else {
        array_push($errors, 'Post image Required');
    }

    if (count($errors) == 0) {
        $id = $_POST['id'];
        unset($_POST['update-post'], $_POST['id']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['publish'] = isset($_POST['publish']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);
        $post_id = update($table, $id, $_POST);
        /* dd($_POST); */

        $_SESSION['message'] = 'Post Updated Successfully';
        $_SESSION['type'] = 'success';
        header("location: " . BASE_URL . "/admin/posts/index_posts.php");
        exit();
    } else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $topic_id = $_POST['topic_id'];
        $publish = isset($_POST['publish']) ? 1 : 0;
    }
}
