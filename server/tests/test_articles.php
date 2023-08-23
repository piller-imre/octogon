<?php

require '../database.php';

function test_createArticle_successful()
{
    $connection = db\connect('demo');
    $article = array(
        'article_type_id' => 2,
        'title' => 'Competition paper for sample',
        'abstract' => 'The detailed abstract here.',
        'volume_id' => 3,
        'first_page' => 40,
        'last_page' => 50,
        'document_id' => 5
    );
    $articleId = db\createArticle($connection, $article);
    assert(10 === $articleId);
    $retrieved = db\getArticleById($connection, $articleId);
    assert(2 === $retrieved['article_type_id']);
    assert('Competition paper for sample' === $retrieved['title']);
    assert('The detailed abstract here.' === $retrieved['abstract']);
    assert(3 === $retrieved['volume_id']);
    assert(40 === $retrieved['first_page']);
    assert(50 === $retrieved['last_page']);
    assert(5 === $retrieved['document_id']);
}

function test_createArticle_invalidType()
{
    $connection = db\connect('demo');
    $article = array(
        'article_type_id' => 20,
        'title' => 'Competition paper for sample',
        'abstract' => 'The detailed abstract here.',
        'volume_id' => 3,
        'first_page' => 40,
        'last_page' => 50,
        'document_id' => 5
    );
    try {
        $_ = db\createArticle($connection, $article);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The article type ID (20) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createArticle_missingTitle()
{
    $connection = db\connect('demo');
    $article = array(
        'article_type_id' => 2,
        'title' => ' ',
        'abstract' => 'The detailed abstract here.',
        'volume_id' => 3,
        'first_page' => 40,
        'last_page' => 50,
        'document_id' => 5
    );
    try {
        $_ = db\createArticle($connection, $article);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The title of the article is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createArticle_invalidVolumeId()
{
    $connection = db\connect('demo');
    $article = array(
        'article_type_id' => 2,
        'title' => 'Competition paper for sample',
        'abstract' => 'The detailed abstract here.',
        'volume_id' => 30,
        'first_page' => 40,
        'last_page' => 50,
        'document_id' => 5
    );
    try {
        $_ = db\createArticle($connection, $article);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The volume ID (30) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createArticle_invalidFirstPage()
{
    $connection = db\connect('demo');
    $article = array(
        'article_type_id' => 2,
        'title' => 'Competition paper for sample',
        'abstract' => 'The detailed abstract here.',
        'volume_id' => 3,
        'first_page' => 0,
        'last_page' => 50,
        'document_id' => 5
    );
    try {
        $_ = db\createArticle($connection, $article);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The first page of the article (0) is invalid!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createArticle_invalidLastPage()
{
    $connection = db\connect('demo');
    $article = array(
        'article_type_id' => 2,
        'title' => 'Competition paper for sample',
        'abstract' => 'The detailed abstract here.',
        'volume_id' => 3,
        'first_page' => 20,
        'last_page' => 0,
        'document_id' => 5
    );
    try {
        $_ = db\createArticle($connection, $article);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The last page of the article (0) is invalid!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createArticle_invalidPageInterval()
{
    $connection = db\connect('demo');
    $article = array(
        'article_type_id' => 2,
        'title' => 'Competition paper for sample',
        'abstract' => 'The detailed abstract here.',
        'volume_id' => 3,
        'first_page' => 50,
        'last_page' => 40,
        'document_id' => 5
    );
    try {
        $_ = db\createArticle($connection, $article);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The page interval (from 50 to 40) is invalid!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createArticle_invalidDocumentId()
{
    $connection = db\connect('demo');
    $article = array(
        'article_type_id' => 2,
        'title' => 'Competition paper for sample',
        'abstract' => 'The detailed abstract here.',
        'volume_id' => 3,
        'first_page' => 40,
        'last_page' => 50,
        'document_id' => 123
    );
    try {
        $_ = db\createArticle($connection, $article);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The document ID (123) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_collectArticlesByVolume_empty()
{
    $connection = db\connect('demo');
    $articles = db\collectArticlesByVolume($connection, 5);
    assert([] === $articles);
}

function test_collectArticlesByVolume_multiple()
{
    $connection = db\connect('demo');
    $articles = db\collectArticlesByVolume($connection, 2);
    assert(3 === count($articles));

    assert(6 === $articles[0]['id']);
    assert(1 === $articles[0]['article_type_id']);
    assert('First in second volume' === $articles[0]['title']);
    assert('Nothing special' === $articles[0]['abstract']);
    assert(2 === $articles[0]['volume_id']);
    assert(1 === $articles[0]['first_page']);
    assert(12 === $articles[0]['last_page']);
    assert(null === $articles[0]['document_id']);

    assert(7 === $articles[1]['id']);
    assert(1 === $articles[1]['article_type_id']);
    assert('Second in second volume' === $articles[1]['title']);
    assert('Still nothing special' === $articles[1]['abstract']);
    assert(2 === $articles[1]['volume_id']);
    assert(13 === $articles[1]['first_page']);
    assert(19 === $articles[1]['last_page']);
    assert(null === $articles[1]['document_id']);

    assert(8 === $articles[2]['id']);
    assert(3 === $articles[2]['article_type_id']);
    assert('Proposed problems' === $articles[2]['title']);
    assert('Exciting problems' === $articles[2]['abstract']);
    assert(2 === $articles[2]['volume_id']);
    assert(20 === $articles[2]['first_page']);
    assert(33 === $articles[2]['last_page']);
    assert(4 === $articles[2]['document_id']);
}

function test_collectArticlesByVolume_invalidId()
{
    $connection = db\connect('demo');
    try {
        $_ = db\collectArticlesByVolume($connection, 23);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The volume ID (23) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_getArticleById_successful()
{
    $connection = db\connect('demo');
    $article = db\getArticleById($connection, 7);
    assert(7 === $article['id']);
    assert(1 === $article['article_type_id']);
    assert('Second in second volume' === $article['title']);
    assert('Still nothing special' === $article['abstract']);
    assert(2 === $article['volume_id']);
    assert(13 === $article['first_page']);
    assert(19 === $article['last_page']);
    assert(null === $article['document_id']);
}

function test_getArticleById_invalidId()
{
    $connection = db\connect('demo');
    try {
        $_ = db\getArticleById($connection, 77);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The article ID (77) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateArticle_successful()
{
    $connection = db\connect('demo');
    $article = array(
        'article_type_id' => 3,
        'title' => 'Updated article title',
        'abstract' => 'Arbitrary text for checking the modifications.',
        'volume_id' => 2,
        'first_page' => 36,
        'last_page' => 38,
        'document_id' => 4
    );
    db\updateArticle($connection, 5, $article);
    $article = db\getArticleById($connection, 5);
    assert(5 === $article['id']);
    assert(3 === $article['article_type_id']);
    assert('Updated article title' === $article['title']);
    assert('Arbitrary text for checking the modifications.' === $article['abstract']);
    assert(2 === $article['volume_id']);
    assert(36 === $article['first_page']);
    assert(38 === $article['last_page']);
    assert(4 === $article['document_id']);
}

function test_updateArticle_invalidId()
{
    $connection = db\connect('demo');
    $article = array(
        'article_type_id' => 3,
        'title' => 'Updated article title',
        'abstract' => 'Arbitrary text for checking the modifications.',
        'volume_id' => 2,
        'first_page' => 36,
        'last_page' => 38,
        'document_id' => 4
    );
    try {
        db\updateArticle($connection, 55, $article);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The article ID (55) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateArticle_invalidType()
{
    $connection = db\connect('demo');
    $article = array(
        'article_type_id' => 31,
        'title' => 'Updated article title',
        'abstract' => 'Arbitrary text for checking the modifications.',
        'volume_id' => 2,
        'first_page' => 36,
        'last_page' => 38,
        'document_id' => 4
    );
    try {
        db\updateArticle($connection, 5, $article);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The article type ID (31) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateArticle_missingTitle()
{
    $connection = db\connect('demo');
    $article = array(
        'article_type_id' => 3,
        'title' => ' ',
        'abstract' => 'Arbitrary text for checking the modifications.',
        'volume_id' => 2,
        'first_page' => 36,
        'last_page' => 38,
        'document_id' => 4
    );
    try {
        db\updateArticle($connection, 5, $article);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The title of the article is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateArticle_invalidVolumeId()
{
    $connection = db\connect('demo');
    $article = array(
        'article_type_id' => 3,
        'title' => 'Updated article title',
        'abstract' => 'Arbitrary text for checking the modifications.',
        'volume_id' => 22,
        'first_page' => 36,
        'last_page' => 38,
        'document_id' => 4
    );
    try {
        db\updateArticle($connection, 5, $article);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The volume ID (22) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateArticle_invalidFirstPage()
{
    $connection = db\connect('demo');
    $article = array(
        'article_type_id' => 3,
        'title' => 'Updated article title',
        'abstract' => 'Arbitrary text for checking the modifications.',
        'volume_id' => 2,
        'first_page' => 0,
        'last_page' => 38,
        'document_id' => 4
    );
    try {
        db\updateArticle($connection, 5, $article);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The first page of the article (0) is invalid!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateArticle_invalidLastPage()
{
    $connection = db\connect('demo');
    $article = array(
        'article_type_id' => 3,
        'title' => 'Updated article title',
        'abstract' => 'Arbitrary text for checking the modifications.',
        'volume_id' => 2,
        'first_page' => 36,
        'last_page' => 0,
        'document_id' => 4
    );
    try {
        db\updateArticle($connection, 5, $article);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The last page of the article (0) is invalid!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateArticle_invalidPageInterval()
{
    $connection = db\connect('demo');
    $article = array(
        'article_type_id' => 3,
        'title' => 'Updated article title',
        'abstract' => 'Arbitrary text for checking the modifications.',
        'volume_id' => 2,
        'first_page' => 40,
        'last_page' => 38,
        'document_id' => 4
    );
    try {
        db\updateArticle($connection, 5, $article);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The page interval (from 40 to 38) is invalid!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateArticle_invalidDocumentId()
{
    $connection = db\connect('demo');
    $article = array(
        'article_type_id' => 3,
        'title' => 'Updated article title',
        'abstract' => 'Arbitrary text for checking the modifications.',
        'volume_id' => 2,
        'first_page' => 10,
        'last_page' => 38,
        'document_id' => 43
    );
    try {
        db\updateArticle($connection, 5, $article);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The document ID (43) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_removeArticle_successful()
{
    $connection = db\connect('demo');
    db\removeArticle($connection, 7);
    $articles = db\collectArticlesByVolume($connection, 2);
    assert(2 === count($articles));

    assert(6 === $articles[0]['id']);
    assert(1 === $articles[0]['article_type_id']);
    assert('First in second volume' === $articles[0]['title']);
    assert('Nothing special' === $articles[0]['abstract']);
    assert(2 === $articles[0]['volume_id']);
    assert(1 === $articles[0]['first_page']);
    assert(12 === $articles[0]['last_page']);
    assert(null === $articles[0]['document_id']);

    assert(8 === $articles[1]['id']);
    assert(3 === $articles[1]['article_type_id']);
    assert('Proposed problems' === $articles[1]['title']);
    assert('Exciting problems' === $articles[1]['abstract']);
    assert(2 === $articles[1]['volume_id']);
    assert(20 === $articles[1]['first_page']);
    assert(33 === $articles[1]['last_page']);
    assert(4 === $articles[1]['document_id']);
}

function test_removeArticle_invalidId()
{
    $connection = db\connect('demo');
    try {
        db\removeArticle($connection, 75);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The article ID (75) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

require '../utils/test_runner.php';

?>
