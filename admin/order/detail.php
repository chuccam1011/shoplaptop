<?php
require_once('./../commons/head.php');
require_once('./../../models/users.php');
require_once('./../../models/products.php');
require_once('./../../models/order.php');

$order = new Order();
$product = new Product();
$user = new Users();
$id_order = $_GET['id_order'];
$orders = $order->getOrderById($id_order);
$productList = $order->getProductListInOrder($id_order);
$total = 0;
?>

<body>
    <?php
    require_once('./../commons/nav_menu.php');
    ?>

    <div class="container">
        <table class="table">

            <tbody>
              
                <tr>
                    <td scope="row">#</td>
                    <td><?php echo $id_order ?></td>
                </tr>
                <tr>
                    <td scope="row">Tinh trang</td>
                    <td><?php echo $orders['status'] ?></td>
                </tr>
                <tr>
                    <td scope="row">Thoi gian</td>
                    <td><?php echo $orders['time'] ?></td>
                </tr>
                <tr>
                    <td scope="row">Ten Khach hang</td>
                    <td><?php echo $id_order ?></td>
                </tr>
                <tr>
                    <td scope="row">Danh sach san pham</td>
            
                    <td>
                        <?php foreach ($productList as $product) { ?>
                            <tr>
                                <td><?php echo $product['quantity'] . ' Chiec' ?></td>
                                <td><a href="http://localhost/laptopcu/admin/product/edit.php?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></td>
                                <td><?php echo number_format($product['price']) . ' VND'; ?></td>
                            </tr>
                        <?php } ?>
                     </td>


               </tr>
            <tr>
                <td scope="row">Tong gia</td>
                <td><?php
                    foreach ($productList as $product) {
                        $total = $total + $product['price'] . $product['quantity'];
                    }
                    echo number_format($total) . ' VND' ?></td>
            </tr>
            <tr>
                <td scope="row">Phuong thuc thanh toan</td>
                <td><?php echo 'COD' ?></td>
            </tr>

            </tbody>
        </table>
    </div>
</body>
<?php
require_once('./../commons/footer.php');
?>