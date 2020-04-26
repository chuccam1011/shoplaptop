<div class="single-sidebar">
    <h2 class="sidebar-title">Search Products</h2>
    <form action="">
        <input type="text" placeholder="Search products...">
        <input type="submit" name="search" value="Search">
    </form>
</div>

<div class="single-sidebar">
    <h2 class="sidebar-title">Products New</h2>
    <ul>
        <!-- 
                    <div class="thubmnail-recent">
                        <img src="img/product-thumb-1.jpg" class="recent-thumb" alt="">
                        <h2><a href="">Sony Smart TV - 2015</a></h2>
                        <div class="product-sidebar-price">
                            <ins>$700.00</ins> <del>$100.00</del>
                        </div>
                    </div> -->
        <?php
        //get product top new
        $listTopSell = $product->getTopNew(); // lay 5 sp trong DB
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
                    <ins><?php echo number_format($r['price']), ' VND' ?></ins>
                    <ins><?php echo  $r['time_add'] ?></ins>
                    <!-- <del>$425.00</del> -->
                </div>
            </div>
        <?php } ?>
    </ul>
</div>

<div class="single-sidebar">
    <h2 class="sidebar-title">Recent Posts</h2>
    <ul>
        <?php
        //get product recnet post
        $listTopSell = $product->getTopNew(); // lay 5 sp trong DB
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
                    <ins><?php echo number_format($r['price']), ' VND' ?></ins>
                    <ins><?php echo  $r['time_add'] ?></ins>
                    <!-- <del>$425.00</del> -->
                </div>
            </div>

        <?php } ?>
    </ul>
</div>