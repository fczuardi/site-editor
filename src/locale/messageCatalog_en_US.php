<?php
function text($key) {
    $args = func_get_args();
    
    $messages = array(
        'Site Editor' => 'Site Editor',
        'Greetings Professor Falken' => 'Greetings Professor Falken',
        'Read-Only Mode' => 'Read-Only Mode'
        // ...
        );
    
    if (array_key_exists($key, $messages)) {
        $args[0] = $messages[$key];
    }
    return @call_user_func_array('sprintf', $args);
}
?>