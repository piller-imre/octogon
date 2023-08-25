<?php

require '../database.php';

// TODO: The passwords must be hashed!

function test_isValidPassword_valid()
{
    $connection = db\connect('demo');
    $result = db\isValidPassword($connection, 'admin@octogon.com', 'nothing');
    assert(true === $result);
}

function test_isValidPassword_invalid()
{
    $connection = db\connect('demo');
    $result = db\isValidPassword($connection, 'admin@octogon.com', 'invalid');
    assert(false === $result);
    // TODO: It should be logged!
}

require '../utils/test_runner.php';

?>
