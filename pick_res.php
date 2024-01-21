<?php 
// check whether the current date is greater than the pickup date for the res_id
if ($_SERVER["REQUEST_METHOD"] == 'POST'){

$dsn = "mysql:host=localhost;dbname=Car_Rental_System";
$dbusername = "root";
$dbpassword = "";

try {
$pdo = new PDO($dsn, $dbusername, $dbpassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("SELECT * FROM `reservation` WHERE Reserve_id = :res_id");
$stmt->bindParam(":res_id", $R_id);

$R_id = $_POST["r_id2"];

$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

$result = $stmt->fetchAll();

$row = $result[0];

$pickup_date = $row['pickup_date'];
// 7wel el $pickup_date le date
$Date1 = new DateTime($pickup_date);
$Date2 = new DateTime();


$interval = $Date1->diff($Date2);

$daysDifference = $interval->days;

if ($daysDifference>0){
    echo "cant pick up now please try again later";
}
else{
    echo "Enjoy your Ride and Stay Safe";
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
?>