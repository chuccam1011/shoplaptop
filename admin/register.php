<?php
require_once('./commons/head.php');
require_once('./../models/admin.php');

if (isset($_SESSION['success'])) {
    unset($_SESSION['success']);
}
if (isset($_POST["submit"])) {
    $admin = new Admin();
    $count =  $admin->insert($_POST);
    if ($count == 1) {
        $_SESSION['success'] = 'Đăng ký thành công';
    } else {
        $alert = $count;
    }
}
?>

<body>
    <?php
    if (isset($_SESSION['success'])) {
    ?>
        <div class="alert alert-primary" role="alert">
        <?php echo $_SESSION['success'];
        echo '<a href="login.php">Đăng Nhập</a>';
    } ?>
        </div>
        <p> <?php if (isset($alert)) echo $alert;  ?> </p>
        <div class="container">
            <form name="login" onsubmit="return login()" action="" method="post">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Tên Đăng Nhập</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Mật Khẩu</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Mật Khẩu</label>
                    <div class="col-sm-10">
                        <input type="password" name="passwordR" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="number" name="phone" required>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Đăng ký"></input>

            </form>

            <a href="login.php">Đăng Nhập</a>
        </div>
        <script>
            function login() {
                var password = document.forms["login"]["password"].value;
                var repassword = document.forms["login"]["passwordR"].value;
                if (password != repassword) {
                    return false;
                    alert("Hai mật khẩu đã nhập  không khớp !");
                }
            }
        </script>
</body>

</html>