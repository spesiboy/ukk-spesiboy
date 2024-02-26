<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/x-icon" href="large.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>照片库网站</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body>
    
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="register.php">照片库网站</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
      <div class="navbar-nav me-auto">

      </div>
     
    </div>
  </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body bg-light">
                    <div class="text-center">
                        <h5>注册新账户</h5>
                    </div>
                    <form action="config/aksi_register.php" method="POST">
                        <label class="form-label">用户名</label>
                        <input type="text" name="username" class="form-control" required>
                        <label class="form-label">密码</label>
                        <input type="password" name="password" class="form-control" required>
                        <label class="form-label">电子邮件</label>
                        <input type="email" name="email" class="form-control" required>
                        <label class="form-label">
                        全名</label>
                        <input type="text" name="namalengkap" class="form-control" required>
                        <label class="form-label">
                        微信 ID</label>
                        <input type="text" name="alamat" class="form-control" required>
                        <div class="d-grid mt-2">
                            <button class="btn btn-primary" type="submit" name="kirim">
                            列表</button>
                        </div>
                    </form>
                    <hr>
                    <p>
                    已经有帐户?<a href="login.php">在这里登录</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
    <p>&copy; PILPRES | 2024</p>
</footer>

<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>