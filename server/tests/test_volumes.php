<?php

require '../database.php';

function test_createVolume_successful()
{
    $connection = db\connect('empty');
    $volume = array(
        'volume' => 20,
        'number' => 2,
        'year' => 2012,
        'month' => 10,
        'cover_image' => 'cover_2012_2.png',
        'is_visible' => 0
    );
    $volumeId = db\createVolume($connection, $volume);
    assert(1 === $volumeId);
}

function test_createVolume_invalidVolumeString()
{
    $connection = db\connect('empty');
    $volume = array(
        'volume' => '20',
        'number' => 2,
        'year' => 2012,
        'month' => 10,
        'cover_image' => 'cover_2012_2.png',
        'is_visible' => 0
    );
    try {
        $_ = db\createVolume($connection, $volume);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('Invalid volume data!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createVolume_invalidVolumeNegative()
{
    $connection = db\connect('empty');
    $volume = array(
        'volume' => -10,
        'number' => 2,
        'year' => 2012,
        'month' => 10,
        'cover_image' => 'cover_2012_2.png',
        'is_visible' => 0
    );
    try {
        $_ = db\createVolume($connection, $volume);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('Invalid volume data!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createVolume_invalidNumberString()
{
    $connection = db\connect('empty');
    $volume = array(
        'volume' => 20,
        'number' => '2',
        'year' => 2012,
        'month' => 10,
        'cover_image' => 'cover_2012_2.png',
        'is_visible' => 0
    );
    try {
        $_ = db\createVolume($connection, $volume);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('Invalid volume data!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createVolume_invalidNumberNegative()
{
    $connection = db\connect('empty');
    $volume = array(
        'volume' => 20,
        'number' => -2,
        'year' => 2012,
        'month' => 10,
        'cover_image' => 'cover_2012_2.png',
        'is_visible' => 0
    );
    try {
        $_ = db\createVolume($connection, $volume);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('Invalid volume data!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createVolume_invalidYear()
{
    $connection = db\connect('empty');
    $volume = array(
        'volume' => 20,
        'number' => 2,
        'year' => 1950,
        'month' => 10,
        'cover_image' => 'cover_2012_2.png',
        'is_visible' => 0
    );
    try {
        $_ = db\createVolume($connection, $volume);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('Invalid volume data!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createVolume_invalidMonthZero()
{
    $connection = db\connect('empty');
    $volume = array(
        'volume' => 20,
        'number' => 2,
        'year' => 2012,
        'month' => 13,
        'cover_image' => 'cover_2012_2.png',
        'is_visible' => 0
    );
    try {
        $_ = db\createVolume($connection, $volume);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('Invalid volume data!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createVolume_invalidMonthLarge()
{
    $connection = db\connect('empty');
    $volume = array(
        'volume' => 20,
        'number' => 2,
        'year' => 2012,
        'month' => 13,
        'cover_image' => 'cover_2012_2.png',
        'is_visible' => 0
    );
    try {
        $_ = db\createVolume($connection, $volume);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('Invalid volume data!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createVolume_missingCoverImage()
{
    $connection = db\connect('empty');
    $volume = array(
        'volume' => 20,
        'number' => 2,
        'year' => 2012,
        'month' => 10,
        'cover_image' => '',
        'is_visible' => 0
    );
    try {
        $_ = db\createVolume($connection, $volume);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('Invalid volume data!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createVolume_invalidCoverImage()
{
    $connection = db\connect('empty');
    $volume = array(
        'volume' => 20,
        'number' => 2,
        'year' => 2012,
        'month' => 10,
        'cover_image' => 'unexpected file name',
        'is_visible' => 0
    );
    try {
        $_ = db\createVolume($connection, $volume);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('Invalid volume data!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_collectVolumes_empty()
{
    $connection = db\connect('empty');
    $volumes = db\collectVolumes($connection);
    assert([] === $volumes);
}

function test_collectVolumes_multiple()
{
    $connection = db\connect('demo');
    $volumes = db\collectVolumes($connection);
    assert(5 === count($volumes));

    assert(5 === $volumes[0]['id']);
    assert(20 === $volumes[0]['volume']);
    assert(1 === $volumes[0]['number']);
    assert(2012 === $volumes[0]['year']);
    assert(4 === $volumes[0]['month']);
    assert('cover_2012_1.png' === $volumes[0]['cover_image']);
    assert(0 === $volumes[0]['is_visible']);

    assert(4 === $volumes[1]['id']);
    assert(19 === $volumes[1]['volume']);
    assert(2 === $volumes[1]['number']);
    assert(2011 === $volumes[1]['year']);
    assert(10 === $volumes[1]['month']);
    assert('cover_2011_2.png' === $volumes[1]['cover_image']);
    assert(0 === $volumes[1]['is_visible']);

    assert(3 === $volumes[2]['id']);
    assert(19 === $volumes[2]['volume']);
    assert(1 === $volumes[2]['number']);
    assert(2011 === $volumes[2]['year']);
    assert(4 === $volumes[2]['month']);
    assert('cover_2011_1.png' === $volumes[2]['cover_image']);
    assert(1 === $volumes[2]['is_visible']);

    assert(2 === $volumes[3]['id']);
    assert(18 === $volumes[3]['volume']);
    assert(2 === $volumes[3]['number']);
    assert(2010 === $volumes[3]['year']);
    assert(10 === $volumes[3]['month']);
    assert('cover_2010_2.png' === $volumes[3]['cover_image']);
    assert(1 === $volumes[3]['is_visible']);

    assert(1 === $volumes[4]['id']);
    assert(18 === $volumes[4]['volume']);
    assert(1 === $volumes[4]['number']);
    assert(2010 === $volumes[4]['year']);
    assert(4 === $volumes[4]['month']);
    assert('cover_2010_1.png' === $volumes[4]['cover_image']);
    assert(1 === $volumes[4]['is_visible']);
}

function test_getVolumeById_successful()
{
    $connection = db\connect('demo');
    $volume = db\getVolumeById($connection, 4);
    assert(4 === $volume['id']);
    assert(19 === $volume['volume']);
    assert(2 === $volume['number']);
    assert(2011 === $volume['year']);
    assert(10 === $volume['month']);
    assert('cover_2011_2.png' === $volume['cover_image']);
    assert(0 === $volume['is_visible']);
}

function test_getVolumeById_invalidId()
{
    $connection = db\connect('demo');
    try {
        $volume = db\getVolumeById($connection, 40);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The volume ID (40) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateVolume_successful()
{
    $connection = db\connect('demo');
    $volume = array(
        'volume' => 22,
        'number' => 3,
        'year' => 2015,
        'month' => 9,
        'cover_image' => 'cover_2015_3.png',
        'is_visible' => 1
    );
    db\updateVolume($connection, 5, $volume);
    $volume = db\getVolumeById($connection, 5);
    assert(5 === $volume['id']);
    assert(22 === $volume['volume']);
    assert(3 === $volume['number']);
    assert(2015 === $volume['year']);
    assert(9 === $volume['month']);
    assert('cover_2015_3.png' === $volume['cover_image']);
    assert(1 === $volume['is_visible']);
}

function test_updateVolume_invalidId()
{
    $connection = db\connect('demo');
    $volume = array(
        'volume' => 22,
        'number' => 3,
        'year' => 2015,
        'month' => 9,
        'cover_image' => 'cover_2015_3.png',
        'is_visible' => 1
    );
    try {
        db\updateVolume($connection, 50, $volume);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The volume ID (50) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateVolume_invalidVolume()
{
    $connection = db\connect('demo');
    $volume = array(
        'volume' => 0,
        'number' => 3,
        'year' => 2015,
        'month' => 9,
        'cover_image' => 'cover_2015_3.png',
        'is_visible' => 1
    );
    try {
        db\updateVolume($connection, 5, $volume);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('Invalid volume data!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateVolume_invalidNumber()
{
    $connection = db\connect('demo');
    $volume = array(
        'volume' => 20,
        'number' => 0,
        'year' => 2015,
        'month' => 9,
        'cover_image' => 'cover_2015_3.png',
        'is_visible' => 1
    );
    try {
        db\updateVolume($connection, 5, $volume);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('Invalid volume data!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateVolume_invalidYear()
{
    $connection = db\connect('demo');
    $volume = array(
        'volume' => 20,
        'number' => 3,
        'year' => 1920,
        'month' => 9,
        'cover_image' => 'cover_2015_3.png',
        'is_visible' => 1
    );
    try {
        db\updateVolume($connection, 5, $volume);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('Invalid volume data!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateVolume_invalidMonth()
{
    $connection = db\connect('demo');
    $volume = array(
        'volume' => 20,
        'number' => 3,
        'year' => 2015,
        'month' => 0,
        'cover_image' => 'cover_2015_3.png',
        'is_visible' => 1
    );
    try {
        db\updateVolume($connection, 5, $volume);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('Invalid volume data!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateVolume_missingCoverImage()
{
    $connection = db\connect('demo');
    $volume = array(
        'volume' => 20,
        'number' => 3,
        'year' => 2015,
        'month' => 9,
        'cover_image' => '',
        'is_visible' => 1
    );
    try {
        db\updateVolume($connection, 5, $volume);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('Invalid volume data!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateVolume_invalidCoverImage()
{
    $connection = db\connect('demo');
    $volume = array(
        'volume' => 20,
        'number' => 3,
        'year' => 2015,
        'month' => 9,
        'cover_image' => 'cover 2015 png',
        'is_visible' => 1
    );
    try {
        db\updateVolume($connection, 5, $volume);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('Invalid volume data!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_removeVolume_successful()
{
    $connection = db\connect('demo');
    db\removeVolume($connection, 4);
    $volumes = db\collectVolumes($connection);
    assert(4 === count($volumes));
}

function test_removeVolume_invalidId()
{
    $connection = db\connect('demo');
    try {
        db\removeVolume($connection, 40);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('The volume ID (40) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_removeVolume_inUse()
{
    $connection = db\connect('demo');
    try {
        db\removeVolume($connection, 3);
        assert(false, 'Exception has not raised!');
    }
    catch (db\ValueError $error) {
        assert('Unable to remove, because the volume ID (3) is in use!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

require '../utils/test_runner.php';

?>
