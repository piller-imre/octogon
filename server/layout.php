<!--
TODO: Add parameter for disabling link on menu for the current page!
-->
<?php function beforeContent() { ?>
<html>
    <head>
        <title>Octogon Mathematical Magazine</title>
    </head>
    <body>
        <div class="menu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="archive.php">Archive</a></li>
                <li><a href="rules.php">Rules</a></li>
                <li><a href="editorial-board.php">Editorial Board</a></li>
                <li><a href="contacts.php">Contacts</a></li>
            </ul>
        </div>
        <div class="content">
<?php } ?>

<?php function afterContent() { ?>
        </div>
    </body>
</html>
<?php } ?>
