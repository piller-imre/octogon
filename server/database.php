<?php
namespace db;

// include 'config.php';

// https://www.php.net/manual/en/sqlite3.open.php

class ValueError extends \Exception {}

class OctogonDb extends \SQLite3
{
    function __construct($name = null) {
        if ($name == null) {
            $this->open('octogon.db');
        } else if ($name == 'empty') {
            copy('../test_dbs/empty.db', '../empty.db');
            $this->open('../empty.db');
        } else if ($name == 'demo') {
            copy('../test_dbs/demo.db', '../demo.db');
            $this->open('../demo.db');
        } else {
            throw new InvalidArgumentException('The database name "'.$name.'" is invalid!');
        }
    }
}

/**
 * Connect to the database.
 */
function connect($name = null)
{
    $conn = new OctogonDb($name);
    return $conn;
}

/**
 * Check that the e-mail and password pair is valid.
 * 
 * @return true on valid pair, else false
 */
function isValidPassword($connection, $email, $password)
{
    // TODO: Calc password hash!
}

/**
 * Create a new article type.
 */
function createArticleType($connection, $articleType)
{
    if ($articleType['name'] == '') {
        throw new ValueError('The article type name is missing!');
    }
    $sql = <<<SQL
        INSERT INTO article_types (name, description)
        VALUES (:name, :description)
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':name', $articleType['name'], SQLITE3_TEXT);
    $stmt->bindParam(':description', $articleType['description'], SQLITE3_TEXT);
    $stmt->execute();
    if ($connection->lastErrorMsg() == 'UNIQUE constraint failed: article_types.name') {
        throw new ValueError('The article type name "'.$articleType['name'].'" is already exists!');
    }
    $articleTypeId = $connection->lastInsertRowID();
    $stmt->close();
    return $articleTypeId;
}

/**
 * Collect the available article types.
 */
function collectArticleTypes($connection)
{
    $sql = <<<SQL
        SELECT name, description
        FROM article_types
    SQL;
    $result = $connection->query($sql);
    $articleTypes = [];
    while (($row = $result->fetchArray(SQLITE3_ASSOC))) {
        $articleType = array(
            'name' => $row['name'],
            'description' => $row['description']
        );
        array_push($articleTypes, $articleType);
    }
    return $articleTypes;
}

/**
 * Get the article type by its unique identifier.
 */
function getArticleTypeById($connection, $articleTypeId)
{
    $sql = <<<SQL
        SELECT name, description
        FROM article_types
        WHERE id == :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $articleTypeId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $articleType = $result->fetchArray(SQLITE3_ASSOC);
    if ($articleType == false) {
        throw new ValueError('The article type ID ('.$articleTypeId.') is missing!');
    }
    return $articleType;
}

/**
 * Update the article type.
 */
function updateArticleType($connection, $articleTypeId, $articleType)
{
    if ($articleType['name'] == '') {
        throw new ValueError('The article type name is missing!');
    }
    $sql = <<<SQL
        UPDATE article_types
        SET name = :name, description = :description
        WHERE id == :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':name', $articleType['name'], SQLITE3_TEXT);
    $stmt->bindParam(':description', $articleType['description'], SQLITE3_TEXT);
    $stmt->bindParam(':id', $articleTypeId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    if ($connection->lastErrorMsg() == 'UNIQUE constraint failed: article_types.name') {
        throw new ValueError('The article type name "'.$articleType['name'].'" is already exists!');
    }
    if ($connection->changes() != 1) {
        throw new ValueError('The article type ID ('.$articleTypeId.') is missing!');
    }
}

/**
 * Remove the article type.
 */
function removeArticleType($connection, $articleTypeId)
{
    $sql = <<<SQL
        DELETE FROM article_types
        WHERE id == :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $articleTypeId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    if ($connection->changes() != 1) {
        throw new ValueError('The article type ID ('.$articleTypeId.') is missing!');
    }
}

/**
 * Create a new volume.
 */
function createVolume($connection, $volume)
{

}

/**
 * Collect the available volumes.
 */
function collectVolumes($connection)
{

}

/**
 * Get the volume by its unique identifier.
 */
function getVolumeById($connection, $volumeId)
{

}

/**
 * Update the volume.
 */
function updateVolume($connection, $volumeId, $volume)
{

}

/**
 * Remove the volume.
 */
function removeVolume($connection, $volumeId)
{

}

/**
 * Create a new document.
 */
function createDocument($connection, $document)
{

}

/**
 * Collect the available documents.
 */
function collectDocuments($connection)
{

}

/**
 * Remove the document.
 */
function removeDocument($connection, $documentId)
{

}

/**
 * Create a new article.
 */
function createArticle($connection, $article)
{

}

/**
 * Collect the available articles by volume.
 */
function collectArticlesByVolume($connection, $volumeId)
{

}

/**
 * Get article by its unique identifier.
 */
function getArticleById($connection, $articleId)
{

}

/**
 * Update the article.
 */
function updateArticle($connection, $articleId, $article)
{

}

/**
 * Remove the article.
 */
function removeArticle($connection, $articleId)
{
    // TODO: Remove the related document also!
}

/**
 * Create a new contributor.
 */
function createContributor($connection, $contributor)
{

}

/**
 * Collect all contributors.
 */
function collectContributorsByFilter($connection, $filterExpression)
{

}

/**
 * Get contributor by its unique identifier.
 */
function getContributorById($connection, $contributorId)
{

}

/**
 * Update contributor.
 */
function updateContributor($connection, $contributorId, $contributor)
{

}

/**
 * Remove the contributor.
 */
function removeContributor($connection, $contributorId)
{

}

/**
 * Create an authorship.
 */
function createAuthorship($connection, $authorship)
{

}

/**
 * Collect authorships by article.
 */
function collectAuthorshipsByArticleId($connection, $articleId)
{

}

/**
 * Update the authorship.
 */
function updateAuthorship($connection, $authorshipId, $authorship)
{

}

/**
 * Move the authorship up.
 */
function moveAuthorshipUp($connection, $authorshipId)
{
}

/**
 * Move the authorship down.
 */
function moveAuthorshipDown($connection, $authorshipId)
{
}

/**
 * Remove the authorship.
 */
function removeAuthorship($connection, $authorshipId)
{

}

/**
 * Collect the editors of the Editorial Board.
 */
function collectEditors($connection)
{

}

/**
 * Add a contributor to the Editorial Board.
 */
function addToEditorialBoard($connection, $contributorId)
{

}

/**
 * Remove the contributor from the Editorial Board.
 */
function removeFromEditorialBoard($connection, $contributorId)
{

}

/**
 * Move the contributor up in the Editorial Board.
 */
function moveEditorUp($connection, $contributorId)
{

}

/**
 * Move the contributor down in the Editorial Board.
 */
function moveEditorDown($connection, $contributorId)
{

}

/**
 * Get the content of a public page.
 */
function getPageContent($connection, $pageName)
{

}

/**
 * Update the content of a public page.
 */
function updatePageContent($connection, $pageName, $content)
{

}

/**
 * Create a new post.
 */
function createPost($connection, $post)
{

}

/**
 * Collect the available posts.
 */
function collectPosts($connection)
{

}

/**
 * Get a post by its unique identifier.
 */
function getPostById($connection, $postId)
{

}

/**
 * Update the post.
 */
function updatePost($connection, $postId, $post)
{

}

/**
 * Remove the post.
 */
function removePost($connection, $postId)
{

}

?>
