<?php
include_once("inc/head.php");
include_once("inc/top.php");
?>
<?php
// include_once('inc/filter.php');
$products = new Product();
$cates = new Cate();
//get  list  category
$cateslist = $cates->getAllnoLimit();
$listProducts = array();
$cate_ids = array();
//get  list  products by category

if (isset($_POST['cate_id'])) {
    $cate_ids = $_POST['cate_id'];
    // var_dump($cate_ids);
    $listProducts = $products->getListProductByCategorys($cate_ids, '');
    // var_dump($list);
}
function prinCheckCate($category, $cate_ids)
{   //neu  co id category_id trong danh  sach cate_Ids lay  ve tu POST in laf  checked
    foreach ($cate_ids as $cate_id) {
        if ($category == $cate_id) {
            echo 'checked';
        }
    }
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <!-- list category -->

            <ul>
                <form action="" method="post">
                    <?php foreach ($cateslist as $category) { ?>
                        <li>
                            <input <?php prinCheckCate($category['id'], $cate_ids) ?> type="checkbox" name="cate_id[]" value="<?php echo $category['id']; ?>">
                            <label for=""><?php echo $category['name']; ?></label>
                        </li>
                    <?php } ?>
                    <input type="submit" value="Lọc (Hoặc)">
                </form>
            </ul>
        </div>

        <div class="col-md-7">
            <!-- list  products -->
            <?php if ($listProducts == NULL) echo '<div class="alert alert-primary" role="alert">Không có sản phẩm nào</div>' ?>
            <?php foreach ($listProducts as $product) { ?>
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