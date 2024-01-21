<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="icon" href="assets/car_logo.png" type="image/x-icon">
  <link rel="stylesheet" href="@sweetalert2/theme-dark/dark.css" />
  <script src="sweetalert2/dist/sweetalert2.min.js"></script>
  <script type="text/javascript" src="user_validations.js"></script>
  <title>CARental</title>
</head>

<body>
  <div class="min-h-screen max-h-screen overflow-auto flex bg-no-repeat bg-cover bg-fixed text-white"
    style="background-image: url('assets/car_background4.jpg')">
    
    <?php
    if (1) {
      $dsn = "mysql:host=localhost;dbname=Car_Rental_System";
      $dbusername = "root";
      $dbpassword = "";
      $SSN = $_GET["SSN"];
      try {

        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT *  FROM (SELECT sub.* FROM    (SELECT a.*
        FROM status a
        LEFT OUTER JOIN status b
        ON a.plate_id = b.plate_id AND a.time < b.time
        WHERE b.plate_id IS NULL) sub WHERE sub.status = 'available') as s , car as c 
        WHERE s.plate_id=c.plate_id;");



        $result = $stmt->execute();

        echo "
        <div class='container min-h-screen max-h-fit flex-col place-items-center bg-black bg-opacity-75 px-12 mx-auto h-full w-fit '>
        ";

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $result = $stmt->fetchAll();

        if ($stmt->rowCount() == 0) {
          echo "
            <p class='text-4xl text-center my-72 whitespace-wrap font-bold text-left tracking-wide' >No available cars at the moment</p> </br>
            ";
        } else {
          echo "
            <h1 class='text-4xl text-center mt-12 mb-2 font-bold text-left tracking-wide' >Available Cars</h1> </br>
            <div class = 'relative overflow-x-auto shadow-md sm:rounded-lg'>
            <table class = 'w-full border-2 border-gray-700 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-300'>
            <thead class = 'text-xs text-gray-700 uppercase bg-gray-50 dark:bg-black dark:bg-opacity-70 dark:text-gray-200'>
                    <tr>
                        <th scope='col' class='px-6 py-3'>Plate Id</th>
                        <th scope='col' class='px-6 py-3'>Office Id</th>
                        <th scope='col' class='px-6 py-3'>Model</th> 
                        <th scope='col' class='px-6 py-3'>Year</th>
                        <th scope='col' class='px-6 py-3'>Price per day</th>
                    </tr>
                    </thead>";
          for ($i = 0; $i < $stmt->rowCount(); $i++) {
            $row = $result[$i];
            echo "
                <tbody>
                <tr class='bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>
                      <td class='px-6 py-4'>" . $row["plate_id"] . "</td> 
                      <td class='px-6 py-4'>" . $row["office_id"] . "</td>     
                      <td class='px-6 py-4'>" . $row["model"] . "</td>      
                      <td class='px-6 py-4'>" . $row["year"] . "</td>
                      <td class='px-6 py-4'>" . $row["price_per_day"] . "</td>       
                      </tr>
                      </tbody>";
          }
          echo "</table>
            ";
          ?>
          <script>
            function validate() {
              office = document.getElementById("office_id").value;
              p_id = document.getElementById("plate_id").value;
              input = document.getElementById("start_date").value;
              date1 = new Date(input);
              input = document.getElementById("end_date").value;
              date2 = new Date(input);
              date3 = (new Date()).getTime();
              if (office == "") {
                alert("PLEASE ENTER OFFICE ID");
                return false;
              }
              if (p_id == "") {
                alert("PLEASE ENTER PLATE ID");
                return false;
              }
              if (date1.getTime() > date2.getTime()) {
                alert("THIS IS CRAZYY START DATE IS AFTER THE END DATE??");
                return false;
              }
              if (date1.getTime() < date3) {
                alert("PLEASE CHOOSE A VALID START DATE");
                return false;
              }
            }
          </script>
          <h1 class='text-4xl text-center mt-12 mb-2 font-bold text-left tracking-wide'>Register Car</h1> </br>
          <form action='add_res.php' name="reserve_form" method='POST' class="grid grid-cols-2 gap-y-4 gap-x-3" onsubmit="reserve_car(event)">
            <div>
              <input id="office_id" type="text" name="office_id" class="block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]" placeholder="Your Office ID">
              </div>
              <div>
                <input id="plate_id" type="text" name="plate_id" class="block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]" placeholder="Car Plate ID">
                </div>
                <div>
                  <label for="start_date" class="text-lg">Start date : </label>
                  <input id="start_date" type="date" name="start_date" class="block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]" placeholder="pickup date">
                  </div>
                  <div>
                    <label for="end_date" class="text-lg">End date : </label>
                    <input id="end_date" type="date" name="end_date" class="block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]" placeholder="return date">
                    </div>
                    <div>
                      <label for="SSN" class="text-lg">Confirm your SSN : </label>
                      <?php echo "<input id='SSN' type='text' name='SSN' class='block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]' placeholder=
             $SSN >"; ?>
             </div>

                      <div class="col-span-2">
                        <input type="submit" class="uppercase block w-full p-4 text-lg rounded-full bg-[#3A3A42] hover:bg-[#42362E] focus:outline-none" value="Register">
                        </div>
          </form>
          <?php
        }
        $pdo = null;
        $stmt = null;

      } catch (PDOException $e) {
        echo $e->getMessage();
      }
      $pdo = null;
    } else {
      header("Location: ./index.html");
    }

    ?>

