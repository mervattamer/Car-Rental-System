<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="assets/car_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="@sweetalert2/theme-dark/dark.css" />
    <script src="sweetalert2/dist/sweetalert2.min.js"></script>
    <title>CARental</title>
</head>

<body>
    <div class="h-screen flex bg-no-repeat bg-cover bg-fixed text-white"
        style="background-image: url('assets/car_background6.jpg')">
        <div
            class='container shadow:md flex justify-items-center place-items-center bg-black bg-opacity-75 px-24 mx-auto h-full w-fit flex justify-center justify-items-center'>
            <form action="car_res_db.php" name="car_res_form" id="car_res_form" class="grid grid-rows-3 gap-y-12" method="post" onsubmit = "return check_empty()">
            <h1 class='row-span-1 text-4xl text-center font-bold text-left tracking-wide'> CAR RESERVATIONS </h1>
            <div>
                <input id="car_inp" type="text" name="car_inp" class="block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]" placeholder=" Car Plate">
            </div>
            <div>
                <label for="start_date" class="text-lg">Start date : </label>
                <input id="start_date" name="start_date" type="date" class="block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]" name="start_date" placeholder="pickup date">
            </div>
            <div>
                <label for="end_date" class="text-lg">Return date : </label>
                <input id="end_date" name="end_date" type="date" class="block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]" name="end_date" placeholder="return date">
            </div>
            <div>
                <input type="submit" class="uppercase block w-full p-4 text-lg rounded-full bg-[#3A3A42] hover:bg-[#42362E] focus:outline-none" value="Display">
            </div>
        </form>
        </div>
    </div>
</body>

</html>

<script>
    function check_empty() {
    var car_plate = document.forms["car_res_form"]["car_inp"].value;
    var start_date = document.forms["car_res_form"]["start_date"].value;
    var return_date = document.forms["car_res_form"]["end_date"].value;

    console.log("car_plate: " + car_plate);
    console.log("start_date: " + start_date);
    console.log("return_date: " + return_date);

    if (car_plate == "" || start_date == "" || return_date == "") {
        Swal.fire({
            icon: 'error',
            html: '<span style="color: #ffffff;">Please fill in the missing fields!</span>',
            confirmButtonColor: '#AD2323',
            background: '#3A3A42',
            customClass: {
                popup: 'swal2-dark',
                title: 'swal2-dark',
                content: 'swal2-dark',
            },
        });
        return false;
    }
    return true;
}
</script>