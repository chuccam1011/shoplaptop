<?php
if (isset($_SESSION['success'])) {
    unset($_SESSION['success']);
}
require_once('./../commons/head.php');
require_once('./../../models/slider.php');
require_once('./../../lib/upload.php');

if (isset($_FILES['file']) && isset($_POST['tittle'])) {
    $slider = new Slider();
    ///check file upload
    $upload = new upload();
    if ($upload->upload()) {
        $realpath = $upload->getRealpath();
        $_POST['file'] = $realpath;
        $count = $slider->insert($_POST);
    }
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
        <form method="post" enctype="multipart/form-data">

            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Tên</label>
                <div class="col-sm-10">
                    <input type="text" name="tittle" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Hình ảnh</label>
                <div class="col-sm-10">
                    <input type="file" name="file" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Sản phẩm</label>
                <div class="col-sm-10">
                    <input type="number" name="product_id"  placeholder="Nhập mã sản phẩm" required>
                </div>
            </div>
            <input type="submit" name="submit" value="Thêm Slider" class="btn btn-primary"></input>
        </form>
    </div>
</body>
<?php
require_once('./../commons/footer.php');
?>