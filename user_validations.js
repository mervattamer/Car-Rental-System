function check_empty_model() {
    var model = document.forms["search_by_model_form"]["model"].value;

    if (model == "") {
        Swal.fire({
            icon: 'error',
            html: '<span style="color: #ffffff;">Please insert the model!</span>',
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

function check_empty_year() {
    var year = document.forms["search_by_year_form"]["year"].value;

    if (year == "") {
        Swal.fire({
            icon: 'error',
            html: '<span style="color: #ffffff;">Please insert the year!</span>',
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

function check_empty_year_and_model() {
    var model = document.forms["search_by_year_and_model_form"]["model2"].value;
    var year = document.forms["search_by_year_and_model_form"]["year"].value;

    if (model == "" || year == "") {
        Swal.fire({
            icon: 'error',
            html: '<span style="color: #ffffff;">Please insert both the model and year!</span>',
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

function check_empty_payment() {
    var reservationId = document.forms["payment_form"]["r_id"].value;
    var amount = document.forms["payment_form"]["amount"].value;

    if (reservationId == "" || amount == "") {
        Swal.fire({
            icon: 'error',
            html: '<span style="color: #ffffff;">Please insert both reservation ID and amount!</span>',
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

function check_empty_pickup() {
    var reservationId = document.forms["pickup_form"]["r_id2"].value;

    if (reservationId == "") {
        Swal.fire({
            icon: 'error',
            html: '<span style="color: #ffffff;">Please insert the reservation ID!</span>',
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

function check_empty_return() {
    var reservationId = document.forms["return_form"]["r_id3"].value;

    if (reservationId == "") {
        Swal.fire({
            icon: 'error',
            html: '<span style="color: #ffffff;">Please insert the reservation ID!</span>',
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

function check_empty_add_balance() {
    var amount = document.forms["add_balance_form"]["amount4"].value;
    var ssn = document.forms["add_balance_form"]["SSN4"].value;

    if (amount == "" || ssn == "") {
        Swal.fire({
            icon: 'error',
            html: '<span style="color: #ffffff;">Please insert both the amount and your SSN!</span>',
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

function check_empty_registration() {
    var officeId = document.getElementById("office_id").value;
    var plateId = document.getElementById("plate_id").value;
    var startDate = document.getElementById("start_date").value;
    var endDate = document.getElementById("end_date").value;
    var ssn = document.getElementById("SSN").value;

    if (officeId == "" || plateId == "" || startDate == "" || endDate == "" || ssn == "") {
        Swal.fire({
            icon: 'error',
            html: '<span style="color: #ffffff;">Please fill in all the fields!</span>',
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

function pay(event) {
    event.preventDefault(); // Prevent form submission

    const r_id = document.getElementById("r_id").value;
    const amount = document.getElementById("amount").value;

    var check = check_empty_payment()
    if (check === false){
        return;
    }

    Swal.fire({
        title: '<span style="color: #FFFFFF;">Adding balance</span>',
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
                formData.append("r_id", r_id);
                formData.append("amount", amount);

                const response = await fetch("pay_res.php", {
                    method: "POST",
                    body: formData
                });

                if (!response.ok) {
                    throw new Error(`Request failed with status ${response.status}`);
                }

                const result = await response.text();

                if (result.trim().toLowerCase() === "payment success") {

                    Swal.fire({
                        title: '<span style="color: #FFFFFF;">Success</span>',
                        icon: "success",
                        html: '<span style="color: #ffffff;">Payment Transaction done successfully!</span>',
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
                        title: '<span style="color: #FFFFFF;">Transaction Failed</span>',
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

function pickup(event) {
    event.preventDefault(); // Prevent form submission

    const r_id = document.getElementById("r_id2").value;

    var check = check_empty_pickup()
    if (check === false){
        return;
    }

    Swal.fire({
        title: '<span style="color: #FFFFFF;">Adding balance</span>',
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
                formData.append("r_id2", r_id);

                const response = await fetch("pick_res.php", {
                    method: "POST",
                    body: formData
                });

                if (!response.ok) {
                    throw new Error(`Request failed with status ${response.status}`);
                }

                const result = await response.text();

                if (result.trim().toLowerCase().includes("Enjoy your Ride and Stay Safe")) {

                    Swal.fire({
                        title: '<span style="color: #FFFFFF;">Success</span>',
                        icon: "success",
                        html: '<span style="color: #ffffff;">Pickup Success!</span>',
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
                        title: '<span style="color: #FFFFFF;">Pickup Failed</span>',
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

function add_balance(event) {
    event.preventDefault(); // Prevent form submission

    const amount = document.getElementById("amount4").value;
    const ssn = document.getElementById("SSN4").value;

    var check = check_empty_add_balance()
    if (check === false){
        return;
    }

    Swal.fire({
        title: '<span style="color: #FFFFFF;">Adding balance</span>',
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
                formData.append("amount4", amount);
                formData.append("SSN4", ssn);

                const response = await fetch("add_bal.php", {
                    method: "POST",
                    body: formData
                });

                if (!response.ok) {
                    throw new Error(`Request failed with status ${response.status}`);
                }

                const result = await response.text();

                if (result.trim().toLowerCase() === "balance added successfully") {

                    Swal.fire({
                        title: '<span style="color: #FFFFFF;">Success</span>',
                        icon: "success",
                        html: '<span style="color: #ffffff;">Balance added Successfully!</span>',
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
                        title: '<span style="color: #FFFFFF;">Transaction Failed</span>',
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


function return_reservation(event) {
    event.preventDefault(); // Prevent form submission

    const r_id = document.getElementById("r_id3").value;

    var check = check_empty_return()
    if (check === false){
        return;
    }

    Swal.fire({
        title: '<span style="color: #FFFFFF;">Adding balance</span>',
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
                formData.append("r_id3", r_id);
                const response = await fetch("ret_res.php", {
                    method: "POST",
                    body: formData
                });

                if (!response.ok) {
                    throw new Error(`Request failed with status ${response.status}`);
                }

                const result = await response.text();

                if (result.trim().toLowerCase() === "car returned successfully") {

                    Swal.fire({
                        title: '<span style="color: #FFFFFF;">Success</span>',
                        icon: "success",
                        html: '<span style="color: #ffffff;">Balance added Successfully!</span>',
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
                        title: '<span style="color: #FFFFFF;">Oops ..</span>',
                        text: result,
                        icon: "warning",
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

function reserve_car(event) {
    event.preventDefault(); // Prevent form submission

    const officeId = document.getElementById("office_id").value;
    const plateId = document.getElementById("plate_id").value;
    const startDate = document.getElementById("start_date").value;
    const endDate = document.getElementById("end_date").value;
    const ssn = document.getElementById("SSN").value;

    var check = check_empty_registration()
    if (check === false){
        return;
    }

    Swal.fire({
        title: '<span style="color: #FFFFFF;">Reserving..</span>',
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
                formData.append("office_id", officeId);
                formData.append("plate_id", plateId);
                formData.append("start_date", startDate);
                formData.append("end_date", endDate);
                formData.append("SSN", ssn);
                const response = await fetch("add_res.php", {
                    method: "POST",
                    body: formData
                });

                if (!response.ok) {
                    throw new Error(`Request failed with status ${response.status}`);
                }

                const result = await response.text();

                if (result.trim().toLowerCase().includes("car reserved successfully")) {

                    Swal.fire({
                        title: '<span style="color: #FFFFFF;">Success</span>',
                        icon: "success",
                        html: '<span style="color: #ffffff;">Car Reserved Successfully!</span>',
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
                        title: '<span style="color: #FFFFFF;">Reservation Failed</span>',
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