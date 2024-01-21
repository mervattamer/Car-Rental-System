<?php 
// check if the 
if ($_SERVER["REQUEST_METHOD"] == 'POST'){

$dsn = "mysql:host=localhost;dbname=Car_Rental_System";
$dbusername = "root";
$dbpassword = "";

try {
$pdo = new PDO($dsn, $dbusername, $dbpassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("SELECT * FROM `reservation` WHERE Reserve_id = :res_id");

$stmt->bindParam(":res_id", $R_id);
$R_id = $_POST["r_id3"];

$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

$result = $stmt->fetchAll();

$row = $result[0];

$return_date = $row['return_date'];
// 7wel el $pickup_date le date
$Date1 = new DateTime();
$Date2 = new DateTime($return_date);

// e7na now law lesa shewaya 3al ret date fa tamam make sure en el amount left is 0
$interval = $Date1->diff($Date2);

$daysDifference = $interval->days;

if ($daysDifference<=0){
    $am_left = $row["amount_left"];
    $stmt = $pdo->prepare("INSERT INTO `status`(`plate_id`,`status`) VALUES (:plate_id,'available')");
    $stmt->bindParam(":plate_id", $pid);
    $pid = $row['plate_id'];

    $stmt->execute();
    // han update el return date 3ashan ne 2ool enaha ba2et previous reservation
    $stmt = $pdo->prepare("UPDATE `reservation` SET `return_date`= :ret_date WHERE Reserve_id=:res_id;");

    $stmt->bindParam(":res_id", $R_id);
    $stmt->bindParam(":ret_date", $ret_date);
    $R_id = $_POST["r_id3"];
    $ret_date = date('Y-m-d H:i:s', time());

    $stmt->execute();
    if($am_left==0){   
        echo "car returned Sucessfully";
    }
    else{
        echo "Car Returned Sucessfully but,";
        echo "please dont forget to pay the remaining amount of ".$am_left;
    }
}
else{
    $am_left = $row["amount_left"];
    $stmt = $pdo->prepare("INSERT INTO `status`(`plate_id`,`status`) VALUES (:plate_id,'available')");
    $stmt->bindParam(":plate_id", $pid);
    $pid = $row['plate_id'];

    $stmt->execute();
    $stmt = $pdo->prepare("UPDATE `reservation` SET `return_date`= :ret_date,`amount_left`=`amount_left`+500 WHERE Reserve_id=:res_id;");

    $stmt->bindParam(":res_id", $R_id);
    $stmt->bindParam(":ret_date", $ret_date);
    $R_id = $_POST["r_id3"];
    $ret_date = date('Y-m-d H:i:s', time());

    $stmt->execute();

    echo "Car Returned Sucessfully but late";
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