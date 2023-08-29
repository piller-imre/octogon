<?php include "layout.php" ?>

<?php beforeContent() ?>

<h1>Archive</h1>

<?php
require 'database.php';

$connection = db\connect();
$volumes = db\collectVolumes($connection);
?>

<?php
$monthNames = array(
    1 => 'January',
    2 => 'February',
    3 => 'March',
    4 => 'April',
    5 => 'May',
    6 => 'June',
    7 => 'July',
    8 => 'August',
    9 => 'September',
    10 => 'October',
    11 => 'November',
    12 => 'December'
);
foreach ($volumes as $volume) {
    if ($volume['is_visible']) {
        $monthName = $monthNames[$volume['month']];
?>
    <div class="volume">
        <div>
            <b>
                Volume <?php echo($volume['volume']); ?>.
                No. <?php echo($volume['number']); ?>
                <?php echo($monthName); ?>,
                <?php echo($volume['year']); ?>.
            </b>
        </div>
        <div>
            <?php echo($volume['cover_image']); ?>
        </div>
        <div>
            <a href="volume.php?volumeId=<?php echo($volume['id']); ?>">Contents</a>
        </div>
    </div>
<?php
    }
}
?>

<?php afterContent() ?>
