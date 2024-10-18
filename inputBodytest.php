<?php
session_start();
require "config/db_config.php";

// เชื่อมต่อฐานข้อมูล
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . $e->getMessage());
}

// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $week = trim($_POST['week']);
    $type = trim($_POST['type']);
    $passed = trim($_POST['passed']);
    $failed = trim($_POST['failed']);
    $not_tested = trim($_POST['not_tested']);

    // ตรวจสอบว่าฟิลด์ไม่ว่างและข้อมูลถูกต้อง
    if (empty($week) || empty($type) || empty($passed) || empty($failed) || empty($not_tested)) {
        $error = "กรุณากรอกข้อมูลให้ครบทุกช่อง";
    } elseif (!ctype_digit($week) || !ctype_digit($passed) || !ctype_digit($failed) || !ctype_digit($not_tested)) {
        $error = "กรุณากรอกเฉพาะตัวเลขในช่องสัปดาห์, ผ่าน, ไม่ผ่าน, และไม่ได้ทดสอบ";
    } else {
        try {
            // เตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูล
            $stmt = $pdo->prepare("INSERT INTO ข้อมูลการทดสอบร่างกาย (สัปดาห์, ประเภท, ผ่าน, ไม่ผ่าน, ไม่ได้ทดสอบ) 
            VALUES (:week, :type, :passed, :failed, :not_tested)");

            // ผูกค่าพารามิเตอร์
            $stmt->bindParam(':week', $week);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':passed', $passed);
            $stmt->bindParam(':failed', $failed);
            $stmt->bindParam(':not_tested', $not_tested);

            // ประมวลผลคำสั่ง SQL
            $stmt->execute();
            $success = "บันทึกข้อมูลเรียบร้อยแล้ว";
        } catch (PDOException $e) {
            $error = "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>162 DBMS - กรอกข้อมูลการทดสอบร่างกาย</title>
    <!-- Custom fonts and styles -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<!-- Include navbar -->
<?php include "navbar.php" ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="container mt-5">
        <h2>กรอกข้อมูลการทดสอบร่างกาย</h2>

        <!-- Display errors or success messages -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php elseif (!empty($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <!-- CSRF Token for Security -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>"> -->

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="week">สัปดาห์: <span style="color: red;">*</span></label>
                    <select id="week" name="week" class="form-control" required>
                        <option value="" <?php echo isset($_POST['week']) && $_POST['week'] == '' ? 'selected' : ''; ?>>-- เลือกสัปดาห์ --</option>
                        <option value="1" <?php echo isset($_POST['week']) && $_POST['week'] == '1' ? 'selected' : ''; ?>>สัปดาห์ที่ 1</option>
                        <option value="2" <?php echo isset($_POST['week']) && $_POST['week'] == '2' ? 'selected' : ''; ?>>สัปดาห์ที่ 2</option>
                        <option value="3" <?php echo isset($_POST['week']) && $_POST['week'] == '3' ? 'selected' : ''; ?>>สัปดาห์ที่ 3</option>
                        <option value="4" <?php echo isset($_POST['week']) && $_POST['week'] == '4' ? 'selected' : ''; ?>>สัปดาห์ที่ 4</option>
                        <option value="5" <?php echo isset($_POST['week']) && $_POST['week'] == '5' ? 'selected' : ''; ?>>สัปดาห์ที่ 5</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="type">ประเภท: <span style="color: red;">*</label>
                    <select id="type" name="type" class="form-control" required>
                        <option value="" <?php echo isset($_POST['type']) && $_POST['type'] == '' ? 'selected' : ''; ?>>-- เลือกประเภท --</option>
                        <option value="ดันพื้น" <?php echo isset($_POST['type']) && $_POST['type'] == 'test1' ? 'selected' : ''; ?>>ดันพื้น</option>
                        <option value="ดึงข้อ" <?php echo isset($_POST['type']) && $_POST['type'] == 'test2' ? 'selected' : ''; ?>>ดึงข้อ</option>
                        <option value="ลุกนั่ง" <?php echo isset($_POST['type']) && $_POST['type'] == 'test3' ? 'selected' : ''; ?>>ลุกนั่ง</option>
                        <option value="วิ่ง 2 กม." <?php echo isset($_POST['type']) && $_POST['type'] == 'test3' ? 'selected' : ''; ?>>วิ่ง 2 กม.</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="passed">ผ่าน: <span style="color: red;">*</label>
                    <input type="text" id="passed" name="passed" class="form-control" value="<?php echo isset($_POST['passed']) ? $_POST['passed'] : ''; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="failed">ไม่ผ่าน: <span style="color: red;">*</label>
                    <input type="text" id="failed" name="failed" class="form-control" value="<?php echo isset($_POST['failed']) ? $_POST['failed'] : ''; ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="not_tested">ไม่ได้ทดสอบ: <span style="color: red;">*</label>
                    <input type="text" id="not_tested" name="not_tested" class="form-control" value="<?php echo isset($_POST['not_tested']) ? $_POST['not_tested'] : ''; ?>" required>
                </div>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
        </form>
    </div>
</div>
<br><br><br><br><br><br><br><br><br>
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>162 DBMS &copy; Your Website 2024</span>
        </div>
    </div>
</footer>

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
</body>

</html>