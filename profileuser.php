<?php
include_once("inc/head.php");
include_once("inc/top.php");
require_once('./models/users.php');
?>

<?php
if (isset($_SESSION['success'])) {
    unset($_SESSION['success']);
}
$result_check = '';
$users = new Users();
//kiem tra xem user va mail da ton tiaj troeng DB hay chua
$id = $_SESSION['user_id'];
$user = $users->getByid($id);
if (isset($_POST['update'])) {
    // var_dump($_POST);'
    $_POST['id'] = $user['id'];
    $result = $users->updateUser($_POST);
    if ($result == 1) { // if insert success retun 1 in function insert
        $_SESSION['success'] = 'Sua thanh công';
    } else $alert = $result; //to show alert if inset not success
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
        <?php } ?>
        
        <?php
        if (isset($alert)) echo '<div class="alert alert-primary" role="alert">' . " $alert " . "</div>";
        ?>
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <br>
                <div class="card-header">
                    <h3>Thông tin cá nhân <h3>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class=" form-group">
                            <label for="">Username :</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?> " placeholder="username" required>
                        </div>
                        <div class="  form-group">
                            <label for="">Email :</label>
                            <input type="email" name="email" class="form-control" value="<?php if (isset($result_check) && $result_check == 'OK') echo $email;
                                                                                            else echo $user['email'] ?>" placeholder="email" required>
                        </div>

                        <div class="  form-group">
                            <label for="">Họ Tên</label>
                            <input type="text" value="<?php echo $user['full_name'] ?>" name="full_name" class="form-control" placeholder="Họ và tên">
                        </div>
                        <div class="  form-group">
                            <label for="">Địa chỉ</label>
                            <input type="text" value="<?php echo $user['address'] ?>" name="address" class="form-control" placeholder="Quận huyện tên đường, số nhà">

                        </div>
                        <div class="  form-group">
                            <label for="">Ngày sinh</label>
                            <input type="text" value="<?php echo $user['dob'] ?>" name="dob" class="form-control" placeholder="Ngày sinh">
                        </div>
                        <div class="  form-group">
                            <label for="">Thành phố </label>
                            <input type="text" name="city" value="<?php echo $user['city'] ?>" class="form-control" placeholder="Thành phố">
                        </div>
                        <div class="  form-group">
                            <label for="">Số điện thoại </label>
                            <input type="number" value="<?php echo $user['phone'] ?>" name="phone" class="form-control" placeholder="SĐT">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="update" value="Sửa Thông Tin" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

<?php
include_once("inc/footer.php");
?>