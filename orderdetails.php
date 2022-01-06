<?php
include('inc/header.php');

?>
<?php
    $login_check = Session::get('customer_login');
    if ($login_check == false) {
        header('Location:login.php');
    }

    $cat = new category();
    if(isset($_GET['confirmid']) ){
        $id = $_GET['confirmid'];
        $time = $_GET['time'];
        $price = $_GET['price'];
        $shifted_confirm = $cat->shifted_confirm($id,$time,$price);
    }
    if(isset($_GET['delid']) ){
        $id = $_GET['delid'];
        $time = $_GET['time'];
        $price = $_GET['price'];
        $del_shifted = $cat->del_shifted($id,$time,$price);
    }
?>
<?php
// if (isset($_GET['cartid'])) {
//     $cartid = $_GET['cartid'];
//     $delcart = $cat->del_product_cart($cartid);
// }
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
//     $cartid = $_POST['cartid'];
//     $quantity = $_POST['quantity'];
//     $update_quantity_cart = $cat->update_quantity_cart($quantity, $cartid);
//     if ($quantity <= 0) {
//         $delcart = $cat->del_product_cart($cartid);
//     }
// }
?>
<style type="text/css">
    .box_left {
        width: 100%;
        border: 1px solid #666;

        padding: 4px;

    }
</style>
<form action="" method="post">
    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="heading">
                    <h3>Thanh toán khi nhận hàng</h3>
                </div>
                <div class="clear"></div>
                <div class="box_left">
                    <div class="cartpage">
                        <h2 style="width:100%;">Đơn hàng của bạn</h2>
                        <?php
                        if (isset($update_quantity_cart)) {
                            echo $update_quantity_cart;
                        }
                        ?>
                        <?php
                        if (isset($delcart)) {
                            echo $delcart;
                        }
                        ?>
                        <table class="tblone">
                            <tr>
                                <th width="5%">STT</th>
                                <th width="15%">Tên sản phẩm</th>
                                <th width="10%">Hình ảnh</th>
                                <th width="20%">Giá</th>
                                <th width="10%">Số lượng</th>
                                <th width="10%">Thành tiền</th>
                                <th width="15%">Tình trạng</th>
                                <th width="15%">Ngày đặt</th>
                                <th width="10%">Thao tác</th>

                            </tr>
                            <?php
                            $customer_id = Session::get('customer_id');
                            $get_cart_ordered = $cat->get_cart_ordered($customer_id);
                            if ($get_cart_ordered) {
                                $subtotal = 0;
                                $qty = 0;
                                $i = 0;
                                while ($result = $get_cart_ordered->fetch_assoc()) {
                                    $i++;
                            ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $result['productName'] ?></td>
                                        <td><img src="admin/uploads/<?php echo $result['hinhanh'] ?>" alt="" /></td>

                                        <td><?php echo number_format($result['price']) . " " . "VNĐ" ?></td>
                                        <td>
                                            <?php echo $result['quantity'] ?>
                                        </td>
                                        <td><?php $total = $result['price'] * $result['quantity'];
                                            echo number_format($total) . " " . "VNĐ" ?></td>
                                        <td>
                                        <?php
                                        if($result['status']=='0'){
                                            echo 'Chờ xử lý';
                                        }elseif($result['status']==1){ 
                                        ?>
                                            <!-- <span>Đang vận chuyển</span> -->
                                            <a href="?confirmid=<?php echo $customer_id ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Đã nhận hàng</a>
                                        <?php
                                        }elseif($result['status']==2){
                                            echo 'Đã thanh toán';
                                        }

									 ?>
                                        </td>
                                        <td><?php echo $fm->formatDate($result['date_order']) ?></td>
                                        <!-- <td><a onclick="return confirm('bạn có chắc là bạn muốn xóa sản phẩm <?php echo $result['productName']; ?>')" href="?cartid=<?php echo $result['id'] ?>">Xóa</a></td> -->
                                        <?php
                                        if ($result['status'] == '0') {
                                        ?>
                                            <td><?php echo 'N/A'; ?></td>
                                        <?php

                                        } elseif ($result['status'] == '1') {

                                        ?>
                                            <td><?php echo 'N/A'; ?></td>
                                        <?php
                                        } else {
                                        ?>
                                             <td><?php echo 'Confirmed'; ?></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                            <?php
                                }
                            } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
include('inc/footer.php');

?>