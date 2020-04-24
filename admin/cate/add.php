<?php

require_once('./../commons/head.php');
require_once('./../../models/cate.php');
if (isset($_SESSION['success'])) {
    unset($_SESSION['success']);
}
if (isset($_POST['name'])) {
    $cates = new Cate();
    $count = $cates->insert($_POST);
    if ($count == 1) {
        $_SESSION['success'] = 'Thêm thành công';
    }
}


?>

<body>
    <?php
    require_once('./../commons/nav_menu.php');
    ?>


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
        <form method="post">

            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Tên Thể Loại</label>
                <div class="col-sm-10">
                    <input type="text" name="name"  required>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Cấp Độ</label>
                <div class="col-sm-10">
                    <input type="text" name="level" required>
                </div>
            </div>
            <input type="submit" name="submit" value="Thếm Thể Loại" class="btn btn-primary"></input>
        </form>
    </div>
</body>
<?php
require_once('./../commons/footer.php');
?>