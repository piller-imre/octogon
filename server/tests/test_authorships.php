<?php

require '../database.php';

function test_createAuthorship_successful()
{
    $connection = db\connect('demo');
    $authorship = array(
        'article_id' => 1,
        'contributor_id' => 2,
        'given_name' => 'Zhao',
        'family_name' => 'Changjian',
        'affiliation' => 'China',
        'email' => 'zhao.changjian@octogon.com'
    );
    $authorshipId = db\createAuthorship($connection, $authorship);
    assert(12 === $authorshipId);
    $authorships = db\collectAuthorshipsByArticleId($connection, 1);
    assert(3 === count($authorships));
    assert(12 === $authorships[2]['id']);
    assert(1 === $authorships[2]['article_id']);
    assert(2 === $authorships[2]['contributor_id']);
    assert('Zhao' === $authorships[2]['given_name']);
    assert('Changjian' === $authorships[2]['family_name']);
    assert('China' === $authorships[2]['affiliation']);
    assert('zhao.changjian@octogon.com' === $authorships[2]['email']);
}

function test_createAuthorship_invalidArticleId()
{
    $connection = db\connect('demo');
    $authorship = array(
        'article_id' => 100,
        'contributor_id' => 2,
        'given_name' => 'Zhao',
        'family_name' => 'Changjian',
        'affiliation' => 'China',
        'email' => 'zhao.changjian@octogon.com'
    );
    try {
        $_ = db\createAuthorship($connection, $authorship);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The article ID (100) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createAuthorship_invalidContributorId()
{
    $connection = db\connect('demo');
    $authorship = array(
        'article_id' => 1,
        'contributor_id' => 20,
        'given_name' => 'Zhao',
        'family_name' => 'Changjian',
        'affiliation' => 'China',
        'email' => 'zhao.changjian@octogon.com'
    );
    try {
        $_ = db\createAuthorship($connection, $authorship);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The contributor ID (20) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createAuthorship_missingGivenName()
{
    $connection = db\connect('demo');
    $authorship = array(
        'article_id' => 1,
        'contributor_id' => 2,
        'given_name' => ' ',
        'family_name' => 'Changjian',
        'affiliation' => 'China',
        'email' => 'zhao.changjian@octogon.com'
    );
    try {
        $_ = db\createAuthorship($connection, $authorship);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The given name of the author is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createAuthorship_missingFamilyName()
{
    $connection = db\connect('demo');
    $authorship = array(
        'article_id' => 1,
        'contributor_id' => 2,
        'given_name' => 'Zhao',
        'family_name' => ' ',
        'affiliation' => 'China',
        'email' => 'zhao.changjian@octogon.com'
    );
    try {
        $_ = db\createAuthorship($connection, $authorship);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The family name of the author is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createAuthorship_missingAffiliation()
{
    $connection = db\connect('demo');
    $authorship = array(
        'article_id' => 1,
        'contributor_id' => 2,
        'given_name' => 'Zhao',
        'family_name' => 'Changjian',
        'affiliation' => ' ',
        'email' => 'zhao.changjian@octogon.com'
    );
    try {
        $_ = db\createAuthorship($connection, $authorship);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The affiliation of the author is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createAuthorship_missingEmail()
{
    $connection = db\connect('demo');
    $authorship = array(
        'article_id' => 1,
        'contributor_id' => 2,
        'given_name' => 'Zhao',
        'family_name' => 'Changjian',
        'affiliation' => 'China',
        'email' => ' '
    );
    try {
        $_ = db\createAuthorship($connection, $authorship);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The e-mail address of the author is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_collectAuthorshipsByArticleId_empty()
{
    $connection = db\connect('demo');
    $authorships = db\collectAuthorshipsByArticleId($connection, 9);
    assert([] === $authorships);
}

function test_collectAuthorshipsByArticleId_multiple()
{
    $connection = db\connect('demo');
    $authorships = db\collectAuthorshipsByArticleId($connection, 6);
    assert(3 === count($authorships));
    assert(7 === $authorships[0]['id']);
    assert('Péter' === $authorships[0]['given_name']);
    assert('Körtesi' === $authorships[0]['family_name']);
    assert(8 === $authorships[1]['id']);
    assert('Mihály' === $authorships[1]['given_name']);
    assert('Bencze' === $authorships[1]['family_name']);
    assert(9 === $authorships[2]['id']);
    assert('Ovidiu T.' === $authorships[2]['given_name']);
    assert('Pop' === $authorships[2]['family_name']);
}

function test_collectAuthorshipsByArticleId_invalidArticleId()
{
    $connection = db\connect('demo');
    try {
        $_ = db\collectAuthorshipsByArticleId($connection, 41);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The article ID (41) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateAuthorship_successful()
{
    $connection = db\connect('demo');
    $authorship = array(
        'article_id' => 2,
        'contributor_id' => 2,
        'given_name' => 'Z.',
        'family_name' => 'Changjian',
        'affiliation' => 'Hangzhou, China',
        'email' => 'zhao.changjian@octogon.com'
    );
    db\updateAuthorship($connection, 2, $authorship);
    $authorships = db\collectAuthorshipsByArticleId($connection, 2);
    assert(2 === count($authorships));
    assert(2 === $authorships[0]['article_id']);
    assert(2 === $authorships[0]['contributor_id']);
    assert('Z.' === $authorships[0]['given_name']);
    assert('Changjian' === $authorships[0]['family_name']);
    assert('Hangzhou, China' === $authorships[0]['affiliation']);
    assert('zhao.changjian@octogon.com' === $authorships[0]['email']);
}

function test_updateAuthorship_invalidId()
{
    $connection = db\connect('demo');
    $authorship = array(
        'article_id' => 2,
        'contributor_id' => 2,
        'given_name' => 'Z.',
        'family_name' => 'Changjian',
        'affiliation' => 'Hangzhou, China',
        'email' => 'zhao.changjian@octogon.com'
    );
    try {
        db\updateAuthorship($connection, 234, $authorship);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The authorship ID (234) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateAuthorship_invalidArticleId()
{
    $connection = db\connect('demo');
    $authorship = array(
        'article_id' => 21,
        'contributor_id' => 2,
        'given_name' => 'Z.',
        'family_name' => 'Changjian',
        'affiliation' => 'Hangzhou, China',
        'email' => 'zhao.changjian@octogon.com'
    );
    try {
        db\updateAuthorship($connection, 4, $authorship);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The article ID (21) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateAuthorship_invalidContributorId()
{
    $connection = db\connect('demo');
    $authorship = array(
        'article_id' => 2,
        'contributor_id' => 32,
        'given_name' => 'Z.',
        'family_name' => 'Changjian',
        'affiliation' => 'Hangzhou, China',
        'email' => 'zhao.changjian@octogon.com'
    );
    try {
        db\updateAuthorship($connection, 4, $authorship);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The contributor ID (32) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateAuthorship_missingGivenName()
{
    $connection = db\connect('demo');
    $authorship = array(
        'article_id' => 2,
        'contributor_id' => 2,
        'given_name' => ' ',
        'family_name' => 'Changjian',
        'affiliation' => 'Hangzhou, China',
        'email' => 'zhao.changjian@octogon.com'
    );
    try {
        db\updateAuthorship($connection, 4, $authorship);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The given name of the author is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateAuthorship_missingFamilyName()
{
    $connection = db\connect('demo');
    $authorship = array(
        'article_id' => 2,
        'contributor_id' => 2,
        'given_name' => 'Z.',
        'family_name' => ' ',
        'affiliation' => 'Hangzhou, China',
        'email' => 'zhao.changjian@octogon.com'
    );
    try {
        db\updateAuthorship($connection, 4, $authorship);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The family name of the author is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateAuthorship_missingAffiliation()
{
    $connection = db\connect('demo');
    $authorship = array(
        'article_id' => 2,
        'contributor_id' => 2,
        'given_name' => 'Z.',
        'family_name' => 'Changjian',
        'affiliation' => ' ',
        'email' => 'zhao.changjian@octogon.com'
    );
    try {
        db\updateAuthorship($connection, 4, $authorship);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The affiliation of the author is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateAuthorship_missingEmail()
{
    $connection = db\connect('demo');
    $authorship = array(
        'article_id' => 2,
        'contributor_id' => 2,
        'given_name' => 'Z.',
        'family_name' => 'Changjian',
        'affiliation' => 'Hangzhou, China',
        'email' => ' '
    );
    try {
        db\updateAuthorship($connection, 4, $authorship);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The e-mail address of the author is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateAuthorship_invalidEmail()
{
    $connection = db\connect('demo');
    $authorship = array(
        'article_id' => 2,
        'contributor_id' => 2,
        'given_name' => 'Z.',
        'family_name' => 'Changjian',
        'affiliation' => 'Hangzhou, China',
        'email' => 'zhao.changjian.octogon.com'
    );
    try {
        db\updateAuthorship($connection, 4, $authorship);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The e-mail address of the author is invalid!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_moveAuthorshipUp_successful()
{
    $connection = db\connect('demo');
    db\moveAuthorshipUp($connection, 9);
    $authorships = db\collectAuthorshipsByArticleId($connection, 6);
    assert(3 === count($authorships));
    assert(7 === $authorships[0]['id']);
    assert('Péter' === $authorships[0]['given_name']);
    assert('Körtesi' === $authorships[0]['family_name']);
    assert(9 === $authorships[1]['id']);
    assert('Ovidiu T.' === $authorships[1]['given_name']);
    assert('Pop' === $authorships[1]['family_name']);
    assert(8 === $authorships[2]['id']);
    assert('Mihály' === $authorships[2]['given_name']);
    assert('Bencze' === $authorships[2]['family_name']);
}

function test_moveAuthorshipUp_first()
{
    $connection = db\connect('demo');
    db\moveAuthorshipUp($connection, 7);
    $authorships = db\collectAuthorshipsByArticleId($connection, 6);
    assert(3 === count($authorships));
    assert(7 === $authorships[0]['id']);
    assert('Péter' === $authorships[0]['given_name']);
    assert('Körtesi' === $authorships[0]['family_name']);
    assert(8 === $authorships[1]['id']);
    assert('Mihály' === $authorships[1]['given_name']);
    assert('Bencze' === $authorships[1]['family_name']);
    assert(9 === $authorships[2]['id']);
    assert('Ovidiu T.' === $authorships[2]['given_name']);
    assert('Pop' === $authorships[2]['family_name']);
}

function test_moveAuthorshipUp_invalidId()
{
    $connection = db\connect('demo');
    try {
        $_ = db\moveAuthorshipUp($connection, 70);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The authorship ID (70) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_moveAuthorshipDown_successful()
{
    $connection = db\connect('demo');
    db\moveAuthorshipUp($connection, 7);
    $authorships = db\collectAuthorshipsByArticleId($connection, 6);
    assert(3 === count($authorships));
    assert(8 === $authorships[0]['id']);
    assert('Mihály' === $authorships[0]['given_name']);
    assert('Bencze' === $authorships[0]['family_name']);
    assert(7 === $authorships[1]['id']);
    assert('Péter' === $authorships[1]['given_name']);
    assert('Körtesi' === $authorships[1]['family_name']);
    assert(9 === $authorships[2]['id']);
    assert('Ovidiu T.' === $authorships[2]['given_name']);
    assert('Pop' === $authorships[2]['family_name']);
}

function test_moveAuthorshipDown_last()
{
    $connection = db\connect('demo');
    db\moveAuthorshipUp($connection, 9);
    $authorships = db\collectAuthorshipsByArticleId($connection, 6);
    assert(3 === count($authorships));
    assert(7 === $authorships[0]['id']);
    assert('Péter' === $authorships[0]['given_name']);
    assert('Körtesi' === $authorships[0]['family_name']);
    assert(8 === $authorships[1]['id']);
    assert('Mihály' === $authorships[1]['given_name']);
    assert('Bencze' === $authorships[1]['family_name']);
    assert(9 === $authorships[2]['id']);
    assert('Ovidiu T.' === $authorships[2]['given_name']);
    assert('Pop' === $authorships[2]['family_name']);
}

function test_moveAuthorshipDown_invalidId()
{
    $connection = db\connect('demo');
    try {
        $_ = db\moveAuthorshipDown($connection, 80);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The authorship ID (80) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_removeAuthorship_successful()
{
    $connection = db\connect('demo');
    db\removeAuthorship($connection, 6);
    $authorships = db\collectAuthorshipsByArticleId($connection, 5);
    assert([] === $authorships);
}

function test_removeAuthorship_invalidId()
{
    $connection = db\connect('demo');
    try {
        db\removeAuthorship($connection, 60);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The authorship ID (60) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

require '../utils/test_runner.php';

?>

