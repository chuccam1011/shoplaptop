<?php
$product = new Product();
$list = $product->getAll(0, 10);
?>

<div class="related-products-wrapper">
    <h2 class="related-products-title">Related Products</h2>
    <div class="related-products-carousel">
        <?php
        foreach ($list as $relatedProduct) {
            $listImg = $product->getImg($relatedProduct['id']);
        ?>
            <div class="single-product">
                <div class="product-f-image">
                    <img src="<?php echo 'admin/product/uploads/' . $listImg[0]['img'] ?>" alt="">
                    <div class="product-hover">
                        <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                        <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                    </div>
                </div>

                <h2><a href=""><?php echo $relatedProduct['name'] ?></a></h2>

                <div class="product-carousel-price">
                    <ins><?php
                            $sellprice = $relatedProduct['price'] * (100 - $relatedProduct['discount']) / 100;
                            echo number_format($sellprice) ?></ins>
                    <del><?php if ($sellprice != $relatedProduct['price']) echo number_format($relatedProduct['price']) ?></del>
                </div>
            </div>
        <?php } ?>
    </div>
</div>