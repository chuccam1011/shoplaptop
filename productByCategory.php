<?php
include_once("inc/head.php");
include_once("inc/top.php");
?>

<?php
// hient trên tràng này
// lay so trang der phan trang
$products = new Product();
$pdo = new DB();
$pdo = $pdo->getPDO();
$cates = new Cate();
if (isset($_GET['cate']) && is_numeric($_GET['cate'])) {
    $id = $_GET['cate'];
    $cate = $cates->getCateById($id);
    $list = $products->getListProductByCategory($id);
}
// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// try {
//     if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
//         $page = $_GET['page'];
//     } else {
//         $page = 1;
//     }
//     $count = 10;
//     $offset = ($page - 1) * $count;
//   
// } catch (PDOException $e) {
//     echo $e->getMessage();
// }
// // 

//
?>
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2><?php echo $cate['name'] ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
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

        <!-- <div class="row">
            <?php
            //lau so bnả ghi 
            $cate_id = $_GET['cate'];
            
            $pageTotal = ceil($allRows / $count); //11/5 = 2.2 xấp xỉ 3 -> 2 trang

            ?>
            <div class="col-m d-12">
                <div class="product-pagination text-center">
                    <nav>
                        <ul class="pagination">
                            <li>
                                <a href="?cate=<?php echo $id ?>&&page=<?php echo $page - 1; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $pageTotal; $i++) { ?>
                                <li><a href="?cate=<?php echo $id ?>&&page=<?php echo $i ?>">
                                        <?php if ($i == $page) {
                                            echo '<b class="pagenum">' . $i . '</b>';
                                        } else echo $i;  ?> </a>
                                </li>
                            <?php } ?>
                            <li>
                                <a href="?cate=<?php echo $id ?>&&page=<?php echo $page + 1; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div> -->
    </div>
</div>

<style>
    .pagenum {
        color: black
    }
</style>
<?php
include_once("inc/footer.php")
?>