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
<div class="h-screen overflow-auto w-full flex place-items-center justify-center bg-no-repeat bg-cover bg-fixed text-white"
        style="background-image: url('assets/car_background7.jpg')">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {

            $dsn = "mysql:host=localhost;dbname=Car_Rental_System";
            $dbusername = "root";
            $dbpassword = "";

            try {
                $pdo = new PDO($dsn, $dbusername, $dbpassword);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $pdo->prepare("SELECT * FROM `admin` WHERE email= :email and password=:pwd;");

                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":pwd", $pwd);

                $email = $_POST["admin_email"];
                $pwd = $_POST["admin_pwd"];

                $stmt->execute();

                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

                $result = $stmt->fetchAll();

                if ($stmt->rowCount() == 0) {
                    echo '
                        <script>
                            Swal.fire({
                                icon: "error",
                                html: \'<span style="color: #ffffff;">Wrong Email or Password</span>\',
                                confirmButtonColor: "#AD2323",
                                background: "#3A3A42",
                                customClass: {
                                    popup: "swal2-dark",
                                    title: "swal2-dark",
                                    content: "swal2-dark",
                                },
                            });
                        </script>';


                    // modify this later
        
                    echo '<script>
            setTimeout(function() {
                window.history.back();
            }, 2000); // 2000 milliseconds (2 seconds) delay before going back
            </>';
                    //header("Location: {$_SERVER['HTTP_REFERER']}?error=" . urlencode($errorMessage));
        
                    //header("Location: ./index.html");
                } else {
                    $row = $result[0];
                    echo '
                    <div class="container mt-12 mb-4 w-full max-h-1/2 flex justify-center place-items-center">
                    <div
                    class="w-full overflow-auto row-start-2 max-h-screen max-w-lg bg-[#27272A] bg-opacity-95 border border-gray-200 rounded-lg shadow sm:p-8 ">
                    <div class="mb-1">                
                        <h1 class="text-xl font-bold leading-none text-green-700">Welcome Mr. ' . $row["email"] . '</h1>
                    </div>
                        <div class="flex items-center justify-between mb-2">
                            <h5 class="text-xl font-bold leading-none text-red-700">Dashboard Menu</h5>
                        </div>
                        <div class="flow-root">
                            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                <li class="py-3 sm:py-4">
                                    <form action="car_registration.php" method="post" class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <img class="w-8 h-8" src="assets/logo10.png">
                                        </div>
                                        <button class="flex-1 min-w-0 ms-4 justify-self-left text-left">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                Register Car
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                Add a new car to the system
                                            </p>
                                        </button>
                                    </form>
                                </li>
                                <li class="py-3 sm:py-4">
                                    <a class="flex items-center" href="car_status_update.php">
                                        <div class="flex-shrink-0">
                                            <img class="w-8 h-8" src="assets/logo2.png">
                                        </div>
                                        <div class="flex-1 min-w-0 ms-4">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                Update Car Status
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                Change the status of a specific car
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <li class="py-3 sm:py-4">
                                    <a class="flex items-center" href="cust_reservations.php">
                                        <div class="flex-shrink-0">
                                            <img class="w-8 h-8 rounded-full" src="assets/logo3.png">
                                        </div>
                                        <div class="flex-1 min-w-0 ms-4">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                Display Customer Reservations
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                Show the history of reservations of a customer
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <li class="py-3 sm:py-4">
                                    <a class="flex items-center" href="car_status.php">
                                        <div class="flex-shrink-0">
                                            <img class="w-8 h-8" src="assets/logo4.png">
                                        </div>
                                        <div class="flex-1 min-w-0 ms-4">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                Cars Status
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                Display the status the cars on a specific day
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <li class="py-3 sm:py-4">
                                    <a class="flex items-center" href="car_reservations.php">
                                        <div class="flex-shrink-0">
                                            <img class="w-8 h-8" src="assets/logo8.png">
                                        </div>
                                        <div class="flex-1 min-w-0 ms-4">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                Display Car Reservations
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                Show the history of reservations of a specific car
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <li class="py-3 sm:py-4">
                                    <a class="flex items-center" href="display_reservations.php">
                                        <div class="flex-shrink-0">
                                            <img class="w-8 h-8" src="assets/logo9.png">
                                        </div>
                                        <div class="flex-1 min-w-0 ms-4">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                Display All Reservations
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                Show the history of reservations of customers and cars
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <li class="pt-3 pb-0 sm:pt-4">
                                    <a class="flex items-center" href="payements.php">
                                        <div class="flex-shrink-0">
                                            <img class="w-8 h-8" src="assets/logo6.png">
                                        </div>
                                        <div class="flex-1 min-w-0 ms-4">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                Payments
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                Display a log of payments in a specific period of time
                                            </p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
        
            </div>
        
        
            </div>
                    ';


                    // car registration
                    //         echo '';
                    // echo '';
                    // echo '';
        
                    // car status update
                    // echo '<form action="car_status_update.php" method="post">';
                    // echo '<input type="submit" value="Update Car Status">';
                    // echo '</form>';
        
                    // display reservations --- for cust/car  or both
                    // echo '<form action="display_reservations.php">';
                    // echo '<input type="submit" value="Display All Reservations">';
                    // echo '</form>';
        
                    // echo '<form action="car_reservations.php">';
                    // echo '<input type="submit" value="Display Car Reservations">';
                    // echo '</form>';
        
                    // echo '<form action="cust_reservations.php">';
                    // echo '<input type="submit" value="Display Customer Reservations">';
                    // echo '</form>';
        
                    // display cars status
                    // echo '<form action="car_status.php" method="post">';
                    // echo '<input type="submit" value="Car status">';
                    // echo '</form>';
        
                    // display payements
                    // echo '<form action="payements.php" method="post">';
                    // echo '<input type="submit" value="Payments">';
                    // echo '</form>';
        



                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            $pdo = null;
        } else {
            header("Location: ./index.html");
        }

        //$car_sql = "SELECT * FROM car";
//$reserve_sql = "SELECT * FROM reservation";
        ?>

    </div>
</body>

</html>