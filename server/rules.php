<?php include "layout.php" ?>

<?php beforeContent() ?>

<?php
require 'database.php';

$connection = db\connect();
$rules = db\getPageContent($connection, 'rules');
?>

    <h1>Aims and scope</h1>
    <div>
        <?php echo($rules); ?>
    </div>
<?php afterContent() ?>
