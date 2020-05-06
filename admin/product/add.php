<?php
require_once('./../commons/head.php');
require_once('./../../models/products.php');
require_once('./../../lib/upload.php');
require_once('./../../models/brand.php');
require_once('./../../models/cate.php');

if (isset($_SESSION['success'])) {
    unset($_SESSION['success']);
}

if (isset($_FILES['files']) && isset($_POST['submit'])) {
    $products = new Product();
    //check file upload
    $upload = new upload();
    $src = $upload->multiupload();
    $uploadContentImg = new upload();
    $srcOfContent = $uploadContentImg->uploadImgOfContent(3);
    // print_r($src);
    if ($src != null) { //upload funtion return
        $count = $products->insert($_POST, $src, $srcOfContent);
        if ($count == 1) {
            $_SESSION['success'] = 'Thêm thành công';
        }
    }
}

// get brand  and cate to show on select
$brand = new Brand();
$listbrand =  $brand->getAllNoLimit();
$cate = new Cate();
$listcate = $cate->getAllnoLimit();
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
                    <input type="text" name="productName" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Giá</label>
                <div class="col-sm-10">
                    <input type="number" name="price" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Thương Hiệu</label>
                <div class="col-sm-10">
                    <select name="brand_id">
                        <?php foreach ($listbrand as $r) {
                        ?>
                            <option value="<?php echo $r['id']  ?>"><?php echo $r['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">The Loai</label>
                <div class="col-sm-10">
                    <select name="cate_id[]">
                    <option value="0">Chon the loai</option>
                        <?php foreach ($listcate as $r2) {
                        ?>
                            <option value="<?php echo $r2['id'];  ?>"><?php echo $r2['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <!-- <button onclick="addCate()"></button> -->
            </div>
            
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">The Loai</label>
                <div class="col-sm-10">
                    <select name="cate_id[]">
                        <option value="0">Chon the loai</option>
                        <?php foreach ($listcate as $r2) {
                        ?>
                            <option value="<?php echo $r2['id'];  ?>"><?php echo $r2['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <!-- <button onclick="addCate()"></button> -->
            </div>
            
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">The Loai</label>
                <div class="col-sm-10">
                    <select name="cate_id[]">
                    <option value="0">Chon the loai</option>
                        <?php foreach ($listcate as $r2) {
                        ?>
                            <option value="<?php echo $r2['id'];  ?>"><?php echo $r2['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <!-- <button onclick="addCate()"></button> -->
            </div>

            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Hình ảnh(chọn 3 hình)</label>
                <div class="col-sm-10">
                    <!-- <input type="file" name="file" required> -->
                    <input type="file" name="files[]" multiple required />
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Mô tả</label>
                <div class="col-sm-10">
                    <input type="text" name="short_desc" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Keyword</label>
                <div class="col-sm-10">
                    <input type="text" name="keyword" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Tình trạng máy</label>
                <div class="col-sm-10">
                    <input type="number" value="" name="status" placeholder="1 là mới, 0 là cũ" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Model</label>
                <div class="col-sm-10">
                    <input type="text" name="model" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">CPU</label>
                <div class="col-sm-10">
                    <input type="text" name="chip" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">RAM</label>
                <div class="col-sm-10">
                    <input type="text" name="ram" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Card màn hình</label>
                <div class="col-sm-10">
                    <input type="text" name="card" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Ổ đĩa</label>
                <div class="col-sm-10">
                    <input type="text" name="drive" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Màn hình</label>
                <div class="col-sm-10">
                    <input type="text" name="display" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Có vân tay không</label>
                <div class="col-sm-10">
                    <input type="number" name="vantay" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Hệ điều hành</label>
                <div class="col-sm-10">
                    <input type="text" name="operation" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Pin</label>
                <div class="col-sm-10">
                    <input type="number" name="pin" placeholder="cell" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Trọng Lượng</label>
                <div class="col-sm-10">
                    <input type="number" name="weight" placeholder="Kg" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Kích thước</label>
                <div class="col-sm-10">
                    <input type="text" name="size" placeholder="VD: 20x30x30" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Kết Nối</label>
                <div class="col-sm-10">
                    <input type="text" name="connect" placeholder="Wifi, blutooth " required>
                </div>
            </div>
            <!-- <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Màu</label>
                <div class="col-sm-10">
                    <input type="text" name="color" required>
                </div>
            </div> -->
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Giảm giá</label>
                <div class="col-sm-10">
                    <input type="text" name="discount" placeholder="Bao nhiêu %">
                </div>
            </div>
            <h3>Đặc Điểm Nổi Bật</h3>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Tiêu đề 1</label>
                <div class="col-sm-10">
                    <input type="text" name="title1">
                    <input type="file" name="file1" id="">
                    <textarea name="content1" cols="50" rows="10"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Tiêu đề 2 </label>
                <div class="col-sm-10">
                    <input type="text" name="title2">
                    <input type="file" name="file2" id="">
                    <textarea name="content2" cols="50" rows="10"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Tiêu đề 3</label>
                <div class="col-sm-10">
                    <input type="text" name="title3">
                    <input type="file" name="file3" id="">
                    <textarea name="content3" cols="50" rows="10"></textarea>
                </div>
            </div>
            <input type="submit" name="submit" value="Up Load" class="btn btn-primary"></input>
    </div>
    <input type="submit" name="submit" value="Up Load" class="btn btn-primary"></input>
    </form>
    </div>

</body>
<?php
require_once('./../commons/footer.php');
?>