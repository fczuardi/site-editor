<?php
include('helpers/FilesystemHelper.php');
include('locale/messageCatalog_en_US.php');
include('init.php');

$filename       = $_GET['file'];
$dir            = $_GET['dir'];
$path           = FilesystemHelper::buildPath($appSubdomain, $dir, $filename);
$dirIsWritable  = FilesystemHelper::isDirWritable($path);

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
    $files = FilesystemHelper::getFiles($path);
    include('fragment_fileList.php');
    if ($isOwner && $dirIsWritable) {
    ?>
    <hr />
    <form method="POST" enctype="multipart/form-data" action="upload.php">
    <label><%= text('Upload File') %><input type="file" name="myFile"/></label><input type="submit" />
    <input type="hidden" name="dir" value="<%= $path %>"/>
    </form>
    <form method="GET" action="new.php">
    <label><%= text('Create New File Named') %><input type="text" name="file"/></label><input type="submit" />
    <input type="hidden" name="dir" value="<%= $path %>"/>
    </form>
    <?php
    }
} else {
    // display the file
    FilesystemHelper::printFileContents($path);
    if (! $isOwner) {
    ?>
        <p><%= text('You need to be the site owner to edit this file.') %></p>
        <p>
            <a href="<%= $isLogged ? $signOutUrl : $signInUrl %>"><%= text($isLogged ? 'Sign Out' : 'Sign In') %></a>
        </p>
    <?php
    }else { 
        if ($dirIsWritable) { ?>
        <a href="edit.php?dir=<%= $dir %>&file=<%= $filename %>"><%= text('Edit') %></a> |
        <?php
        }
        ?>
        <a href="<%= FilesystemHelper::openFileUrl('.', $dir) %>"><%= text('Container Folder') %></a>
    <?php
    }
}
include('footer.php');
?>