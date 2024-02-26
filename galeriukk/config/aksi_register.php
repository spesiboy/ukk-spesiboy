<?php
    include "koneksi.php";

    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $email=$_POST['email'];
    $namalengkap=$_POST['namalengkap'];
    $alamat=$_POST['alamat'];

    $sql=mysqli_query($koneksi,"insert into user values('','$username','$password','$email','$namalengkap','$alamat')");

    if ($sql) {
        echo "<script>
        alert('注册成功');
        location.href='../login.php';
        
        </script>";

    }
?>