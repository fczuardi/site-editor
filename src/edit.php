<?php
include('helpers/filesystemHelper.php');
include('locale/messageCatalog_en_US.php');
include('init.php');

$filename   = $_GET['file'];
$dir        = $_GET['dir'];
$path       = $dir.'/'.$filename;

include('header.php');

if (!file_exists($path)) {
    die('file not found');
}
if (! $isOwner) {
    die('you are not allowed to open this file');
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
<?php
include('footer.php');
?>