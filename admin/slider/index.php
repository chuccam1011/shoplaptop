<?php
require_once('./../commons/head.php');
require_once('./../../models/slider.php');
$slider = new Slider();
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'delete':
            if (is_numeric($_GET['id'])) {
                $slider->delete($_GET['id']);
            }
            break;

        default:
            # code...
            break;
    }
}
?>

<body>
    <?php
    require_once('./../commons/nav_menu.php');
    ?>

    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Mã Sản phẩm</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <br>
            <a class="btn btn-primary" href="add.php">Thêm</a>
            <br>
            <br>

            <tbody>
                <?php

                $list = $slider->getAll(0, 5);

                foreach ($list as $r) {
                ?>
                    <tr>
                        <td><?php echo $r['id'] ?></td>
                        <td><?php echo $r['tittle'] ?></td>
                        <td> <img height="30px" width="50px" src="<?php echo 'uploads/' . $r['img'] ?>" alt=""> </td>
                        <td><?php echo $r['product_id'] ?></td>
                   
                        <td>
                            <a class="btn btn-danger" href="?action=delete&id=<?php echo $r['id']; ?>">Xoá</a>
                            <a class="btn btn-warning" href="edit.php?id=<?php echo $r['id'] ?>">Sửa</a>
                            <a class="btn btn-warning" href="http://localhost/laptopcu/admin/product/edit.php/?id=<?php echo $r['product_id'] ?>">Xem</a>
                        </td>
                    </tr>
                <?php
                }

                ?>

            </tbody>
        </table>
    </div>
</body>
<?php
require_once('./../commons/footer.php');
?>