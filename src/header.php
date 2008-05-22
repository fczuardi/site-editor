<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><%= $pageTitle %></title>
</head>
<body style="background-color:#ccc">
<h1><%= text('Site Editor') %></h1>
<h2><%= $isOwner ? text('Greetings Professor Falken') : text('Read-Only Mode') %></h2>    