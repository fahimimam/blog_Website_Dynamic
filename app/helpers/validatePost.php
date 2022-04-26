<?php
function validatePost($post)
{
    $errors = array();
    //$errors = array();
    if (empty($post['title'])) {
        array_push($errors, 'Title is required');
    }

    if (empty($post['body'])) {
        array_push($errors, 'Body is required');
    }

    if (empty($post['topic_id'])) {
        array_push($errors, 'Please Select a Topic');
    }




    $existingPost = selectOne('posts', ['title' => $post['title']]);
    if ($existingPost) {
        //dd($post);
        //dd($existingPost);
        if (isset($post['update-post']) && $existingPost['title'] != $post['title']) {
            array_push($errors, 'Post With This Title already exists');
        }
        
        if(isset($post['add-post']))
        {
            array_push($errors, 'Post With This Title already exists');
        }
    }

    return $errors;
}
