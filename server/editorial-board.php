<?php include "layout.php" ?>

<?php beforeContent() ?>

<?php
require 'database.php';

$connection = db\connect();
$editors = db\collectEditors($connection);
?>

    <h1>Editorial Board</h1>
    <div>
        <?php
        foreach ($editors as $editor) {
        ?>
            <div class="editor">
                <div class="editor-name"><?php echo($editor['given_name'].' '.$editor['family_name']); ?></div>
                <div><?php echo($editor['affiliation']); ?></div>
            </div>
        <?php
        }
        ?>
    </div>

<?php afterContent() ?>
