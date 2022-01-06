<?php
include('inc/header.php');

?>
<?php
if (isset($_GET['orderid']) && $_GET['orderid']=='order') {
    $customer_id = Session::get('customer_id');
    $insertOrder = $cat->insertOrder($customer_id);

    //khi đặt hàng thành công sẽ xóa tất cả giỏ hàng của user
    
    header('Location:success.php');
    $delCart = $cat->del_all_data_cart();
} 
?>
<style type="text/css">
    .box_left {
        width: 60%;
        border: 1px solid #666;
        float: left;
        padding: 4px;

    }

    .box_right {
        width: 37%;
        border: 1px solid #666;
        float: right;
        padding: 4px;
    }

    a.submit_order {
        background: #1d9731;
        padding: 7px 20px;
        color: #fff;
        font-size: 21px;
        
        cursor: pointer;
    }
    a.submit_order:hover {
        background: #11521b;
        padding: 7px 20px;
        color: #fff;
        font-size: 21px;
        
        cursor: pointer;
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
                    <!-- <h2 style="width:100%;">Giỏ hành của bạn</h2> -->
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
                            <th width="30%">Tên sản phẩm</th>
                            
                            <th width="25%">Giá</th>
                            <th width="15%">Số lượng</th>
                            <th width="25%">Thành tiền</th>
                           
                        </tr>
                        <?php
                        $get_product_cart = $cat->get_product_cart();
                        if ($get_product_cart) {
                            $subtotal = 0;
                            $qty = 0;
                            $i=0;
                            while ($result = $get_product_cart->fetch_assoc()) {
                                $i++;
                        ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $result['productName'] ?></td>
                                    
                                    <td><?php echo number_format($result['price']) . " " . "VNĐ" ?></td>
                                    <td>
                                    <?php echo $result['quantity'] ?>
                                    </td>
                                    <td><?php $total = $result['price'] * $result['quantity'];
                                        echo number_format($total) . " " . "VNĐ" ?></td>
                                   
                                </tr>

                        <?php $subtotal += $total;
                                $qty = $qty + $result['quantity'];
                            }
                        } ?>

                    </table>
                    <?php
                    $check_cart = $cat->check_cart();
                    if ($check_cart) {


                    ?>
                        <table style="float:right;text-align:left;" width="60%">
                            <!-- <tr>
                                <th>Tổng thu : </th>
                                <td><?php

                                    echo number_format($subtotal) . " " . "VNĐ";
                                    Session::set("sum", $subtotal);
                                    Session::set("qty", $qty);
                                    ?></td>
                            </tr>
                            <tr>
                                <th>VAT : </th>
                                <td>10%</td>
                            </tr> -->
                            <tr>
                                <th>Tổng số tiền phải thanh toán :</th>
                                <td><?php
                                    // $vat = $subtotal * 0.1;
                                    // $gtotal = $subtotal + $vat;
                                    echo number_format($subtotal) . " " . "VNĐ";
                                    ?></td>
                            </tr>
                        </table>
                    <?php } else {
                        echo "Giỏ hàng của bạn chưa có sản phẩm nào !";
                    } ?>
                </div>
            </div>
            <div class="box_right">
            <table class="tblone">
                <?php 
                $id = Session::get('customer_id');
                    $get_customers = $cat->show_customer($id);
                    if($get_customers){
                        while($result = $get_customers->fetch_assoc()){

                        
                ?>
                <tr>
                    <td>Họ và tên</td>
                    <td>:</td>
                    <td><?php echo $result['name'] ?></td>
                </tr>
                <tr>
                    <td>Thành phố hoặc tỉnh</td>
                    <td>:</td>
                    <td><?php echo $result['city'] ?></td>
                </tr>
                <tr>
                    <td>Mã thành phố hoặc tỉnh</td>
                    <td>:</td>
                    <td><?php echo $result['zipcode'] ?></td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td>:</td>
                    <td><?php echo $result['address'] ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $result['email'] ?></td>
                </tr>
                <tr>
                    <td>Số điện thoại</td>
                    <td>:</td>
                    <td><?php echo $result['phone'] ?></td>
                </tr>
                <tr>
                    <td colspan="3"><a href="editprofile.php">Chỉnh sửa Thông tin cá nhân</a></td>
                    
                </tr>
               
                <?php }
                    } ?>
            </table>
            </div>
            
        </div>
    </div>
    <div style="width:100% ; text-align: center; margin-bottom: 20px;height: 40px;" >
        <a href="?orderid=order" class="submit_order">Đặt hàng</a>
    </div>
</div>
</form>
<?php
include('inc/footer.php');

?>