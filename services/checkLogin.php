<?php
    //เรียกใช้ session
    session_start();
    $LOGGEDIN = FALSE;
    //ถ้า log in แล้วจะมี UID อยู่ใน $_SESSION
    if (array_key_exists('ID', $_SESSION)) {
        $LOGGEDIN = TRUE;
    }
?>