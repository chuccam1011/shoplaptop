<?php
$product = new Product();
$list = $product->getAll(0, 10);
?>


<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">Latest Products</h2>
                    <div class="product-carousel">
                        <?php
                        foreach ($list as $r) {
                            $listImg = $product->getImg($r['id']);

                        ?>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="<?php echo 'admin/product/uploads/'.$listImg[0]['img']; ?>" alt="">
                                    <div class="product-hover">
                                        <a href="#" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                        <!-- <a href="single-product.php" class="view-details-link"><i class="fa fa-link"></i> See details</a> -->
                                    </div>
                                </div>

                                <h2><a href="single-product.php"><?php echo $r['name'] ?></a></h2>

                                <div class="product-carousel-price">
                                    <ins><?php echo $r['price'].' VND' ?></ins>
                                    <!-- <del>$100.00</del> -->
                                </div>
                            </div>
                        <?php  } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>