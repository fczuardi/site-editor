<?php
include('locale/messageCatalog_en_US.php');
include('helpers/filesystemHelper.php');
include('init.php');

//get the file list for the current directory
$path = '.';
$files = filesystemHelper::getFiles($path);

include('header.php');
?>

<h1><%= text('Site Editor') %></h1>
<h2><%= $isOwner ? text('Greetings Professor Falken') : text('Read-Only Mode') %></h2>
<?php 
include('fragment_fileList.php');
 ?>
<p><a href="<%= $signOutUrl %>"><%= text('Sign Out') %></a></p>
</body>
