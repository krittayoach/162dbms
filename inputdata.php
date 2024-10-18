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

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // SQL query with placeholders
    $sql = "
    INSERT INTO ทหารใหม่ (
        ลำดับ, หมวด, ชื่อ_สกุล, สังกัด, ต้นสังกัด, ที่อยู่ปัจจุบัน, ตำบล, อำเภอ, พิกัด, ระดับการศึกษา, กรณีการเข้ามา, ประเภท,
        ช่องทางการรับรู้_ออนไลน์, ความต้องการศึกษาต่อ_กศร
    ) VALUES (
        :ลำดับ, :หมวด, :ชื่อ_สกุล, :สังกัด, :ต้นสังกัด, :ที่อยู่ปัจจุบัน, :ตำบล, :อำเภอ, :พิกัด, :ระดับการศึกษา, :กรณีการเข้ามา, :ประเภท,
        :ช่องทางการรับรู้_ออนไลน์, :ความต้องการศึกษาต่อ_กศร
    )";

    $stmt = $pdo->prepare($sql);

    // Bind values from $_POST
    $stmt->bindValue(':ลำดับ', $_POST['ลำดับ']);
    $stmt->bindValue(':หมวด', $_POST['หมวด']);
    $stmt->bindValue(':ชื่อ_สกุล', $_POST['ชื่อ_สกุล']);
    $stmt->bindValue(':สังกัด', $_POST['สังกัด']);
    $stmt->bindValue(':ต้นสังกัด', $_POST['ต้นสังกัด']);
    $stmt->bindValue(':ที่อยู่ปัจจุบัน', $_POST['ที่อยู่ปัจจุบัน']);
    $stmt->bindValue(':ตำบล', $_POST['ตำบล']);
    $stmt->bindValue(':อำเภอ', $_POST['อำเภอ']);
    $stmt->bindValue(':พิกัด', $_POST['พิกัด']);
    $stmt->bindValue(':ระดับการศึกษา', $_POST['ระดับการศึกษา']);
    $stmt->bindValue(':กรณีการเข้ามา', $_POST['กรณีการเข้ามา']);
    $stmt->bindValue(':ประเภท', $_POST['ประเภท']);
    $stmt->bindValue(':ช่องทางการรับรู้_ออนไลน์', $_POST['ช่องทางการรับรู้_ออนไลน์']);
    $stmt->bindValue(':ความต้องการศึกษาต่อ_กศร', $_POST['ความต้องการศึกษาต่อ_กศร']);

    // Execute the statement and handle errors
    try {
        $stmt->execute();
        $_SESSION['success'] = "Data inserted successfully!";
        header("Location: success.php"); // Redirect to a success page
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error inserting data: " . $e->getMessage();
    }
}

// Close the database connection
$pdo = null;
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
<div class="container-fluid">
    <div class="container mt-5">
        <h2>ข้อมูลทหารใหม่</h2>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error']; ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php elseif (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success']; ?>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="ลำดับ">ลำดับ:</label>
                    <input type="text" id="ลำดับ" name="ลำดับ" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="หมวด">หมวด:</label>
                    <input type="text" id="หมวด" name="หมวด" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="ชื่อ_สกุล">ชื่อ-สกุล:</label>
                <input type="text" id="ชื่อ_สกุล" name="ชื่อ_สกุล" class="form-control" required>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="สังกัด">สังกัด:</label>
                    <input type="text" id="สังกัด" name="สังกัด" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="ต้นสังกัด">ต้นสังกัด:</label>
                    <input type="text" id="ต้นสังกัด" name="ต้นสังกัด" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="ที่อยู่ปัจจุบัน">ที่อยู่ปัจจุบัน:</label>
                <textarea id="ที่อยู่ปัจจุบัน" name="ที่อยู่ปัจจุบัน" class="form-control" required></textarea>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="ตำบล">ตำบล:</label>
                    <input type="text" id="ตำบล" name="ตำบล" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="อำเภอ">อำเภอ:</label>
                    <input type="text" id="อำเภอ" name="อำเภอ" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label for="พิกัด">พิกัด:</label>
                <input type="text" id="พิกัด" name="พิกัด" class="form-control">
            </div>

            <div class="form-group">
                <label for="ระดับการศึกษา">ระดับการศึกษา:</label>
                <input type="text" id="ระดับการศึกษา" name="ระดับการศึกษา" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="กรณีการเข้ามา">กรณีการเข้ามา:</label>
                <input type="text" id="กรณีการเข้ามา" name="กรณีการเข้ามา" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="ประเภท">ประเภท:</label>
                <input type="text" id="ประเภท" name="ประเภท" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="ช่องทางการรับรู้_ออนไลน์">ช่องทางการรับรู้(ออนไลน์):</label>
                <input type="text" id="ช่องทางการรับรู้_ออนไลน์" name="ช่องทางการรับรู้_ออนไลน์" class="form-control">
            </div>

            <div class="form-group">
                <label for="ความต้องการศึกษาต่อ_กศร">ความต้องการศึกษาต่อ (กศร):</label>
                <input type="text" id="ความต้องการศึกษาต่อ_กศร" name="ความต้องการศึกษาต่อ_กศร" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
        </form>
    </div>
</div>

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>162 DBMS &copy; Your Website 2024</span>
        </div>
    </div>
</footer>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>