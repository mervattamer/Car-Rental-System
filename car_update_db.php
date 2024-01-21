<?php 
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $dsn = "mysql:host=localhost;dbname=Car_Rental_System";
    $dbusername = "root";
    $dbpassword = "";
    $car_inp = $_POST["car_inp"];
    $status_update = $_POST["status_choice"];
   // echo $status_update;
   
   try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Hcheck el awl lw el 3arabeya asln f el table
    $checkCarStmt = $pdo->prepare("SELECT COUNT(*) FROM `car` WHERE plate_id = :plate_id");
    $checkCarStmt->bindParam(":plate_id", $plate_id);
    $checkCarStmt->execute();
    $carCount = $checkCarStmt->fetchColumn();

    if ($carCount > 0) {
        $stmt = $pdo->prepare("SELECT * FROM `status` WHERE plate_id = :car_inp AND `time` >= :dayD AND `time` <= :dayD2;");
        $stmt->bindParam(":car_inp", $plate_id);
        $stmt->bindParam(":dayD", $dayD);
        $stmt->bindParam(":dayD2", $dayD2);
    try {
        $stmt = $pdo->prepare("INSERT INTO `status`(`plate_id`,`status`) VALUES (:car_inp,:stat_update)");
        $stmt->bindParam(":stat_update", $status_update);
        $stmt->bindParam(":car_inp", $car_inp);

        $car_inp = $_POST["car_inp"];
        $status_update = $_POST["status_choice"];
        
        $stmt->execute();
        echo "updated successfully";

        
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    // $pdo = null;
    } else {
        echo "No car found with this plate no.";
    }
} catch(PDOException $e) {
    echo $e->getMessage();
}

    $pdo = null;
}
?>
