<?php

require '../database.php';

function test_createArticleType_successful()
{
    $connection = db\connect('empty');
    $articleType = array(
        'name' => 'competition',
        'description' => 'Mathematical competition'
    );
    $typeId = db\createArticleType($connection, $articleType);
    assert($typeId === 1);
    $retrieved = db\getArticleTypeById($connection, $typeId);
    assert('competition' === $retrieved['name']);
    assert('Mathematical competition' === $retrieved['description']);
}

function test_createArticleType_missing_name()
{
    $connection = db\connect('empty');
    $articleType = array(
        'name' => '',
        'description' => 'Missing name'
    );
    try {
        $_ = db\createArticleType($connection, $articleType);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The article type name is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_createArticleType_existing_name()
{
    $connection = db\connect('empty');
    for ($i = 1; $i <= 3; $i++) {
        $articleType = array(
            'name' => 'competition '.$i,
            'description' => 'Mathematical competition'
        );
        $typeId = db\createArticleType($connection, $articleType);
        assert($i === $typeId);
    }
    $furtherArticleType = array(
        'name' => 'competition 2',
        'description' => 'Further name'
    );
    try {
        $_ = db\createArticleType($connection, $furtherArticleType);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The article type name "competition 2" is already exists!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_collectArticleTypes_empty()
{
    $connection = db\connect('empty');
    $articleTypes = db\collectArticleTypes($connection);
    assert([] === $articleTypes);
}

function test_collectArticleTypes_multiple()
{
    $connection = db\connect('empty');
    for ($i = 1; $i <= 3; $i++) {
        $articleType = array(
            'name' => 'competition '.$i,
            'description' => 'Mathematical competition'
        );
        $typeId = db\createArticleType($connection, $articleType);
        assert($i === $typeId);
    }
    $articleTypes = db\collectArticleTypes($connection);
    assert(length($articleTypes) == 3);
    for ($i = 1; $i <= 3; $i++) {
        assert('competition '.$i === $articleTypes[$i - 1]['name']);
        assert('Mathematical competition' === $articleTypes[$i - 1]['description']);
    }
}

function test_getArticleTypeById_successful()
{
    $connection = db\connect('empty');
    for ($i = 1; $i <= 3; $i++) {
        $articleType = array(
            'name' => 'competition '.$i,
            'description' => 'Mathematical competition'
        );
        $typeId = db\createArticleType($connection, $articleType);
        assert($i === $typeId);
    }
    for ($i = 1; $i <= 3; $i++) {
        $retrieved = db\getArticleTypeById($connection, $typeId);
        assert('competition '.$i === $retrieved['name']);
    }
}

function test_getArticleTypeById_invalid()
{
    $connection = db\connect('empty');
    for ($i = 1; $i <= 3; $i++) {
        $articleType = array(
            'name' => 'competition '.$i,
            'description' => 'Mathematical competition'
        );
        $typeId = db\createArticleType($connection, $articleType);
        assert($i === $typeId);
    }
    try {
        $retrieved = db\getArticleTypeById($connection, 5);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The article type ID (5) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateArticleType_successful()
{
    $connection = db\connect('empty');
    $articleType = array(
        'name' => 'competition',
        'description' => 'Mathematical competition'
    );
    $typeId = db\createArticleType($connection, $articleType);
    assert($typeId === 1);
    $modifiedArticleType = array(
        'name' => 'solutions',
        'description' => 'Solutions'
    );
    db\updateArticleType($connection, $typeId, $modifiedArticleType);
    $retrieved = db\getArticleTypeById($connection, $typeId);
    assert('solutions' === $retrieved['name']);
    assert('Solutions' === $retrieved['description']);
}

function test_updateArticleType_invalidId()
{
    $connection = db\connect('empty');
    for ($i = 1; $i <= 3; $i++) {
        $articleType = array(
            'name' => 'competition '.$i,
            'description' => 'Mathematical competition'
        );
        $typeId = db\createArticleType($connection, $articleType);
        assert($i === $typeId);
    }
    $modifiedArticleType = array(
        'name' => 'solutions',
        'description' => 'Solutions'
    );
    try {
        db\updateArticleType($connection, 8, $modifiedArticleType);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The article type ID (8) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateArticleType_missingName()
{
    $connection = db\connect('empty');
    for ($i = 1; $i <= 3; $i++) {
        $articleType = array(
            'name' => 'competition '.$i,
            'description' => 'Mathematical competition'
        );
        $typeId = db\createArticleType($connection, $articleType);
        assert($i === $typeId);
    }
    $modifiedArticleType = array(
        'name' => 'solutions',
        'description' => 'Solutions'
    );
    try {
        db\updateArticleType($connection, 8, $modifiedArticleType);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The article type name is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_updateArticleType_existingName()
{
    $connection = db\connect('empty');
    for ($i = 1; $i <= 3; $i++) {
        $articleType = array(
            'name' => 'competition '.$i,
            'description' => 'Mathematical competition'
        );
        $typeId = db\createArticleType($connection, $articleType);
        assert($i === $typeId);
    }
    $modifiedArticleType = array(
        'name' => 'competition 2',
        'description' => 'Further name'
    );
    try {
        $_ = db\updateArticleType($connection, 3, $modifiedArticleType);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The article type name "competition 2" is already exists!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_removeArticleType_successful()
{
    $connection = db\connect('empty');
    for ($i = 1; $i <= 3; $i++) {
        $articleType = array(
            'name' => 'competition '.$i,
            'description' => 'Mathematical competition'
        );
        $typeId = db\createArticleType($connection, $articleType);
        assert($i === $typeId);
    }
    db\removeArticleType($connection, 1);
    $articleTypes = db\collectArticleTypes($connection);
    assert(2 === length($articleTypes));
    assert('competition 2' === $articleTypes[0]['name']);
    assert('competition 3' === $articleTypes[1]['name']);
}

function test_removeArticleType_invalidId()
{
    $connection = db\connect('empty');
    for ($i = 1; $i <= 3; $i++) {
        $articleType = array(
            'name' => 'competition '.$i,
            'description' => 'Mathematical competition'
        );
        $typeId = db\createArticleType($connection, $articleType);
        assert($i === $typeId);
    }
    db\removeArticleType($connection, 1);
    try {
        $_ = db\removeArticleType($connection, 1);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The article type ID (1) is missing!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_removeArticleType_inUse()
{
    $connection = db\connect('empty');
    try {
        $_ = db\removeArticleType($connection, 3);
        assert(false, 'Exception has not raised!');
    }
    catch (ValueError $error) {
        assert('The article type ID (3) is in use!' === $error->getMessage());
    }
    catch (Exception $error) {
        assert(false, 'Invalid exception type!');
    }
}

function test_removeArticleType_insertAfterRemove()
{
    $connection = db\connect('empty');
    for ($i = 1; $i <= 3; $i++) {
        $articleType = array(
            'name' => 'competition '.$i,
            'description' => 'Mathematical competition'
        );
        $typeId = db\createArticleType($connection, $articleType);
        assert($i === $typeId);
    }
    db\removeArticleType($connection, 3);
    $articleType = array(
        'name' => 'solutions',
        'description' => 'Solutions'
    );
    $typeId = db\createArticleType($connection, $articleType);
    assert(4 === $typeId);
}

require '../utils/test_runner.php';

?>
