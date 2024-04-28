<?php

function gavias_hook_themer_writecache( $folder, $file, $value, $e='css' ){
  $file   = $folder  . preg_replace('/[^A-Z0-9\._-]/i', '', $file).'.'.$e ;
  $handle = fopen($file, 'w+');
    fwrite($handle, ($value));
    fclose($handle);
}
