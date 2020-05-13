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
<style>
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_asc_disabled:before,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:before {
        bottom: .5em;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2
    }

    th {
        cursor: pointer;
    }
</style>

<body>

    <?php
    require_once('./../commons/nav_menu.php');
    ?>
    <div class="container">
        <input class="form-control" id="myInput" type="text" placeholder="Search..">
        <p><strong>Click the headers to sort the table.</strong></p>
        <p>The first time you click, the sorting direction is ascending (A to Z).</p>
        <p>Click again, and the sorting direction will be descending (Z to A):</p>
    </div>


    <div class="container-fluid">
        <table id="myTableSort" class="table table-striped  table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th onclick="sortTable(0)" class="th-sm" scope="col">#</th>
                    <th onclick="sortTable()" class="th-sm" scope="col">Hình ảnh</th>
                    <th onclick="sortTable(2)" class="th-sm" scope="col">Tên</th>
                    <th onclick="sortTable(3)" class="th-sm" scope="col">Thương hiệu</th>
                    <th onclick="sortTable(4)" class="th-sm" scope="col">Giá</th>
                    <th onclick="sortTable(5)" class="th-sm" scope="col">Đã bán</th>
                    <th onclick="sortTable(6)" class="th-sm" scope="col">Kho hàng</th>
                    <th onclick="sortTable(7)" class="th-sm" scope="col">Mô tả</th>
                    <th onclick="sortTable(8)" class="th-sm" scope="col">CPU</th>
                    <th onclick="sortTable(9)" class="th-sm" scope="col">RAM</th>
                    <th onclick="sortTable(10)" class="th-sm" scope="col">Card đồ họa</th>
                    <th onclick="sortTable()" class="th-sm" scope="col">Thao tác</th>
                </tr>
            </thead>
            <br>
            <a class="btn btn-primary" href="add.php">Thêm</a>
            <br>
            <br>
            <tbody id="myTable">
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

                        <td><?php echo number_format($r['price']) . ' VND' ?></td>
                        <td><?php echo $r['selled'] ?></td>
                        <td><?php echo $r['quantity_product'] ?></td>

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
    <script>
        $(document).ready(function() {
            // Filter on the table

            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

        });
        //sort data table
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("myTableSort");
            switching = true;
            //Set the sorting direction to ascending:
            dir = "asc";
            /*Make a loop that will continue until
            no switching has been done:*/
            while (switching) {
                //start by saying: no switching is done:
                switching = false;
                rows = table.rows;
                /*Loop through all table rows (except the
                first, which contains table headers):*/
                for (i = 1; i < (rows.length - 1); i++) {
                    //start by saying there should be no switching:
                    shouldSwitch = false;
                    /*Get the two elements you want to compare,
                    one from current row and one from the next:*/
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    /*check if the two rows should switch place,
                    based on the direction, asc or desc:*/
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            //if so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            //if so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    /*If a switch has been marked, make the switch
                    and mark that a switch has been done:*/
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    //Each time a switch is done, increase this count by 1:
                    switchcount++;
                } else {
                    /*If no switching has been done AND the direction is "asc",
                    set the direction to "desc" and run the while loop again.*/
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>
</body>
<?php
require_once('./../commons/footer.php');
?>