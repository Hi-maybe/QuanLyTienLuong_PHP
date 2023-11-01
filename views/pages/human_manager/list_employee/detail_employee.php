<?php $this->layout('layout_manager') ?>
<?php $this->section('content'); ?>
<style>
	.profile-left-container {
		margin-right: 30px;
	}

	ul li span {
		font-size: 30px !important;
	}

	img {
		width: 100%;
		height: 100%;
	}

	button,
	.btn {
		background-color: #007bff;
		color: #fff;
		padding: 10px 20px;
		border: none;
		cursor: pointer;
	}

	.modal button {
		background-color: #007bff;
		color: #fff;
		padding: 10px 20px;
		border: none;
		cursor: pointer;
	}

	.modal button:hover {
		background-color: #0056b3;
	}

	.card {
		height: 615px;

	}
	h6{
		font-size: 23px!important;
	}
	.hr{
		border: 1px solid!important;
		width: 100%;
		opacity: 0.25;
		margin: 15px 2px;
	}
</style>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
$maNV = $_GET['MaNV'];
$sqlNhanVien = "select * from nhan_vien, phong_ban,chuc_vu
	where nhan_vien.MaChucVu = chuc_vu.MaChucVu and nhan_vien.MaPhong= phong_ban.MaPhong AND nhan_vien.MaNV='$maNV'	 ";
$resultNhanVien = mysqli_query($conn, $sqlNhanVien);
$ttNV = mysqli_fetch_array($resultNhanVien);

if ($ttNV['GioiTinh'] == 0) $gt = "Nữ";
else $gt = "Nam";
?>

<body>
	<div class="container">
		<div class="main-body">
			<div class="row gutters-sm">
				<div class="col-md-4 mb-3">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center ">
								<img <?php echo "src='" .  '/' . explode('/', $_SERVER["PHP_SELF"])[1] . "/assets/images/imgnv/$ttNV[Hinh]" . "' alt='Avatar' " ?> class="rounded-circle" width="150">
								<div class="mt-3 p-2">
									<h1><?php echo "$ttNV[HoNV]     $ttNV[TenNV]"  ?></h1>
									<h3 class="text-secondary mb-1"><?php echo "$ttNV[TenChucVu]" ?></h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card mb-3">
						<div class="card-body">
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Mã nhân viên</h6>
								</div>
								<div class="col-sm-9 text-secondary " style="font-size: 18px;">
									<?php echo "$ttNV[MaNV]" ?>
								</div>
							</div>
							<div class="hr">	</div>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Phòng</h6>
								</div>
								<div class="col-sm-9 text-secondary " style="font-size: 18px;">
									<?php echo "$ttNV[TenPhong]" ?>
								</div>
							</div>
							<div class="hr">	</div>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Giới Tính</h6>
								</div>
								<div class="col-sm-9 text-secondary" style="font-size: 18px;">
								
									<?php echo "$gt " ?>
								</div>
							</div>
							<div class="hr">	</div>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Ngày Sinh</h6>
								</div>
								<div class="col-sm-9 text-secondary" style="font-size: 18px;">
									<?php echo "$ttNV[NgaySinh]" ?>
								</div>
							</div>
							<div class="hr">	</div>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Địa Chỉ</h6>
								</div>
								<div class="col-sm-9 text-secondary" style="font-size: 18px;">
									<?php echo "$ttNV[DiaChi]" ?>
								</div>
							</div>
							<div class="hr">	</div>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Số Tài Khoản</h6>
								</div>
								<div class="col-sm-9 text-secondary" style="font-size: 18px;">
									<?php echo "$ttNV[STK]" ?>
								</div>
							</div>
							<div class="hr">	</div>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">CMND</h6>
								</div>
								<div class="col-sm-9 text-secondary" style="font-size: 18px;">
									<?php echo "$ttNV[CCCD]" ?>
								</div>
							</div>
							<div class="hr">	</div>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Số điện thoại</h6>
								</div>
								<div class="col-sm-9 text-secondary" style="font-size: 18px;">
									<?php echo "$ttNV[SDT]" ?>
								</div>
							</div>
							<div class="hr">	</div>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Số con</h6>
								</div>
								<div class="col-sm-9 text-secondary" style="font-size: 18px;">
									<?php echo "$ttNV[SoCon]" ?>
								</div>
							</div>
							<div class="hr">	</div>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Hệ số lương</h6>
								</div>
								<div class="col-sm-9 text-secondary" style="font-size: 18px;">
									<?php echo "$ttNV[HeSoLuong]" ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            <div class='option-buttons d-flex justify-content-start'>
                <a href="index.php"><input class="btn btn-info" type="submit" value="Quay lại" /></a>
            </div>
		</div>
	</div>
</body>
<?php $this->end(); ?>