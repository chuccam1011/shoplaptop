<?php
$product = new Product();
$cate = new Cate();
$cateList = $cate->getAllNoLimit();
foreach ($cateList as $category) { ?>
    <?php $listBycate = $cate->getProductByCate($category['id']); ?>
    <div class="latest-product">
        <!-- <h2 class="section-title">Latest Products</h2> -->
        <a href="productByCategory.php?cate=<?php echo $category['id'];?>">
            <h2 class="section-title"><?php echo $category['name']; ?></h2>
        </a>
        <div class="product-carousel">
            <?php
            foreach ($listBycate as $relatedProduct) {
                $listImg = $product->getImg($relatedProduct['id']);
            ?>
                <div class="single-product">
                    <div class="product-f-image">
                        <img src="<?php echo 'admin/product/uploads/' . $listImg[0]['img'] ?>" alt="">
                        <div class="product-hover">
                            <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                            <a href="single-product.php?product_id=<?php echo $relatedProduct['id'] ?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                        </div>
                    </div>

                    <h2><a href="single-product.php?product_id=<?php echo $relatedProduct['id'] ?>"><?php echo $relatedProduct['name'] ?></a></h2>

                    <div class="product-carousel-price">
                        <ins><?php
                                $sellprice = $relatedProduct['price'] * (100 - $relatedProduct['discount']) / 100;
                                echo number_format($sellprice).' VND' ?></ins>
                        <del><?php if ($sellprice != $relatedProduct['price']) echo number_format($relatedProduct['price']).' VND' ?></del>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

<?php } ?>