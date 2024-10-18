<?php
require_once 'config/db_config.php';

try {
    // Create a single PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch ทหารใหม่ data
    $stmt = $pdo->query('SELECT * FROM ทหารใหม่');
    $ทหารใหม่ = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Query to fetch ข้อมูลการทดสอบร่างกาย data
    $sql = "SELECT สัปดาห์, ประเภท, ผ่าน, ไม่ผ่าน, ไม่ได้ทดสอบ FROM testresults";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(); // Execute the prepared statement
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}

// Close the connection by setting it to null
$pdo = null;
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>162 DBMS</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
<!-- include navbar for navbar page -->
<?php include "navbar.php" ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row">

        <?php include "dashboard.php" ?>

    </div>



    <div class="row">
        <?php for ($i = 0; $i < 5; $i++): // เปลี่ยนจาก 4 เป็น 5 
        ?>
            <div class="col-xl-6">
                <div class="card mb-8">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        ข้อมูลการทดสอบร่างกายประจำสัปดาห์ที่ <?php echo $i + 1; ?>
                    </div>
                    <div class="card-body">
                        <canvas id="chart_week<?php echo $i + 1; ?>" width="100%" height="40"></canvas>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>

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

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>162 DBMS &copy; Your Website 2024</span>
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
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
<script src="js/demo/datatables-demo.js"></script>

<script>
    // Convert PHP array to JavaScript object
    var data = <?php echo json_encode($data); ?>;

    // Create an array to hold data for each week
    var weeks = Array.from({
        length: 5
    }, () => {
        return {
            'ผ่าน': 0,
            'ไม่ผ่าน': 0,
            'ไม่ได้ทดสอบ': 0
        };
    });

    // Process data and populate weeks array
    data.forEach(function(item) {
        var weekIndex = parseInt(item['สัปดาห์']) - 1;
        weeks[weekIndex]['ผ่าน'] += parseInt(item['ผ่าน']);
        weeks[weekIndex]['ไม่ผ่าน'] += parseInt(item['ไม่ผ่าน']);
        weeks[weekIndex]['ไม่ได้ทดสอบ'] += parseInt(item['ไม่ได้ทดสอบ']);
    });

    // Define colors for each result type
    var colors = {
        'ผ่าน': 'green',
        'ไม่ผ่าน': 'red',
        'ไม่ได้ทดสอบ': 'yellow'
    };

    // Generate a chart for each week
    for (var i = 0; i < 5; i++) {
        var ctx = document.getElementById('chart_week' + (i + 1)).getContext('2d');
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(weeks[i]),
                datasets: [{
                    label: 'ผลการทดสอบ',
                    data: Object.values(weeks[i]),
                    backgroundColor: Object.keys(weeks[i]).map(key => colors[key]), // Dynamic color mapping
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
</script>
</body>

</html>