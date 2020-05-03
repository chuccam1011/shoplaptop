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
                    <!-- <a href="" class="wid-view-more">View All</a> -->
                    <?php
                    //get product top seller
                    $listTopSell = $product->getTopSell(); //lay 5 san pham
                    foreach ($listTopSell as $r) {
                        $listImg = $product->getImg($r['id']);
                    ?>
                        <div class="single-wid-product">
                            <a href="single-product.php?product_id=<?php echo $r['id'] ?>"><img src="<?php echo 'admin/product/uploads/' . $listImg[0]['img'] ?>" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.php?product_id=<?php echo $r['id'] ?>"><?php echo $r['name'] ?></a></h2>
                            <div class="product-wid-rating">
                                <ins>Đã bán <?php echo $r['selled'] ?></ins>
                            </div>
                            <div class="product-wid-price">
                                <ins><?php $sellprice = $r['price'] * (100 - $r['discount']) / 100;
                                        echo number_format($sellprice) ?></ins>
                                <del><?php if ($sellprice != $r['price']) echo number_format($r['price']) ?></del>

                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Top Views</h2>
                    <!-- <a href="" class="wid-view-more">View All</a> -->
                    <?php
                    //get product top seller
                    $listTopSell = $product->getTopSell();
                    foreach ($listTopSell as $r) {
                        $listImg = $product->getImg($r['id']);
                    ?>
                        <div class="single-wid-product">
                            <a href="single-product.php?product_id=<?php echo $r['id'] ?>"><img src="<?php echo 'admin/product/uploads/' . $listImg[0]['img'] ?>" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.php?product_id=<?php echo $r['id'] ?>"><?php echo $r['name'] ?></a></h2>

                            <div class="product-wid-price">
                                <ins><?php $sellprice = $r['price'] * (100 - $r['discount']) / 100;
                                        echo number_format($sellprice) ?></ins>
                                <del><?php if ($sellprice != $r['price']) echo number_format($r['price']) ?></del>
                                <!-- <del>$425.00</del> -->
                            </div>
                        </div>

                    <?php } ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Top New</h2>
                    <!-- <a href="#" class="wid-view-more">View All</a> -->

                    <?php
                    //get product top seller
                    $listTopSell = $product->getTopNew();
                    foreach ($listTopSell as $r) {
                        $listImg = $product->getImg($r['id']);
                    ?>
                        <div class="single-wid-product">
                            <a href="single-product.php?product_id=<?php echo $r['id'] ?>"><img src="<?php echo 'admin/product/uploads/' . $listImg[0]['img'] ?>" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.php?product_id=<?php echo $r['id'] ?>"><?php echo $r['name'] ?></a></h2>

                            <div class="product-wid-price">
                                <ins><?php $sellprice = $r['price'] * (100 - $r['discount']) / 100;
                                        echo number_format($sellprice) ?></ins>
                                <del><?php if ($sellprice != $r['price']) echo number_format($r['price']) ?></del><br>
                                <ins><?php echo  $r['time_add'] ?></ins>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>