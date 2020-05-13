<?php
include_once("inc/head.php");
include_once("inc/top.php");
?>
<?php
$product = new Product();
$order = new Order();

$listOrder = $order->getListOrderByUser($_SESSION['user_id'],0, 20);

?>

<div class="product-big-title-area ">
    <div class="container ">
        <div class="row ">
            <div class="col-md-12 ">
                <div class="product-bit-title text-center ">
                    <h2>Danh Sách Đơn Hàng</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page title area -->

<div class="single-product-area ">
    <div class="zigzag-bottom "></div>
    <div class="container ">
        <div class="row ">
            <div class="col-md-4 ">
                <?php include_once('inc/singleSlidebar.php'); ?>
            </div>
            <div class="col-md-8 ">
                <div class="product-content-right ">
                    <div class="woocommerce ">
                        <table class="table table-striped table-inverse table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Xem</th>
                                    <th>Thời Gian Đặt</th>
                                    <th>Tình Trạng Đơn </th>
                                    <th>Tổng Giá</th>
                                    <th>Ghi chú </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listOrder as $item) {
                                    $listProducts = $order->getOrderProducts($item['id']); //get product list in order
                                    $totalOrder = 0;
                                    //tinh tong thanh tonas don hang
                                    foreach ($listProducts as $pro) {
                                        $single = $product->getProductById($pro['product_id']);
                                        $price = $single['price'];
                                        $totalOrder += $pro['quantity'] * $price;
                                    }
                                ?>
                                    <tr>
                                        <td scope="row">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $item['id'] ?>">
                                                Xem Chi Chi Tiết
                                                <?php echo '#' . $item['id'] ?>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="<?php echo $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle"><?php echo 'Mã Đơn Hàng  #' . $item['id'] ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-striped table-inverse table-responsive">
                                                                <thead class="thead-inverse">
                                                                    <tr>
                                                                        <th>Tên Sản Phẩm</th>
                                                                        <th>Số Lượng</th>
                                                                        <th>Đơn Giá</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <!-- show list of product in modal -->
                                                                    <?php foreach ($listProducts as $pro) { //list product in order from products_orders
                                                                        $singleproduct = $product->getProductById($pro['product_id']);

                                                                    ?>
                                                                        <tr>
                                                                            <td scope="row"><a href="single-product.php?product_id=<?php echo $singleproduct['id'] ?>"><?php echo $singleproduct['name']; ?></a></td>
                                                                            <td><?php echo $pro['quantity'] ?></td>
                                                                            <td><?php echo number_format($singleproduct['price']) . ' vnd'; ?></td>

                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </td>
                                        <td><?php echo $item['time'] ?></td>
                                        <td><?php
                                            switch ($item['status']) {
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
                                            ?></td>
                                        <td><?php echo number_format($totalOrder) . ' vnd' ?></td>
                                        <td><?php echo $item['notes'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once("inc/footer.php");
?>