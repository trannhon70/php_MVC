<?php
include('inc/header.php');

?>
<?php

$login_check = Session::get('customer_login');
if ($login_check) {
	header('Location:order.php');
}
?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$insertCustomers = $cat->insert_customers($_POST);
}
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
	$loginCustomers = $cat->login_customers($_POST);
}
?>

<div class="main">
	<div class="content">
		<div class="login_panel">
			<h3>Đăng nhập</h3>
			<?php
			if (isset($loginCustomers)) {
				echo $loginCustomers;
			}
			?>
			<form class="form-group" action="" method="POST">
				<input class="form-control" type="email" style="width: 93%;padding: 7px;margin-top: 5px;" name="email" type="email" placeholder="email" class="field" o>
				<input class="form-control" name="password" type="password" placeholder="password" class="field">


				<div class="buttons">
					<div><button class="grey" type="submit" name="login">Đăng nhập</button></div>
				</div>
			</form>
		</div>




		<div class="register_account" style="height: auto;">
			<h3>Đăng ký tài khoản mới</h3>
			<?php
			if (isset($insertCustomers)) {
				echo $insertCustomers;
			}
			?>
			<form action="" method="POST">
				<table class="table">
					<div class="row">
						<div class="col-12 col-lg-6">
							<input class="form-control col-12 " type="text" name="name" placeholder="Họ và tên">
						</div>

						<div class="col-12 col-lg-6">
							<input class="form-control col-12 " type="text" name="city" placeholder="Thành phố hoặc tỉnh">
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-lg-6">
							<input class="form-control col-12" type="text" name="zipcode" placeholder="mã thành phố ">
						</div>
						<div class="col-12 col-lg-6">
							<input class="form-control col-12" style="width: 342px;padding: 7px;margin-top: 5px;" type="email" name="email" placeholder="email">
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-lg-6">
							<input class="form-control col-12" type="text" name="address" placeholder="địa chỉ">
						</div>
						<div class="col-12 col-lg-6">
							<select class="form-control col-12" id="country" name="country" class="frm-field required">
								<option class="form-control col-12" value="null">Chọn quốc gia</option>
								<option class="form-control col-12" value="vn">Việt Nam</option>

							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-lg-6">
							<input class="form-control col-12" type="text" name="phone" placeholder="số điện thoại">
						</div>

						<div class="col-12 col-lg-6">
							<input class="form-control col-12" type="password" style="width: 342px;padding: 7px;margin-top: 5px;" name="password" placeholder="mật khẩu">
						</div>
					</div>

				</table>
				<div class="search">
					<div><button type="submit" name="submit" class="grey">Tạo tài khoản</button></div>
				</div>

				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
include('inc/footer.php');

?>