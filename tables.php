<?php
require_once 'config/db_config.php';

// Now you can use $pdo to run SQL queries
$stmt = $pdo->query('SELECT * FROM ทหารใหม่');
$ทหารใหม่ = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>162 DBMS - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<?php include "navbar.php" ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>หมวด</th>
                            <th>ชื่อ - สกุล</th>
                            <th>สังกัด</th>
                            <th>ต้นสังกัด</th>
                            <th>ที่อยู่ปัจจุบัน</th>
                            <th>ตำบล</th>
                            <th>อำเภอ</th>
                            <th>จังหวัด</th>
                            <th>พิกัด</th>
                            <th>กรณีการเข้ามา</th>
                            <th>ประเภท</th>
                            <th>ช่องทางการรับรู้ (เฉพาะออนไลน์)</th>
                            <th>ประจำการ (ปี)</th>
                            <th>รูปภาพ</th>
                            <th>สามารถอ่าน/เขียน</th>
                            <th>ความสามารถพิเศษ</th>
                            <th>น้ำหนักทหารใหม่ (กก.)</th>
                            <th>ส่วนสูงทหารใหม่ (ซม.)</th>
                            <th>BMI</th>
                            <th>วัน/เดือน/ปีเกิด</th>
                            <th>อายุ (ปี)</th>
                            <th>หมายเลขโทรศัพท์</th>
                            <th>ศาสนา</th>
                            <th>สัญชาติ</th>
                            <th>เชื้อชาติ</th>
                            <th>กรุ๊ปเลือด</th>
                            <th>ชื่อเล่น</th>
                            <th>เลขบัตรประชาชน</th>
                            <th>ID : Line (ไอดีไลน์)</th>
                            <th>Facebook ( เฟสบุ๊ค )</th>
                            <th>Instagram ( อินสตราแกรม )</th>
                            <th>Tiktok ( ติ๊กต๊อก )</th>
                            <th>Twitter ( ทวิตเตอร์ )</th>
                            <th>เป็น influencer หรือไม่</th>
                            <th>รายละเอียด1</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($ทหารใหม่)) : ?>
                            <?php foreach ($ทหารใหม่ as $row) : ?>
                                <tr>
                                    <td><?= $row['ลำดับ'] ?></td>
                                    <td><?= $row['หมวด'] ?></td>
                                    <td><?= $row['ชื่อ_สกุล'] ?></td>
                                    <td><?= $row['สังกัด'] ?></td>
                                    <td><?= $row['ต้นสังกัด'] ?></td>
                                    <td><?= $row['ที่อยู่ปัจจุบัน'] ?></td>
                                    <td><?= $row['ตำบล'] ?></td>
                                    <td><?= $row['อำเภอ'] ?></td>
                                    <td><?= $row['จังหวัด'] ?></td>
                                    <td><?= $row['พิกัด'] ?></td>
                                    <td><?= $row['กรณีการเข้ามา'] ?></td>
                                    <td><?= $row['ประเภท'] ?></td>
                                    <td><?= $row['ช่องทางการรับรู้_ออนไลน์'] ?></td>
                                    <td><?= $row['ประจำการ_ปี'] ?></td>
                                    <td><?= $row['รูปภาพ'] ?></td>
                                    <td><?= $row['สามารถอ่าน_เขียน'] ?></td>
                                    <td><?= $row['ความสามารถพิเศษ'] ?></td>
                                    <td><?= $row['น้ำหนักทหารใหม่_กก_'] ?></td>
                                    <td><?= $row['ส่วนสูงทหารใหม่_ซม_'] ?></td>
                                    <td><?= $row['BMI'] ?></td>
                                    <td><?= $row['วันเดือนปีเกิด'] ?></td>
                                    <td><?= $row['อายุ_ปี_'] ?></td>
                                    <td><?= $row['เบอร์โทรศัพท์'] ?></td>
                                    <td><?= $row['ศาสนา'] ?></td>
                                    <td><?= $row['สัญชาติ'] ?></td>
                                    <td><?= $row['เชื้อชาติ'] ?></td>
                                    <td><?= $row['กรุ๊ปเลือด'] ?></td>
                                    <td><?= $row['ชื่อเล่น'] ?></td>
                                    <td><?= $row['เลขบัตรประชาชน'] ?></td>
                                    <td><?= $row['ID_Line'] ?></td>
                                    <td><?= $row['Facebook'] ?></td>
                                    <td><?= $row['Instagram'] ?></td>
                                    <td><?= $row['Tiktok'] ?></td>
                                    <td><?= $row['Twitter'] ?></td>
                                    <td><?= $row['เป็น_influencer_หรือไม่'] ?></td>
                                    <td><?= $row['รายละเอียด1'] ?></td>
                                    <td>
                                        <a href="detail_information.php?id=<?= $row['ลำดับ'] ?>" class="btn btn-primary btn-sm">รายละเอียด</a>
                                    </td>
                                    <td>
                                        <a href="edit_M.php?id=<?= $row['ลำดับ'] ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                                        <a href="#" onclick="confirmDelete(<?= $row['ลำดับ'] ?>);" class="btn btn-danger btn-sm">ลบ</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="37">ไม่พบข้อมูล</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>