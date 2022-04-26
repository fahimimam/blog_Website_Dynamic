<?php
session_start();
require('connect.php');

function dd($value) //to be deleted
{
    echo "<pre>", print_r($value, true), "</pre>";
    die();
}

function executeQuery($sql, $data)
{
    global $conn;
    $stmt = $conn->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt;
}

function selectAll($table, $conditions = [])
{
    global $conn;

    $sql = "SELECT * FROM $table";

    if (empty($conditions)) {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    } else {
        //return records that matches conditions
        //$sql = "SELECT * FROM $table WHERE username='fahim' AND admin=1";
        $i = 0;
        foreach ($conditions as $key => $value) {

            if ($i == 0) {
                $sql = $sql . " WHERE $key=?";
            } else {
                $sql = $sql . " AND $key=?";
            }
            $i++;
        }
        //dd($sql);

        $stmt = executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
}


function selectOne($table, $conditions)
{
    global $conn;
    $sql = "SELECT * FROM $table";


    //return records that matches conditions
    $i = 0;
    foreach ($conditions as $key => $value) {
        if ($i == 0) {
            $sql = $sql . " WHERE $key=?";
        } else {
            $sql = $sql . " AND $key=?";
        }
        $i++;
    }
    //dd($sql);
    $sql = $sql . " LIMIT 1";
    $stmt = executeQuery($sql, $conditions);
    $records = $stmt->get_result()->fetch_assoc();
    return $records;
}

function create($table, $data)
{
    global $conn;
    //sql = insert into users set username=? 
    $sql = "INSERT INTO $table SET ";

    $i = 0;
    foreach ($data as $key => $value) {
        if ($i == 0) {
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }

    $stmt = executeQuery($sql, $data);
    $id = $stmt->insert_id;
    return $id;
}

function update($table, $id, $data)
{
    global $conn;
    //sql = "UPDATE users SET username=?, email=? WHERE id=?" 
    $sql = "UPDATE $table SET ";

    $i = 0;
    foreach ($data as $key => $value) {
        if ($i == 0) {
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }

    $sql = $sql . " WHERE id=?";
    $data['id'] = $id;
    $stmt = executeQuery($sql, $data);
    $id = $stmt->insert_id;
    return $stmt->affected_rows;
}

function delete($table, $id)
{
    global $conn;
    //sql = "DELETE from users SET username=?, email=? WHERE id=?" 
    $sql = "DELETE FROM $table WHERE id=? ";




    $stmt = executeQuery($sql, ['id' => $id]);
    return $stmt->affected_rows;
}


function getPublishedPosts()
{
    global $conn;
    $sql = "Select p.*, u.username FROM posts as p JOIN users AS u ON p.user_id=u.id WHERE p.publish=? ORDER by p.created_at DESC";
    $stmt = executeQuery($sql, ['publish' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getPostsByTopicId($topic_id)
{
    global $conn;
    $sql = "Select p.*, u.username FROM posts as p JOIN users AS u ON p.user_id=u.id WHERE p.publish=? AND topic_id=? ORDER by p.created_at DESC";
    $stmt = executeQuery($sql, ['publish' => 1, 'topic_id' => $topic_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getPostByID($user_id)
{
    global $conn;
    $sql = "Select p.*, u.username FROM posts as p JOIN users AS u ON p.user_id=u.id WHERE p.publish=? AND u.id=? ORDER by p.created_at DESC";
    $stmt = executeQuery($sql, ['publish' => 1, 'user_id' => $user_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}


function getPostsWithUsername()
{
    global $conn;
    $sql = "Select p.*, u.username FROM posts as p JOIN users AS u ON p.user_id=u.id ORDER by p.created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function searchPosts($term)
{
    $match = '%' . $term . '%';
    global $conn;
    $sql = "Select
     p.*, u.username 
     FROM posts as p 
     JOIN users AS u 
     ON p.user_id=u.id 
     WHERE p.publish=? 
     AND p.title LIKE ? OR p.body LIKE ?
     ORDER by p.created_at DESC";
    $stmt = executeQuery($sql, ['publish' => 1, 'title' => $match, 'body' => $match]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}


/*  $data = [
    'username' => 'sayemamar',
    'admin' => 0,
    'email' => 'sayem@fahim.com',
    'password' => 'sayem'  
];

$id = create('users', $data);
dd($id); */