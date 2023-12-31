<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$maCV = $_GET["maCV"];
$getChucVu = "select * from chuc_vu where MaChucVu='$maCV'";
$resultChucVu = mysqli_query($conn, $getChucVu);
$row = mysqli_fetch_array($resultChucVu, MYSQLI_ASSOC);
$tenCV = $row["TenChucVu"];
$HSL = $row["HeSoLuong"];

function checkCV($conn,$maCV){
    $sqlMaCV = "select * from nhan_vien where MaChucVu = '$maCV' ";
    $resultMaCV = mysqli_query($conn, $sqlMaCV);

    if(mysqli_num_rows($resultMaCV) > 0){
        return true;
    }return false;
} 

$err = array();


?>
<?php

if (isset($_POST['delete'])) {
    if (!checkCV($conn,$maCV)) {
    $sqldelete = "delete from chuc_vu where MaChucVu = '$_GET[maCV]'";
    $deleteResult = mysqli_query($conn, $sqldelete);
    echo "<script type='text/javascript'>
    $('#delete').prop('disabled','disabled');
    toastr.success('Xoá thành công');
    setTimeout(function() {
        window.location.href = '/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/admin?page=admin-position" . "';
    }, 1500);
    </script>";
    }else{
        echo "<script type='text/javascript'>toastr.error('Hiện vẫn còn nhân viên ở chức vụ này, Không thể xóa!!'); toastr.options.timeOut = 3000;</script>";
    }
}

?>
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">XÓA CHỨC VỤ</h5>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr class="tr">
                            <td>Mã chức vụ</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maCV" value="<?php echo $row["MaChucVu"]; ?> " disabled="disabled" /></td>
                            <td>Hệ số lương</td>
                            <td><input class="form-control py-2" type="text" name="HSL" value="<?php echo $HSL; ?>" disabled="disabled" /></td>
                        </tr>
                        <tr class="tr">
                            <td>Tên chức vụ </td>
                            <td><input class="form-control py-2" type="text" size="20" name="tenCV" value="<?php echo $tenCV; ?>" disabled="disabled" /></td>
                            <td id="no_color" colspan="2">
                                <button class="btn btn-outline-danger themnhanvien-btn mb-5 w-25" type="button" data-bs-toggle="modal" data-bs-target="#xacnhanxoa">Xoá</button>
                                <a class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" href="index.php?page=admin-position"> Quay Lại</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Xác nhận xóa -->
<div class="modal fade" id="xacnhanxoa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xoá chức vụ <strong><?php echo $row["MaChucVu"]; ?></strong> không?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <form action="" method="post">
                    <input id="delete" class="btn btn-danger" type="submit" value="Xoá" name="delete" />
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->end(); ?>