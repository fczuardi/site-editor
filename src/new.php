<?php
include('helpers/FilesystemHelper.php');
include('locale/messageCatalog_en_US.php');
include('init.php');

$filename   = $_GET['file'];
$dir        = $_GET['dir'];
$path       = $dir.'/'.$filename;
$currentDir = FilesystemHelper::getCurrentDir($path);
include('header.php');

if (file_exists($path)) {
    ?>
    <p><%= text('The file already exists.') %></p>
    <p><a href="<%= FilesystemHelper::openFileUrl($filename, $dir) %>"><%= text('Show me!') %></a></p>
    <?php
} else if (! $isOwner) {
    ?>
    <p><%= text('You need to be the site owner to create this file.') %></p>
    <p>
        <a href="<%= $isLogged ? $signOutUrl : $signInUrl %>"><%= text($isLogged ? 'Sign Out' : 'Sign In') %></a>
    </p>
    <?php
//    die('you are not allowed to open this file');
} else {
    ?>
    <h1><%= $currentDir . '/' . $filename %></h1>
<form action="edit.php?file=<%= $filename %>&dir=<%= $dir %>" method="POST">
<textarea style="width:90%;height:90%;" name="contents">
</textarea>
<input type="hidden" name="newfile" value="1" />
<input type="submit">
</form>
    <?php
}
?>
<?php
include('footer.php');
?>