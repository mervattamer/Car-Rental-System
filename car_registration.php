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
        style="background-image: url('assets/car_background4.jpg')">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {

            echo "
    <div class='container bg-black bg-opacity-75 px-24 mx-auto h-full w-fit flex justify-center justify-items-center'>
    <form name='car_reg_form' action='insertData.php' class = 'grid grid-cols-2 my-24 gap-x-12' method='post' onsubmit='register_car(event)'>
    <h1 class='col-span-2 text-4xl text-center my-12 font-bold text-left tracking-wide'> CAR REGISTRATION </h1>
    <div class = '' >
    <label for='plate_input' class = 'text-lg'>Plate No. : </label>
    <input name='plate_input' type='text' class='block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]' id='plate_input' name='plate_input'><br /><br />
    </div>

    <div class = '' >
    <label for='model_input' class = 'text-lg'>Model: </label>
    <input name='model_input' type='text' class='block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]' id='model_input' name='model_input'><br /><br />
    </div>

    <div class = '' >
    <label for='year_input' class = 'text-lg'>Year: </label>
    <input name='year_input' type='text' class='block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]' id='year_input' name='year_input'><br /><br />
    </div>

    <div class = '' >
    <label for='price_input' class = 'text-lg'>Price Per Day: </label>
    <input name='price_input' type='text' class='block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]' id='price_input' name='price_input'><br /><br />
    </div>

    <div class = '' >
    <label for='office_input' class = 'text-lg'>Office: </label>
    <input name='office_input' type='text' class='block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]' id='office_input' name='office_input'><br /><br />
    </div>

    <div class = 'col-start-1 col-span-2 justify-self-center w-2/3' >
    <input type='submit' class='uppercase block w-full p-4 text-lg rounded-full bg-[#3A3A42] hover:bg-[#42362E] focus:outline-none' value='REGISTER'>
    </div>
    </form>
    </div>";
        } else {
            header("Location: ./admin.php");
        }
        ?>
    </div>
</body>

</html>
<script>
    function check_empty() {
        var car_plate = document.forms["car_reg_form"]["plate_input"].value;
        var model_inp = document.forms["car_reg_form"]["model_input"].value;
        var year_inp = document.forms["car_reg_form"]["year_input"].value;
        var price_inp = document.forms["car_reg_form"]["price_input"].value;
        var office_inp = document.forms["car_reg_form"]["office_input"].value;


        if (car_plate == "" || model_inp == "" || year_inp == "" || price_inp == "" || office_inp == "") {
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

    function register_car(event) {
        event.preventDefault(); // Prevent form submission

        const car_plate = document.forms["car_reg_form"]["plate_input"].value;
        const model_inp = document.forms["car_reg_form"]["model_input"].value;
        const year_inp = document.forms["car_reg_form"]["year_input"].value;
        const price_inp = document.forms["car_reg_form"]["price_input"].value;
        const office_inp = document.forms["car_reg_form"]["office_input"].value;

        var check = check_empty()
        if (check === false) {
            return;
        }

        Swal.fire({
            title: '<span style="color: #FFFFFF;">Updating Status</span>',
            html: '<span style="color: #ffffff;">Please wait...</span>',
            confirmButtonColor: '#AD2323',
            background: '#3A3A42',
            customClass: {
                popup: 'swal2-dark',
                title: 'swal2-dark',
                content: 'swal2-dark',
            },
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: false,
            didOpen: async () => {
                try {
                    const formData = new FormData();
                    formData.append("plate_input", car_plate);
                    formData.append("model_input", model_inp);
                    formData.append("year_input", year_inp);
                    formData.append("price_input", price_inp);
                    formData.append("office_input", office_inp);

                    const response = await fetch("insertData.php", {
                        method: "POST",
                        body: formData
                    });

                    if (!response.ok) {
                        throw new Error(`Request failed with status ${response.status}`);
                    }

                    const result = await response.text();

                    if (result.trim().toLowerCase() === "car registered successfully") {

                        Swal.fire({
                            title: '<span style="color: #FFFFFF;">Success</span>',
                            icon: "success",
                            html: '<span style="color: #ffffff;">Car Registered Successfully!</span>',
                            confirmButtonColor: '#AD2323',
                            background: '#3A3A42',
                            customClass: {
                                popup: 'swal2-dark',
                                title: 'swal2-dark',
                                content: 'swal2-dark',
                            },
                        });
                    }
                    else {
                        Swal.fire({
                            title: '<span style="color: #FFFFFF;">Car Registration Failed</span>',
                            text: result,
                            icon: "error",
                            confirmButtonColor: '#AD2323',
                            background: '#3A3A42',
                            customClass: {
                                popup: 'swal2-dark',
                                title: 'swal2-dark',
                                content: 'swal2-dark',
                            },
                        });
                    }
                } catch (error) {
                    Swal.fire({
                        title: '<span style="color: #FFFFFF;">Request Failed</span>',
                        text: error.toString(),
                        icon: "error",
                        confirmButtonColor: '#AD2323',
                        background: '#3A3A42',
                        customClass: {
                            popup: 'swal2-dark',
                            title: 'swal2-dark',
                            content: 'swal2-dark',
                        },
                    });
                }
            }
        });
    }
</script>