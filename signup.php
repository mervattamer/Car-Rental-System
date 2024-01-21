<?php
  if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $dsn = "mysql:host=localhost;dbname=Car_Rental_System";
    $dbusername = "root";
    $dbpassword = "";
    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $email = $_POST["email"];
        $ssn = $_POST["SSN"];

        $stmt = $pdo->prepare("SELECT * FROM user WHERE user.email = :email or user.ssn = :ssn ;");
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':ssn',$ssn);

        $result = $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

        $result = $stmt->fetchAll();
        
        if($stmt->rowCount() > 0){
          // echo "Can't create account. <br/>";
          // echo "Please go back and edit your info .";
          // echo "Please Remember to provide your unique email as well as your unique SSN";
          // echo "<br /><a href='index.html'>back to signup</a>";
          echo "user already exists";
        }
        else {
          $stmt = $pdo->prepare("INSERT INTO user (SSN,email,`password`,phone,fname,lname,balance) VALUES(:ssn,:email, :pwd, :phone , :fname, :lname, :balance);");
          $stmt->bindParam(':ssn', $ssn);
          $stmt->bindParam(':email', $email);
          $stmt->bindParam(':pwd', $pwd);
          $stmt->bindParam(':phone', $phone);
          $stmt->bindParam(':fname', $fname);
          $stmt->bindParam(':lname', $lname);
          $stmt->bindParam(':balance', $balance);
   
          $ssn = $_POST["SSN"];
          $email = $_POST["email"];
          $pwd = $_POST["pwd"];
          $phone = $_POST["phone_no"];
          $fname = $_POST["fname"];
          $lname = $_POST["lname"];
          $balance = $_POST["balance"];
          $stmt->execute();
          
          echo "record added successfully";
          // echo "<br>Record added successfully<br>";
          // echo "<br /><a href='index.html'>login</a>";
          // echo "<br /><a href='signup.html'>signup</a>";
          // header("Location: ./index.html");
    }
      $pdo = null;
      $stmt = null;

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