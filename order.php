

<?php
	include('inc/header.php');
	// include('inc/slider.php');
 ?>
 
 <?php
	
	$login_check = Session::get('customer_login');
	if($login_check==false){
		header('Location:login.php');
	}
?>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                
                <h2 class="not_found" style="color: #228B22; width:100%;">Bạn đã đăng nhập thành công</h2>
               
            </div>
        </div>

    </div>
</div>

<?php
	include('inc/footer.php');
	
 ?>