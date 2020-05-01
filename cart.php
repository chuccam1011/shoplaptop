<?php
include_once("inc/head.php");
include_once("inc/top.php");
?>

<?php
$product = new Product();
$cart = $_SESSION['cart'];

//nếu tồn tại get delete
if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    if (isset($_SESSION['cart'])) {
        //tìm kiếm phần tử theo id trong mảng
        for ($i = 0; $i < count($cart); $i++) {
            if ($id == $cart[$i]['id']) {
                //xoa phan tu tai vi tri i
                array_splice($cart, $i, 1);
                break;
            }
        }
        //gán nguợc lại mảng vào session
        $_SESSION['cart'] = $cart;
    }
}

if (isset($_GET['plus'])) {
    $id = $_GET['id'];

    for ($i = 0; $i < count($cart); $i++) {
        if ($id == $cart[$i]['id']) {
            //cập nhật tăng số luợng lên
            $cart[$i]['quantity'] = $cart[$i]['quantity'] + 1;
            break;
        }
    }
    $_SESSION['cart'] = $cart;
}
//nếu như nguơi dùng gửi thông tin giam số luợng sp
if (isset($_GET['minus'])) {
    $id = $_GET['id'];
    for ($i = 0; $i < count($cart); $i++) {
        if ($id == $cart[$i]['id']) {
            //giảm số luợng đi
            if ($cart[$i]['quantity'] >= 2) {
                $cart[$i]['quantity'] = $cart[$i]['quantity'] - 1;
            }
            break;
        }
    }

    $_SESSION['cart'] = $cart;
}
// update quantity for item 
if (isset($_POST['update_cart'])) {
    // var_dump($_POST);
    //tìm kiếm phần tử theo id trong mảng
    for ($i = 0; $i < count($cart); $i++) {
        $id = $_POST['id'][$i];
        //    echo $id;
        if ($id == $cart[$i]['id']) {
            //giảm số luợng đi
            $cart[$i]['quantity'] = $_POST['quantity'][$i];
            //  break;
        }
    }
    $_SESSION['cart'] = $cart;
}

?>



<div class="product-big-title-area ">
    <div class="container ">
        <div class="row ">
            <div class="col-md-12 ">
                <div class="product-bit-title text-center ">
                    <h2>Giỏ Hàng</h2>
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
                        <form method="post" action="">
                            <table cellspacing="0 " class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-thumbnail ">&nbsp;Hình ảnh</th>
                                        <th class="product-name ">Tên Sản phẩm </th>
                                        <th class="product-price ">Đơn giá</th>
                                        <th class="product-quantity ">Số lượng</th>
                                        <th class="product-subtotal ">Giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($cart); $i++) {
                                        $listImg = $product->getImg($cart[$i]['id']);
                                    ?>
                                        <tr class="cart_item ">
                                            <td class="product-remove">
                                                <a title="Xóa sản phẩm này" class="remove" href="?delete&&id=<?php echo $cart[$i]['id'] ?>">×</a>
                                            </td>

                                            <td class="product-thumbnail">
                                                <a href="single-product.php?product_id=<?php echo $cart[$i]['id'] ?>"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="<?php echo 'admin/product/uploads/' . $listImg[0]['img'] ?>"></a>
                                            </td>

                                            <td class="product-name">
                                                <a href="single-product.php?product_id=<?php echo $cart[$i]['id'] ?>"><?php echo $cart[$i]['name']; ?></a>
                                            </td>

                                            <td class="product-price ">
                                                <span class="amount"><?php echo number_format($cart[$i]['price']) . ' VND'; ?></span>
                                            </td>

                                            <td class="product-quantity">
                                                <div class="quantity buttons_added">
                                                    <a href="?minus&&id=<?php echo $cart[$i]['id'] ?>"><input type="button" class="minus" value="-"></a>
                                                    <input name="quantity[]" type="number" size="4" class="input-text qty text" title="Qty" value="<?php echo $cart[$i]['quantity'] ?>" min="0" step="1">
                                                    <input type="hidden" name="id[]" value="<?php echo $cart[$i]['id'] ?>">
                                                    <a href="?plus&&id=<?php echo $cart[$i]['id'] ?>"><input type="button" class="plus" value="+"></a>
                                                </div>
                                            </td>

                                            <td class="product-subtotal">
                                                <span class="amount"><?php echo number_format($cart[$i]['price'] * $cart[$i]['quantity']) . ' VND' ?></span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td class="actions" colspan="6">
                                            <div class="coupon">
                                                <label for="coupon_code">Coupon:</label>
                                                <input type="text" placeholder="Coupon code " value="" id="coupon_code" class="input-text" name="coupon_code">
                                                <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
                                            </div>
                                            <input type="submit" value="Update Cart" name="update_cart" class="button">
                                            <!-- <input type="submit" value="CheckOut" name="check_out" class="button"> -->
                                            <a  class="button" href="checkout.php">Đặt hàng</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>

                        <div class="cart-collaterals ">
                            <div class="cross-sells ">
                                <h2>Có thể bạn sẽ thích .</h2>
                                <ul class="products ">
                                    <li class="product ">
                                        <a href="single-product.php ">
                                            <img width="325" height="325" alt="T_4_front " class="attachment-shop_catalog wp-post-image " src="img/product-2.jpg ">
                                            <h3>Ship Your Idea</h3>
                                            <span class="price "><span class="amount">£20.00</span></span>
                                        </a>

                                        <a class="add_to_cart_button " data-quantity="1 " data-product_sku=" " data-product_id="22 " rel="nofollow " href="single-product.php ">Select options</a>
                                    </li>

                                    <li class="product ">
                                        <a href="single-product.php ">
                                            <img width="325" height="325" alt="T_4_front " class="attachment-shop_catalog wp-post-image " src="img/product-4.jpg ">
                                            <h3>Ship Your Idea</h3>
                                            <span class="price "><span class="amount">£20.00</span></span>
                                        </a>

                                        <a class="add_to_cart_button " data-quantity="1 " data-product_sku=" " data-product_id="22 " rel="nofollow " href="single-product.php ">Select options</a>
                                    </li>
                                </ul>
                            </div>


                            <div class="cart_totals">
                                <h2>Giỏ Hàng</h2>

                                <table cellspacing="0">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Tổng thanh toán </th>
                                            <td><span class="amount"><?php echo number_format($total) . ' VND'; ?></span></td>
                                        </tr>

                                        <tr class="shipping">
                                            <?php $ship = 120000; ?>
                                            <th>Shipping</th>
                                            <td><?php echo number_format($ship) . ' VND' ?></td>
                                        </tr>
                                        <tr class="order-total ">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount"><?php echo number_format($total + $ship) . ' VND' ?></span></strong> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                            <form method="post" action="" class="shipping_calculator">
                                <h2>
                                    <a class="shipping-calculator-button" data-toggle="collapse" href=""" aria-expanded=" false" aria-controls="calcalute-shipping-wrap ">Tính phí ship</a></h2>

                                <select rel="calc_shipping_state" class="country_to_state" id="calc_shipping_countr" name="calc_shipping_country ">
                                    <option value=" ">Chọn thành phố...</option>
                                    <option value="HN">Hà nội</option>
                                    <option value="HCM">Hồ chí minh</option>
                                    <option value="DN">Đà nẵng</option>
                                </select>
                                <button class="button" value="1" name="calc_shipping" type="submit">Update Totals</button>
                                </section>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once("inc/footer.php");
?>