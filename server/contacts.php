<?php include "layout.php" ?>

<?php beforeContent() ?>

<?php
require 'database.php';

$connection = db\connect();
$contacts = db\getPageContent($connection, 'contacts');
?>

    <h1>Contacts</h1>
    <div>
        <?php echo($contacts); ?>
    </div>
<?php afterContent() ?>
