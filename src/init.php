<?php
$currentUrl     = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$isLogged       = XN_Profile::current()->isLoggedIn();
$app            = XN_Application::load();
$appSubdomain   = $app->relativeUrl;
$appUrl         = 'http://' . XN_AtomHelper::HOST_APP($appSubdomain);
$isOwner        = XN_Profile::current()->isOwner();
//some old Ning networks don't have the XN_Request::signInUrl /Out methods
$signInUrl      = method_exists('XN_Request', 'signInUrl') ? XN_Request::signInUrl() : 'http://www.ning.com/main/authorization/signIn?target=' . urlencode($currentUrl);
$signOutUrl     = method_exists('XN_Request', 'signOutUrl') ? XN_Request::signOutUrl() : 'http://www.ning.com/main/authorization/signOut?target=' . urlencode($currentUrl);
//$viewSourceUrl  = "http://www.ning.com/view-source.html?appUrl=$appSubdomain";
?>