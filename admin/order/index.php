<?php
require_once('./../commons/head.php');
require_once('./../../models/order.php');
if (isset($_SESSION['success'])) {
    unset($_SESSION['success']);
}
$order = new Order();
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
if (isset($_GET['update_order_status'])) {
    $id = $_GET['id'];
    $status = $_GET['update_order_status'];
    $alert = $order->update($id, $status);
    if ($alert == 1) {
        $_SESSION['success'] = 'Cap nhat thanh cong đơn hàng #'.$id;
    }
}

?>

<body>
    <?php
    require_once('./../commons/nav_menu.php');
    ?>


    <div class="container">
        <?php if(isset($_SESSION['success'])) echo '<div class="alert alert-primary" role="alert">'.$_SESSION['success'].'</div>';?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên Người dùng</th>
                    <th scope="col">Tình trạng đơn hàng</th>
                    <th scope="col">Ghi chú</th>
                    <th scope="col">Thời gian</th>
                    <th scope="col">Thao Tác</th>
                </tr>
            </thead>
            <br>
            <tbody>
                <?php

                $list = $order->getOrder(0, 10);
                foreach ($list as $r) {
                ?>
                    <tr>
                        <td><?php echo $r['id'] ?></td>
                        <td><?php echo $r['username'] ?></td>
                        <td>
                            <?php
                            switch ($r['status']) {
                                case '1':
                                    echo 'Đa giao  cho DVVC';
                                    break;
                                case '0':
                                    echo 'Mới đặt hàng';
                                    break;
                                case '2':
                                    echo 'Đã nhận';
                                    break;
                                default:
                                    echo 'Unknows';
                                    break;
                            }
                            ?>
                        </td>
                        <td><?php echo $r['notes'] ?></td>
                        <td><?php echo $r['time'] ?></td>
                        <td>
                            <a class="btn btn-warning" href="detail.php?id_order=<?php echo $r['id'] ?>">Xem</a>
                            <div class="btn-group" role="group" aria-label="">

                                <div class="btn-group" role="group">
                                    <button id="dropdownId" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Cập nhật
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                                        <a class="dropdown-item" href="?update_order_status=1&&id=<?php echo $r['id'] ?>">Đa giao cho DVVC</a>
                                        <a class="dropdown-item" href="?update_order_status=2&&id=<?php echo $r['id'] ?>">Đã nhận</a>

                                    </div>
                                </div>
                            </div>
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