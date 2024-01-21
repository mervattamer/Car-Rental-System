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
    <div class="h-screen flex bg-no-repeat bg-cover bg-fixed text-white"
        style="background-image: url('assets/car_background5.jpg')">
        <div
            class='container place-items-center bg-black bg-opacity-75 px-24 mx-auto h-full w-1/3 flex justify-center justify-items-center'>
            <form name="car_stat_form" action="car_status_db.php" class="w-full grid grid-rows-3 gap-y-12" method="post"
                onsubmit="return check_empty()">
                <h1 class='row-span-1 text-4xl text-center font-bold text-left tracking-wide'> CAR STATUS </h1>

                <!-- <div>
                    <input id="car_inp" name="car_inp" type="text"
                        class="block mx-auto w-full p-4 my-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]"
                        name="car_inp" placeholder=" Car Plate">
                </div> -->

                <div>
                    <label for="day_date" class="text-lg"> Date : </label>
                    <input id="day_date" name="day_date" type="date"
                        class="block mx-auto w-full p-4 my-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]"
                        name="day_date">
                </div>

                <div>
                    <input type="submit"
                        class="uppercase justify-self-center block w-2/3 mx-auto p-4 text-lg rounded-full bg-[#3A3A42] hover:bg-[#B5511F] hover:text-black focus:outline-none"
                        value="Display">
                </div>
            </form>

</body>

</html>
<script>
    function check_empty() {
        // var car_plate = document.forms["car_stat_form"]["car_inp"].value;
        var date = document.forms["car_stat_form"]["day_date"].value;

        if ( date == "") {
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