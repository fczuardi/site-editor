<hr />
    <p>
    <a href="index.php"><%= text('Root') %></a> |
    <a href="<%= $urlMappingUrl %>"><%= text('URL Mappings') %></a> |
    <a href="javascript:alert('not possible NING-7866')"><%= text('Roles') %></a> |
    <a href="javascript:alert('not possible NING-7930')"><%= text('Setup Bot') %></a> |
    <a href="<%= $isLogged ? $signOutUrl : $signInUrl %>"><%= text($isLogged ? 'Sign Out' : 'Sign In') %>
</p>
<hr />
<p><small>powered by <a href="http://github.com/fczuardi/site-editor/tree/master">site-editor</a></small></p>
</body>