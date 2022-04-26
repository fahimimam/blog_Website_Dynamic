<?php

function validateEdit($topic)
{
    $errors = array();
    //$errors = array();
    if (empty($topic['name'])) {
        array_push($errors, 'Name is required');
    }

    $existingTopic = selectOne('topics', ['name' => $topic['name']]);
    if ($existingTopic) {
        if (isset($topic['update-topic']) && $existingTopic['name'] != $topic['name']) {
            array_push($errors, 'Same Topic Name Exists');
        }
    }

    


    return $errors;
}
