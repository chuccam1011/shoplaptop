<?php
include_once("inc/head.php");
include_once("inc/top.php");
include_once("./models/users.php");
include_once("./models/order.php");

?>
<?php
if (isset($_SESSION['success'])) {
    unset($_SESSION['success']);
}
//show product of cart
$product = new Product(); // to show slibar products
$users = new Users();
$order = new Order();
$cart = $_SESSION['cart'];
$user = $users->getByid($_SESSION['user_id']);
//to order users
if (isset($_POST['order']) && $cart != NULL) {
    //thong tin nguoi mua hang
    $_POST['user_id'] = $_SESSION['user_id'];
    $result =  $order->insert($_POST, $cart);
    // var_dump($result);
    if ($result == 1) {
        $_SESSION['success'] = 'Đặt hàng  thành công';
        $_SESSION['cart'] = array();
        // header("Location:orders.php");
    }
}
?>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <?php
        if (isset($_SESSION['success'])) {
        ?>
            <div class="alert alert-primary" role="alert">
                <?php echo $_SESSION['success'] ?>
                <a href="orders.php">Xem đơn hàng của bạn</a><br>
                <a href="index.php">Tiếp tục mua hang </a><br>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-4">
                <?php include_once('inc\singleSlidebar.php') ?>
            </div>

            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <form enctype="multipart/form-data" action="" class="checkout" method="post" name="checkout">

                            <div id="customer_details" class="col2-set">
                                <div class="col-1">
                                    <div class="woocommerce-billing-fields">
                                        <h3>Thông tin gửi hàng </h3>
                                        <p id="billing_country_field" class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                            <label class="" for="billing_country">Thành phố<abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="text" value="<?php echo $user['city'] ?>" name="shipping_country">
                                        </p>

                                        <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                            <label class="" for="billing_first_name">Họ Tên<abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="text" value="<?php echo $user['full_name'] ?>" placeholder="" id="billing_first_name" name="shipping_full_name" class="input-text">
                                        </p>

                                        <div class="clear"></div>
                                        <p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                                            <label class="" for="billing_address_1">Địa chỉ <abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="text" value="<?php echo $user['address'] ?>" placeholder="Quận,huyện,.. " id="billing_address_1" name="shipping_address" class="input-text ">
                                        </p>

                                        <div class="clear"></div>

                                        <p id="billing_email_field" class="form-row form-row-first validate-required validate-email">
                                            <label class="" for="billing_email">Email <abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="email" value="<?php echo $user['email'] ?>" placeholder="exaple@abc.com" id="billing_email" name="shipping_email" class="input-text ">
                                        </p>

                                        <p id="billing_phone_field" class="form-row form-row-last validate-required validate-phone">
                                            <label class="" for="billing_phone">Phone<abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="text" value="<?php echo $user['phone'] ?>" placeholder="" id="billing_phone" name="shipping_phone" class="input-text ">
                                        </p>
                                        <div class="clear"></div>


                                        <p id="order_comments_field" class="form-row notes">
                                            <label class="" for="order_comments">Ghi chú đơn hàng</label>
                                            <textarea cols="5" rows="2" placeholder="Ghi chú cho đơn vị vân chuyển " id="order_comments" class="input-text " name="shipping_notes"></textarea>
                                        </p>
                                    </div>
                                </div>

                                <!-- <div class="col-2">
                                    <div class="woocommerce-shipping-fields">
                                        <h3 id="ship-to-different-address">
                                            <label class="checkbox" for="ship-to-different-address-checkbox">Gửi tới 1 địa chỉ khác </label>
                                            <input type="checkbox" value="" name="ship_to_different_address" class="input-checkbox" id="ship-to-different-address-checkbox">
                                        </h3>
                                        <div class="shipping_address" style="display: block;">
                                            <p id="shipping_country_field" class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                                <label class="" for="shipping_country">Thành phố<abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" name="shipping_country" required></input>
                                            </p>

                                            <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                                <label class="" for="shipping_first_name">Họ Tên<abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="" id="shipping_first_name" name="shipping_full_name" class="input-text ">
                                            </p>
                                            <div class="clear"></div>

                                            <p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                                                <label class="" for="billing_address_1">Địa chỉ <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="" placeholder="Quận,huyện,.. " id="billing_address_1" name="shipping_address" class="input-text ">
                                            </p>

                                            <div class="clear"></div>

                                            <p id="billing_email_field" class="form-row form-row-first validate-required validate-email">
                                                <label class="" for="billing_email">Email <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="email" value="" placeholder="exaple@abc.com" id="billing_email" name="shipping_email" class="input-text ">
                                            </p>

                                            <p id="billing_phone_field" class="form-row form-row-last validate-required validate-phone">
                                                <label class="" for="billing_phone">Phone <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="" placeholder="" id="billing_phone" name="billing_phone" class="input-text ">
                                            </p>
                                            <div class="clear"></div>
                                            <p id="order_comments_field" class="form-row notes">
                                                <label class="" for="order_comments">Ghi chú đơn hàng</label>
                                                <textarea cols="5" rows="2" placeholder="Ghi chú cho đơn vị vân chuyển " id="order_comments" class="input-text " name="shipping_notes"></textarea>
                                            </p>
                                        </div>

                                    </div>

                                </div> -->

                            </div>

                            <h3 id="order_review_heading">Đơn Hàng Của Bạn</h3>

                            <div id="order_review" style="position: relative;">
                                <table class="shop_table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Sản phẩm</th>
                                            <th class="product-total">Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($cart as $item) { ?>
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    <?php echo $item['name']; ?> <strong class="product-quantity">× <?php echo $item['quantity']; ?></strong> </td>
                                                <td class="product-total">
                                                    <span class="amount"><?php echo number_format($item['price'] * $item['quantity']) . ' VND' ?></span> </td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                    <tfoot>

                                        <tr class="cart-subtotal">
                                            <th>Tổng Giỏ Hàng</th>
                                            <td><span class="amount"><?php echo number_format($total) . ' VND' ?></span>
                                            </td>
                                        </tr>
                                        <?php $shipping = 0; ?>
                                        <tr class="shipping">
                                            <th>Shipping</th>
                                            <td>
                                                Free Shipping
                                                <input type="hidden" class="shipping_method" value="free_shipping" id="shipping_method_0" data-index="0" name="shipping_method[0]">
                                            </td>
                                        </tr>


                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount"><?php echo number_format($total + $shipping) ?></span></strong> </td>
                                        </tr>

                                    </tfoot>
                                </table>


                                <div id="payment">
                                    <ul class="payment_methods methods">
                                        <li class="payment_method_bacs">
                                            <input type="radio" data-order_button_text="" checked="checked" value="backing" name="payment_method" class="input-radio" id="payment_method_bacs">
                                            <label for="payment_method_bacs">Chuyển khoản ngân hàng </label>
                                            <p>Bộ phận CSKH sẽ hướng dán cho bạn </p>
                                        </li>
                                        <li class="payment_method_cheque">
                                            <input type="radio" data-order_button_text="" value="cod" name="payment_method" class="input-radio" id="payment_method_cheque">
                                            <label for="payment_method_cheque">COD(Thanh toán khi nhận hàng)</label>
                                        </li>

                                    </ul>

                                    <div class="form-row place-order">
                                        <input type="submit" name="order" data-value="Place order" value="Đặt Hàng" id="place_order" name="woocommerce_checkout_place_order" class="button alt">
                                    </div>

                                    <div class="clear"></div>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once("inc/footer.php");

?>