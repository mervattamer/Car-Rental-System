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
    <div class="h-screen overflow-auto w-full flex place-items-center justify-center bg-no-repeat bg-cover bg-fixed text-white"
        style="background-image: url('assets/car_background7.jpg')">
        <?php
        if (1) {

            $dsn = "mysql:host=localhost;dbname=Car_Rental_System";
            $dbusername = "root";
            $dbpassword = "";

            try {
                $pdo = new PDO($dsn, $dbusername, $dbpassword);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $pdo->prepare("SELECT * FROM `user` WHERE user.email= :email and user.password=:pwd;");

                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":pwd", $pwd);

                $email = $_POST["user_email"];
                $pwd = $_POST["user_pwd"];

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
                } else {
                    $row = $result[0];

                    ?>
                    <!-- <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Home Page</title>
            </head>

            <body> -->
                    <div class="container mt-12 mb-4 w-full max-h-1/2 flex justify-center place-items-center">
                        <div
                            class="w-full overflow-auto row-start-2 max-h-screen max-w-2xl bg-[#27272A] bg-opacity-95 border border-gray-200 rounded-lg shadow sm:p-8 ">
                            <div class="mb-1">
                                <?php echo '<h1 class="text-xl font-bold leading-none text-green-700">Welcome Mr.  ' . $row["fname"] . '</h1>'; ?>
                            </div>
                            <!-- <h1>Helloo Mr -->
                            <!-- <h3> User Info </h3> -->
                            <div class="flex items-center justify-between mb-2">
                                <h5 class="text-xl font-bold leading-none text-red-700">User Info</h5>
                            </div>
                            <div class="flow-root">
                                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <li class="py-3 sm:py-4">
                                        <div class='relative overflow-x-auto shadow-md sm:rounded-lg'>
                                            <table
                                                class='w-full border-2 border-gray-700 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-300'>
                                                <thead
                                                    class='text-xs text-gray-700 uppercase bg-gray-50 dark:bg-black dark:bg-opacity-70 dark:text-gray-200'>
                                                    <tr>
                                                        <th scope='col' class='px-6 py-3'>SSN</th>
                                                        <th scope='col' class='px-6 py-3'>First Name</th>
                                                        <th scope='col' class='px-6 py-3'>Last Name</th>
                                                        <th scope='col' class='px-6 py-3'>Phone Number</th>
                                                        <th scope='col' class='px-6 py-3'>Balance</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class='border-b bg-gray-900 border-gray-700 hover:bg-gray-600'>
                                                        <td class='px-6 py-4'>
                                                            <?php echo $row["SSN"] ?>
                                                        </td>
                                                        <td class='px-6 py-4'>
                                                            <?php echo $row["fname"] ?>
                                                        </td>
                                                        <td class='px-6 py-4'>
                                                            <?php echo $row["lname"] ?>
                                                        </td>
                                                        <td class='px-6 py-4'>
                                                            <?php echo $row["phone"] ?>
                                                        </td class='px-6 py-4'>
                                                        <td class='px-6 py-4'>
                                                            <?php echo $row["balance"] ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </li>
                                    <?php
                                    // current reservations 
                                    $stmt = $pdo->prepare("SELECT * FROM `reservation` as r,car as c WHERE r.plate_id = c.plate_id and r.SSN = :SSN and r.pickup_date<CURRENT_TIMESTAMP() and r.return_date>CURRENT_TIMESTAMP();");

                                    $stmt->bindParam(":SSN", $SSN);

                                    $SSN = $row["SSN"];

                                    $stmt->execute();

                                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

                                    $result = $stmt->fetchAll();
                                    echo '
                    <li class="py-3 sm:py-4">
                                            <p class="text-lg font-medium text-gray-900 truncate dark:text-white">
                                                Ongoing Reservations 
                                            </p>';
                                    echo "
                                            <div class = 'relative overflow-x-auto shadow-md sm:rounded-lg'>
                                            <table class = 'w-full border-2 border-gray-700 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-300'>
                                            <thead class = 'text-xs text-gray-700 uppercase bg-gray-50 dark:bg-black dark:bg-opacity-70 dark:text-gray-200'>
        <tr>
            <th scope='col' class='px-6 py-3'>Reserve Id</th>
            <th scope='col' class='px-6 py-3'>Plate Id</th>
            <th scope='col' class='px-6 py-3'>Model</th> 
            <th scope='col' class='px-6 py-3'>Year</th>
            <th scope='col' class='px-6 py-3'>Reservation Date</th>
            <th scope='col' class='px-6 py-3'>Pickup Date</th>
            <th scope='col' class='px-6 py-3'>Return Date</th>
            <th scope='col' class='px-6 py-3'>Amount Left</th>
        </tr>
        </thead>";
                                    for ($i = 0; $i < $stmt->rowCount(); $i++) {
                                        $Rrow = $result[$i];
                                        echo "
                        <tbody>
                        <tr class='border-b bg-gray-900 border-gray-700 hover:bg-gray-600'>
                    <td class='px-6 py-4'>" . $Rrow["Reserve_id"] . "</td>
                      <td class='px-6 py-4'>" . $Rrow["plate_id"] . "</td>     
                      <td class='px-6 py-4'>" . $Rrow["model"] . "</td>      
                      <td class='px-6 py-4'>" . $Rrow["year"] . "</td> 
                      <td class='px-6 py-4'>" . $Rrow["reserve_date"] . "</td>
                      <td class='px-6 py-4'>" . $Rrow["pickup_date"] . "</td>
                      <td class='px-6 py-4'>" . $Rrow["return_date"] . "</td>
                      <td class='px-6 py-4'>" . $Rrow["amount_left"] . "</td>      
                      </tr>
                      </tbody>
                      ";
                                    }
                                    echo "
                    </table>
                    </div>
                </li>
            ";
                                    ?>
                                    <?php
                                    // current reservations 
                                    $stmt = $pdo->prepare("SELECT * FROM `reservation` as r,car as c WHERE r.plate_id = c.plate_id and r.SSN = :SSN and r.return_date<CURRENT_TIMESTAMP()");

                                    $stmt->bindParam(":SSN", $SSN);

                                    $SSN = $row["SSN"];

                                    $stmt->execute();

                                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

                                    $result = $stmt->fetchAll();
                                    echo '
                    <li class="py-3 sm:py-4">
                                            <p class="text-lg font-medium text-gray-900 truncate dark:text-white">
                                                Previous Reservations 
                                            </p>';
                                    echo "
                                            <div class = 'relative overflow-x-auto shadow-md sm:rounded-lg'>
                                            <table class = 'w-full border-2 border-gray-700 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-300'>
                                            <thead class = 'text-xs text-gray-700 uppercase bg-gray-50 dark:bg-black dark:bg-opacity-70 dark:text-gray-200'>
        <tr>
            <th scope='col' class='px-6 py-3'>Reserve Id</th>
            <th scope='col' class='px-6 py-3'>Plate Id</th>
            <th scope='col' class='px-6 py-3'>Model</th> 
            <th scope='col' class='px-6 py-3'>Year</th>
            <th scope='col' class='px-6 py-3'>Reservation Date</th>
            <th scope='col' class='px-6 py-3'>Pickup Date</th>
            <th scope='col' class='px-6 py-3'>Return Date</th>
            <th scope='col' class='px-6 py-3'>Amount Left</th>
        </tr>
        </thead>";
                                    for ($i = 0; $i < $stmt->rowCount(); $i++) {
                                        $Rrow = $result[$i];
                                        echo "
                        <tbody>
                        <tr class='border-b bg-gray-900 border-gray-700 hover:bg-gray-600'>
                    <td class='px-6 py-4'>" . $Rrow["Reserve_id"] . "</td>
                      <td class='px-6 py-4'>" . $Rrow["plate_id"] . "</td>     
                      <td class='px-6 py-4'>" . $Rrow["model"] . "</td>      
                      <td class='px-6 py-4'>" . $Rrow["year"] . "</td> 
                      <td class='px-6 py-4'>" . $Rrow["reserve_date"] . "</td>
                      <td class='px-6 py-4'>" . $Rrow["pickup_date"] . "</td>
                      <td class='px-6 py-4'>" . $Rrow["return_date"] . "</td>
                      <td class='px-6 py-4'>" . $Rrow["amount_left"] . "</td>      
                      </tr>
                      </tbody>";
                                    }
                                    echo "
                </table>
                </div>
                </li>
            ";
                                    ?>
                                    <?php
                                    // current reservations 
                                    $stmt = $pdo->prepare("SELECT * FROM `reservation` as r,car as c WHERE r.plate_id = c.plate_id and r.SSN = :SSN and r.pickup_date>CURRENT_TIMESTAMP()");

                                    $stmt->bindParam(":SSN", $SSN);

                                    $SSN = $row["SSN"];
                                    $BAL = $row["balance"];

                                    $stmt->execute();

                                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

                                    $result = $stmt->fetchAll();
                                    echo '
                    <li class="py-3 sm:py-4">
                    <p class="text-lg font-medium text-gray-900 truncate dark:text-white">
                        Future Reservations 
                    </p>';
                                    echo "
                    <div class = 'relative overflow-x-auto shadow-md sm:rounded-lg'>
                    <table class = 'w-full border-2 border-gray-700 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-300'>
                    <thead class = 'text-xs text-gray-700 uppercase bg-gray-50 dark:bg-black dark:bg-opacity-70 dark:text-gray-200'>
        <tr>
            <th scope='col' class='px-6 py-3'>Reserve Id</th>
            <th scope='col' class='px-6 py-3'>Plate Id</th>
            <th scope='col' class='px-6 py-3'>Model</th> 
            <th scope='col' class='px-6 py-3'>Year</th>
            <th scope='col' class='px-6 py-3'>Reservation Date</th>
            <th scope='col' class='px-6 py-3'>Pickup Date</th>
            <th scope='col' class='px-6 py-3'>Return Date</th>
            <th scope='col' class='px-6 py-3'>Amount Left</th>
        </tr>
        </thead>";
                                    for ($i = 0; $i < $stmt->rowCount(); $i++) {
                                        $Rrow = $result[$i];
                                        echo "
                        <tbody>
                        <tr class='border-b bg-gray-900 border-gray-700 hover:bg-gray-600'>
                    <td class='px-6 py-4'>" . $Rrow["Reserve_id"] . "</td>
                      <td class='px-6 py-4'>" . $Rrow["plate_id"] . "</td>     
                      <td class='px-6 py-4'>" . $Rrow["model"] . "</td>      
                      <td class='px-6 py-4'>" . $Rrow["year"] . "</td> 
                      <td class='px-6 py-4'>" . $Rrow["reserve_date"] . "</td>
                      <td class='px-6 py-4'>" . $Rrow["pickup_date"] . "</td>
                      <td class='px-6 py-4'>" . $Rrow["return_date"] . "</td>
                      <td class='px-6 py-4'>" . $Rrow["amount_left"] . "</td>      
                      </tr>
                      </tbody>";
                                    }
                                    echo "
                </table>
                </div>
                </li>
            "; ?>
                                </ul>
                            </div>
                        </div>

                        <div
                            class="w-full mx-4 overflow-scroll row-start-2 min-h-fit max-h-screen max-w-lg bg-[#27272A] bg-opacity-95 border border-gray-200 rounded-lg shadow sm:p-8 ">
                            <div class="flex items-center justify-between mb-2">
                                <h5 class="text-xl font-bold leading-none text-red-700">Actions</h5>
                            </div>
                            <div class="flow-root">
                                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <li class="py-3 sm:py-4">
                                        <a class="flex items-center" href="reserve.php?SSN=<?php echo urlencode($SSN);?>">
                                            <div class="flex-shrink-0">
                                                <img class="w-8 h-8" src="assets/logo2.png">
                                            </div>
                                            <div class="flex-1 min-w-0 ms-4 justify-self-left text-left">
                                                <p class="text-xl font-medium text-gray-900 truncate dark:text-white">
                                                    Reserve a car
                                                </p>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="py-3 sm:py-4">
                                        <p class="text-2xl font-medium text-gray-900 truncate dark:text-white">
                                            Search Car by Model
                                        </p>
                                        <form action='search_by_model.php' name="search_by_model_form" class="grid grid-rows-2 gap-y-4" method='POST'
                                            onsubmit='return check_empty_model()'>
                                            <div>
                                                <label for="model" class="text-md"> Model: </label>
                                                <input id='model' type='text' name='model'
                                                    class="block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]">
                                            </div>
                                            <div>
                                                <input type="submit"
                                                    class="uppercase block w-full p-4 text-lg rounded-full bg-[#3A3A42] hover:bg-[#42362E] focus:outline-none">
                                            </div>
                                        </form>
                                    </li>
                                    <li class="py-3 sm:py-4">
                                        <p class="text-2xl font-medium text-gray-900 truncate dark:text-white">
                                            Search Car by Year
                                        </p>
                                        <form action='search_by_year.php' method='POST' name="search_by_year_form" class="grid grid-rows-2 gap-y-4"
                                            onsubmit='return check_empty_year()'>
                                            <div>
                                                <label for="year" class="text-md"> Year: </label>
                                                <input type="number" id="year" name="year" min="1900" max="2099" required
                                                    class="block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]">
                                            </div>
                                            <div>
                                                <input type="submit"
                                                    class="uppercase block w-full p-4 text-lg rounded-full bg-[#3A3A42] hover:bg-[#42362E] focus:outline-none">
                                            </div>
                                        </form>
                                    </li>
                                    <li class="py-3 sm:py-4">
                                        <p class="text-2xl font-medium text-gray-900 truncate dark:text-white">
                                            Search Car by Year and Model
                                        </p>
                                        <form action='search_by_year_and_model.php' method='POST' name="search_by_year_and_model_form" class="grid grid-rows-3 gap-y-4"
                                            onsubmit='return check_empty_year_and_model()'>
                                            <div>
                                                <label for="model2" class="text-md"> Model: </label>
                                                <input id='model2' type='text' name='model2'
                                                    class="block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]">
                                            </div>
                                            <div>
                                                <label for="year" class="text-md"> Year: </label>
                                                <input type="number" id="year" name="year" min="1900" max="2099" required
                                                    class="block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]">
                                            </div>
                                            <div>
                                                <input type="submit"
                                                    class="uppercase block w-full p-4 text-lg rounded-full bg-[#3A3A42] hover:bg-[#42362E] focus:outline-none">
                                            </div>
                                        </form>
                                    </li>
                                    <li class="py-3 sm:py-4">
                                        <p class="text-2xl font-medium text-gray-900 truncate dark:text-white">
                                            PAYMENT
                                        </p>
                                        <form action='pay_res.php' name="payment_form" method='POST' class="grid grid-rows-3 gap-y-4"
                                            onsubmit='pay(event)'>
                                            <div>
                                                <label for="r_id" class="text-md"> Reservation ID: </label>
                                                <input id='r_id' type='text' name='r_id'
                                                    class="block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]">
                                            </div>
                                            <div>
                                                <label for="amount" class="text-md"> Amount: </label>
                                                <input id='amount' type='text' name='amount'
                                                    class="block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]">
                                            </div>
                                            <div>
                                                <input type="submit"
                                                    class="uppercase block w-full p-4 text-lg rounded-full bg-[#3A3A42] hover:bg-[#42362E] focus:outline-none">
                                            </div>
                                        </form>
                                    </li>

                                    <li class="py-3 sm:py-4">
                                        <p class="text-2xl font-medium text-gray-900 truncate dark:text-white">
                                            PICKUP
                                        </p>
                                        <form action='pick_res.php' name="pickup_form" method='POST' onsubmit='pickup(event)'
                                            class="grid grid-rows-2 gap-y-4">
                                            <div>
                                                <label for="r_id2" class="text-md"> Reservation ID: </label>
                                                <input id='r_id2' type='text' name='r_id2'
                                                    class="block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]">
                                            </div>
                                            <div>
                                                <input type="submit"
                                                    class="uppercase block w-full p-4 text-lg rounded-full bg-[#3A3A42] hover:bg-[#42362E] focus:outline-none">
                                            </div>
                                        </form>
                                    </li>

                                    <li class="py-3 sm:py-4">
                                        <p class="text-2xl font-medium text-gray-900 truncate dark:text-white">
                                            RETURN
                                        </p>
                                        <form action='ret_res.php' name="return_form" method='POST' onsubmit="return_reservation(event)"
                                            class="grid grid-rows-2 gap-y-4">
                                            <div>
                                                <label for="r_id3" class="text-md"> Reservation ID: </label>
                                                <input id='r_id3' type='text' name='r_id3'
                                                    class="block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]">
                                            </div>
                                            <div>
                                                <input type="submit"
                                                    class="uppercase block w-full p-4 text-lg rounded-full bg-[#3A3A42] hover:bg-[#42362E] focus:outline-none">
                                            </div>
                                        </form>
                                    </li>

                                    <li class="py-3 sm:py-4">
                                        <p class="text-2xl font-medium text-gray-900 truncate dark:text-white">
                                            ADD TO BALANCE
                                        </p>
                                        <form action='add_bal.php' name="add_balance_form" method='POST' onsubmit="add_balance(event)"
                                            class="grid grid-rows-4 gap-y-4">
                                            <div>
                                                <label for="amount4" class="text-md"> Amount: </label>
                                                <input id='amount4' type='text' name='amount4'
                                                    class="block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]">
                                            </div>
                                            <div>
                                                <label for="SSN4" class="text-md"> Confirm your SSN: </label>
                                                <input id='SSN4' type='text' name='SSN4'
                                                    class="block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]">
                                            </div>
                                            <div>
                                                <input type="submit"
                                                    class="uppercase block w-full p-4 text-lg rounded-full bg-[#3A3A42] hover:bg-[#42362E] focus:outline-none">
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>

                            <?php

                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            $pdo = null;
        } else {
            header("Location: ./index.html");
        }
        // zawed form lel search we page te show feha el table el hayetla3
// zawed el payment button
        ?>
</body>
