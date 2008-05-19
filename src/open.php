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
if (!is_dir($dir)){
    die("$dir is not a valid directory");
}
if (strpos($path, 'xn_private') && (! $isOwner)) {
    die('you are not allowed to open this file');
}
if (is_dir($path)){
    $files = filesystemHelper::getFiles($path);
    include('fragment_fileList.php');
} else {
    // display the file
    filesystemHelper::printFileContents($path);
    if (! $isOwner) {
    ?>
        <p><%= text('You need to be the site owner to edit this file.') %></p>
        <p>
            <a href="<%= $isLogged ? $signOutUrl : $signInUrl %>"><%= text($isLogged ? 'Sign Out' : 'Sign In') %></a>
        </p>
    <?php
    }else { ?>
        <a href="edit.php?dir=<%= $dir %>&file=<%= $filename %>"><%= text('Edit') %></a>
    <?php
    }
}
?>
</body>