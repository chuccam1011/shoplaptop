<?php
include_once("inc/head.php");
include_once("inc/top.php");
?>
<?php
$product = new Product();
if (isset($_GET['product_id'])) {
    $id = $_GET['product_id'];
    $productSingle = $product->getProductById($id);
    $cate = new Cate();
    $cateSingle = $cate->getCateById($productSingle['cate_id']);
    //  var_dump($cateSingle);
} else {
    //header('Location:http://localhost/laptopcu');
}

?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shop</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?php include_once('inc/singleSlidebar.php') ?>
            </div>
            <!-- ./ end sidebar -->
            <!-- MAin details -->
            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="product-breadcroumb">
                        <a href="index.php">Home</a>
                        <a href=""><?php echo $cateSingle['name'] ?></a>
                        <a href=""><?php echo $productSingle['name'] ?></a>
                    </div>
                    <?php $listImg = $product->getImg($productSingle['id']); ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="product-images">
                                <div class="product-main-img">
                                    <?php
                                    $src = 'admin/product/uploads/' . $listImg[0]['img'];
                                    if (isset($_GET['img'])) {
                                        $src = 'admin/product/uploads/' . $_GET['img'];
                                        echo '<img height="800px" width="1000px" src="' . $src . '" alt="">';
                                    } else {
                                        echo '<img height="800px" width="1000px" src="' . $src . '" alt="">';
                                    }
                                    ?>
                                </div>
                                <div class="product-gallery">
                                    <?php
                                    foreach ($listImg as $r) {
                                    ?>
                                        <a href="?product_id=<?php echo $id ?>&&img=<?php echo  $r['img'] ?>">
                                            <img src="<?php echo 'admin/product/uploads/' . $r['img'] ?>" alt=""></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="product-inner">
                                <h2 class="product-name"><?php echo $productSingle['name'] ?></h2>
                                <div class="product-inner-price">
                                    <ins><?php echo number_format($productSingle['price']) . ' VND' ?></ins>
                                    <!-- <del>$100.00</del> -->
                                </div>

                                <form action="" class="cart">
                                    <div class="quantity">
                                        <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                    </div>
                                    <button class="add_to_cart_button" type="submit">Add to cart</button>
                                </form>

                                <div class="product-inner-category">
                                    <!-- <p>Category: <a href=""><?php  ?></a>. -->
                                    Keyword: <a href="?seach=<?php echo $productSingle['keyword'] ?> "><?php echo $productSingle['keyword'] ?></a>
                                </div>

                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                            <h2><?php echo $productSingle['short_desc'] ?></h2>
                                            <h2><b>Đặc Điểm Nổi Bật</b></h2>
                                            <hr>
                                            <?php // layu noi dung chi tiet ve lap top theo id san pham
                                            $contents = $product->getContentProduct($id);
                                            foreach ($contents as  $r) { ?>
                                                <h3><?php echo $r['title'] ?></h3>
                                                <img height="300px" width="400px" src="<?php echo 'admin/product/uploads/' . $r['img'] ?> " alt="">
                                                <p><?php echo $r['content'] ?></p>
                                                <hr>
                                            <?php } ?>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="profile">
                                            <h2>Reviews</h2>
                                            <div class="submit-review">
                                                <p><label for="name">Name</label> <input name="name" type="text"></p>
                                                <p><label for="email">Email</label> <input name="email" type="email"></p>
                                                <div class="rating-chooser">
                                                    <p>Your rating</p>
                                                    <div class="rating-wrap-post">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                <p><input type="submit" value="Submit"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <?php
                    include_once("inc/related.php")
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once("inc/footer.php");
?>