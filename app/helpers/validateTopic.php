<?php

function validateTopic($topic)
{
    $errors = array();
    //$errors = array();
    if (empty($topic['name'])) {
        array_push($errors, 'Name is required');
    }


    $existingTopic = selectOne('topics', ['name' => $topic['name']]);
    if ($existingTopic) {
        if (isset($topic['update-topic']) && $existingTopic['name'] != $topic['name']) {
            array_push($errors, 'Name Already Exists');
        }
        
        if(isset($topic['add-topic']))
        {
            array_push($errors, 'Name Already Exists');
        }
    }

    return $errors;
}
