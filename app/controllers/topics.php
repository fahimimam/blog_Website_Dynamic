<?php

use function PHPSTORM_META\type;

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validateTopic.php");
include(ROOT_PATH . "/app/helpers/validateEdit.php");
include(ROOT_PATH . "/app/helpers/middleware.php");

$table = 'topics';

$errors = array();
$id = '';
$name = '';
$description = '';

$topics = selectAll($table);



if (isset($_POST['add-topic'])) {
    adminOnly();
    $errors = validateTopic($_POST);

    if (count($errors) == 0) {
        unset($_POST['add-topic']);
        $topic_id = create($table, $_POST);

        $_SESSION['message'] = 'Topic Created Successfully';
        $_SESSION['type'] = 'success';

        header('location: ' . BASE_URL . '/admin/topics/index_topics.php');
        exit();
    } else {
        $_SESSION['message'] = 'Topic Name Required';
        $_SESSION['type'] = 'error';
        $name = $_POST['name'];
        $description = $_POST['description'];
    }
}

if (isset($_POST['update-topic'])) {
    adminOnly();
    $errors = validateTopic($_POST);

    if (count($errors) == 0) {
        unset($_POST['update-topic']);
        $id = $_POST['id'];
        //dd($_POST);
        unset($_POST['id']);

        $topic_id = update($table, $id, $_POST);

        $_SESSION['message'] = 'Topic Updated Successfully';
        $_SESSION['type'] = 'success';

        header('location: ' . BASE_URL . '/admin/topics/index_topics.php');
        exit();
    } else {
        
        $name = $_POST['name'];
        $description = $_POST['description'];
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $topic = selectOne($table, ['id' => $id]);

    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];
}

if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $count = delete($table, $id);

    $_SESSION['message'] = 'Topic deleted Successfully';
    $_SESSION['type'] = 'success';

    header('location: ' . BASE_URL . '/admin/topics/index_topics.php');
    exit();
}


