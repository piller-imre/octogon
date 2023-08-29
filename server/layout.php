<!--
TODO: Add parameter for disabling link on menu for the current page!
-->
<?php function beforeContent() { ?>
<html>
    <head>
        <title>Octogon Mathematical Magazine</title>
        <link rel="stylesheet" href="assets/octogon.css">
    </head>
    <body>
        <div class="main">
            <div class="banner">
            </div>
            <div class="menu">
                <div><a href="index.php">Home</a></div>
                <div><a href="archive.php">Archive</a></div>
                <div><a href="rules.php">Rules</a></div>
                <div><a href="editorial-board.php">Editorial Board</a></div>
                <div><a href="contacts.php">Contacts</a></div>
            </div>
            <div class="content">
<?php } ?>

<?php function afterContent() { ?>
            </div>
            <div class="footer">
                <div style="padding-top: 4px;">Octogon Mathematical Magazine, 2023.</div>
            </div>
        </div>
    </body>
</html>
<?php } ?>
