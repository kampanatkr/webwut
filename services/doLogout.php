<?php
    session_start();
    //ลบ session ทิ้งแล้วกลับไปหน้าแรก
    session_destroy();
    header("location:../index.php");
?>