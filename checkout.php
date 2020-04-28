<?php
include_once("inc/head.php");
include_once("inc/top.php");
?>
<?php
$product = new Product();
?>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?php include_once('inc\singleSlidebar.php') ?>
            </div>

            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <div class="woocommerce-info">Returning customer? <a class="showlogin" data-toggle="collapse" href="#login-form-wrap" aria-expanded="false" aria-controls="login-form-wrap">Click here to login</a>
                        </div>

                        <form id="login-form-wrap" class="login collapse" method="post">
                            <p class="form-row form-row-first">
                                <label for="username">Usernam <span class="required">*</span>
                                </label>
                                <input type="text" id="username" name="username" class="input-text" required>
                            </p>
                            <p class="form-row form-row-last">
                                <label for="password">Password <span class="required">*</span>
                                </label>
                                <input type="password" id="password" name="password" class="input-text" required>
                            </p>
                            <div class="clear"></div>

                            <p class="form-row">
                                <input type="submit" value="Login" name="login" class="button">
                                <label class="inline" for="rememberme"><input type="checkbox" value="forever" id="rememberme" name="rememberme"> Remember me </label>
                            </p>
                            <p class="lost_password">
                                <a href="#">Lost your password?</a>
                            </p>
                            <div class="clear"></div>
                        </form>

                        <div class="woocommerce-info">Have a coupon? <a class="showcoupon" data-toggle="collapse" href="#coupon-collapse-wrap" aria-expanded="false" aria-controls="coupon-collapse-wrap">Click here to enter your code</a>
                        </div>

                        <form id="coupon-collapse-wrap" method="post" class="checkout_coupon collapse">
                            <p class="form-row form-row-first">
                                <input type="text" value="" id="coupon_code" placeholder="Coupon code" class="input-text" name="coupon_code">
                            </p>
                            <p class="form-row form-row-last">
                                <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
                            </p>
                            <div class="clear"></div>
                        </form>

                        <form enctype="multipart/form-data" action="#" class="checkout" method="post" name="checkout">

                            <div id="customer_details" class="col2-set">
                                <div class="col-1">
                                    <div class="woocommerce-billing-fields">
                                        <h3>Thông tin gửi hàng </h3>
                                        <p id="billing_country_field" class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                            <label class="" for="billing_country">Thành phố<abbr title="required" class="required">*</abbr>
                                            </label>
                                            <select class="country_to_state country_select" id="billing_country" name="billing_country">

                                            </select>
                                        </p>

                                        <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                            <label class="" for="billing_first_name">Họ Tên<abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="text" value="" placeholder="" id="billing_first_name" name="name" class="input-text">
                                        </p>

                                        <div class="clear"></div>
                                        <p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                                            <label class="" for="billing_address_1">Địa chỉ <abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="text" value="" placeholder="Quận,huyện,.. " id="billing_address_1" name="billing_address_1" class="input-text ">
                                        </p>

                                        <p id="billing_address_2_field" class="form-row form-row-wide address-field">
                                            <input type="text" value="" placeholder="Tên đường, số nhà,..." id="billing_address_2" name="billing_address_2" class="input-text ">
                                        </p>

                                        <div class="clear"></div>

                                        <p id="billing_email_field" class="form-row form-row-first validate-required validate-email">
                                            <label class="" for="billing_email">Email <abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="email" value="" placeholder="exaple@abc.com" id="billing_email" name="billing_email" class="input-text ">
                                        </p>

                                        <p id="billing_phone_field" class="form-row form-row-last validate-required validate-phone">
                                            <label class="" for="billing_phone">Phone <abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="text" value="" placeholder="" id="billing_phone" name="billing_phone" class="input-text ">
                                        </p>
                                        <div class="clear"></div>

                                  
                                        <p id="order_comments_field" class="form-row notes">
                                            <label class="" for="order_comments">Order Notes</label>
                                            <textarea cols="5" rows="2" placeholder="Notes about your order, e.g. special notes for delivery." id="order_comments" class="input-text " name="order_comments"></textarea>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="woocommerce-shipping-fields">
                                        <h3 id="ship-to-different-address">
                                            <label class="checkbox" for="ship-to-different-address-checkbox">Gửi tới 1 địa chỉ khác </label>
                                            <input type="checkbox" value="1" name="ship_to_different_address" checked="checked" class="input-checkbox" id="ship-to-different-address-checkbox">
                                        </h3>
                                        <div class="shipping_address" style="display: block;">
                                            <p id="shipping_country_field" class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                                <label class="" for="shipping_country">Country <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <select class="country_to_state country_select" id="shipping_country" name="shipping_country">
                                                    <option value="">Chọn tỉnh thành</option>
                                                    <option value="HN"> Hà nội </option>
                                                    <option value="HCM">HỒ chí minh </option>
                                                    <option value="DN">Đà nẵng</option>
                                                </select>
                                            </p>

                                            <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                                <label class="" for="shipping_first_name">Họ Tên<abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="" placeholder="" id="shipping_first_name" name="shipping_first_name" class="input-text ">
                                            </p>

                                            <div class="clear"></div>

                                            <p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                                                <label class="" for="billing_address_1">Địa chỉ <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="" placeholder="Quận,huyện,.. " id="billing_address_1" name="billing_address_1" class="input-text ">
                                            </p>

                                            <p id="billing_address_2_field" class="form-row form-row-wide address-field">
                                                <input type="text" value="" placeholder="Tên đường, số nhà,..." id="billing_address_2" name="billing_address_2" class="input-text ">
                                            </p>

                                            <div class="clear"></div>

                                            <p id="billing_email_field" class="form-row form-row-first validate-required validate-email">
                                                <label class="" for="billing_email">Email <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="email" value="" placeholder="exaple@abc.com" id="billing_email" name="billing_email" class="input-text ">
                                            </p>

                                            <p id="billing_phone_field" class="form-row form-row-last validate-required validate-phone">
                                                <label class="" for="billing_phone">Phone <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="" placeholder="" id="billing_phone" name="billing_phone" class="input-text ">
                                            </p>
                                            <div class="clear"></div>
                                            <p id="order_comments_field" class="form-row notes">
                                                <label class="" for="order_comments">Order Notes</label>
                                                <textarea cols="5" rows="2" placeholder="Notes about your order, e.g. special notes for delivery." id="order_comments" class="input-text " name="order_comments"></textarea>
                                            </p>
                                        </div>



                                    </div>

                                </div>

                            </div>

                            <h3 id="order_review_heading">Your order</h3>

                            <div id="order_review" style="position: relative;">
                                <table class="shop_table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="cart_item">
                                            <td class="product-name">
                                                Ship Your Idea <strong class="product-quantity">× 1</strong> </td>
                                            <td class="product-total">
                                                <span class="amount">£15.00</span> </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>

                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount">£15.00</span>
                                            </td>
                                        </tr>

                                        <tr class="shipping">
                                            <th>Shipping and Handling</th>
                                            <td>

                                                Free Shipping
                                                <input type="hidden" class="shipping_method" value="free_shipping" id="shipping_method_0" data-index="0" name="shipping_method[0]">
                                            </td>
                                        </tr>


                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount">£15.00</span></strong> </td>
                                        </tr>

                                    </tfoot>
                                </table>


                                <div id="payment">
                                    <ul class="payment_methods methods">
                                        <li class="payment_method_bacs">
                                            <input type="radio" data-order_button_text="" checked="checked" value="backing" name="payment_method" class="input-radio" id="payment_method_bacs">
                                            <label for="payment_method_bacs">Chuyển khoản ngân hàng </label>
                                           <p>Bộ phận  CSKH sẽ hướng dán cho bạn </p>
                                        </li>
                                        <li class="payment_method_cheque">
                                            <input type="radio" data-order_button_text="" value="cod" name="payment_method" class="input-radio" id="payment_method_cheque">
                                            <label for="payment_method_cheque">COD(Thanh toán khi  nhận hàng)</label>
                                        
                                        </li>
                                    
                                    </ul>

                                    <div class="form-row place-order">
                                        <input type="submit" data-value="Place order" value="Đặt Hàng" id="place_order" name="woocommerce_checkout_place_order" class="button alt">
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