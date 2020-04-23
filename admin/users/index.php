<?php
require_once('./../commons/head.php');
require_once('./../../models/users.php');
$users = new Users();
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'delete':
            if (is_numeric($_GET['id'])) {
                $users->delete($_GET['id']);
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
                    <th scope="col">Username</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Họ Tên</th>
                    <th scope="col">Thành phố</th>
                    <th scope="col">Ngày Sinh</th>
                    <th scope="col">Email</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <br>
            <a class="btn btn-primary" href="add.php">Thêm</a>
            <br>
            <br>

            <tbody>
                <?php

                $list = $users->getAll(0, 5);

                foreach ($list as $r) {
                ?>
                <tr>
                    <td><?php echo $r['id'] ?></td>
                    <td><?php echo $r['username'] ?></td>
                    <td><?php echo $r['address'] ?></td>
                    <td><?php echo $r['phone'] ?></td>
                    <td><?php echo $r['full_name'] ?></td>
                    <td><?php echo $r['city'] ?></td>
                    <td><?php echo $r['dob'] ?></td>
                    <td><?php echo $r['email'] ?></td>
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