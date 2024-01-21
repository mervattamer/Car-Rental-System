<?php 
// hangeeb el SSN meneen??
if ($_SERVER["REQUEST_METHOD"] == 'POST'){

$dsn = "mysql:host=localhost;dbname=Car_Rental_System";
$dbusername = "root";
$dbpassword = "";

try {
$pdo = new PDO($dsn, $dbusername, $dbpassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("UPDATE `user` SET `balance`=`balance`+:amount WHERE SSN = :SSN");
$stmt->bindParam(":amount", $amount);
$stmt->bindParam(":SSN", $SSN);

$amount = $_POST["amount4"];
$SSN = $_POST["SSN4"];

$stmt->execute();
echo"balance added successfully";
// header("Location: ./user.php");

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