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
    <div class="h-screen flex bg-no-repeat bg-cover bg-fixed text-white" style="background-image: url('assets/car_background5.jpg')">
    <div class='container place-items-center bg-black bg-opacity-75 px-24 mx-auto h-full w-fit flex justify-center justify-items-center'>
    <form name="cust_res_form" action="cust_res_db.php" class="grid grid-rows-3 gap-y-12" method = "post" onsubmit = "return check_empty()">
    <h1 class='row-span-1 text-4xl text-center font-bold text-left tracking-wide'> CUSTOMER RESERVATIONS </h1>
    
    <div>
    <input id="cust_inp" type="text" name="cust_inp" class="block p-4 mx-auto w-2/3 my-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]" placeholder="  Customer SSN">
    </div>
    
    <div>
    <input type="submit" class="uppercase justify-self-center block w-2/3 mx-auto p-4 text-lg rounded-full bg-[#3A3A42] hover:bg-[#1D2214] focus:outline-none" value="Display">
    </div>
    </form>

</body>

</html>

<script>
    function check_empty() {
    var cust_ssn = document.forms["cust_res_form"]["cust_inp"].value;

    if (cust_ssn == "") {
        Swal.fire({
            icon: 'error',
            html: '<span style="color: #ffffff;">Please insert the customer SSN!</span>',
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
