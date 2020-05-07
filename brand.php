<?php
include_once("inc/head.php");
include_once("inc/top.php");
?>
<?php
$products = new Product();
$brands = new Brand();
//get  list  brnad
$brandsList = $brands->getAllnoLimit();
$list = array();
//get  list  products by category
if (isset($_GET['brand_id'])) {
    $brand_id = $_GET['brand_id'];
    $list = $brands->getProduct($brand_id);
    // var_dump($list);
}



?>
<div class="container">
    <div class="col-md-2">
        <!-- list brands -->
        <ul>
            <?php foreach ($brandsList as $brand) { ?>
                <li ><a  href="?brand_id=<?php echo $brand['id']; ?>"><?php echo $brand['name']; ?></a></li>
            <?php } ?>
        </ul>
    </div>

    <div class="col-md-10">
        <!-- list  products -->
        <?php if ($list == NULL) echo '<div class="alert alert-primary" role="alert">Không có sản phẩm nào</div>' ?>
        <?php foreach ($list as $product) { ?>
            <?php $listImg = $products->getImg($product['id']); ?>
            <div class="col-md-3 col-sm-6">
                <div class="single-shop-product">
                    <div class="product-upper">
                        <img height="250px" width="300px" src="<?php echo 'admin/product/uploads/' . $listImg[1]['img'] ?>" alt="<?php echo $product['name'] ?>">
                    </div>
                    <h2><a href="single-product.php?product_id=<?php echo $product['id']; ?>"><?php echo $product['name'] ?></a></h2>
                    <div class="product-carousel-price">
                        <ins><?php $sellprice = $product['price'] * (100 - $product['discount']) / 100;
                                echo number_format($sellprice) . ' VND' ?></ins>
                        <del><?php if ($sellprice != $product['price']) echo number_format($product['price']) . ' VND' ?></del>
                    </div>
                    <div class="product-option-shop">
                        <a class="add_to_cart_button" data-quantity="1" rel="nofollow" href="?cate=<?php echo $id ?>&&add-to-cart=<?php echo $product['id'] ?>">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>

        <?php  } ?>

    </div>

</div>

</div>

<?php
include_once("inc/footer.php")
?>