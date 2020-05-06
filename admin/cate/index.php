<?php
require_once('./../commons/head.php');
require_once('./../../models/cate.php');
$cates = new Cate();
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'delete':
            if (is_numeric($_GET['id'])) {
                $cates->delete($_GET['id']);
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
                    <th scope="col">Tên Thể Loại</th>
                    <th scope="col">Cấp Độ</th>
                    <th scope="col">Thao Tác</th>
                </tr>
            </thead>
            <br>
            <a class="btn btn-primary" href="add.php">Thêm</a>
            <br>
            <br>

            <tbody>
                <?php

                $list = $cates->getAllnoLimit();
                foreach ($list as $r) {
                ?>
                    <tr>
                        <td><?php echo $r['id'] ?></td>
                        <td><?php echo $r['name'] ?></td>
                        <td><?php echo $r['level'] ?></td>
                        <td>
                            <a class="btn btn-danger" href="?action=delete&id=<?php echo $r['id']; ?>">Xoá</a>
                            <a class="btn btn-warning" href="edit.php?id=<?php echo $r['id'] ?>">Sửa</a>
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