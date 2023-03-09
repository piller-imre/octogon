<style>
div.test-cases {
    background-color: #EEEEEE;
    padding: 12px;
}

div.test-cases div.successful,
div.test-cases div.failed {
    padding: 12px;
    margin-bottom: 12px;
    border-radius: 5px;
}

div.test-cases div.successful {
    background-color: #AAFFAA;
    border: solid #88AA88 1px;
}

div.test-cases div.failed {
    background-color: #FFAA88;
    border: solid #AA8844 1px;
}

div.test-cases div.test-name {
    font-weight: bold;
}

div.test-cases div.message {
    margin-top: 6px;
    margin-bottom: 6px;
    background-color: #FFEEEE;
    font-family: monospace;
    padding: 5px;
}

div.test-cases table.trace {
    text-align: left;
    background-color: #FFEEEE;
}

div.test-cases table.trace td {
    background-color: white;
    padding: 5px;
}
</style>

<?php
function showStackTrace($error)
{
?>
<table class="trace">
    <tr>
        <th>File</th>
        <th>Line</th>
        <th>Function</th>
    </tr>
<?php
    foreach (array_reverse($error->getTrace()) as $item) {
?>
    <tr>
        <td><?php echo $item['file']; ?></td>
        <td><?php echo $item['line']; ?></td>
        <td><?php echo $item['function']; ?></td>
    </tr>
<?php
    }
?>
</table>
<?php
}

function runAllTests()
{
    $TEST_FUNC_PREFIX = 'test_';
    $nTotal = 0;
    $nSuccessful = 0;
    $nFailed = 0;
    $func_names = get_defined_functions()['user'];
    echo '<div class="test-cases">';
    foreach ($func_names as $func_name) {
        if (substr($func_name, 0, strlen($TEST_FUNC_PREFIX)) === 'test_') {
            try {
                call_user_func($func_name);
                echo '<div class="successful">';
                echo '<div class="test-name">'.$func_name.'</div>';
                echo "</div>";
                $nSuccessful++;
            }
            catch (AssertionError $error) {
                echo '<div class="failed">';
                echo '<div class="test-name">'.$func_name.'</div>';
                echo '<div class="message">'.$error->getMessage()."</div>";
                showStackTrace($error);
                echo "</div>";
                $nFailed++;
            }
            $nTotal++;
        }
    }
    echo '</div>';
    echo '<div class="summary">'.$nSuccessful.'/'.$nTotal.' ('.$nFailed.' failed)</div>';
}

runAllTests();
?>
