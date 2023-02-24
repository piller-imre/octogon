<?php
// curl -X POST -F file=@notes.md http://127.0.0.1/api/files/upload.php
$documentDir = "/tmp";
echo "Name      : ".$_FILES["file"]["name"]."\n";
echo "Temp name : ".$_FILES["file"]["tmp_name"]."\n";
echo "Size      : ".$_FILES["file"]["size"]."\n";

$sourcePath = $_FILES["file"]["tmp_name"];
$targetPath = $documentDir."/".$_FILES["file"]["name"];

if (file_exists($targetPath) == false) {
    move_uploaded_file($sourcePath, $targetPath);
    echo "Successful upload!\n";
} else {
    echo "The file already exists!\n";
}
?>
