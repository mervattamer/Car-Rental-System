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
    <div class="min-h-screen max-h-screen overflow-auto flex place-items-center bg-no-repeat bg-cover bg-fixed text-white" style="background-image: url('assets/car_background4.jpg')">

<?php 
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $dsn = "mysql:host=localhost;dbname=Car_Rental_System";
    $dbusername = "root";
    $dbpassword = "";
    // $plate_id = $_POST["car_inp"];
    $day_date = $_POST["day_date"];
    // $day_date2 = $_POST["day_date"];
    // $dayD = date("Y-m-d 00:00:00", strtotime($day_date2));
    // $dayD2 = date("Y-m-d 23:59:59", strtotime($day_date));

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT a.*
        FROM status a
        LEFT OUTER JOIN status b
        ON a.plate_id = b.plate_id AND a.time < b.time and a.time <= :day_date and b.time <= :day_date
        WHERE b.plate_id IS NULL;");
        // $stmt->bindParam(":car_inp", $plate_id);
        // $stmt->bindParam(":dayD", $dayD);
        // $stmt->bindParam(":dayD2", $dayD2);
        $stmt->bindParam(":day_date", $day_date);

        $stmt->execute();

        echo"
        <div class='container min-h-screen max-h-fit flex-col place-items-center bg-black bg-opacity-75 px-12 mx-auto h-full w-fit '>
        ";

        if ($stmt->rowCount() > 0) {
            //echo "<table style='border: solid 1px black;'>";

            echo "
            <h1 class='text-4xl text-center mt-24 mb-8 font-bold text-left tracking-wide' >STATUS OF CARS ON ".$day_date." </br><span class='text-2xl mt-1 text-gray-500'> SEARCH RESULTS: ".$stmt->rowCount()." RECORD(S) </span> </h1> </br>
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
                echo "<tr class='border-b bg-gray-900 border-gray-700 hover:bg-gray-600'>";
                foreach ($row as $value) {
                    echo "<td class='px-6 py-4'>{$value}</td>";
                }
                echo "</tr>";
                echo "</tbody>";
            }
            echo "</table>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "
            <p class='text-4xl text-center my-72 whitespace-wrap font-bold text-left tracking-wide' >NO STATUS FOUND </br></br> FOR CARS ON ".$day_date." </p> </br>
            ";
        }
        echo "</div>";
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    $pdo = null;
}
?>
