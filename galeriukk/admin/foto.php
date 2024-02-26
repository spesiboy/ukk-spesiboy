<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('您尚未登录');
    location.href='../index.php';
    </script>";
}

?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>照片库网站</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="../large.ico">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
  <a class="navbar-brand" href="index.php" style="color: white;">照片库网站</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
      <div class="navbar-nav me-auto">
      <a href="home.php" class="nav-link" style="color : white;">主页</a>
        <a href="album.php" class="nav-link" style="color : white;">相册</a>
        <a href="foto.php" class="nav-link" style="color : white;">照片</a>
      </div>
      <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1">退出</a>
    </div>
  </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card mt-2">
            <div class="card-header" style="background-color:#2E7D32; color: white;">添加照片</div>
                <div class="card-body">
                    <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                        <label for="" class="form-label">照片标题</label>
                        <input type="text" name="judulfoto" class="form-control" lang="zh" required >
                        <label for="" class="form-label">描述</label>
                        <textarea class="form-control" name="deskripsifoto" lang="zh" required></textarea>
                        <label for="" class="form-label">相册</label>
                        <select class="form-control" name="albumid"  lang="zh" required>
                            <?php
                            $userid = $_SESSION['userid'];
                            $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid' ");
                            while($data_album = mysqli_fetch_array($sql_album)) { ?>
                                <option value="<?php echo $data_album['albumid']?>">
                                    <?php echo $data_album['namaalbum']?>
                                </option>
                            <?php } ?>
                        </select>
                        <label for="" class="form-label">文件</label>
                        <input type="file" name="lokasifile" class="form-control" required>
                        <button type="submit" class="btn btn-success mt-2" name="tambah" >添加数据</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mt-2">
            <div class="card-header" style="background-color:#2E7D32; color: white;">相册数据</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>照片标题</th>
                                <th>照片</th>
                                <th>描述</th>
                                <th>日期</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $userid = $_SESSION['userid'];
                            $sql = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid'");

                            while($data = mysqli_fetch_array($sql)) {

                            
                            ?>
                            <tr>
                                <td> <?php echo $no++ ?> </td>
                                <td><img src="../assets/img/<?php echo $data['lokasifile'] ?>" width="100px"></td>
                                <td> <?php echo $data['judulfoto'] ?> </td>
                                <td> <?php echo $data['deskripsifoto'] ?> </td>
                                <td> <?php echo $data['tanggalunggah'] ?> </td>
                                <td>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['fotoid']?>">
                                    编辑
                                    </button>
                                    <div class="modal fade" id="edit<?php echo $data['fotoid']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">编辑数据</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="fotoid" value="<?php echo $data['fotoid']?>">
                                                <label for="" class="form-label">照片标题</label>
                                                <input type="text" name="judulfoto" value="<?php echo $data['judulfoto']?>" class="form-control" required >
                                                <label for="" class="form-label">描述</label>
                                                <textarea class="form-control" name="deskripsifoto" required><?php echo $data['deskripsifoto']?></textarea>
                                                <label for="" class="form-label">相册</label>
                                                <select class="form-control" name="albumid" >
                                                    <?php
                                                    $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
                                                    while($data_album = mysqli_fetch_array($sql_album)) { ?>
                                                        <option <?php if($data_album['albumid'] == $data['albumid']) { ?> selected="selected" <?php } ?> value="<?php echo $data_album['albumid']?>">
                                                            <?php echo $data_album['namaalbum']?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            <label for="" class="form-label">文件</label>
                                                <div class="row">
                                                    <div class="cod-md-4">
                                                        <img src="../assets/img/<?php echo $data['lokasifile'] ?>" width="100px"><br>
                                                    </div>
                                                    <div class="cod-md-8">
                                                    <label for="" class="form-label">更改文件</label>
                                                    <input type="file" name="lokasifile" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="modal-footer">
                                                <button type="submit" name="edit" class="btn btn-primary">编辑数据</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                    </div>

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['fotoid']?>">
                                    删除
                                    </button>
                                    <div class="modal fade" id="hapus<?php echo $data['fotoid']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">删除数据</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="../config/aksi_foto.php" method="POST" >
                                                <input type="hidden" name="fotoid" value="<?php echo $data['fotoid']?>">
                                                您确定要删除数据吗？ <b><?php echo $data['judulfoto']?></b>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="hapus" class="btn btn-primary">删除数据</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                    </div>

                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="d-flex justify-content-center botder-top mt-3 bg-light fixed-bottom">
<p>&copy; PILPRES | 2024</p>
</footer>

<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
