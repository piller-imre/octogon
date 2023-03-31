<?php

require '../database.php';

function test_createPost_successful()
{
    $connection = db\connect('demo');
    $post = array(
        'content' => 'This is a new post',
        'upload_date' => '2023-03-30'
    );
    $postId = db\createPost($connection, $post);
    assert(5, $postId);
    $retrieved = db\getPostById($connection, $postId);
    assert('This is a new post', $retrieved['content']);
    assert('2023-03-30', $retrieved['upload_date']);
}

function test_createPost_missingContent()
{
    $connection = db\connect('demo');
    $post = array(
        'content' => '',
        'upload_date' => '2023-03-30'
    );
    try {
        $_ = db\createPost($connection, $post);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The content of the post is missing!', $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_collectPosts_empty()
{
    $connection = db\connect('empty');
    $posts = db\collectPosts($connection);
    assert([] === $posts);
}

function test_collectPosts_multiple()
{
    $connection = db\connect('demo');
    $posts = db\collectPosts($connection);
    assert(4, count($posts));
    assert('Latest post' === $posts[0]['content']);
    assert('2023-03-30' === $posts[0]['upload_date']);
    assert('Third post' === $posts[1]['content']);
    assert('2022-04-20' === $posts[1]['upload_date']);
    assert('Second post' === $posts[2]['content']);
    assert('2018-10-12' === $posts[2]['upload_date']);
    assert('Oldest post' === $posts[3]['content']);
    assert('2010-02-03' === $posts[3]['upload_date']);
}

function test_collectPosts_reordered()
{
    $connection = db\connect('demo');
    $post = array(
        'content' => 'Renewed content',
        'upload_date' => '2023-03-28'
    );
    db\updatePost($connection, 1, $post);
    $posts = db\collectPosts($connection);
    assert(4, count($posts));
    assert('Latest post' === $posts[0]['content']);
    assert('2023-03-30' === $posts[0]['upload_date']);
    assert('Renewed content' === $posts[1]['content']);
    assert('2023-03-28' === $posts[1]['upload_date']);
    assert('Third post' === $posts[2]['content']);
    assert('2022-04-20' === $posts[2]['upload_date']);
    assert('Second post' === $posts[3]['content']);
    assert('2018-10-12' === $posts[3]['upload_date']);
}

function test_getPostById_successful()
{
    $connection = db\connect('demo');
    $post = db\getPostById($connection, 3);
    assert('Third post' === $post['content']);
    assert('2022-04-20' === $post['upload_date']);
}

function test_getPostById_invalidId()
{
    $connection = db\connect('demo');
    try {
        $_ = db\getPostById($connection, 404);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The post ID (404) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updatePost_successful()
{
    $connection = db\connect('demo');
    $post = array(
        'content' => 'Updated content',
        'upload_date' => '2023-03-10'
    );
    db\updatePost($connection, 1, $post);
    $post = db\getPostById($connection, 3);
    assert('Updated content' === $post['content']);
    assert('2023-03-10' === $post['upload_date']);
}

function test_updatePost_invalidId()
{
    $connection = db\connect('demo');
    $post = array(
        'content' => 'Updated content',
        'upload_date' => '2023-03-10'
    );
    try {
        db\updatePost($connection, 404, $post);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The post ID (404) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updatePost_missingContent()
{
    $connection = db\connect('demo');
    $post = array(
        'content' => '',
        'upload_date' => '2023-03-10'
    );
    try {
        db\updatePost($connection, 4, $post);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The content of the post is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_removePost_successful()
{
    $connection = db\connect('demo');
    db\removePost($connection, 2);
    assert(3, count($posts));
    assert('Latest post' === $posts[0]['content']);
    assert('2023-03-30' === $posts[0]['upload_date']);
    assert('Third post' === $posts[1]['content']);
    assert('2022-04-20' === $posts[1]['upload_date']);
    assert('Oldest post' === $posts[2]['content']);
    assert('2010-02-03' === $posts[2]['upload_date']);
}

function test_removePost_invalidId()
{
    $connection = db\connect('demo');
    try {
        db\removePost($connection, 404);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The post ID (404) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

require '../utils/test_runner.php';

?>
