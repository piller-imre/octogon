<?php
namespace db;

include 'config.php';

/**
 * Open a new database connection.
 * 
 * @return a database connection object
 */
function openDbConnection()
{
    $connection = new \mysqli(
        \Config::DB_HOST,
        \Config::DB_USERNAME,
        \Config::DB_PASSWORD,
        \Config::DB_DATABASE
    );
    if ($connection->connect_error) {
        die('Failed to connect to the DB: '.$connection->connect_error);
    }
    return $connection;
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

}

/**
 * Collect the available article types.
 */
function collectArticleTypes($connection)
{

}

/**
 * Get the article type by its unique identifier.
 */
function getArticleTypeById($connection, $articleTypeId)
{

}

/**
 * Update the article type.
 */
function updateArticleType($connection, $articleTypeId, $articleType)
{

}

/**
 * Remove the article type.
 */
function removeArticleType($connection, $articleTypeId)
{

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
function removeEditorialBoard($connection, $contributorId)
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
