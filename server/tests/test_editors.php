<?php

require '../database.php';

function test_collectEditors_empty()
{
    $connection = db\connect('empty');
    $editors = db\collectEditors($connection);
    assert([] === $posts);
}

function test_collectEditors_multiple()
{
    $connection = db\connect('demo');
    $editors = db\collectEditors($connection);
    assert(4, count($editors));
    assert('José Luis' === $editors[0]['given_name']);
    assert('Díaz-Barrero' === $editors[0]['family_name']);
    assert('Universitat Politechnica de Catalunya, Barcelona, Spain' === $editors[0]['affiliation']);
    assert('barrero@octogon.com' === $editors[0]['email']);
    assert('Péter' === $editors[1]['given_name']);
    assert('Körtesi' === $editors[1]['family_name']);
    assert('University of Miskolc, Miskolc, Hungary' === $editors[1]['affiliation']);
    assert('pkortesi@octogon.com' === $editors[1]['email']);
    assert('Zhao' === $editors[2]['given_name']);
    assert('Changjian' === $editors[2]['family_name']);
    assert('China Jiliang University, Hangzhou, China' === $editors[2]['affiliation']);
    assert('zhao@octogon.com' === $editors[2]['email']);
    assert('Ovodiu T.' === $editors[3]['given_name']);
    assert('Pop' === $editors[3]['family_name']);
    assert('National College Mihai Eminescu, Satu Mare, Romania' === $editors[3]['affiliation']);
    assert('pop@octogon.com' === $editors[3]['email']);
}

function test_addToEditorialBoard_successful()
{
    $connection = db\connect('demo');
    db\addToEditorialBoard($connection, 4);
    $editors = db\collectEditors($connection);
    assert(5, count($editors));
    assert('Sever S.' === $editors[3]['given_name']);
    assert('Dragomir' === $editors[3]['family_name']);
    assert('Victoria University, Melbourne, Australia' === $editors[3]['affiliation']);
    assert('dragomir@octogon.com' === $editors[3]['email']);
}

function test_addToEditorialBoard_invalidId()
{
    $connection = db\connect('demo');
    try {
        db\addToEditorialBoard($connection, 8);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The contributor ID (8) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_addToEditorialBoard_alreadyAdded()
{
    $connection = db\connect('demo');
    try {
        db\addToEditorialBoard($connection, 2);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The editor with contributor ID (8) has been already added!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_removeFromEditorialBoard_successful()
{
    $connection = db\connect('demo');
    db\removeFromEditorialBoard($connection, 2);
    $editors = db\collectEditors($connection);
    assert(3, count($editors));
    assert('José Luis' === $editors[0]['given_name']);
    assert('Díaz-Barrero' === $editors[0]['family_name']);
    assert('Universitat Politechnica de Catalunya, Barcelona, Spain' === $editors[0]['affiliation']);
    assert('barrero@octogon.com' === $editors[0]['email']);
    assert('Péter' === $editors[1]['given_name']);
    assert('Körtesi' === $editors[1]['family_name']);
    assert('University of Miskolc, Miskolc, Hungary' === $editors[1]['affiliation']);
    assert('pkortesi@octogon.com' === $editors[1]['email']);
    assert('Ovodiu T.' === $editors[2]['given_name']);
    assert('Pop' === $editors[2]['family_name']);
    assert('National College Mihai Eminescu, Satu Mare, Romania' === $editors[2]['affiliation']);
    assert('pop@octogon.com' === $editors[2]['email']);
}

function test_removeFromEditorialBoard_invalidId()
{
    $connection = db\connect('demo');
    try {
        db\removeFromEditorialBoard($connection, 9);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The contributor ID (9) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_removeFromEditorialBoard_notAdded()
{
    $connection = db\connect('demo');
    try {
        db\removeFromEditorialBoard($connection, 4);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The editor with contributor ID (4) has not been added yet!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_moveEditorUp_successful()
{
    $connection = db\connect('demo');
    db\moveEditorUp($connection, 2);
    $editors = db\collectEditors($connection);
    assert(4, count($editors));
    assert('José Luis' === $editors[0]['given_name']);
    assert('Díaz-Barrero' === $editors[0]['family_name']);
    assert('Universitat Politechnica de Catalunya, Barcelona, Spain' === $editors[0]['affiliation']);
    assert('barrero@octogon.com' === $editors[0]['email']);
    assert('Zhao' === $editors[1]['given_name']);
    assert('Changjian' === $editors[1]['family_name']);
    assert('China Jiliang University, Hangzhou, China' === $editors[1]['affiliation']);
    assert('zhao@octogon.com' === $editors[1]['email']);
    assert('Péter' === $editors[2]['given_name']);
    assert('Körtesi' === $editors[2]['family_name']);
    assert('University of Miskolc, Miskolc, Hungary' === $editors[2]['affiliation']);
    assert('pkortesi@octogon.com' === $editors[2]['email']);
    assert('Ovodiu T.' === $editors[3]['given_name']);
    assert('Pop' === $editors[3]['family_name']);
    assert('National College Mihai Eminescu, Satu Mare, Romania' === $editors[3]['affiliation']);
    assert('pop@octogon.com' === $editors[3]['email']);
}

function test_moveEditorUp_invalidId()
{
    $connection = db\connect('demo');
    try {
        db\moveEditorUp($connection, 12);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The contributor ID (12) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_moveEditorUp_onFirst()
{
    $connection = db\connect('demo');
    db\moveEditorUp($connection, 3);
    $editors = db\collectEditors($connection);
    assert(4, count($editors));
    assert('José Luis' === $editors[0]['given_name']);
    assert('Díaz-Barrero' === $editors[0]['family_name']);
    assert('Universitat Politechnica de Catalunya, Barcelona, Spain' === $editors[0]['affiliation']);
    assert('barrero@octogon.com' === $editors[0]['email']);
    assert('Péter' === $editors[1]['given_name']);
    assert('Körtesi' === $editors[1]['family_name']);
    assert('University of Miskolc, Miskolc, Hungary' === $editors[1]['affiliation']);
    assert('pkortesi@octogon.com' === $editors[1]['email']);
    assert('Zhao' === $editors[2]['given_name']);
    assert('Changjian' === $editors[2]['family_name']);
    assert('China Jiliang University, Hangzhou, China' === $editors[2]['affiliation']);
    assert('zhao@octogon.com' === $editors[2]['email']);
    assert('Ovodiu T.' === $editors[3]['given_name']);
    assert('Pop' === $editors[3]['family_name']);
    assert('National College Mihai Eminescu, Satu Mare, Romania' === $editors[3]['affiliation']);
    assert('pop@octogon.com' === $editors[3]['email']);
}

function test_moveEditorDown_successful()
{
    $connection = db\connect('demo');
    db\moveEditorDown($connection, 2);
    $editors = db\collectEditors($connection);
    assert(4, count($editors));
    assert('Péter' === $editors[0]['given_name']);
    assert('Körtesi' === $editors[0]['family_name']);
    assert('University of Miskolc, Miskolc, Hungary' === $editors[0]['affiliation']);
    assert('pkortesi@octogon.com' === $editors[0]['email']);
    assert('José Luis' === $editors[1]['given_name']);
    assert('Díaz-Barrero' === $editors[1]['family_name']);
    assert('Universitat Politechnica de Catalunya, Barcelona, Spain' === $editors[1]['affiliation']);
    assert('barrero@octogon.com' === $editors[1]['email']);
    assert('Zhao' === $editors[2]['given_name']);
    assert('Changjian' === $editors[2]['family_name']);
    assert('China Jiliang University, Hangzhou, China' === $editors[2]['affiliation']);
    assert('zhao@octogon.com' === $editors[2]['email']);
    assert('Ovodiu T.' === $editors[3]['given_name']);
    assert('Pop' === $editors[3]['family_name']);
    assert('National College Mihai Eminescu, Satu Mare, Romania' === $editors[3]['affiliation']);
    assert('pop@octogon.com' === $editors[3]['email']);
}

function test_moveEditorDown_invalidId()
{
    $connection = db\connect('demo');
    try {
        db\moveEditorDown($connection, 15);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The contributor ID (15) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_moveEditorDown_onLast()
{
    $connection = db\connect('demo');
    db\moveEditorDown($connection, 6);
    $editors = db\collectEditors($connection);
    assert(4, count($editors));
    assert('José Luis' === $editors[0]['given_name']);
    assert('Díaz-Barrero' === $editors[0]['family_name']);
    assert('Universitat Politechnica de Catalunya, Barcelona, Spain' === $editors[0]['affiliation']);
    assert('barrero@octogon.com' === $editors[0]['email']);
    assert('Péter' === $editors[1]['given_name']);
    assert('Körtesi' === $editors[1]['family_name']);
    assert('University of Miskolc, Miskolc, Hungary' === $editors[1]['affiliation']);
    assert('pkortesi@octogon.com' === $editors[1]['email']);
    assert('Zhao' === $editors[2]['given_name']);
    assert('Changjian' === $editors[2]['family_name']);
    assert('China Jiliang University, Hangzhou, China' === $editors[2]['affiliation']);
    assert('zhao@octogon.com' === $editors[2]['email']);
    assert('Ovodiu T.' === $editors[3]['given_name']);
    assert('Pop' === $editors[3]['family_name']);
    assert('National College Mihai Eminescu, Satu Mare, Romania' === $editors[3]['affiliation']);
    assert('pop@octogon.com' === $editors[3]['email']);
}

require '../utils/test_runner.php';

?>

