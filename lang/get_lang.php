<?php
function getLang($key){
    global $lang;
    if(!isset($lang[$key])){
        return 'default';
    }
    return $lang[$key];
}    
?>