<?php
include('inc/header.php');

?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
} 
?>
<?php
// if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {

// 	echo "<script>window.location = '404.php'</script>";
// } else {
// 	$id = $_GET['proid'];
// }
$id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
	
	 $updateCustomer = $cat->update_customer($_POST,$id);
}
?>

<div class="main">
    <div class="content">
        <div class="section group">
        <div class="content_top">
    		<div class="heading">
    		<h3>Chỉnh sửa thông tin cá nhân </h3>
    		</div>
    		<div class="clear"></div>
    	</div>
           <form action="" method="post">
            <table class="tblone">
                <tr>
                    
                        <?php 
                            if(isset($updateCustomer)){
                                echo '<td colspan="3">'.$updateCustomer.'</td>';
                            }
                        ?>
                    
                </tr>
                <?php 
                $id = Session::get('customer_id');
                    $get_customers = $cat->show_customer($id);
                    if($get_customers){
                        while($result = $get_customers->fetch_assoc()){

                        
                ?>
                <tr>
                    <td>Họ và tên</td>
                    <td>:</td>
                    <td><input style="color: black; padding: 3px 5px;font-weight: 600;width:50%;" type="text" name="name" value="<?php echo $result['name'] ?>"> </td>
                    
                </tr>
                <tr>
                    <td>Thành phố hoặc tỉnh</td>
                    <td>:</td>
                    <td><input style="color: black; padding: 3px 5px;font-weight: 600; width:50%;" type="text" name="city" value="<?php echo $result['city'] ?>"> </td>
                    
                </tr>
                <tr>
                    <td>Mã thành phố hoặc tỉnh</td>
                    <td>:</td>
                    <td><input style="color: black; padding: 3px 5px;font-weight: 600;width:50%;" type="text" name="zipcode" value="<?php echo $result['zipcode'] ?>"> </td>
                    
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td>:</td>
                    <td><input style="color: black; padding: 3px 5px;font-weight: 600;width:50%;" type="text" name="address" value="<?php echo $result['address'] ?>"> </td>
                    
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><input style="color: black; padding: 3px 5px;font-weight: 600;width:50%;" type="email" name="email" value="<?php echo $result['email'] ?>"> </td>
                    
                </tr>
                <tr>
                    <td>Số điện thoại</td>
                    <td>:</td>
                    <td><input style="color: black; padding: 3px 5px;font-weight: 600;width:50%;" type="number" name="phone" value="<?php echo $result['phone'] ?>"> </td>
                    
                </tr>
                <tr>
                    <td colspan="3"><button type="submit" name="save" >Lưu Thông tin cá nhân</button></td>
                    
                </tr>
               
                <?php }
                    } ?>
            </table>
            </form>
        </div>
    </div>
</div>
<?php
include('inc/footer.php');

?>