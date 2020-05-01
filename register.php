<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!-- https://bootsnipp.com/tags/login -->
<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <!--Made with love by Mutiullah Samim -->
    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<?php
if (isset($_SESSION['success'])) {
    unset($_SESSION['success']);
}

require_once('./models/users.php');
$result_check = '';
//kiem tra xem user va mail  da ton tiaj  troeng DB hay chua
if (isset($_POST['checkUser']) || isset($_POST['checkEmail'])) {
    $users = new Users();
    $username = $_POST['username'];
    $email = $_POST['email'];
    $result_check =  $users->checkUser_Enail($username, $email);
}

if (isset($_POST['register'])) {
    // var_dump($_POST);'
    $users = new Users();
    $result = $users->insert($_POST);
    if ($result == 1) {// if insert success retun 1 in function insert
        $_SESSION['success'] = 'Đăng ký thành công';
    } else $alert = $result;//to show alert if inset not success
}

?>

<body>
    <div class="container">
        <?php
        if (isset($_SESSION['success'])) {
        ?>
            <div class="alert alert-primary" role="alert">
                <?php echo $_SESSION['success'] ?>
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($result_check) && $result_check != '') {
            echo '<div class="alert alert-primary" role="alert">' . " $result_check " . "</div>";
        }
        if (isset($alert)) echo '<div class="alert alert-primary" role="alert">' . " $result " . "</div>";
        ?>
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Đăng ký<h3>
                            <div class="d-flex justify-content-end social_icon">
                                <span><i class="fab fa-facebook-square"></i></span>
                                <span><i class="fab fa-google-plus-square"></i></span>
                            </div>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="username" class="form-control" value="<?php if (isset($result_check) && $result_check == 'OK') echo $username; ?>" placeholder="username" required>
                            <input type="submit" name="checkUser" value="Check">
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="password" required>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="passwordR" class="form-control" placeholder="Re enter password" required>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="email" name="email" class="form-control" value="<?php if (isset($result_check) && $result_check == 'OK') echo $email; ?>" placeholder="email" required>
                            <input type="submit" name="checkEmail" value="Check">
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="full_name" class="form-control" placeholder="Họ và tên">
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="address" class="form-control" placeholder="Quận huyện tên đường, số nhà">

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>

                            <input type="date" name="dob" class="form-control" placeholder="Ngày sinh">
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="city" class="form-control" placeholder="Thành phố">
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="number" name="phone" class="form-control" placeholder="SĐT">
                        </div>

                        <div class="row align-items-center remember">
                            <input type="checkbox" checked="checked" name="remember">Remember Me
                        </div>

                        <div class="form-group">
                            <input type="submit" name="register" value="Đăng ký" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        <a href="login.php">Đăng nhập</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="#">Quên mật khẩu?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>