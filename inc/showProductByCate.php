<?php
// hiện trên trang index
$product = new Product();
$cate = new Cate();
$cateList = $cate->getCateIndex();
foreach ($cateList as $category) { ?>
    <?php
    $listProducts = $product->getListProductByCategory($category['id']);
    ?>
    <div class="latest-product">
        <a href="productByCategory.php?cate=<?php echo $category['id']; ?>">
            <h2 class="section-title"><?php echo $category['name']; ?></h2>
        </a>
        <div class="product-carousel">
            <?php
            foreach ($listProducts as $r) {
                $listImg = $product->getImg($r['id']);
            ?>
                <div class="single-product">
                    <div class="product-f-image">
                        <img src="<?php echo 'admin/product/uploads/' . $listImg[0]['img'] ?>" alt="">
                        <div class="product-hover">
                            <a href="?add-to-cart=<?php echo $r['id'] ?>" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                        </div>
                    </div>

                    <h2><a href="single-product.php?product_id=<?php echo $r['id'] ?>"><?php echo $r['name'] ?></a></h2>

                    <div class="product-carousel-price">
                        <ins><?php
                                $sellprice = $r['price'] * (100 - $r['discount']) / 100;
                                echo number_format($sellprice) . ' VND' ?></ins>
                        <del><?php if ($sellprice != $r['price']) echo number_format($r['price']) . ' VND' ?></del>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

<?php } ?>