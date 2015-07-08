<?php

if(isset($_POST['addComment'])) {
    $data = $_POST['addComment'] . "\n";
    $ret = file_put_contents('inputcomments/testfile.txt', $data, FILE_APPEND | LOCK_EX);
    if($ret === false) {
        die('There was an error writing this file');
    }
    else {
        echo "$ret bytes written to file";
    }
}
else {
   die('no post data to process');
}