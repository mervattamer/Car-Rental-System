<?php 
// update res amount left
// update user balance
// add payment record
if ($_SERVER["REQUEST_METHOD"] == 'POST'){

$dsn = "mysql:host=localhost;dbname=Car_Rental_System";
$dbusername = "root";
$dbpassword = "";

try {
$pdo = new PDO($dsn, $dbusername, $dbpassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// han update amount left fel reservation we hanget el ssn min el res_id

$stmt = $pdo->prepare("UPDATE `reservation` SET `amount_left`= `amount_left`-:amount WHERE `Reserve_id`=:res_id");
$stmt->bindParam(":amount", $AMOUNT);
$stmt->bindParam(":res_id", $R_id);

$R_id = $_POST["r_id"];
$AMOUNT = $_POST["amount"];

$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

$result = $stmt->fetchAll();

// get SSN

$stmt = $pdo->prepare("SELECT * from `reservation` where `Reserve_id`=:res_id");
$stmt->bindParam(":res_id", $R_id);

$R_id = $_POST["r_id"];

$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

$result = $stmt->fetchAll();

$row = $result[0];

// update user balance
$stmt = $pdo->prepare("UPDATE `user` SET `balance`=`balance`-:amount WHERE SSN = :SSN");
$stmt->bindParam(":SSN", $SSN);
$stmt->bindParam(":amount", $amount);

$SSN = $row["SSN"];
$amount = $_POST["amount"];

$stmt->execute();


// insert in payments el SSN wel amount
$stmt = $pdo->prepare("INSERT INTO `payments`(`SSN`, `amount`) VALUES (:SSN,:amount)");
$stmt->bindParam(":SSN", $SSN);
$stmt->bindParam(":amount", $amount);

$SSN = $row["SSN"];
$amount = $_POST["amount"];

$stmt->execute();
echo"payment success";
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