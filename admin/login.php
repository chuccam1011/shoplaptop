<?php
require_once('./commons/head.php');
require_once('./../models/admin.php');
$_SESSION['username']='2';
if (isset($_POST['submit'])) {
    $admin = new Admin();
    if ($admin->checkLogin($_POST) != null) {
        $_SESSION['username'] = $_POST['username'];
        header("Location:product/index.php");
       // var_dump($_SESSION);
    } else {
        //var_dump($_SESSION);
        $alert = 'Sai ten dang  nhap hoac mat khau  sai !';
    }
}
?>

<body>
    <div class="container">
        <form action="" method="post">
            <?php
            if ($_SESSION['login'] = false) echo "<p>Tên tài khoản hoặc mật khẩu không đúng !</p>";
            ?>
            <p> <?php if (isset($alert)) echo $alert;  ?></p>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">UserName</label>
                <div class="col-sm-10">
                    <input type="text" name="username" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Pass</label>
                <div class="col-sm-10">
                    <input type="password" name="password" required>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" name="submit" value="Đăng Nhập">
        </form>
        <a href="register.php">Bạn chưa có tài khoản ?</a>
    </div>
</body>

</html>