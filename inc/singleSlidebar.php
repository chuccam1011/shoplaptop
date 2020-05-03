<div class="single-sidebar">
    <h2 class="sidebar-title">Tìm kiếm sản phẩm</h2>
    <form method="get" action="search.php">
        <input type="text" name="search_key" placeholder="Nhập tên sản phẩm ...." required>
        <input type="submit" name="search" value="Search">
    </form>
</div>

<div class="single-sidebar">
    <h2 class="sidebar-title">Products New</h2>
    <ul>

        <?php
        //get product top new
        $listTopSell = $product->getTopNew(); // lay 5 sp trong DB
        foreach ($listTopSell as $r) {
            $listImg = $product->getImg($r['id']);
        ?>
            <div class="single-wid-product">
                <a href="single-product.php?product_id=<?php echo $r['id'] ?>"><img src="<?php echo 'admin/product/uploads/' . $listImg[0]['img'] ?>" alt="" class="product-thumb"></a>
                <h2><a href="single-product.php?product_id=<?php echo $r['id'] ?>"><?php echo $r['name'] ?></a></h2>

                <div class="product-wid-price">
                    <ins><?php $sellprice = $r['price'] * (100 - $r['discount']) / 100;
                            echo number_format($sellprice) . ' VND' ?></ins>
                    <del><?php if ($sellprice != $r['price']) echo number_format($r['price']) ?></del><br>
                    <ins><?php echo  date("d/m/Y", strtotime($r['time_add'])); ?></ins>
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
                <a href="single-product.php?product_id=<?php echo $r['id'] ?>"><img src="<?php echo 'admin/product/uploads/' . $listImg[0]['img'] ?>" alt="" class="product-thumb"></a>
                <h2><a href="single-product.php?product_id=<?php echo $r['id'] ?>"><?php echo $r['name'] ?></a></h2>
                <!-- <div class="product-wid-rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div> -->
                <div class="product-wid-price">
                    <ins><?php $sellprice = $r['price'] * (100 - $r['discount']) / 100;
                            echo number_format($sellprice) . ' VND' ?></ins>
                    <del><?php if ($sellprice != $r['price']) echo number_format($r['price']) ?></del><br>
                    <ins><?php echo  date("d/m/Y", strtotime($r['time_add'])); ?></ins>

                </div>
            </div>

        <?php } ?>
    </ul>
</div>