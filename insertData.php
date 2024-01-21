<?php 
if ($_SERVER["REQUEST_METHOD"] == 'POST')
{   
    $plateNo = $_POST["plate_input"];
    $model = $_POST["model_input"];
    $year = $_POST["year_input"];
    $pricePerDay = $_POST["price_input"];
    $office = $_POST["office_input"];

    // Database connection
    $dsn = "mysql:host=localhost;dbname=Car_Rental_System";
    $dbusername = "root";
    $dbpassword = "";

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // H check el awl eza kan el plate_id already mawgood (primary key)
        $checkCarStmt = $pdo->prepare("SELECT COUNT(*) FROM car WHERE plate_id = :plate_id");
        $checkCarStmt->bindParam(":plate_id", $plateNo);
        $checkCarStmt->execute();
        $carCount = $checkCarStmt->fetchColumn();

        if ($carCount > 0) {
            echo "Car Plate ID already exists !";
        } else {
            // H check lw fih office mawgood bel rakam da
            $checkOfficeStmt = $pdo->prepare("SELECT COUNT(*) FROM office WHERE office_id = :office_id");
            $checkOfficeStmt->bindParam(":office_id", $office);
            $checkOfficeStmt->execute();
            $officeCount = $checkOfficeStmt->fetchColumn();

            if ($officeCount > 0) {
                // Keda el denya metzabata, proceed and add the new car

                $stmt = $pdo->prepare("INSERT INTO car (plate_id, model, year, price_per_day, office_id) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$plateNo, $model, $year, $pricePerDay, $office]);
                $stmt2 = $pdo->prepare("INSERT INTO `status`(`plate_id`, `status`) VALUES ($plateNo,'available')");
                $stmt2->execute();

                echo "car registered successfully";
            } else {
                echo "No office found with this id";
            }
        }
        // echo '<form action="car_registration.php" method="post">' .
        // '<input type="submit" value="Register another">' .
        // '</form>';
        // echo '<form action="admin.php" method="post">' .
        // '<input type="submit" value="Admin page">' .
        // '</form>';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $pdo = null;


}

else{
    header("Location: ./admin.php");
}
?>