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
        style="background-image: url('assets/car_background6.jpg')">
        <div
            class='container flex justify-items-center place-items-center bg-black bg-opacity-75 px-24 mx-auto h-full w-fit flex justify-center justify-items-center'>
            <form action="display_db.php" name = "disp_res_form" class="grid grid-rows-3 gap-y-12" method="post" onsubmit="return check_empty()">
                <h1 class='row-span-1 text-4xl text-center font-bold text-left tracking-wide'> DISPLAY RESERVATIONS
                </h1>
                <div>
                    <label for="Pickup_date" class="text-lg ">Pickup date : </label>
                    <input id="pickup_date" name="pickup_date" type="date"
                        class="block w-full p-4 h-fit my-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]"
                        name="pickup_date" placeholder="pickup date">
                </div>
                <div>
                    <label for="return_date" class="text-lg">Return date : </label>
                    <input id="return_date" name="return_date" type="date"
                        class="block w-full p-4 h-fit my-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]"
                        name="return_date" placeholder="return date">
                </div>
                <input type="submit"
                    class="uppercase justify-self-center block w-2/3 mx-auto p-4 text-lg rounded-full bg-[#3A3A42] hover:bg-[#B5511F] hover:text-black focus:outline-none"
                    value="Display">
            </form>
        </div>
    </div>
    </div>
</body>

</html>
<script>
    function check_empty() {
    var pickup_date = document.forms["disp_res_form"]["pickup_date"].value;
    var return_date = document.forms["disp_res_form"]["return_date"].value;


    if (pickup_date == "" || return_date == "") {
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