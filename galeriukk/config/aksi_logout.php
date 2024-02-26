<?php
session_start();
session_destroy();
echo "<script>
    alert('退出成功');
    location.href='../index.php';
    </script>";

?>