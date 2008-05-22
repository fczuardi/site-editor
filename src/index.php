<?php
include('init.php');
include('helpers/FilesystemHelper.php');
$file   = '';
$dir    = FilesystemHelper::getAppRoot();
header('Location: '.FilesystemHelper::openFileUrl($file, $dir));
 ?>
