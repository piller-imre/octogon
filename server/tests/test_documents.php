<?php

require '../database.php';

function test_createDocument_successful()
{
    $connection = db\connect('empty');
    $document = array(
        'name' => 'published.pdf'
    );
    $documentId = db\createDocument($connection, $document);
    assert(1 === $documentId);
    $documents = db\collectDocuments($connection);
    assert(1 === count($documents));
    assert('published.pdf' === $documents[0]['name']);
}

function test_createDocument_missingName()
{
    $connection = db\connect('empty');
    $document = array(
        'name' => ' '
    );
    try {
        $_ = db\createDocument($connection, $document);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The name of the document is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createDocument_existingName()
{
    $connection = db\connect('demo');
    $document = array(
        'name' => 'OQ_2010_1.pdf'
    );
    try {
        $_ = db\createDocument($connection, $document);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The document "OQ_2010_1.pdf" is already exists!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_collectDocuments_empty()
{
    $connection = db\connect('empty');
    $documents = db\collectDocuments($connection);
    assert([] === $documents);
}

function test_collectDocuments_multiple()
{
    $connection = db\connect('demo');
    $documents = db\collectDocuments($connection);
    assert(5 === count($documents));
    assert('Wildt_2010_1.pdf' === $documents[0]['name']);
    assert('PP_2010_1.pdf' === $documents[1]['name']);
    assert('OQ_2010_1.pdf' === $documents[2]['name']);
    assert('PP_2010_2.pdf' === $documents[3]['name']);
    assert('OQ_2010_2.pdf' === $documents[4]['name']);
}

function test_removeDocument_successful()
{
    $connection = db\connect('demo');
    db\removeDocument($connection, 3);
    $documents = db\collectDocuments($connection);
    assert(4 === count($documents));
    assert('Wildt_2010_1.pdf' === $documents[0]['name']);
    assert('PP_2010_1.pdf' === $documents[1]['name']);
    assert('PP_2010_2.pdf' === $documents[2]['name']);
    assert('OQ_2010_2.pdf' === $documents[3]['name']);
}

function test_removeDocument_invalidId()
{
    $connection = db\connect('demo');
    try {
        db\removeDocument($connection, 30);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The document ID (30) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_removeDocument_inUse()
{
    $connection = db\connect('demo');
    try {
        db\removeDocument($connection, 2);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The document ID (2) is in use!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

require '../utils/test_runner.php';

?>
