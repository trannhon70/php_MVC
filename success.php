<?php
include('inc/header.php');

?>
<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $customer_id = Session::get('customer_id');
    $insertOrder = $cat->insertOrder($customer_id);

    // //khi đặt hàng thành công sẽ xóa tất cả giỏ hàng của user
    // $delCart = $cat->del_all_data_cart();
    // header('Location:success.php');
}
?>
<style type="text/css">
    .success_order{
        text-align: center;
        color: #228B22;
    }
    p.success_note {
    text-align: center;
    padding: 8px;
    font-size: 17px;
}
</style>
<form action="" method="post">
    <div class="main">
        <div class="content">
            <div class="section group">
                <h2 class="success_order">Đặt hàng thành công </h2>
                <?php
                  $customer_id = Session::get('customer_id');
                    $get_amount = $cat->getAmountPrice($customer_id);
                    if($get_amount){
                        $amount=0;
                        while($result = $get_amount->fetch_assoc()){
                            $price = $result['price'];
                            $amount += $price;
                        }
                    }

                ?>
                <p class="success_note">Tổng số tiền mà bạn đã đặt mua sản phẩm của website chúng tôi trong thời gian vừa qua là : <?php $vat = $amount * 0.1; 
                    $total = $vat + $amount;
                    echo number_format($total).' VNĐ';
                ?> </p>
                <p class="success_note">Chúng tối sẽ liên lạc với bạn sớm nhất có thể. bạn có thể xem lại đơn hàng của mình <a href="orderdetails.php">xem lại đơn hàng</a></p>
            </div>
        </div>

    </div>
</form>
<?php
include('inc/footer.php');

?>