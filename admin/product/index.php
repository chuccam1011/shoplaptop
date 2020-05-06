<?php
require_once('./../commons/head.php');
require_once('./../../models/products.php');
require_once('./../../models/cate.php');
require_once('./../../models/brand.php');
require_once('./../../db.php');
$products = new Product();
$cate = new Cate();
$brand = new Brand();
$pdo = new DB();
$pdo = $pdo->getPDO();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'delete':
            if (is_numeric($_GET['id'])) {
                $products->delete($_GET['id']);
            }
            break;

        default:
            # code...
            break;
    }
}
try {
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $count = 10;
    $offset = ($page - 1) * $count;
    $list = $products->getAll($offset, $count);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<body>
    <?php
    require_once('./../commons/nav_menu.php');
    ?>


    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Thương hiệu</th>
                    <!-- <th scope="col">Thể loại</th> -->
                    <th scope="col">Giá</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">CPU</th>
                    <th scope="col">RAM</th>
                    <th scope="col">Card đồ họa</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <br>
            <a class="btn btn-primary" href="add.php">Thêm</a>
            <br>
            <br>
            <tbody>
                <?php
                foreach ($list as $r) {
                    $listImg = $products->getImg($r['id']);
                ?>
                    <tr>
                        <td><?php echo $r['id'] ?></td>
                        <td><img height="50px" width="50px" src="<?php echo 'uploads/' . $listImg[0]['img'] ?>" alt=""></td>
                        <td><?php echo $r['name'] ?></td>
                        <?php
                        $obj = $brand->getBrandById($r['brand_id']);
                        ?>  
                        <td><?php echo $obj['name'] ?></td>
                     
                        <td><?php echo number_format($r['price']). ' VND'?></td>
                        <td><?php echo $r['short_desc'] ?></td>
                        <td><?php echo $r['chip'] ?></td>
                        <td><?php echo $r['ram']  ?></td>
                        <td><?php echo $r['card'] ?></td>
                        <td>
                            <a class="btn btn-danger" href="?action=delete&id=<?php echo $r['id']; ?>">Xoá</a>
                            <a class="btn btn-warning" href="edit.php?id=<?php echo $r['id'] ?>">Xem-Sửa</a>
                        </td>
                    </tr>
                <?php
                }

                ?>
            </tbody>
        </table>
        <?php
        //tinh tổng số bản ghi
        $row = $pdo->query('select count(*) as count from product');
        foreach ($row as $r) {
            $allRows = $r['count'];
        }
        $page = ceil($allRows / $count); //11/5 = 2.2 xấp xỉ 3 -> 2 trang
        for ($i = 0; $i < $page; $i++) {
            $pageCount = $i + 1;
            echo ' <button> <a href="?page=' . $pageCount . '">' . $pageCount . '</a></button>';
        }
        ?>
    </div>

</body>
<?php
require_once('./../commons/footer.php');
?>