<?php
require_once 'config/db_config.php';

// Initialize counts
$green_count = 0;
$yellow_count = 0;
$red_count = 0;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password); // Ensure $host is defined
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch new soldiers data
    $stmt = $pdo->query('SELECT * FROM ทหารใหม่');
    $ทหารใหม่ = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Query to fetch the count of new soldiers
    $stmt = $pdo->query('SELECT COUNT(*) AS count FROM ทหารใหม่');
    $countResult = $stmt->fetch(PDO::FETCH_ASSOC);
    $newSoldiersCount = $countResult['count'];

    // Fetch count for "กลุ่มสีเขียว"
    $sql_green = "SELECT COUNT(*) AS count 
    FROM ทหารใหม่ 
    WHERE กลุ่มประเภททหารใหม่_การคัดกรองโควิด_19 = 'กลุ่มที่ 2 (เขียว)' 
      AND โรคประจำตัว = 'ไม่มี' 
      AND bmi < 30";
    $stmt_green = $pdo->prepare($sql_green);
    $stmt_green->execute();
    $green_count = $stmt_green->fetch(PDO::FETCH_ASSOC)['count'];

    // Fetch count for "กลุ่มสีเหลือง"
    $sql_yellow = "SELECT COUNT(*) AS count 
    FROM ทหารใหม่ 
    WHERE กลุ่มประเภททหารใหม่_การคัดกรองโควิด_19 = 'กลุ่มที่ 1 (เหลือง)' 
      AND โรคประจำตัว != 'ไม่มี'";
    $stmt_yellow = $pdo->prepare($sql_yellow);
    $stmt_yellow->execute();
    $yellow_count = $stmt_yellow->fetch(PDO::FETCH_ASSOC)['count'];

    // Fetch count for "กลุ่มสีแดง"
    $sql_red = "SELECT COUNT(*) AS count 
    FROM ทหารใหม่ 
    WHERE กลุ่มประเภททหารใหม่_การคัดกรองโควิด_19 = 'กลุ่มที่ 3 (แดง)' 
      OR bmi >= 30";
    $stmt_red = $pdo->prepare($sql_red);
    $stmt_red->execute();
    $red_count = $stmt_red->fetch(PDO::FETCH_ASSOC)['count'];
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage()); // Log the error
    echo "Database error: " . $e->getMessage(); // Display the error message for debugging
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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- New Soldiers -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-x font-weight-bold text-primary text-uppercase mb-1">ทหารใหม่</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $newSoldiersCount; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-user fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Green Group -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-x font-weight-bold text-success text-uppercase mb-1">กลุ่มสีเขียว</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $green_count; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Yellow Group -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-x font-weight-bold text-warning text-uppercase mb-1">กลุ่มสีเหลือง</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $yellow_count; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Red Group -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-x font-weight-bold text-danger text-uppercase mb-1">กลุ่มสีแดง</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $red_count; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End of row -->
    </div> <!-- End of container-fluid -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
</body>

</html>