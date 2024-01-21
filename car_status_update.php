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
            class='container place-items-center bg-black bg-opacity-75 px-24 mx-auto h-full w-fit flex justify-center justify-items-center'>
            <form name="car_update_form" action="car_update_db.php" class="my-10" method="post"
                onsubmit="updateStatus(event)">
                <h1 class='col-span-2 text-4xl text-center py-24 font-bold text-left tracking-wide'> UPDATE CAR STATUS
                </h1>
                <input name="car_inp" id="car_inp" type="text"
                    class="block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]" name="car_inp"
                    placeholder="car plate">
                <br />
                <label for="status_choice" class="text-lg py-2">Select a choice:</label>
                <select id="status_choice" name="status_choice"
                    class='block w-full p-2 text-lg rounded-md bg-black border-2 border-[#3A3A42]'>
                    <option value="available">available</option>
                    <option value="rented">rented</option>
                    <option value="out_service">out of service</option>
                </select>
                <br />
                <input type="submit"
                    class='uppercase block w-full p-4 text-lg rounded-full bg-[#3A3A42] hover:bg-[#42362E] focus:outline-none'
                    value="update">
            </form>
        </div>
    </div>
</body>

</html>
<script>
    function check_empty() {
        var car_plate = document.forms["car_update_form"]["car_inp"].value;

        if (car_plate == "") {
            Swal.fire({
                icon: 'error',
                html: '<span style="color: #ffffff;">Please insert the car plate!</span>',
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

  function updateStatus(event) {
  event.preventDefault(); // Prevent form submission

  const carPlateNumber = document.getElementById("car_inp").value;
  const statusChoice = document.getElementById("status_choice").value;

  var check =check_empty()
  if (check === false){
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
        formData.append("car_inp", carPlateNumber);
        formData.append("status_choice", statusChoice);

        const response = await fetch("car_update_db.php", {
          method: "POST",
          body: formData
        });

        if (!response.ok) {
          throw new Error(`Request failed with status ${response.status}`);
        }

        const result = await response.text();

        if (result.trim().toLowerCase() === "updated successfully") {

        Swal.fire({
          title: '<span style="color: #FFFFFF;">Status Updated</span>',
          icon: "success",
          html: '<span style="color: #ffffff;">Updated Successfully!</span>',
            confirmButtonColor: '#AD2323',
            background: '#3A3A42',
            customClass: {
                popup: 'swal2-dark',
                title: 'swal2-dark',
                content: 'swal2-dark',
            },
        });}
        else {
        Swal.fire({
          title: '<span style="color: #FFFFFF;">Status Update Failed</span>',
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