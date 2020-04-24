<?php
$product = new Product();

?>

<div class="product-widget-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">


            <div class="col-md-4">

                <div class="single-product-widget">
                    <h2 class="product-wid-title">Top Sellers</h2>
                    <a href="" class="wid-view-more">View All</a>
                    <?php
                    //get product top seller
                    $listTopSell = $product->getTopSell(); //lay 5 san pham
                    foreach ($listTopSell as $r) {
                        $listImg = $product->getImg($r['id']);
                    ?>
                        <div class="single-wid-product">
                            <a href="single-product.php"><img src="<?php echo 'admin/product/uploads/' . $listImg[0]['img'] ?>" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.php"><?php echo $r['name'] ?></a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins>
                                <ins>Đã bán <?php echo $r['selled'] ?></ins>
                                <!-- <del>$425.00</del> -->
                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Recently Viewed</h2>
                    <a href="#" class="wid-view-more">View All</a>
                    <?php
                    //get product top seller
                    $listTopSell = $product->getTopSell();
                    foreach ($listTopSell as $r) {
                        $listImg = $product->getImg($r['id']);
                    ?>
                        <div class="single-wid-product">
                            <a href="single-product.php"><img src="<?php echo 'admin/product/uploads/' . $listImg[0]['img'] ?>" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.php"><?php echo $r['name'] ?></a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins>
                                <!-- <del>$425.00</del> -->
                            </div>
                        </div>

                    <?php } ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Top New</h2>
                    <a href="#" class="wid-view-more">View All</a>

                    <?php
                    //get product top seller
                    $listTopSell = $product->getTopNew();
                    foreach ($listTopSell as $r) {
                        $listImg = $product->getImg($r['id']);
                    ?>
                        <div class="single-wid-product">
                            <a href="single-product.php"><img src="<?php echo 'admin/product/uploads/' . $listImg[0]['img'] ?>" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.php"><?php echo $r['name'] ?></a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins>
                                <ins><?php echo  $r['time_add'] ?></ins>
                                <!-- <del>$425.00</del> -->
                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>