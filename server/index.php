<?php include "layout.php" ?>

<?php beforeContent() ?>

<?php
require 'database.php';

$connection = db\connect();
$posts = db\collectPosts($connection);
?>

    <h1>Octogon Mathematical Magazine</h1>
    <div>
        <div>Brassó Kronstadt Braşov</div>
        <br />
        <div>The Octogon Mathematical Magazine is a continuation of Gamma Mathematical Magazine (1978-1989).</div>
        <br />
        <div>Print Edition: ISSN 1222-5657</div>
        <div>Online Edition: ISSN 2248-1893</div>
        <br />
        <div>© Fulgur Publishers</div>
    </div>

<?php
foreach ($posts as $post) {
?>
    <hr />
    <div class="post">
        <div><?php echo($post['content']); ?></div>
        <div class="post-date"><i><?php echo($post['upload_date']); ?></i></div>
    </div>
<?php
}
?>

<?php afterContent() ?>
