<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="assets/car_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="@sweetalert2/theme-dark/dark.css" />
    <script src="sweetalert2/dist/sweetalert2.min.js"></script>
    <title>CARental</title>
</head>
<body>
    <div class="min-h-screen max-h-screen overflow-auto flex bg-no-repeat bg-cover bg-fixed text-white" style="background-image: url('assets/car_background4.jpg')">
<?php 
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $dsn = "mysql:host=localhost;dbname=Car_Rental_System";
    $dbusername = "root";
    $dbpassword = "";
    $car_inp = $_POST["car_inp"];
    $startD = $_POST["start_date"];
    $EndD = $_POST["end_date"];

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM reservation JOIN car ON reservation.plate_id = car.plate_id  WHERE car.plate_id = :car_inp AND reservation.pickup_date <= :startD AND reservation.return_date >= :EndD;");
        $stmt->bindParam(":startD", $startD);
        $stmt->bindParam(":EndD", $EndD);
        $stmt->bindParam(":car_inp", $car_inp);

        $stmt->execute();

        echo"
        <div class='container min-h-screen max-h-fit flex-col place-items-center bg-black bg-opacity-75 px-12 mx-auto h-full w-fit '>
        ";

        if ($stmt->rowCount() > 0) {
            echo "

            <h1 class='text-4xl text-center mt-24 mb-8 font-bold text-left tracking-wide' >RESERVATIONS OF CAR WITH PLATE NO. = ".$car_inp." </br> <span class='text-2xl mt-1 text-gray-500'> SEARCH RESULTS: ".$stmt->rowCount()." RECORD(S) </span> </h1> </br>
            <div class = 'relative overflow-x-auto shadow-md sm:rounded-lg'>
            <table class = 'w-full border-2 border-gray-700 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-300'>
            <thead class = 'text-xs text-gray-700 uppercase bg-gray-50 dark:bg-black dark:bg-opacity-70 dark:text-gray-200'>
            ";

            // Get column names
            $columns = array_keys($stmt->fetch(PDO::FETCH_ASSOC));
            // Reset the statement pointer
            $stmt->execute();

            // Construct the table header
            echo "<tr>";
            foreach ($columns as $column) {
                echo "<th scope='col' class='px-6 py-3'>$column</th>";
            }
            echo "</tr>";
            echo "</thead>";

            // Construct the table rows
            echo "<tbody>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr class='bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>";
                foreach ($row as $value) {
                    echo "<td class='px-6 py-4'>{$value}</td>";
                }
                echo "</tr>";
                echo "</tbody>";
            }
            echo "</table>";
        } else {
            echo "
            <p class='text-4xl text-center my-72 whitespace-wrap font-bold text-left tracking-wide' >NO RESERVATIONS FOUND </br> FOR CAR WITH PLATE NO. ".$car_inp." </p> </br>
            ";
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    $pdo = null;
}
?>
