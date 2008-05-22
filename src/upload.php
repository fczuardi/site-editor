<?php
include('helpers/FilesystemHelper.php');
include('locale/messageCatalog_en_US.php');
include('init.php');

$filename   = $_POST['myFile'] ? $_POST['myFile'] : $_POST['file'];
$dir        = $_POST['dir'];
$path       = $dir.'/'.$filename;
$replace    = $_POST['replace'];
$contents   = $_POST['myFile'] ? XN_Request::uploadedFileContents($_POST['myFile']) : $_POST['contents'];
if (!$isOwner) {
    die('you are not allowed to upload files');
}
if (file_exists($path) && !$replace ) {
?>
    <p><%= text('This file already exists.') %></p>
    <ul>
    <li><form action="" method="POST">
        <input type="text" name="file" value="<%= htmlentities($filename) %>" />
        <input type="hidden" name="contents" value="<%= htmlentities($contents) %>" />
        <input type="hidden" name="dir" value="<%= htmlentities($dir) %>" />
        <input type="submit" value="<%= text('Rename') %>" />
    </form></li>
    <li><form action="" method="POST">
        <input type="hidden" name="file" value="<%= htmlentities($filename) %>" />
        <input type="hidden" name="contents" value="<%= htmlentities($contents) %>" />
        <input type="hidden" name="dir" value="<%= htmlentities($dir) %>" />
        <input type="hidden" name="replace" value="1" />
        <input type="submit" value="<%= text('Replace! (no undo)') %>" />
    </form></li>
    </ul>
<?php
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        file_put_contents($path, $contents);
    }
}
echo "$path uploaded: " . date ("F d Y H:i:s.", filemtime($path));
?>
<p>
    <a href="<%= FilesystemHelper::openFileUrl($filename, $dir) %>"><%= text('View File') %></a>
</p>