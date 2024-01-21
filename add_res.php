<?php 
if ($_SERVER["REQUEST_METHOD"] == 'POST'){

$dsn = "mysql:host=localhost;dbname=Car_Rental_System";
$dbusername = "root";
$dbpassword = "";
try {
$pdo = new PDO($dsn, $dbusername, $dbpassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$stmt = $pdo->prepare("SELECT a.*
FROM status a
LEFT OUTER JOIN status b
ON a.plate_id = b.plate_id AND a.time < b.time
WHERE b.plate_id IS NULL and a.plate_id=:plate_id and a.status = 'available';");
$stmt->bindParam(":plate_id", $pid);
$pid = $_POST['plate_id'];

$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

$result = $stmt->fetchAll();

if($stmt->rowCount() == 0){
    echo "Please choose an available car";
}
else{  
$stmt = $pdo->prepare("SELECT price_per_day
FROM car where car.plate_id = :plate_id");
$stmt->bindParam(":plate_id", $pid);
$pid = $_POST['plate_id'];

$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

$result = $stmt->fetchAll();
$row = $result[0];

$stmt = $pdo->prepare("INSERT INTO `reservation`(`plate_id`, `SSN`, `reserve_date`, `pickup_date`, `return_date`, `amount_left`) VALUES (:plate_id,:SSN,CURRENT_TIMESTAMP(),:pickup_date,:return_date,:amount);");
// 3ashan ne7seb amount left me7tageen (:pickup_date-:return_date)*:ppd)
$stmt->bindParam(":plate_id",$pid);
$stmt->bindParam(":SSN",$SSN);
$stmt->bindParam(":pickup_date", $pickup);
$stmt->bindParam(":return_date", $return);
$stmt->bindParam(":amount", $amount);

$pid = $_POST["plate_id"];
$pickup = $_POST["start_date"];
$return = $_POST["end_date"];
$SSN = $_POST["SSN"];
$ppd = $row["price_per_day"];
$amount = $daysDifference * $ppd;

$startDate = new DateTime($pickup);
$endDate = new DateTime($return);

$interval = $startDate->diff($endDate);

$daysDifference = $interval->days;
$amount = $daysDifference * $ppd;


$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

$result = $stmt->fetchAll();

$stmt = $pdo->prepare("INSERT INTO `status`(`plate_id`,`status`) VALUES (:plate_id,'rented')");
$stmt->bindParam(":plate_id", $pid);
$pid = $_POST['plate_id'];

$stmt->execute();

echo"car reserved successfully";

// $stmt = $pdo->prepare("SELECT * FROM `reservation` WHERE plate_id = :plate_id and SSN = :SSN AND pickup_date = :pickup_date and return_date = :return_date;");
// // 3ashan ne7seb amount left me7tageen (:pickup_date-:return_date)*:ppd)
// $stmt->bindParam(":plate_id",$pid);
// $stmt->bindParam(":SSN",$SSN);
// $stmt->bindParam(":pickup_date", $pickup);
// $stmt->bindParam(":return_date", $return);


// $pid = $_POST["plate_id"];
// $pickup = $_POST["start_date"];
// $return = $_POST["end_date"];
// $SSN = $_POST["SSN"];

// $stmt->execute();

// $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

// $result = $stmt->fetchAll();

// $row = $result[0];

// echo $row["Reserve_id"];
// header("Location: ./reserve.php");


}
}
catch(PDOException $e) {
  echo $e->getMessage();
}
$pdo = null;
}
else{
    header("Location: ./index.html");
}
// zawed form lel search we page te show feha el table el hayetla3
?>