<?php

require '../database.php';

function test_getPageContent_successful()
{
    $connection = db\connect('demo');
    $content = db\getPageContent($connection, 'rules');
    assert('Some rules here' === $content);
}

function test_getPageContent_invalidName()
{
    $connection = db\connect('demo');
    try {
        $_ = db\getPageContent($connection, 'unknown');
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The page name "unknown" is invalid!', $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updatePageContent_successful()
{
    $connection = db\connect('demo');
    db\updatePageContent($connection, 'contacts', 'New contact info');
    $content = db\getPageContent($connection, 'contacts');
    assert('New contact info' === $content);
}

function test_updatePageContent_invalidName()
{
    $connection = db\connect('demo');
    try {
        $_ = db\updatePageContent($connection, 'nonexisting', 'Ignored');
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The page name "nonexisting" is invalid!', $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updatePageContent_missingContent()
{
    $connection = db\connect('demo');
    try {
        $_ = db\updatePageContent($connection, 'rules', '');
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The content of the page is missing!', $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

require '../utils/test_runner.php';

?>

