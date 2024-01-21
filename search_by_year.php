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
// check whether the current date is greater than the pickup date for the res_id
if ($_SERVER["REQUEST_METHOD"] == 'POST'){

$dsn = "mysql:host=localhost;dbname=Car_Rental_System";
$dbusername = "root";
$dbpassword = "";

try {
$pdo = new PDO($dsn, $dbusername, $dbpassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("SELECT * FROM car,(SELECT a.*
        FROM status a
        LEFT OUTER JOIN status b
        ON a.plate_id = b.plate_id AND a.time < b.time
        WHERE b.plate_id IS NULL) as s WHERE year = :year and s.plate_id=car.plate_id and s.status = 'available';");
$stmt->bindParam(":year", $year);

$year = $_POST["year"];

$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

$result = $stmt->fetchAll();
echo"
    <div class='container min-h-screen max-h-fit flex-col place-items-center bg-black bg-opacity-75 px-12 mx-auto h-full w-fit '>
        ";
// show table
if($stmt->rowCount() == 0){
    echo "
        <p class='text-4xl text-center my-72 whitespace-wrap font-bold text-left tracking-wide' >No available cars of this type.</br></p> </br>
            ";
}
else {
    echo "
        <body>
            <h3 class='text-4xl text-center mt-24 mb-8 font-bold text-left tracking-wide'>Available Cars</br> <span class='text-2xl mt-1 text-gray-500'> SEARCH RESULTS: ".$stmt->rowCount()." RECORD(S) </span>  </h3> </br>
            <div class = 'relative overflow-x-auto shadow-md sm:rounded-lg'>
            <table class = 'w-full border-2 border-gray-700 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-300'>
            <thead class = 'text-xs text-gray-700 uppercase bg-gray-50 dark:bg-black dark:bg-opacity-70 dark:text-gray-200'>
                    <tr >
                        <th scope='col' class='px-6 py-3'>Plate Id</th>
                        <th scope='col' class='px-6 py-3'>Model</th> 
                        <th scope='col' class='px-6 py-3'>Year</th>
                        <th scope='col' class='px-6 py-3'>Price per day</th>
                    </tr>
                    </thead>";
            for ($i=0; $i < $stmt->rowCount(); $i++) {
                $row = $result[$i]; 
                echo "<tr class='border-b bg-gray-900 border-gray-700 hover:bg-gray-600'>
                      <td class='px-6 py-4'>".$row["plate_id"]."</td>     
                      <td class='px-6 py-4'>".$row["model"]."</td>      
                      <td class='px-6 py-4'>".$row["year"]."</td>
                      <td class='px-6 py-4'>".$row["price_per_day"]."</td>       
                      </tr>";
                  }
            echo "</table>
            </body>
            ";
}
echo "</div>";
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