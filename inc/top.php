<?php
//cart in session
//unset($_SESSION['cart']);
if (isset($_GET['add-to-cart'])) {
    //  var_dump($_GET);
    $id = $_GET['add-to-cart'];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
        $flag = false;
        //tăng số luợng sp nếu đã có sp này trong giỏ hàng
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['id'] == $id) {
                $cart[$i]['quantity'] = $cart[$i]['quantity'] + 1;
                $flag = true; //da ton tai mot cai san pham có id như vay trong gio hang
                break;
            }
        }

        // thêm mới sp vào giỏ hàng
        if ($flag == false) {
            $products = new Product();
            $product = $products->getProductById($id);
            $item = array(
                'id' => $product['id'],
                'name' => $product['name'],
                'quantity' => 1,
                'price' => $product['price']
            );
            array_push($cart, $item);
        }
        $_SESSION['cart'] = $cart;
    } else {
        // đẩy sp vào giỏ hàng
        $products = new Product();
        $product = $products->getProductById($id);
        $item = array(
            'id' => $product['id'],
            'name' => $product['name'],
            'quantity' => 1,
            'price' => $product['price']
        );
        $cart = array($item);
        $_SESSION['cart'] = $cart;
    }
    //  var_dump($_SESSION['cart']);
}
$cart = $_SESSION['cart'];

$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<body>
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            <li><img height="20px" width="20px" src="" alt=""><?php echo 'Xin Chào!  ' . $_SESSION['user_login'] ?></li>
                            <li><a href="profileuser.php"><i class="fa fa-user"></i>Tài khoản của tôi </a></li>

                            <li><a href="orders.php"><i class="fa fa-shopping-cart"></i>Đơn Hàng</a></li>
                            <li><a href="cart.php"><i class="fa fa-shopping-cart"></i>Giỏ Hàng</a></li>
                            <li><a href="checkout.php"><i class="fa fa-check"></i> Checkout</a></li>
                            <!-- <li><a href="login.php"><i class="fa fa-user"></i> Đăng Nhập</a></li> -->
                            <li><a href="?logout=true"><i class=""></i> Đăng xuất</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div> <!-- End header area -->

    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="./"><img src="img/logo.png"></a></h1>
                    </div>

                </div>

                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="cart.php">Cart - <span class="cart-amunt"><?php echo number_format($total) . ' đ'; ?></span>
                            <i class="fa fa-shopping-cart"></i> <span class="product-count"><?php echo count($cart); ?></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->

    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <!-- <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                </div> -->
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="shop.php">Tất cả sản phẩm</a></li>
                        <li><a href="category.php">Danh Mục Sản Phẩm</a></li>
                        <li><a href="brand.php">Hãng Sản Xuất</a></li>
                        <li><a href="#">Linh Kiện</a></li>
                        <!-- <li>
                            <form style="margin-top: 10px" action="search.php" method="get">
                                <input type="text" name="search_key" id="" required>
                                <input type="submit" name="search" value="Tìm Kiếm">
                            </form>
                        </li> -->
                        <li>
                            <form action="search.php" method="get" style="margin-top: 10px" class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="search" name="search_key" placeholder="Nhap tu khoa.." aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" name="" type="submit">Tìm Kiếm</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End mainmenu area -->