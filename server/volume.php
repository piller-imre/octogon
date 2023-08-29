<?php include "layout.php" ?>

<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<script>
// https://docs.mathjax.org/en/latest/options/input/tex.html#tex-options
window.MathJax = {
  tex: {
    inlineMath: [
      ['$', '$'],
      ['\\(', '\\)']
    ],
    displayMath: [
      ['$$', '$$'],
      ['\\[', '\\]']
    ]
  }
};
</script>

<?php beforeContent() ?>

<?php
require 'database.php';

$connection = db\connect();
$volumeId = $_GET['volumeId'];
$volume = db\getVolumeById($connection, $volumeId);
$articles = db\collectArticlesByVolume($connection, $volumeId);
?>

<h1>
Volume <?php echo($volume['volume']); ?>.
No. <?php echo($volume['number']); ?>
<?php echo($monthName); ?>,
<?php echo($volume['year']); ?>.
</h1>

<?php
foreach ($articles as $article) {
    $authors = db\collectAuthorshipsByArticleId($connection, $article['id']);
?>
    <div class="article">
        <div class="title"><?php echo($article['title']); ?></div>
        <div class="authors">
            <?php
            foreach ($authors as $author) {
            ?>
            <span><?php echo($author['given_name'].' '.$author['family_name']); ?>;</span>
            <?php
            }
            ?>
        </div>
        <?php
            if ($article['document_id']) {
                $document = db\getDocumentById($connection, $article['document_id']);
        ?>
            <div>
                <a href="documents/<?php echo($document['name']); ?>"><?php echo($document['name']); ?></a>
            </div>
        <?php
            }
        ?>
        <div class="abstract">
            <?php echo($article['abstract']); ?>
        </div>
        <div class="pages">pp. <?php echo($article['first_page']); ?>-<?php echo($article['last_page']); ?>.</div>
        <div class="citation">
        Arkady M. Alt:
        About one inequality from APMO, 20045-New solution and generalizations,
        Octogon Mathematical Magazine,
        vol. 27, No. 1, 2019.
        pp. 100-120.
        </div>
    </div>
<?php
}
?>

<?php afterContent() ?>
