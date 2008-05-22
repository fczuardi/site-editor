<?php
include('helpers/FilesystemHelper.php');
include('locale/messageCatalog_en_US.php');
include('init.php');

$filename       = $_GET['file'];
$dir            = $_GET['dir'];
$path           = FilesystemHelper::buildPath($appSubDomain, $dir, $filename);
$dirIsWritable  = FilesystemHelper::isDirWritable($path);
$isNew          = $_POST['newfile'];

include('header.php');
if (!file_exists($path) && !$isNew) {
     die('file not found');
}
if (!$isOwner || !dirIsWritable) {
    die('you are not allowed to edit this file');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    file_put_contents($path, $_POST['contents']);
}
echo "$path was last modified: " . date ("F d Y H:i:s.", filemtime($path));
?>
<form action="" method="POST">
<textarea style="width:90%;height:90%;" name="contents">
<%= file_get_contents($path) %>
</textarea>
<input type="submit">
</form>
<p>
    <a href="<%= FilesystemHelper::openFileUrl($filename, $dir) %>"><%= text('View File') %></a>
</p>
<?php
include('footer.php');
?>