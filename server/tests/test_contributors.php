<?php

require '../database.php';

function test_createContributor_successful()
{
    $connection = db\connect('empty');
    $contributor = array(
        'given_name' => 'Gao',
        'family_name' => 'Minghze',
        'affiliation' => 'China',
        'email' => 'g.minghze@octogon.com'
    );
    $contributorId = db\createContributor($connection, $contributor);
    assert($contributorId === 7);
    $retrieved = db\getContributorById($connection, $contributorId);
    assert(7 === $retrieved['id']);
    assert('Gao' === $retrieved['given_name']);
    assert('Minghze' === $retrieved['family_name']);
    assert('China' === $retrieved['affiliation']);
    assert('g.minghze@octogon.com' === $retrieved['email']);
}

function test_createContributor_missingGivenName()
{
    $connection = db\connect('empty');
    $contributor = array(
        'given_name' => ' ',
        'family_name' => 'Minghze',
        'affiliation' => 'China',
        'email' => 'g.minghze@octogon.com'
    );
    try {
        $_ = db\createContributor($connection, $contributor);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The given name of the contributor is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createContributor_missingFamilyName()
{
    $connection = db\connect('empty');
    $contributor = array(
        'given_name' => 'Gao',
        'family_name' => ' ',
        'affiliation' => 'China',
        'email' => 'g.minghze@octogon.com'
    );
    try {
        $_ = db\createContributor($connection, $contributor);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The family name of the contributor is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createContributor_missingAffiliation()
{
    $connection = db\connect('empty');
    $contributor = array(
        'given_name' => 'Gao',
        'family_name' => 'Minghze',
        'affiliation' => ' ',
        'email' => 'g.minghze@octogon.com'
    );
    try {
        $_ = db\createContributor($connection, $contributor);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The affiliation of the contributor is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createContributor_missingEmail()
{
    $connection = db\connect('empty');
    $contributor = array(
        'given_name' => 'Gao',
        'family_name' => 'Minghze',
        'affiliation' => 'China',
        'email' => ' '
    );
    try {
        $_ = db\createContributor($connection, $contributor);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The e-mail address of the contributor is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createContributor_invalidEmail()
{
    $connection = db\connect('empty');
    $contributor = array(
        'given_name' => 'Gao',
        'family_name' => 'Minghze',
        'affiliation' => 'China',
        'email' => 'gao.minghze'
    );
    try {
        $_ = db\createContributor($connection, $contributor);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The e-mail address of the contributor is invalid!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_collectContributorsByFilter_empty()
{
    $connection = db\connect('empty');
    $contributors = db\collectContributorsByFilter($connection, '');
    assert([] === $contributors);
}

function test_collectContributorsByFilter_multiple()
{
    $connection = db\connect('demo');
    $contributors = db\collectContributorsByFilter($connection, 'withoutmatching');
    assert([] === $contributors);
}

function test_collectContributorsByFilter_withFilter()
{
    $connection = db\connect('demo');
    $contributors = db\collectContributorsByFilter($connection, 'er');
    assert(3 === count($contributors));
    assert(3 === $contributors[0]['id']);
    assert('José Luis' === $contributors[0]['given_name']);
    assert('Díaz-Barrero' === $contributors[0]['family_name']);
    assert('Universitat Politechnica de Catalunya, Barcelona, Spain' === $contributors[0]['affiliation']);
    assert('barrero@octogon.com' === $contributors[0]['email']);
    assert(4 === $contributors[1]['id']);
    assert('Sever S.' === $contributors[1]['given_name']);
    assert('Dragomir' === $contributors[1]['family_name']);
    assert('Victoria University, Melbourne, Australia' === $contributors[1]['affiliation']);
    assert('dragomir@octogon.com' === $contributors[1]['email']);
    assert(5 === $contributors[2]['id']);
    assert('Péter' === $contributors[2]['given_name']);
    assert('Körtesi' === $contributors[2]['family_name']);
    assert('University of Miskolc, Miskolc, Hungary' === $contributors[2]['affiliation']);
    assert('pkortesi@octogon.com' === $contributors[2]['email']);
}

function test_getContributorById_successful()
{
    $connection = db\connect('demo');
    $contributor = db\getContributorById($connection, 4);
    assert(4 === $contributor['id']);
    assert('Sever S.' === $contributor['given_name']);
    assert('Dragomir' === $contributor['family_name']);
    assert('Victoria University, Melbourne, Australia' === $contributor['affiliation']);
    assert('dragomir@octogon.com' === $contributor['email']);
}

function test_getContributorById_invalidId()
{
    $connection = db\connect('demo');
    try {
        $_ = db\getContributorById($connection, 99);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The contributor ID (99) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateContributor_successful()
{
    $connection = db\connect('demo');
    $contributor = array(
        'given_name' => 'B.',
        'family_name' => 'A.',
        'affiliation' => 'C.',
        'email' => 'some@thing.com'
    );
    db\updateContributor($connection, 3, $contributor);
    $retrieved = db\getContributorById($connection, 3);
    assert(3 === $retrieved['id']);
    assert('B.' === $retrieved['given_name']);
    assert('A.' === $retrieved['family_name']);
    assert('C.' === $retrieved['affiliation']);
    assert('some@thing.com' === $retrieved['email']);
}

function test_updateContributor_invalidId()
{
    $connection = db\connect('demo');
    $contributor = array(
        'given_name' => 'B.',
        'family_name' => 'A.',
        'affiliation' => 'C.',
        'email' => 'some@thing.com'
    );
    try {
        db\updateContributor($connection, 50, $contributor);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The contributor ID (50) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateContributor_missingGivenName()
{
    $connection = db\connect('demo');
    $contributor = array(
        'given_name' => ' ',
        'family_name' => 'A.',
        'affiliation' => 'C.',
        'email' => 'some@thing.com'
    );
    try {
        db\updateContributor($connection, 4, $contributor);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The given name of the contributor is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateContributor_missingFamilyName()
{
    $connection = db\connect('demo');
    $contributor = array(
        'given_name' => 'B.',
        'family_name' => ' ',
        'affiliation' => 'C.',
        'email' => 'some@thing.com'
    );
    try {
        db\updateContributor($connection, 4, $contributor);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The family name of the contributor is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateContributor_missingAffiliation()
{
    $connection = db\connect('demo');
    $contributor = array(
        'given_name' => 'B.',
        'family_name' => 'A.',
        'affiliation' => ' ',
        'email' => 'some@thing.com'
    );
    try {
        db\updateContributor($connection, 4, $contributor);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The affiliation of the contributor is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateContributor_missingEmail()
{
    $connection = db\connect('demo');
    $contributor = array(
        'given_name' => 'B.',
        'family_name' => 'A.',
        'affiliation' => 'C.',
        'email' => ' '
    );
    try {
        db\updateContributor($connection, 4, $contributor);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The e-mail address of the contributor is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateContributor_invalidEmail()
{
    $connection = db\connect('demo');
    $contributor = array(
        'given_name' => 'B.',
        'family_name' => 'A.',
        'affiliation' => 'C.',
        'email' => 'something.com'
    );
    try {
        db\updateContributor($connection, 4, $contributor);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The e-mail address of the contributor is invalid!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_removeContributor_successful()
{
    $connection = db\connect('demo');
    $contributor = array(
        'given_name' => 'Gao',
        'family_name' => 'Minghze',
        'affiliation' => 'China',
        'email' => 'g.minghze@octogon.com'
    );
    $contributorId = db\createContributor($connection, $contributor);
    assert($contributorId === 7);
    db\removeContributor($connection, $contributorId);
    $contributors = db\collectContributorsByFilter($connection, '');
    assert(6 === count($contributors));
    assert(1 === $contributor[0]['id']);
    assert(2 === $contributor[1]['id']);
    assert(3 === $contributor[2]['id']);
    assert(4 === $contributor[3]['id']);
    assert(5 === $contributor[4]['id']);
    assert(6 === $contributor[5]['id']);
}

function test_removeContributor_invalidId()
{
    $connection = db\connect('demo');
    try {
        db\removeContributor($connection, 40);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The contributor ID (40) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_removeContributor_isAnAuthor()
{
    $connection = db\connect('demo');
    try {
        db\removeContributor($connection, 4);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The contributor ID (4) is referenced as an author!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_removeContributor_isAnEditor()
{
    $connection = db\connect('demo');
    $contributor = array(
        'given_name' => 'Gao',
        'family_name' => 'Minghze',
        'affiliation' => 'China',
        'email' => 'g.minghze@octogon.com'
    );
    $contributorId = db\createContributor($connection, $contributor);
    assert($contributorId === 7);
    db\addToEditorialBoard($connection, 7);
    try {
        db\removeContributor($connection, 7);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The contributor ID (4) is referenced as an editor!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

require '../utils/test_runner.php';

?>
