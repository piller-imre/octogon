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
        SELECT count(id)
        FROM articles
        WHERE article_type_id == :article_type_id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':article_type_id', $articleTypeId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    if ($row['count(id)'] > 0) {
        throw new ValueError('The article type ID ('.$articleTypeId.') is in use!');
    }
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
 * Check the data of the volume.
 */
function checkVolumeData($volume)
{
    if (
        gettype($volume['volume']) != 'integer' ||
        $volume['volume'] < 1 ||
        gettype($volume['number']) != 'integer' ||
        $volume['number'] < 1 ||
        $volume['year'] < 2000 ||
        $volume['month'] < 1 ||
        $volume['month'] > 12 ||
        $volume['cover_image'] == '' ||
        preg_match('/\\.png$/i', $volume['cover_image']) != 1
    ) {
        throw new ValueError('Invalid volume data!');
    }
}

/**
 * Create a new volume.
 */
function createVolume($connection, $volume)
{
    checkVolumeData($volume);
    $sql = <<<SQL
        INSERT INTO volumes (volume, number, year, month, cover_image, is_visible)
        VALUES (:volume, :number, :year, :month, :cover_image, :is_visible)
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':volume', $volume['volume'], SQLITE3_INTEGER);
    $stmt->bindParam(':number', $volume['number'], SQLITE3_INTEGER);
    $stmt->bindParam(':year', $volume['year'], SQLITE3_INTEGER);
    $stmt->bindParam(':month', $volume['month'], SQLITE3_INTEGER);
    $stmt->bindParam(':cover_image', $volume['cover_image'], SQLITE3_TEXT);
    $stmt->bindParam(':is_visible', $volume['is_visible'], SQLITE3_INTEGER);
    $stmt->execute();
    $volumeId = $connection->lastInsertRowID();
    $stmt->close();
    return $volumeId;
}

/**
 * Collect the available volumes.
 */
function collectVolumes($connection)
{
    $sql = <<<SQL
        SELECT id, volume, number, year, month, cover_image, is_visible
        FROM volumes
        ORDER BY id DESC
    SQL;
    $result = $connection->query($sql);
    $volumes = [];
    while (($row = $result->fetchArray(SQLITE3_ASSOC))) {
        $volume = array(
            'id' => $row['id'],
            'volume' => $row['volume'],
            'number' => $row['number'],
            'year' => $row['year'],
            'month' => $row['month'],
            'cover_image' => $row['cover_image'],
            'is_visible' => $row['is_visible']
        );
        array_push($volumes, $volume);
    }
    return $volumes;
}

/**
 * Get the volume by its unique identifier.
 */
function getVolumeById($connection, $volumeId)
{
    $sql = <<<SQL
        SELECT id, volume, number, year, month, cover_image, is_visible
        FROM volumes
        WHERE id == :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $volumeId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $volume = $result->fetchArray(SQLITE3_ASSOC);
    if ($volume == false) {
        throw new ValueError('The volume ID ('.$volumeId.') is missing!');
    }
    return $volume;
}

/**
 * Update the volume.
 */
function updateVolume($connection, $volumeId, $volume)
{
    checkVolumeData($volume);
    $sql = <<<SQL
        UPDATE volumes
        SET volume = :volume,
            number = :number,
            year = :year,
            month = :month,
            cover_image = :cover_image,
            is_visible = :is_visible
        WHERE id == :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':volume', $volume['volume'], SQLITE3_INTEGER);
    $stmt->bindParam(':number', $volume['number'], SQLITE3_INTEGER);
    $stmt->bindParam(':year', $volume['year'], SQLITE3_INTEGER);
    $stmt->bindParam(':month', $volume['month'], SQLITE3_INTEGER);
    $stmt->bindParam(':cover_image', $volume['cover_image'], SQLITE3_TEXT);
    $stmt->bindParam(':is_visible', $volume['is_visible'], SQLITE3_INTEGER);
    $stmt->bindParam(':id', $volumeId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    if ($connection->changes() != 1) {
        throw new ValueError('The volume ID ('.$volumeId.') is missing!');
    }
}

/**
 * Remove the volume.
 */
function removeVolume($connection, $volumeId)
{
    $sql = <<<SQL
        SELECT count(id)
        FROM articles
        WHERE volume_id == :volume_id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':volume_id', $volumeId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    if ($row['count(id)'] > 0) {
        throw new ValueError('Unable to remove, because the volume ID ('.$volumeId.') is in use!');
    }
    $sql = <<<SQL
        DELETE FROM volumes
        WHERE id == :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $volumeId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    if ($connection->changes() != 1) {
        throw new ValueError('The volume ID ('.$volumeId.') is missing!');
    }
}

/**
 * Create a new document.
 */
function createDocument($connection, $document)
{
    if (trim($document['name']) == '') {
        throw new ValueError('The name of the document is missing!');
    }
    $sql = <<<SQL
        INSERT INTO documents (name, upload_date)
        VALUES (:name, :upload_date)
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':name', $document['name'], SQLITE3_TEXT);
    $stmt->bindParam(':upload_date', date('d-m-y h:i:s'), SQLITE3_TEXT);
    $stmt->execute();
    if ($connection->lastErrorMsg() == 'UNIQUE constraint failed: documents.name') {
        throw new ValueError('The document "'.$document['name'].'" is already exists!');
    }
    $documentId = $connection->lastInsertRowID();
    $stmt->close();
    return $documentId;
}

/**
 * Collect the available documents.
 */
function collectDocuments($connection)
{
    $sql = <<<SQL
        SELECT id, name, upload_date
        FROM documents
    SQL;
    $result = $connection->query($sql);
    $documents = [];
    while (($row = $result->fetchArray(SQLITE3_ASSOC))) {
        $document = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'upload_date' => $row['upload_date']
        );
        array_push($documents, $document);
    }
    return $documents;
}

/**
 * Remove the document.
 */
function removeDocument($connection, $documentId)
{
    $sql = <<<SQL
        SELECT count(id)
        FROM articles
        WHERE document_id == :document_id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':document_id', $documentId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    if ($row['count(id)'] > 0) {
        throw new ValueError('The document ID ('.$documentId.') is in use!');
    }
    $sql = <<<SQL
        DELETE FROM documents
        WHERE id == :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $documentId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    if ($connection->changes() != 1) {
        throw new ValueError('The document ID ('.$documentId.') is missing!');
    }
}

/**
 * Check the article type id.
 */
function checkArticleTypeId($connection, $articleTypeId)
{
    $sql = <<<SQL
        SELECT count(id)
        FROM article_types
        WHERE id == :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $articleTypeId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    if ($row['count(id)'] != 1) {
        throw new ValueError('The article type ID ('.$articleTypeId.') is missing!');
    }
}

/**
 * Check the volume id.
 */
function checkVolumeId($connection, $volumeId)
{
    $sql = <<<SQL
        SELECT count(id)
        FROM volumes
        WHERE id == :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $volumeId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    if ($row['count(id)'] != 1) {
        throw new ValueError('The volume ID ('.$volumeId.') is missing!');
    }
}

/**
 * Check the document id.
 */
function checkDocumentId($connection, $documentId)
{
    $sql = <<<SQL
        SELECT count(id)
        FROM documents
        WHERE id == :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $documentId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    if ($row['count(id)'] != 1) {
        throw new ValueError('The document ID ('.$documentId.') is missing!');
    }
}

/**
 * Check the data of the article.
 */
function checkArticleData($connection, $article)
{
    if (trim($article['title']) == '') {
        throw new ValueError('The title of the article is missing!');
    }
    if ($article['first_page'] < 1) {
        throw new ValueError('The first page of the article ('.$article['first_page'].') is invalid!');
    }
    if ($article['last_page'] < 1) {
        throw new ValueError('The last page of the article ('.$article['last_page'].') is invalid!');
    }
    if ($article['last_page'] < $article['first_page']) {
        throw new ValueError('The page interval (from '.$article['first_page'].' to '.$article['last_page'].') is invalid!');
    }
    checkArticleTypeId($connection, $article['article_type_id']);
    checkVolumeId($connection, $article['volume_id']);
    checkDocumentId($connection, $article['document_id']);
}

/**
 * Create a new article.
 */
function createArticle($connection, $article)
{
    checkArticleData($connection, $article);
    $sql = <<<SQL
        INSERT INTO articles (
            article_type_id,
            title,
            abstract,
            volume_id,
            first_page,
            last_page,
            document_id
        )
        VALUES (
            :article_type_id,
            :title,
            :abstract,
            :volume_id,
            :first_page,
            :last_page,
            :document_id
        )
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':article_type_id', $article['article_type_id'], SQLITE3_INTEGER);
    $stmt->bindParam(':title', $article['title'], SQLITE3_TEXT);
    $stmt->bindParam(':abstract', $article['abstract'], SQLITE3_TEXT);
    $stmt->bindParam(':volume_id', $article['volume_id'], SQLITE3_INTEGER);
    $stmt->bindParam(':first_page', $article['first_page'], SQLITE3_INTEGER);
    $stmt->bindParam(':last_page', $article['last_page'], SQLITE3_INTEGER);
    $stmt->bindParam(':document_id', $article['document_id'], SQLITE3_INTEGER);
    $stmt->execute();
    $articleId = $connection->lastInsertRowID();
    $stmt->close();
    return $articleId;
}

/**
 * Collect the available articles by volume.
 */
function collectArticlesByVolume($connection, $volumeId)
{
    checkVolumeId($connection, $volumeId);
    $sql = <<<SQL
        SELECT
            id,
            article_type_id,
            title,
            abstract,
            volume_id,
            first_page,
            last_page,
            document_id
        FROM articles
        WHERE volume_id = :volume_id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':volume_id', $volumeId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $articles = [];
    while (($row = $result->fetchArray(SQLITE3_ASSOC))) {
        $article = array(
            'id' => $row['id'],
            'article_type_id' => $row['article_type_id'],
            'title' => $row['title'],
            'abstract' => $row['abstract'],
            'volume_id' => $row['volume_id'],
            'first_page' => $row['first_page'],
            'last_page' => $row['last_page'],
            'document_id' => $row['document_id']
        );
        array_push($articles, $article);
    }
    return $articles;
}

/**
 * Get article by its unique identifier.
 */
function getArticleById($connection, $articleId)
{
    $sql = <<<SQL
        SELECT
            id,
            article_type_id,
            title,
            abstract,
            volume_id,
            first_page,
            last_page,
            document_id
        FROM articles
        WHERE id = :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $articleId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $article = $result->fetchArray(SQLITE3_ASSOC);
    if ($article == false) {
        throw new ValueError('The article ID ('.$articleId.') is missing!');
    }
    return $article;
}

/**
 * Update the article.
 */
function updateArticle($connection, $articleId, $article)
{
    checkArticleData($connection, $article);
    $sql = <<<SQL
        UPDATE articles
        SET article_type_id = :article_type_id,
            title = :title,
            abstract = :abstract,
            volume_id = :volume_id,
            first_page = :first_page,
            last_page = :last_page,
            document_id = :document_id
        WHERE id == :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':article_type_id', $article['article_type_id'], SQLITE3_INTEGER);
    $stmt->bindParam(':title', $article['title'], SQLITE3_TEXT);
    $stmt->bindParam(':abstract', $article['abstract'], SQLITE3_TEXT);
    $stmt->bindParam(':volume_id', $article['volume_id'], SQLITE3_INTEGER);
    $stmt->bindParam(':first_page', $article['first_page'], SQLITE3_INTEGER);
    $stmt->bindParam(':last_page', $article['last_page'], SQLITE3_INTEGER);
    $stmt->bindParam(':document_id', $article['document_id'], SQLITE3_INTEGER);
    $stmt->bindParam(':id', $articleId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    if ($connection->changes() != 1) {
        throw new ValueError('The article ID ('.$articleId.') is missing!');
    }
}

/**
 * Remove the article.
 */
function removeArticle($connection, $articleId)
{
    $sql = <<<SQL
        DELETE FROM articles
        WHERE id == :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $articleId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    if ($connection->changes() != 1) {
        throw new ValueError('The article ID ('.$articleId.') is missing!');
    }
    // TODO: Remove the related documents also! ..and test it before!
}

/**
 * Check the contributor data.
 */
function checkContributorData($contributor)
{
    if (trim($contributor['given_name']) == '') {
        throw new ValueError('The given name of the contributor is missing!');
    }
    if (trim($contributor['family_name']) == '') {
        throw new ValueError('The family name of the contributor is missing!');
    }
    if (trim($contributor['affiliation']) == '') {
        throw new ValueError('The affiliation of the contributor is missing!');
    }
    if (trim($contributor['email']) == '') {
        throw new ValueError('The e-mail address of the contributor is missing!');
    }
    if (filter_var($contributor['email'], FILTER_VALIDATE_EMAIL) == false) {
        throw new ValueError('The e-mail address of the contributor is invalid!');
    }
}

/**
 * Create a new contributor.
 */
function createContributor($connection, $contributor)
{
    checkContributorData($contributor);
    $sql = <<<SQL
        INSERT INTO contributors (given_name, family_name, affiliation, email)
        VALUES (:given_name, :family_name, :affiliation, :email)
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':given_name', $contributor['given_name'], SQLITE3_TEXT);
    $stmt->bindParam(':family_name', $contributor['family_name'], SQLITE3_TEXT);
    $stmt->bindParam(':affiliation', $contributor['affiliation'], SQLITE3_TEXT);
    $stmt->bindParam(':email', $contributor['email'], SQLITE3_TEXT);
    $stmt->execute();
    $contributorId = $connection->lastInsertRowID();
    $stmt->close();
    return $contributorId;
}

/**
 * Collect all contributors against a filter expression.
 */
function collectContributorsByFilter($connection, $filterExpression)
{
    $sql = <<<SQL
        SELECT
            id,
            given_name,
            family_name,
            affiliation,
            email,
            lower(given_name || ' ' || family_name || ' ' || affiliation || ' ' || email) as descriptor
        FROM contributors
        WHERE descriptor LIKE :pattern
        ORDER BY family_name
    SQL;
    $stmt = $connection->prepare($sql);
    $pattern = '%'.$filterExpression.'%';
    $stmt->bindParam(':pattern', $pattern, SQLITE3_TEXT);
    $result = $stmt->execute();
    $contributors = [];
    while (($row = $result->fetchArray(SQLITE3_ASSOC))) {
        $contributor = array(
            'id' => $row['id'],
            'given_name' => $row['given_name'],
            'family_name' => $row['family_name'],
            'affiliation' => $row['affiliation'],
            'email' => $row['email']
        );
        array_push($contributors, $contributor);
    }
    return $contributors;
}

/**
 * Get contributor by its unique identifier.
 */
function getContributorById($connection, $contributorId)
{
    $sql = <<<SQL
        SELECT id, given_name, family_name, affiliation, email
        FROM contributors
        WHERE id = :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $contributorId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $contributor = $result->fetchArray(SQLITE3_ASSOC);
    if ($contributor == false) {
        throw new ValueError('The contributor ID ('.$contributorId.') is missing!');
    }
    return $contributor;
}

/**
 * Update contributor.
 */
function updateContributor($connection, $contributorId, $contributor)
{
    checkContributorData($contributor);
    $sql = <<<SQL
        UPDATE contributors
        SET given_name = :given_name,
            family_name = :family_name,
            affiliation = :affiliation,
            email = :email
        WHERE id == :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':given_name', $contributor['given_name'], SQLITE3_TEXT);
    $stmt->bindParam(':family_name', $contributor['family_name'], SQLITE3_TEXT);
    $stmt->bindParam(':affiliation', $contributor['affiliation'], SQLITE3_TEXT);
    $stmt->bindParam(':email', $contributor['email'], SQLITE3_TEXT);        
    $stmt->bindParam(':id', $contributorId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    if ($connection->changes() != 1) {
        throw new ValueError('The contributor ID ('.$contributorId.') is missing!');
    }
}

/**
 * Check that the contributor is an author.
 */
function isAnAuthor($connection, $contributorId)
{
    $sql = <<<SQL
        SELECT count(id)
        FROM authorships
        WHERE contributor_id == :contributor_id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':contributor_id', $contributorId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    if ($row['count(id)'] > 0) {
        return true;
    }
    return false;
}

/**
 * Check that the contributor is an author.
 */
function isAnEditor($connection, $contributorId)
{
    $sql = <<<SQL
        SELECT count(id)
        FROM editors
        WHERE contributor_id == :contributor_id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':contributor_id', $contributorId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    if ($row['count(id)'] > 0) {
        return true;
    }
    return false;
}

/**
 * Remove the contributor.
 */
function removeContributor($connection, $contributorId)
{
    if (isAnAuthor($connection, $contributorId)) {
        throw new ValueError('The contributor ID ('.$contributorId.') is referenced as an author!');
    }
    if (isAnEditor($connection, $contributorId)) {
        throw new ValueError('The contributor ID ('.$contributorId.') is referenced as an editor!');
    }
    $sql = <<<SQL
        DELETE FROM contributors
        WHERE id == :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $contributorId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    if ($connection->changes() != 1) {
        throw new ValueError('The contributor ID ('.$contributorId.') is missing!');
    }
}

/**
 * Check the author data.
 */
function checkAuthorData($authorship)
{
    if (trim($authorship['given_name']) == '') {
        throw new ValueError('The given name of the author is missing!');
    }
    if (trim($authorship['family_name']) == '') {
        throw new ValueError('The family name of the author is missing!');
    }
    if (trim($authorship['affiliation']) == '') {
        throw new ValueError('The affiliation of the author is missing!');
    }
    if (trim($authorship['email']) == '') {
        throw new ValueError('The e-mail address of the author is missing!');
    }
    if (filter_var($authorship['email'], FILTER_VALIDATE_EMAIL) == false) {
        throw new ValueError('The e-mail address of the author is invalid!');
    }
}

/**
 * Check the article id.
 */
function checkArticleId($connection, $articleId)
{
    $sql = <<<SQL
        SELECT count(id)
        FROM articles
        WHERE id == :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $articleId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    if ($row['count(id)'] != 1) {
        throw new ValueError('The article ID ('.$articleId.') is missing!');
    }
}

/**
 * Check the contributor id.
 */
function checkContributorId($connection, $contributorId)
{
    $sql = <<<SQL
        SELECT count(id)
        FROM contributors
        WHERE id == :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $contributorId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    if ($row['count(id)'] != 1) {
        throw new ValueError('The contributor ID ('.$contributorId.') is missing!');
    }
}

/**
 * Create an authorship.
 */
function createAuthorship($connection, $authorship)
{
    checkAuthorData($authorship);
    checkArticleId($connection, $authorship['article_id']);
    checkContributorId($connection, $authorship['contributor_id']);
    $sql = <<<SQL
        INSERT INTO authorships (
            article_id, contributor_id,
            indx,
            given_name, family_name, affiliation, email
        )
        VALUES (
            :article_id, :contributor_id,
            (
                SELECT count(id)
                FROM authorships
                WHERE article_id = :article_id
            ),
            :given_name, :family_name, :affiliation, :email
        )
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':article_id', $authorship['article_id'], SQLITE3_INTEGER);
    $stmt->bindParam(':contributor_id', $authorship['contributor_id'], SQLITE3_INTEGER);
    $stmt->bindParam(':given_name', $authorship['given_name'], SQLITE3_TEXT);
    $stmt->bindParam(':family_name', $authorship['family_name'], SQLITE3_TEXT);
    $stmt->bindParam(':affiliation', $authorship['affiliation'], SQLITE3_TEXT);
    $stmt->bindParam(':email', $authorship['email'], SQLITE3_TEXT);
    $stmt->execute();
    $authorshipId = $connection->lastInsertRowID();
    $stmt->close();
    return $authorshipId;
}

/**
 * Collect authorships by article.
 */
function collectAuthorshipsByArticleId($connection, $articleId)
{
    checkArticleId($connection, $articleId);
    $sql = <<<SQL
        SELECT
            id, article_id, contributor_id, indx,
            given_name, family_name, affiliation, email
        FROM authorships
        WHERE article_id = :article_id
        ORDER BY indx
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':article_id', $articleId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $authorships = [];
    while (($row = $result->fetchArray(SQLITE3_ASSOC))) {
        $authorship = array(
            'id' => $row['id'],
            'article_id' => $row['article_id'],
            'contributor_id' => $row['contributor_id'],
            'indx' => $row['indx'],
            'given_name' => $row['given_name'],
            'family_name' => $row['family_name'],
            'affiliation' => $row['affiliation'],
            'email' => $row['email']
        );
        array_push($authorships, $authorship);
    }
    return $authorships;
}

/**
 * Update the authorship.
 */
function updateAuthorship($connection, $authorshipId, $authorship)
{
    checkAuthorData($authorship);
    checkArticleId($connection, $authorship['article_id']);
    checkContributorId($connection, $authorship['contributor_id']);
    $sql = <<<SQL
        UPDATE authorships
        SET article_id = :article_id,
            contributor_id = :contributor_id,
            given_name = :given_name,
            family_name = :family_name,
            affiliation = :affiliation,
            email = :email
        WHERE id == :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':article_id', $authorship['article_id'], SQLITE3_INTEGER);
    $stmt->bindParam(':contributor_id', $authorship['contributor_id'], SQLITE3_INTEGER);
    $stmt->bindParam(':given_name', $authorship['given_name'], SQLITE3_TEXT);
    $stmt->bindParam(':family_name', $authorship['family_name'], SQLITE3_TEXT);
    $stmt->bindParam(':affiliation', $authorship['affiliation'], SQLITE3_TEXT);
    $stmt->bindParam(':email', $authorship['email'], SQLITE3_TEXT);        
    $stmt->bindParam(':id', $authorshipId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    if ($connection->changes() != 1) {
        throw new ValueError('The authorship ID ('.$authorshipId.') is missing!');
    }
}

/**
 * Collect the ordered list of authorship ids regard to the related article.
 */
function collectOrderedAuthorshipIds($connection, $authorshipId)
{
    $sql = <<<SQL
        SELECT id
        FROM authorships
        WHERE article_id = (
            SELECT article_id
            FROM authorships
            WHERE id = :authorship_id
        )
        ORDER BY indx
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':authorship_id', $authorshipId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $orderedIds = [];
    while (($row = $result->fetchArray(SQLITE3_ASSOC))) {
        array_push($orderedIds, $row['id']);
    }
    if (count($orderedIds) == 0) {
        throw new ValueError('The authorship ID ('.$authorshipId.') is missing!');
    }
    return $orderedIds;
}

/**
 * Move the authorship up.
 */
function moveAuthorshipUp($connection, $authorshipId)
{
    $orderedIds = collectOrderedAuthorshipIds($connection, $authorshipId);
    $i = 0;
    while ($orderedIds[$i] != $authorshipId) {
        ++$i;
    }
    if ($i == 0) {
        return;
    }
    $sql = <<<SQL
        UPDATE authorships
        SET indx = indx - 1
        WHERE id = :authorship_id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':authorship_id', $authorshipId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $stmt->close();
    $sql = <<<SQL
        UPDATE authorships
        SET indx = indx + 1
        WHERE id = :authorship_id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':authorship_id', $orderedIds[$i - 1], SQLITE3_INTEGER);
    $result = $stmt->execute();
    $stmt->close();
}

/**
 * Move the authorship down.
 */
function moveAuthorshipDown($connection, $authorshipId)
{
    $orderedIds = collectOrderedAuthorshipIds($connection, $authorshipId);
    $i = 0;
    while ($orderedIds[$i] != $authorshipId) {
        ++$i;
    }
    if ($i == count($orderedIds) - 1) {
        return;
    }
    $sql = <<<SQL
        UPDATE authorships
        SET indx = indx + 1
        WHERE id = :authorship_id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':authorship_id', $authorshipId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $stmt->close();
    $sql = <<<SQL
        UPDATE authorships
        SET indx = indx - 1
        WHERE id = :authorship_id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':authorship_id', $orderedIds[$i + 1], SQLITE3_INTEGER);
    $result = $stmt->execute();
    $stmt->close();
}

/**
 * Remove the authorship.
 */
function removeAuthorship($connection, $authorshipId)
{
    $sql = <<<SQL
        DELETE FROM authorships
        WHERE id == :id
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $authorshipId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    if ($connection->changes() != 1) {
        throw new ValueError('The authorship ID ('.$authorshipId.') is missing!');
    }
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
    $sql = <<<SQL
        INSERT INTO editors (contributor_id, indx)
        VALUES (:contributor_id, 0)
    SQL;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':contributor_id', $contributorId, SQLITE3_INTEGER);
    $stmt->execute();
    $editorId = $connection->lastInsertRowID();
    $stmt->close();
    return $editorId;
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
