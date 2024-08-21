$(document).ready(function () {
    // Initialize the DataTable
    $("#CustomersTable").DataTable({
        scrollX: true,
        scrollCollapse: true,
        processing: true,
        lengthChange: true,
        lengthMenu: [10, 25, 100, 200],
        pageLength: 10,
        searching: true,
        language: {
            paginate: {
                previous: "&laquo;", 
                next: "&raquo;", 
            },
        },
    });

    // Form validation and submission for new customer
    $(".customer-form .submit-btn").click(function (e) {
        e.preventDefault();
        $(".submit-btn").prop("disabled", true);

        var company_name = $("#company_name").val();
        var contact_name = $("#contact_name").val();
        var phone_1 = $("#phone_1").val();
        var phone_2 = $("#phone_2").val();
        var email = $("#email").val();
        var city = $("#city").val();
        var mailing_address = $("#mailing_address").val();
        var billing_address = $("#billing_address").val();
        var notes = $("#notes").val();

        var isRequired = 0;

        if (!company_name) {
            $("#company_name").css("border", "1px solid red");
            isRequired++;
        }
        if (!contact_name) {
            $("#contact_name").css("border", "1px solid red");
            isRequired++;
        }

        if (isRequired) {
            swal({
                text: "* fields are required!",
                icon: "warning",
                button: "OK",
            }).then(function () {
                $(".submit-btn").prop("disabled", false);
            });
        } else {
            $(".loader-div").show();
            $.ajax({
                url: 'ajaxcallforcustomers.php',
                method: 'POST',
                data: $("#customer-form").serialize() + '&action=NewCustomer',
                success: function (response) {
                    $(".loader-div").hide();
                    if (response == 1) {
                        $(".success-alert-text").text("Customer added successfully");
                        $(".success-alert").css("display", "flex");
                        fadeOutAlertMessage();
                        setTimeout(() => {
                            window.location = "customers";
                        }, 3000);
                    } else if (response == "CUSTOMER_ALREADY_EXIST") {
                        $(".warning-alert-text").text("Customer already exists");
                        $(".warning-alert").css("display", "flex");
                        fadeOutAlertMessage();
                        setTimeout(() => {
                            $(".submit-btn").prop("disabled", false);
                        }, 3000);
                    } else {
                        $(".error-alert-text").text("Something went wrong!");
                        $(".error-alert").css("display", "flex");
                        fadeOutAlertMessage();
                    }
                },
            });
        }
    });

    // Form validation and submission for editing customer
    $(".edit-customer-form .submit-btn").click(function (e) {
        e.preventDefault();
        $(".submit-btn").prop("disabled", true);

        var company_name = $("#company_name").val();
        var contact_name = $("#contact_name").val();
        var phone_1 = $("#phone_1").val();
        var phone_2 = $("#phone_2").val();
        var email = $("#email").val();
        var city = $("#city").val();
        var mailing_address = $("#mailing_address").val();
        var billing_address = $("#billing_address").val();
        var notes = $("#notes").val();

        var isRequired = 0;

        if (!company_name) {
            $("#company_name").css("border", "1px solid red");
            isRequired++;
        }

        if (!contact_name) {
            $("#contact_name").css("border", "1px solid red");
            isRequired++;
        }

        if (isRequired) {
            swal({
                text: "* fields are required!",
                icon: "warning",
                button: "OK",
            }).then(function () {
                $(".submit-btn").prop("disabled", false);
            });
        } else {
            $(".loader-div").show();
            $.ajax({
                url: 'ajaxcallforcustomers.php',
                method: 'POST',
                data: $("#edit-customer-form").serialize() + '&action=EditCustomer',
                success: function (response) {
                    $(".loader-div").hide();
                    if (response == 1) {
                        $(".success-alert-text").text("Customer updated successfully");
                        $(".success-alert").css("display", "flex");
                        fadeOutAlertMessage();
                    } else {
                        swal({
                            text: "Error updating customer!",
                            icon: "error",
                        });
                    }
                    setTimeout(() => {
                        window.location.href = "customers";
                    }, 2000);
                },
            });
        }
    });

    // Delete customer
    $(".delete-customer").click(function () {
        var customerId = $(this).data('id');
        swal({
            text: "Are you sure you want to delete this customer?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $(".loader-div").show();
                $.ajax({
                    url: 'ajaxcallforcustomers.php',
                    method: 'POST',
                    data: {
                        action: "DeleteCustomer",
                        id: customerId
                    },
                    success: function (response) {
                        $(".loader-div").hide();
                        if (response == 1) {
                            $(".success-alert-text").text("Customer deleted successfully");
                            $(".success-alert").css("display", "flex");
                            fadeOutAlertMessage();
                            window.location.reload();
                        } else {
                            swal({
                                text: "Error deleting customer!",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    });
});
