<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php' ?>
<?php
if(!isset($_GET['customerid']) || $_GET['customerid']==NULL){
    echo "<script>window.location = 'inbox.php'</script>";
}
else{
    $id = $_GET['customerid'];
}
$cat = new category();

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thông tin khách hàng</h2>
               <div class="block copyblock"> 
               
                <?php 
                    $show_customer = $cat->show_customer($id);
                    if($show_customer){
                        while($result = $show_customer->fetch_assoc()){

                      
                ?>
                 <form action="" method="post" style="font-size: 16px;font-weight: 600;">
                    <table class="form ">					
                        <tr>
                            <td>Họ và tên</td>
                            <td>:</td>
                            <td><?php echo $result['name'] ?></td>
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
                            <td>Thành phố hoặc tỉnh</td>
                            <td>:</td>
                            <td><?php echo $result['city'] ?></td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td>:</td>
                            <td><?php echo $result['address'] ?></td>
                        </tr>
                    </table>
                    </form>
                <?php
                      }
                    }
                ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>