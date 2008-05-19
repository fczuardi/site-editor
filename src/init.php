<?php
$isLogged       = XN_Profile::current()->isLoggedIn();
$app            = XN_Application::load();
$appSubdomain   = $app->relativeUrl;
$appUrl         = 'http://' . XN_AtomHelper::HOST_APP($appSubdomain);
$isOwner        = XN_Profile::current()->isOwner();
$signInUrl      = XN_Request::signInUrl();
$signOutUrl     = XN_Request::signOutUrl();
//$viewSourceUrl  = "http://www.ning.com/view-source.html?appUrl=$appSubdomain";
?>