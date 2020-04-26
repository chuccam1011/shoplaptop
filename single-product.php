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
                    <?php $listImg = $product->getImg($productSingle['id']);
                    ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="product-images">
                                <div class="product-main-img">
                                    <?php
                                    $src = null;
                                    if (count($listImg) != 0) $src = 'admin/product/uploads/' . $listImg[0]['img'];
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
                                    <!-- <ins><?php echo number_format($productSingle['price']) . ' VND' ?></ins> -->
                                    <ins><?php $sellprice = $productSingle['price'] * (100 - $productSingle['discount']) / 100;
                                            echo number_format($sellprice). ' VND' ?></ins>
                                    <del><?php if ($sellprice != $productSingle['price']) echo number_format($productSingle['price']). ' VND' ?></del>
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
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Thông số kỹ thuật</a></li>
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
                                            <table class="table table-striped table-inverse table-responsive">

                                                <tbody>
                                                    <tr>
                                                        <td scope="row">Model</td>
                                                        <td><?php echo $productSingle['model'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">CPU</td>
                                                        <td><?php echo $productSingle['chip'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">VGA</td>
                                                        <td><?php echo $productSingle['card'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Tình trạng máy</td>
                                                        <td><?php if ($productSingle['status'] == 0) echo 'Máy mới';
                                                            else echo 'Máy cũ' ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">RAM</td>
                                                        <td><?php echo $productSingle['ram'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Ổ đĩa</td>
                                                        <td><?php echo $productSingle['drive'] ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td scope="row">Màn hình</td>
                                                        <td><?php echo $productSingle['display'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Kết nối</td>
                                                        <td><?php echo $productSingle['connect'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Vân tay</td>
                                                        <td><?php if ($productSingle['vantay'] == 0) echo 'Có';
                                                            else echo 'Không' ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">HDH</td>
                                                        <td><?php echo $productSingle['operation'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Pin</td>
                                                        <td><?php echo $productSingle['pin'] . ' cell' ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Trọng lượng</td>
                                                        <td><?php echo $productSingle['weight'] . ' kg' ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Kích thước</td>
                                                        <td><?php echo $productSingle['size'] . ' cm' ?></td>
                                                    </tr>
                                                    <!-- <tr>
                                                        <td scope="row">Đã bán</td>
                                                        <td><?php echo $productSingle['selled'] ?></td>
                                                    </tr> -->
                                                </tbody>
                                            </table>
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